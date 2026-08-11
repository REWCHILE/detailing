<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\WafSetting;
use App\Models\WafBlockedIp;
use App\Models\WafLog;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WebApplicationFirewall
{
    /**
     * Known bot patterns to flag / scan.
     */
    private const EVIL_BOT_PATTERNS = [
        'sqlmap', 'nikto', 'dirbuster', 'gobuster', 'nmap', 'w3af', 'masscan', 
        'acunetix', 'havij', 'hydra', 'netsparker', 'owasp', 'zaproxy', 'nessus'
    ];

    private const GOOD_BOT_PATTERNS = [
        'googlebot', 'bingbot', 'slurp', 'duckduckbot', 'baidu',
        'yandex', 'sogou', 'exabot', 'facebot', 'ia_archiver', 'applebot'
    ];

    /**
     * Threat payloads definitions.
     */
    private const SQLI_REGEX = '/(union\s+select|select\s+.*\s+from|insert\s+into|update\s+.*\s+set|delete\s+from|drop\s+table|group\s+by\s+.*\s+having|--|#|\\b(or|and)\\b\s+[\'"]?\\d+[\'"]?\s*=\s*[\'"]?\\d+)/i';
    private const XSS_REGEX = '/(<script|javascript:|onerror\s*=|onload\s*=|onmouseover\s*=|<img\s+src|document\.cookie|window\.location)/i';
    private const PATH_TRAVERSAL_REGEX = '/(\.\.\/|\.\.\\\\|\/etc\/passwd|\/etc\/hosts|win\.ini|boot\.ini)/i';
    
    // Paths commonly targeted by malicious scanners
    private const SCANNER_PATHS = [
        'wp-admin', 'wp-content', 'wp-login.php', '.git', '.env', 'composer.lock', 
        'package.json', 'xmlrpc.php', 'config/database.php', 'phpinfo.php', 
        'shell.php', 'cmd.php', 'backup.sql', 'dump.sql', 'admin/phpmyadmin', 
        'phpmyadmin', 'config.php', 'setup.php', 'install.php', 'info.php'
    ];

    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $ip = $request->ip();

        // 1. Load Settings (cache for 5 minutes)
        $settings = Cache::remember('waf_settings', 300, function () {
            $settingsObj = WafSetting::firstOrCreate([
                'id' => 1
            ], [
                'waf_enabled' => true,
                'block_mode' => false, // Default to log-only detection mode
                'bot_protection' => true,
                'max_requests_per_minute' => 100
            ]);
            return $settingsObj->toArray();
        });

        if (!$settings['waf_enabled']) {
            return $next($request);
        }

        // 2. Check if IP is Whitelisted (cache query for 1 minute)
        $isWhitelisted = Cache::remember('waf_whitelisted_' . $ip, 60, function () use ($ip) {
            return \App\Models\WafWhitelistedIp::where('ip', $ip)->exists();
        });

        if ($isWhitelisted) {
            return $next($request);
        }

        // 3. Check if IP is Blocked (cache query for 1 minute)
        $isBlocked = Cache::remember('waf_blocked_' . $ip, 60, function () use ($ip) {
            return WafBlockedIp::where('ip', $ip)
                ->where(function ($query) {
                    $query->whereNull('expires_at')
                          ->orWhere('expires_at', '>', now());
                })
                ->exists();
        });

        if ($isBlocked) {
            return $this->renderBlockPage($ip, 'Bloqueado por detección automática del WAF / Historial de ataques.');
        }

        // 3. Inspect request for threats
        $threatScore = 0;
        $threatType = 'None';
        $isBot = false;
        $userAgent = $request->userAgent() ?? '';
        $uaLower = strtolower($userAgent);

        // Check if it's a generic bot
        foreach (self::GOOD_BOT_PATTERNS as $pattern) {
            if (str_contains($uaLower, $pattern)) {
                $isBot = true;
                break;
            }
        }

        // Check for evil bots (high score immediate flag)
        foreach (self::EVIL_BOT_PATTERNS as $pattern) {
            if (str_contains($uaLower, $pattern)) {
                $isBot = true;
                $threatScore += 50;
                $threatType = 'Evil Bot / Scanner';
                break;
            }
        }

        // Check suspicious target paths (Honeypot Trap URL Trigger - INCONDICIONAL)
        $path = $request->path();
        foreach (self::SCANNER_PATHS as $scannerPath) {
            if (str_contains(strtolower($path), $scannerPath)) {
                // Add to blacklist for 24h immediately
                WafBlockedIp::create([
                    'ip' => $ip,
                    'reason' => 'Gatillador WAF (Intento de acceso a: ' . $scannerPath . ')',
                    'blocked_at' => now(),
                    'expires_at' => now()->addHours(24)
                ]);

                // Clear WAF cache
                Cache::forget('waf_blocked_' . $ip);

                // Log in Database
                WafLog::create([
                    'ip' => $ip,
                    'url' => $request->fullUrl(),
                    'method' => $request->method(),
                    'user_agent' => substr($userAgent, 0, 500),
                    'payload' => substr($payloadString, 0, 1000),
                    'threat_type' => 'Honeypot Trap',
                    'threat_score' => 100,
                    'is_bot' => true,
                    'country' => 'Desconocido',
                    'status' => 'blocked'
                ]);

                return $this->renderBlockPage($ip, 'Acceso prohibido a dirección restringida: ' . $scannerPath);
            }
        }

        // Inspect payloads (GET query and POST inputs)
        $payloads = array_merge($request->query(), $request->input());
        $payloadString = json_encode($payloads, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

        if ($threatType === 'None') {
            if (preg_match(self::SQLI_REGEX, $payloadString)) {
                $threatScore += 40;
                $threatType = 'SQL Injection';
            } elseif (preg_match(self::XSS_REGEX, $payloadString)) {
                $threatScore += 40;
                $threatType = 'Cross-Site Scripting (XSS)';
            } elseif (preg_match(self::PATH_TRAVERSAL_REGEX, $payloadString)) {
                $threatScore += 50;
                $threatType = 'Path Traversal';
            }
        }

        // 4. If a threat is detected
        if ($threatScore >= 30) {
            $status = 'flagged';

            // Geolocation lookup cached for 24h
            $geo = Cache::remember('waf_geo_' . $ip, 86400, function () use ($ip) {
                return $this->geolocateIp($ip);
            });

            // Log event in database
            $log = WafLog::create([
                'ip' => $ip,
                'url' => $request->fullUrl(),
                'method' => $request->method(),
                'user_agent' => substr($userAgent, 0, 500),
                'payload' => substr($payloadString, 0, 1000),
                'threat_type' => $threatType,
                'threat_score' => $threatScore,
                'is_bot' => $isBot,
                'country' => $geo['country'] ?? 'Desconocido',
                'region' => $geo['region'] ?? null,
                'city' => $geo['city'] ?? null,
                'status' => 'allowed' // updated if blocked
            ]);

            // Block action if score >= 50 and blocking mode is enabled
            if ($threatScore >= 50 && $settings['block_mode']) {
                // Save IP to blocklist for 24h
                WafBlockedIp::create([
                    'ip' => $ip,
                    'reason' => 'Detección automática: ' . $threatType,
                    'blocked_at' => now(),
                    'expires_at' => now()->addHours(24)
                ]);

                // Clear WAF block cache to enforce block immediately
                Cache::forget('waf_blocked_' . $ip);

                // Update WafLog status
                $log->update(['status' => 'blocked']);

                return $this->renderBlockPage($ip, 'Intento de intrusión detectado: ' . $threatType);
            }
        }

        return $next($request);
    }

    /**
     * Geolocate an IP address using ip-api.com.
     */
    private function geolocateIp(string $ip): array
    {
        if (in_array($ip, ['127.0.0.1', '::1']) || str_starts_with($ip, '192.168.') || str_starts_with($ip, '10.')) {
            return [
                'country' => 'Local',
                'region' => 'Desarrollo',
                'city' => 'Localhost',
            ];
        }

        try {
            $response = Http::timeout(1.5)->get("http://ip-api.com/json/{$ip}", [
                'fields' => 'status,country,regionName,city',
                'lang' => 'es',
            ]);

            if ($response->successful()) {
                $data = $response->json();
                if (($data['status'] ?? '') === 'success') {
                    return [
                        'country' => $data['country'] ?? 'Desconocido',
                        'region' => $data['regionName'] ?? null,
                        'city' => $data['city'] ?? null,
                    ];
                }
            }
        } catch (\Exception $e) {
            Log::debug('[WAF] Geoloc lookup failed: ' . $e->getMessage());
        }

        return ['country' => 'Desconocido', 'region' => null, 'city' => null];
    }

    /**
     * Renders a premium, dark glassmorphic HTTP 403 Block Page.
     */
    private function renderBlockPage(string $ip, string $reason): Response
    {
        $html = <<<HTML
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso Denegado | Web Application Firewall</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;800&family=Inter:wght@400;500&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #050505;
        }
        .font-display {
            font-family: 'Outfit', sans-serif;
        }
        .glow {
            box-shadow: 0 0 80px 10px rgba(239, 68, 68, 0.15);
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen text-slate-100 p-6 overflow-hidden relative">
    <!-- Gradient Background glows -->
    <div class="absolute w-[500px] h-[500px] rounded-full bg-red-950/20 blur-[120px] top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 pointer-events-none"></div>

    <div class="relative w-full max-w-xl p-8 md:p-12 rounded-[2.5rem] bg-zinc-900/40 border border-red-500/20 backdrop-blur-xl glow text-center z-10">
        <!-- Shield Icon -->
        <div class="w-20 h-20 mx-auto mb-8 rounded-3xl bg-red-500/10 border border-red-500/20 flex items-center justify-center text-red-500 animate-pulse">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.57-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
            </svg>
        </div>

        <h1 class="font-display text-3xl md:text-4xl font-extrabold text-white tracking-tight mb-4 uppercase">
            Acceso <span class="text-red-500">Denegado</span>
        </h1>
        
        <p class="text-slate-400 text-sm md:text-base mb-8 leading-relaxed">
            Tu conexión ha sido bloqueada temporalmente por nuestro sistema de seguridad automática (WAF) debido al comportamiento sospechoso o solicitudes no autorizadas detectadas desde tu red.
        </p>

        <!-- Technical details box -->
        <div class="p-6 rounded-2xl bg-zinc-950/60 border border-white/5 text-left space-y-3 mb-8">
            <div class="flex justify-between items-center text-xs border-b border-white/5 pb-2">
                <span class="text-slate-500 font-semibold uppercase">Dirección IP</span>
                <span class="font-mono text-red-400 font-bold bg-red-500/10 px-2 py-0.5 rounded">{$ip}</span>
            </div>
            <div class="flex justify-between items-start text-xs pt-1">
                <span class="text-slate-500 font-semibold uppercase shrink-0">Motivo del Bloqueo</span>
                <span class="text-slate-300 font-medium text-right ml-4">{$reason}</span>
            </div>
        </div>

        <p class="text-[11px] text-slate-500">
            Si crees que esto es un error, por favor contacta al administrador de High Contrast Detailing Center.
        </p>
    </div>
</body>
</html>
HTML;

        return response($html, 403);
    }
}
