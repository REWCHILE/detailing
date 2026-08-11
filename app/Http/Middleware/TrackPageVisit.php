<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\PageVisit;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TrackPageVisit
{
    /**
     * Known page titles for friendly display in the admin panel.
     */
    private const PAGE_TITLES = [
        '/' => 'Inicio',
        '/nosotros' => 'Nosotros',
        '/reserva' => 'Cotizador / Reservas',
        '/limpieza-y-detallado' => 'Limpieza y Detallado',
        '/sellado-ceramico' => 'Sellado Cerámico',
        '/pulido-de-autos-santiago' => 'Pulido de Autos',
        '/proteccion-parabrisas-santiago' => 'Protección Parabrisas',
        '/detailing-interior' => 'Detailing Interior',
        '/tratamiento-ceramico' => 'Tratamiento Cerámico',
        '/restauracion-de-focos' => 'Restauración de Focos',
    ];

    /**
     * Bot user-agent patterns to exclude from tracking.
     */
    private const BOT_PATTERNS = [
        'googlebot', 'bingbot', 'slurp', 'duckduckbot', 'baidu',
        'yandex', 'sogou', 'exabot', 'facebot', 'ia_archiver',
        'semrush', 'ahrefs', 'mj12bot', 'dotbot', 'petalbot',
        'crawler', 'spider', 'bot/', 'headlesschrome',
        'curl', 'python', 'guzzle', 'axios', 'go-http-client',
        'postman', 'java/', 'winhttp', 'libwww', 'httpclient',
        'wget', 'scrapy', 'node-fetch', 'node-superagent', 'uptime', 'monitor'
    ];

    /**
     * Handle an incoming request — track the page visit.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Only track successful GET requests to HTML pages
        if (!$request->isMethod('GET') || $response->getStatusCode() >= 400) {
            return $response;
        }

        $path = '/' . ltrim($request->path(), '/');

        // Skip admin, API, auth, asset routes
        if ($this->shouldSkip($path, $request)) {
            return $response;
        }

        try {
            $ip = $request->ip();
            $ipHash = hash('sha256', $ip . config('app.key'));
            $userAgent = $request->userAgent() ?? '';

            // Determine page title
            $basePath = $path;
            if (preg_match('#^/reserva/.+#', $path)) {
                $basePath = '/reserva/{id}';
            }
            $pageTitle = self::PAGE_TITLES[$basePath] ?? self::PAGE_TITLES[$path] ?? ucfirst(trim(str_replace(['/', '-'], [' ', ' '], $path)));

            // Prepare visit data
            $visitData = [
                'page_path' => $path,
                'page_title' => $pageTitle,
                'ip_hash' => $ipHash,
                'user_agent' => Str::limit($userAgent, 500),
                'referer' => Str::limit($request->header('referer'), 1000),
                'visited_at' => now(),
            ];

            // Geolocate the IP (synchronous, ~100ms)
            $geoData = $this->geolocateIp($ip);
            if ($geoData) {
                $visitData = array_merge($visitData, $geoData);
            }

            PageVisit::create($visitData);

        } catch (\Exception $e) {
            // Never break the user experience for analytics
            Log::warning('[PageVisit] Tracking error: ' . $e->getMessage());
        }

        return $response;
    }

    /**
     * Determine if the request should be skipped.
     */
    private function shouldSkip(string $path, Request $request): bool
    {
        // Skip admin, API, auth, assets, storage paths
        $skipPrefixes = ['/admin', '/api/', '/login', '/register', '/logout', '/dashboard', '/profile',
                         '/forgot-password', '/reset-password', '/confirm-password', '/verify-email',
                         '/email/', '/password', '/up', '/_debugbar'];
        foreach ($skipPrefixes as $prefix) {
            if (str_starts_with($path, $prefix)) {
                return true;
            }
        }

        // Skip asset extensions
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        if (in_array(strtolower($ext), ['css', 'js', 'png', 'jpg', 'jpeg', 'gif', 'svg', 'ico', 'woff', 'woff2', 'ttf', 'map'])) {
            return true;
        }

        // Skip bots
        $ua = strtolower($request->userAgent() ?? '');
        foreach (self::BOT_PATTERNS as $pattern) {
            if (str_contains($ua, $pattern)) {
                return true;
            }
        }

        // Skip AJAX/JSON requests (they are API calls from frontend JS)
        if ($request->ajax() || $request->wantsJson()) {
            return true;
        }

        return false;
    }

    /**
     * Geolocate an IP address using ip-api.com (free, no API key, 45 req/min).
     */
    private function geolocateIp(string $ip): ?array
    {
        // Skip private/local IPs
        if (in_array($ip, ['127.0.0.1', '::1']) || str_starts_with($ip, '192.168.') || str_starts_with($ip, '10.')) {
            return [
                'country' => 'Local',
                'region' => 'Desarrollo',
                'city' => 'Localhost',
                'latitude' => -33.4489,
                'longitude' => -70.6693,
            ];
        }

        try {
            $response = Http::timeout(2)->get("http://ip-api.com/json/{$ip}", [
                'fields' => 'status,country,regionName,city,lat,lon',
                'lang' => 'es',
            ]);

            if ($response->successful()) {
                $data = $response->json();
                if (($data['status'] ?? '') === 'success') {
                    return [
                        'country' => $data['country'] ?? null,
                        'region' => $data['regionName'] ?? null,
                        'city' => $data['city'] ?? null,
                        'latitude' => $data['lat'] ?? null,
                        'longitude' => $data['lon'] ?? null,
                    ];
                }
            }
        } catch (\Exception $e) {
            // Geolocation is best-effort, don't fail the visit tracking
            Log::debug('[PageVisit] Geo lookup failed: ' . $e->getMessage());
        }

        return null;
    }
}
