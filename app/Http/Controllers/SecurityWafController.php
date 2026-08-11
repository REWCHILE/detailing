<?php

namespace App\Http\Controllers;

use App\Models\WafSetting;
use App\Models\WafBlockedIp;
use App\Models\WafLog;
use App\Models\BusinessProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SecurityWafController extends Controller
{
    /**
     * Display WAF dashboard and traffic audits.
     */
    public function index()
    {
        // 1. Get security settings
        $settings = WafSetting::firstOrCreate([
            'id' => 1
        ], [
            'waf_enabled' => true,
            'block_mode' => false,
            'bot_protection' => true,
            'max_requests_per_minute' => 100
        ]);

        // 2. Statistics summaries
        $totalBlockedToday = WafLog::where('status', 'blocked')
            ->where('created_at', '>=', now()->startOfDay())
            ->count();

        $totalThreatsAllTime = WafLog::where('threat_score', '>=', 30)->count();
        $totalBotsDetectedToday = WafLog::where('is_bot', true)
            ->where('created_at', '>=', now()->startOfDay())
            ->count();

        // 3. Active blocks, whitelist and logs
        $blockedIps = WafBlockedIp::orderBy('blocked_at', 'desc')->get();
        $whitelistedIps = \App\Models\WafWhitelistedIp::orderBy('created_at', 'desc')->get();
        $logs = WafLog::orderBy('created_at', 'desc')->take(100)->get();

        $currentUserIp = request()->ip();
        $currentUserIsWhitelisted = \App\Models\WafWhitelistedIp::where('ip', $currentUserIp)->exists();

        // 4. Data for charts
        // Threat distribution by type
        $threatDistribution = WafLog::where('threat_type', '!=', 'None')
            ->select('threat_type', DB::raw('count(*) as count'))
            ->groupBy('threat_type')
            ->pluck('count', 'threat_type')
            ->toArray();

        // allowed vs blocked
        $statusCounts = WafLog::select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        // bot vs human
        $botHumanCounts = WafLog::select('is_bot', DB::raw('count(*) as count'))
            ->groupBy('is_bot')
            ->pluck('count', 'is_bot')
            ->toArray();

        // Last 7 days threats trend
        $trendsData = WafLog::select(DB::raw("DATE(created_at) as date"), DB::raw('count(*) as count'))
            ->where('created_at', '>=', now()->subDays(7))
            ->groupBy(DB::raw("DATE(created_at)"))
            ->orderBy('date', 'asc')
            ->pluck('count', 'date')
            ->toArray();

        $shopProfile = BusinessProfile::first();

        return view('admin.seguridad', compact(
            'settings',
            'totalBlockedToday',
            'totalThreatsAllTime',
            'totalBotsDetectedToday',
            'blockedIps',
            'whitelistedIps',
            'currentUserIp',
            'currentUserIsWhitelisted',
            'logs',
            'threatDistribution',
            'statusCounts',
            'botHumanCounts',
            'trendsData',
            'shopProfile'
        ));
    }

    /**
     * Update security settings.
     */
    public function updateSettings(Request $request)
    {
        $request->validate([
            'max_requests_per_minute' => 'required|integer|min:10|max:1000',
        ]);

        $settings = WafSetting::firstOrCreate(['id' => 1]);
        $settings->update([
            'waf_enabled' => $request->boolean('waf_enabled'),
            'block_mode' => $request->boolean('block_mode'),
            'bot_protection' => $request->boolean('bot_protection'),
            'max_requests_per_minute' => $request->input('max_requests_per_minute'),
        ]);

        // Evict settings cache
        Cache::forget('waf_settings');

        return redirect()->back()->with('success', 'Configuración de seguridad actualizada correctamente.');
    }

    /**
     * Manually block an IP address.
     */
    public function blockIp(Request $request)
    {
        $request->validate([
            'ip' => 'required|ip',
            'reason' => 'nullable|string|max:255',
            'duration' => 'required|string',
        ]);

        $ip = $request->input('ip');
        $expiresAt = null;

        if ($request->input('duration') === '1h') {
            $expiresAt = now()->addHour();
        } elseif ($request->input('duration') === '24h') {
            $expiresAt = now()->addDay();
        } elseif ($request->input('duration') === '7d') {
            $expiresAt = now()->addWeek();
        }

        WafBlockedIp::updateOrCreate(
            ['ip' => $ip],
            [
                'reason' => $request->input('reason') ?? 'Bloqueo manual administrativo',
                'blocked_at' => now(),
                'expires_at' => $expiresAt
            ]
        );

        // Evict WAF block cache
        Cache::forget('waf_blocked_' . $ip);

        return redirect()->back()->with('success', "La dirección IP {$ip} ha sido bloqueada correctamente.");
    }

    /**
     * Unblock an IP address.
     */
    public function unblockIp($id)
    {
        $blockedIp = WafBlockedIp::findOrFail($id);
        $ip = $blockedIp->ip;
        
        $blockedIp->delete();

        // Evict WAF block cache
        Cache::forget('waf_blocked_' . $ip);

        return redirect()->back()->with('success', "La dirección IP {$ip} ha sido desbloqueada correctamente.");
    }

    /**
     * Add an IP address to the whitelist.
     */
    public function whitelistIp(Request $request)
    {
        $request->validate([
            'ip' => 'required|ip',
            'reason' => 'nullable|string|max:255',
        ]);

        $ip = $request->input('ip');

        \App\Models\WafWhitelistedIp::updateOrCreate(
            ['ip' => $ip],
            ['reason' => $request->input('reason') ?? 'Lista blanca administrativa']
        );

        // Delete from blocked IPs if exists
        WafBlockedIp::where('ip', $ip)->delete();

        // Evict WAF caches
        Cache::forget('waf_whitelisted_' . $ip);
        Cache::forget('waf_blocked_' . $ip);

        return redirect()->back()->with('success', "La dirección IP {$ip} ha sido agregada a la lista blanca.");
    }

    /**
     * Remove an IP address from the whitelist.
     */
    public function unwhitelistIp($id)
    {
        $whitelistedIp = \App\Models\WafWhitelistedIp::findOrFail($id);
        $ip = $whitelistedIp->ip;
        
        $whitelistedIp->delete();

        // Evict WAF cache
        Cache::forget('waf_whitelisted_' . $ip);

        return redirect()->back()->with('success', "La dirección IP {$ip} ha sido removida de la lista blanca.");
    }

    /**
     * Clear security logs table.
     */
    public function clearLogs()
    {
        WafLog::query()->delete();
        return redirect()->back()->with('success', 'Historial de auditoría de seguridad limpiado correctamente.');
    }
}
