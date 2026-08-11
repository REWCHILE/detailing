@extends('layouts.admin')

@section('title', 'Seguridad & WAF | High Contrast Detailing')
@section('title_section', 'Seguridad y Cortafuegos')

@section('content')
<div class="space-y-8" x-data="{ activeTab: 'dashboard' }">
    @if(session('success'))
        <div class="rounded-xl border border-green-500/20 bg-green-500/10 p-4 text-sm text-green-600 dark:text-green-400">
            {{ session('success') }}
        </div>
    @endif

    <!-- Tabs Navigation -->
    <div class="flex border-b border-black/5 dark:border-white/5 gap-2">
        <button 
            @click="activeTab = 'dashboard'" 
            :class="activeTab === 'dashboard' ? 'border-brand text-brand font-bold' : 'border-transparent text-black/50 dark:text-white/40 font-medium hover:text-brand'" 
            class="px-5 py-3 border-b-2 text-sm transition-all outline-none"
        >
            Panel General
        </button>
        <button 
            @click="activeTab = 'logs'" 
            :class="activeTab === 'logs' ? 'border-brand text-brand font-bold' : 'border-transparent text-black/50 dark:text-white/40 font-medium hover:text-brand'" 
            class="px-5 py-3 border-b-2 text-sm transition-all outline-none"
        >
            Auditoría de Tráfico ({{ count($logs) }})
        </button>
        <button 
            @click="activeTab = 'blacklist'" 
            :class="activeTab === 'blacklist' ? 'border-brand text-brand font-bold' : 'border-transparent text-black/50 dark:text-white/40 font-medium hover:text-brand'" 
            class="px-5 py-3 border-b-2 text-sm transition-all outline-none"
        >
            Lista Negra IP ({{ count($blockedIps) }})
        </button>
        <button 
            @click="activeTab = 'whitelist'" 
            :class="activeTab === 'whitelist' ? 'border-brand text-brand font-bold' : 'border-transparent text-black/50 dark:text-white/40 font-medium hover:text-brand'" 
            class="px-5 py-3 border-b-2 text-sm transition-all outline-none"
        >
            Lista Blanca IP ({{ count($whitelistedIps) }})
        </button>
        <button 
            @click="activeTab = 'config'" 
            :class="activeTab === 'config' ? 'border-brand text-brand font-bold' : 'border-transparent text-black/50 dark:text-white/40 font-medium hover:text-brand'" 
            class="px-5 py-3 border-b-2 text-sm transition-all outline-none"
        >
            Configuración del WAF
        </button>
    </div>

    <!-- TAB 1: DASHBOARD -->
    <div x-show="activeTab === 'dashboard'" class="space-y-8">
        <!-- Stats Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Stat Card 1 -->
            <div class="p-6 rounded-2xl border border-black/5 dark:border-white/5 shadow-sm premium-card">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-10 h-10 rounded-xl bg-red-500/10 flex items-center justify-center text-red-500 stat-icon transition-all duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m0-10.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.75c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.57-.598-3.75h-.152c-3.196 0-6.1-1.249-8.25-3.286z" />
                        </svg>
                    </div>
                </div>
                <p class="text-black/40 dark:text-white/40 text-sm mb-1 font-medium">Bloqueos de IP hoy</p>
                <p class="font-display text-3xl font-extrabold text-black dark:text-white">{{ $totalBlockedToday }}</p>
            </div>

            <!-- Stat Card 2 -->
            <div class="p-6 rounded-2xl border border-black/5 dark:border-white/5 shadow-sm premium-card">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-10 h-10 rounded-xl bg-yellow-500/10 flex items-center justify-center text-yellow-500 dark:text-yellow-400 stat-icon transition-all duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                </div>
                <p class="text-black/40 dark:text-white/40 text-sm mb-1 font-medium">Amenazas totales auditadas</p>
                <p class="font-display text-3xl font-extrabold text-black dark:text-white">{{ $totalThreatsAllTime }}</p>
            </div>

            <!-- Stat Card 3 -->
            <div class="p-6 rounded-2xl border border-black/5 dark:border-white/5 shadow-sm premium-card">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-10 h-10 rounded-xl bg-blue-500/10 flex items-center justify-center text-blue-500 stat-icon transition-all duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 17.25v1.007a3 3 0 01-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0115 18.257V17.25m6-12V15a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 15V5.25m18 0A2.25 2.25 0 0018.75 3H5.25A2.25 2.25 0 003 5.25m18 0V12a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 12V5.25" />
                        </svg>
                    </div>
                </div>
                <p class="text-black/40 dark:text-white/40 text-sm mb-1 font-medium">Bots detectados hoy</p>
                <p class="font-display text-3xl font-extrabold text-black dark:text-white">{{ $totalBotsDetectedToday }}</p>
            </div>

            <!-- Stat Card 4 -->
            <div class="p-6 rounded-2xl border border-black/5 dark:border-white/5 shadow-sm premium-card">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-10 h-10 rounded-xl bg-green-500/10 flex items-center justify-center text-green-500 stat-icon transition-all duration-300">
                        @if($settings->waf_enabled)
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.75c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.57-.598-3.75h-.152c-3.196 0-6.1-1.249-8.25-3.286z" />
                            </svg>
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-red-500">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m0-10.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.75c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.57-.598-3.75h-.152c-3.196 0-6.1-1.249-8.25-3.286z" />
                            </svg>
                        @endif
                    </div>
                </div>
                <p class="text-black/40 dark:text-white/40 text-sm mb-1 font-medium">Estado del Escudo</p>
                <p class="font-display text-xl font-extrabold {{ $settings->waf_enabled ? 'text-green-500' : 'text-red-500' }}">
                    {{ $settings->waf_enabled ? ($settings->block_mode ? 'Cortafuegos Activo' : 'Detección Pasiva') : 'Apagado' }}
                </p>
            </div>
        </div>

        <!-- Charts Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Line Chart (Trend) -->
            <div class="lg:col-span-2 p-6 rounded-2xl border border-black/5 dark:border-white/5 bg-white dark:bg-[#111111]/45 backdrop-blur-xl shadow-sm">
                <h3 class="font-display font-bold text-sm text-black/85 dark:text-white mb-6 uppercase tracking-wider">Tendencia de Amenazas (Últimos 7 Días)</h3>
                <div class="h-80 relative">
                    <canvas id="trendChart"></canvas>
                </div>
            </div>

            <!-- Donut Charts -->
            <div class="p-6 rounded-2xl border border-black/5 dark:border-white/5 bg-white dark:bg-[#111111]/45 backdrop-blur-xl shadow-sm flex flex-col justify-between">
                <h3 class="font-display font-bold text-sm text-black/85 dark:text-white mb-6 uppercase tracking-wider">Distribución de Amenazas</h3>
                <div class="h-60 relative flex items-center justify-center">
                    @if(count($threatDistribution) > 0)
                        <canvas id="threatChart"></canvas>
                    @else
                        <p class="text-xs text-black/40 dark:text-white/40 font-medium">No se han registrado amenazas suficientes para graficar.</p>
                    @endif
                </div>
                <div class="mt-4 pt-4 border-t border-black/5 dark:border-white/5 flex justify-around text-center">
                    <div>
                        <span class="block text-[10px] uppercase font-bold text-black/40 dark:text-white/40">Humano</span>
                        <span class="text-lg font-extrabold text-brand">{{ $botHumanCounts[0] ?? 0 }}</span>
                    </div>
                    <div class="border-l border-black/5 dark:border-white/5 h-8"></div>
                    <div>
                        <span class="block text-[10px] uppercase font-bold text-black/40 dark:text-white/40">Bot</span>
                        <span class="text-lg font-extrabold text-blue-500">{{ $botHumanCounts[1] ?? 0 }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Logs Table Preview -->
        <div class="space-y-4">
            <div class="flex items-center justify-between">
                <h2 class="font-display text-lg font-bold text-black dark:text-white">Últimos incidentes registrados</h2>
                <button @click="activeTab = 'logs'" class="text-brand text-sm font-semibold hover:text-brand-light transition-colors">
                    Ver todos
                </button>
            </div>
            <div class="rounded-2xl border border-black/5 dark:border-white/5 overflow-hidden shadow-sm premium-card">
                <div class="overflow-x-auto">
                    <table class="w-full text-left premium-table text-xs">
                        <thead>
                            <tr class="bg-black/[0.02] dark:bg-white/[0.02] border-b border-black/5 dark:border-white/5 text-[10px] uppercase font-bold tracking-wider text-black/40 dark:text-white/40">
                                <th class="p-4">Fecha/Hora</th>
                                <th class="p-4">IP</th>
                                <th class="p-4">Ubicación</th>
                                <th class="p-4">URL</th>
                                <th class="p-4">Amenaza</th>
                                <th class="p-4">Score</th>
                                <th class="p-4 text-right">Estado</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-black/5 dark:divide-white/5">
                            @forelse($logs->take(5) as $log)
                                <tr class="text-black/80 dark:text-white/80">
                                    <td class="p-4 font-mono">{{ $log->created_at->format('d/m H:i:s') }}</td>
                                    <td class="p-4 font-mono font-bold">{{ $log->ip }}</td>
                                    <td class="p-4">
                                        <span class="font-semibold">{{ $log->country }}</span>
                                        @if($log->city)
                                            <span class="text-[10px] text-black/40 dark:text-white/40 block">{{ $log->city }}</span>
                                        @endif
                                    </td>
                                    <td class="p-4 font-mono max-w-[200px] truncate" title="{{ $log->url }}">
                                        <span class="text-[10px] px-1.5 py-0.5 rounded bg-black/5 dark:bg-white/5 text-black/60 dark:text-white/60 font-bold mr-1">{{ $log->method }}</span>
                                        {{ parse_url($log->url, PHP_URL_PATH) }}
                                    </td>
                                    <td class="p-4 font-semibold text-red-500 dark:text-red-400">{{ $log->threat_type }}</td>
                                    <td class="p-4">
                                        <span class="font-bold px-2 py-0.5 rounded-full {{ $log->threat_score >= 50 ? 'bg-red-500/10 text-red-500' : 'bg-yellow-500/10 text-yellow-500' }}">
                                            {{ $log->threat_score }}
                                        </span>
                                    </td>
                                    <td class="p-4 text-right flex items-center justify-end gap-2">
                                        <span class="inline-block px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider {{ $log->status === 'blocked' ? 'bg-red-500/10 text-red-500 border border-red-500/20' : 'bg-green-500/10 text-green-500 border border-green-500/20' }}">
                                            {{ $log->status === 'blocked' ? 'Bloqueado' : 'Permitido' }}
                                        </span>
                                        @if($log->status !== 'blocked')
                                            <form method="POST" action="{{ route('admin.seguridad.block') }}" class="inline-block">
                                                @csrf
                                                <input type="hidden" name="ip" value="{{ $log->ip }}">
                                                <input type="hidden" name="reason" value="Auditoría: {{ $log->threat_type }}">
                                                <input type="hidden" name="duration" value="24h">
                                                <button type="submit" class="text-xs bg-red-600 hover:bg-red-700 text-white font-semibold px-2.5 py-1 rounded-lg shadow-sm transition-all text-center">
                                                    Bloquear
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="p-8 text-center text-black/40 dark:text-white/40 font-medium">Ningún ataque o bot sospechoso registrado en el sistema.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- TAB 2: AUDITORIA DE TRAFICO -->
    <div x-show="activeTab === 'logs'" class="space-y-4" style="display: none;">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="font-display font-bold text-lg text-black dark:text-white">Auditoría en Vivo</h3>
                <p class="text-xs text-black/40 dark:text-white/40">Visualiza los intentos de ataque, bots escaneadores e IPs sospechosas auditadas por el cortafuegos.</p>
            </div>
            @if(count($logs) > 0)
                <form method="POST" action="{{ route('admin.seguridad.clear-logs') }}">
                    @csrf
                    <button type="submit" class="rounded-xl border border-red-500/25 bg-red-500/12 px-4 py-2.5 text-xs font-semibold text-red-600 dark:text-red-400 hover:bg-red-500/20 transition-all shadow-md">
                        Limpiar Historial
                    </button>
                </form>
            @endif
        </div>

        <div class="rounded-2xl border border-black/5 dark:border-white/5 overflow-hidden shadow-sm premium-card">
            <div class="overflow-x-auto">
                <table class="w-full text-left premium-table text-xs">
                    <thead>
                        <tr class="bg-black/[0.02] dark:bg-white/[0.02] border-b border-black/5 dark:border-white/5 text-[10px] uppercase font-bold tracking-wider text-black/40 dark:text-white/40">
                            <th class="p-4">Fecha/Hora</th>
                            <th class="p-4">IP</th>
                            <th class="p-4">Ubicación</th>
                            <th class="p-4">Navegador / Dispositivo</th>
                            <th class="p-4">Petición</th>
                            <th class="p-4">Amenaza</th>
                            <th class="p-4">Payload sospechoso</th>
                            <th class="p-4 text-right">Estado</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-black/5 dark:divide-white/5">
                        @forelse($logs as $log)
                            <tr class="text-black/80 dark:text-white/80 align-top">
                                <td class="p-4 font-mono whitespace-nowrap">{{ $log->created_at->format('d/m/Y H:i:s') }}</td>
                                <td class="p-4 font-mono font-bold whitespace-nowrap">
                                    {{ $log->ip }}
                                    <span class="block text-[9px] font-semibold tracking-wider uppercase mt-1 px-1.5 py-0.5 rounded w-max {{ $log->is_bot ? 'bg-blue-500/10 text-blue-500' : 'bg-brand/10 text-brand' }}">
                                        {{ $log->is_bot ? 'Bot' : 'Humano' }}
                                    </span>
                                </td>
                                <td class="p-4">
                                    <span class="font-semibold block">{{ $log->country }}</span>
                                    <span class="text-[10px] text-black/40 dark:text-white/40 block">{{ $log->city ?? $log->region ?? 'Local' }}</span>
                                </td>
                                <td class="p-4 max-w-[180px] truncate" title="{{ $log->user_agent }}">
                                    {{ $log->user_agent }}
                                </td>
                                <td class="p-4 font-mono max-w-[200px] break-all">
                                    <span class="text-[10px] px-1.5 py-0.5 rounded bg-black/5 dark:bg-white/5 text-black/60 dark:text-white/60 font-bold mr-1">{{ $log->method }}</span>
                                    <span class="text-xs font-semibold block text-black dark:text-white mt-1">{{ parse_url($log->url, PHP_URL_PATH) }}</span>
                                    @if(parse_url($log->url, PHP_URL_QUERY))
                                        <span class="text-[10px] text-black/40 dark:text-white/40 font-mono block break-all">?{{ parse_url($log->url, PHP_URL_QUERY) }}</span>
                                    @endif
                                </td>
                                <td class="p-4">
                                    <span class="font-semibold text-red-500 dark:text-red-400 block">{{ $log->threat_type }}</span>
                                    <span class="text-[9px] text-black/40 dark:text-white/40 font-medium">Score: {{ $log->threat_score }}/100</span>
                                </td>
                                <td class="p-4 max-w-[250px] font-mono text-[10px] bg-black/5 dark:bg-white/5 break-all text-slate-500 overflow-x-auto">
                                    {{ $log->payload ?? 'Sin datos' }}
                                </td>
                                <td class="p-4 text-right whitespace-nowrap flex items-center justify-end gap-2">
                                    <span class="inline-block px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider {{ $log->status === 'blocked' ? 'bg-red-500/10 text-red-500 border border-red-500/20' : 'bg-green-500/10 text-green-500 border border-green-500/20' }}">
                                        {{ $log->status === 'blocked' ? 'Bloqueado' : 'Permitido' }}
                                    </span>
                                    @if($log->status !== 'blocked')
                                        <form method="POST" action="{{ route('admin.seguridad.block') }}" class="inline-block">
                                            @csrf
                                            <input type="hidden" name="ip" value="{{ $log->ip }}">
                                            <input type="hidden" name="reason" value="Auditoría: {{ $log->threat_type }}">
                                            <input type="hidden" name="duration" value="24h">
                                            <button type="submit" class="text-xs bg-red-600 hover:bg-red-700 text-white font-semibold px-2.5 py-1 rounded-lg shadow-sm transition-all text-center">
                                                Bloquear
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="p-8 text-center text-black/40 dark:text-white/40 font-medium">Ningún ataque o bot sospechoso registrado en el sistema.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- TAB 3: BLACKLIST IP -->
    <div x-show="activeTab === 'blacklist'" class="grid grid-cols-1 lg:grid-cols-3 gap-8" style="display: none;">
        <!-- Left Column: Block IP form -->
        <div class="lg:col-span-1 space-y-6">
            <div class="rounded-2xl border border-black/5 dark:border-white/5 bg-white dark:bg-[#111111]/45 p-6 shadow-sm backdrop-blur-xl">
                <div class="flex items-center gap-3 mb-6 border-b border-black/5 dark:border-white/5 pb-4">
                    <div class="w-10 h-10 rounded-xl bg-red-500/10 flex items-center justify-center text-red-500">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-display font-bold text-lg text-black dark:text-white">Bloqueo Preventivo</h3>
                        <p class="text-xs text-black/40 dark:text-white/40">Bloquea de forma manual cualquier dirección IP sospechosa de inmediato.</p>
                    </div>
                </div>

                <form method="POST" action="{{ route('admin.seguridad.block') }}" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-xs uppercase text-black/55 dark:text-white/50 font-bold mb-1.5">Dirección IP</label>
                        <input type="text" name="ip" placeholder="ej. 186.20.144.92" required class="w-full rounded-xl border border-black/10 dark:border-white/10 bg-white dark:bg-[#111111] px-4 py-2.5 text-sm text-black dark:text-white outline-none focus:border-brand">
                    </div>
                    <div>
                        <label class="block text-xs uppercase text-black/55 dark:text-white/50 font-bold mb-1.5">Razón del Bloqueo</label>
                        <input type="text" name="reason" placeholder="ej. Spam constante / fuerza bruta" class="w-full rounded-xl border border-black/10 dark:border-white/10 bg-white dark:bg-[#111111] px-4 py-2.5 text-sm text-black dark:text-white outline-none focus:border-brand">
                    </div>
                    <div>
                        <label class="block text-xs uppercase text-black/55 dark:text-white/50 font-bold mb-1.5">Duración</label>
                        <select name="duration" class="w-full rounded-xl border border-black/10 dark:border-white/10 bg-white dark:bg-[#111111] px-4 py-2.5 text-sm text-black dark:text-white outline-none focus:border-brand">
                            <option value="1h">1 Hora</option>
                            <option value="24h" selected>24 Horas (1 Día)</option>
                            <option value="7d">7 Días (1 Semana)</option>
                            <option value="permanent">Permanente (Sin expiración)</option>
                        </select>
                    </div>
                    <button type="submit" class="w-full rounded-xl bg-red-600 hover:bg-red-700 text-white py-3 text-sm font-semibold shadow-md transition-all">
                        Bloquear Dirección IP
                    </button>
                </form>
            </div>
        </div>

        <!-- Right Column: Blacklist table -->
        <div class="lg:col-span-2 space-y-4">
            <h3 class="font-display font-bold text-lg text-black dark:text-white">IPs Bloqueadas Actualmente</h3>
            <div class="rounded-2xl border border-black/5 dark:border-white/5 overflow-hidden shadow-sm premium-card">
                <div class="overflow-x-auto">
                    <table class="w-full text-left premium-table text-xs">
                        <thead>
                            <tr class="bg-black/[0.02] dark:bg-white/[0.02] border-b border-black/5 dark:border-white/5 text-[10px] uppercase font-bold tracking-wider text-black/40 dark:text-white/40">
                                <th class="p-4">Dirección IP</th>
                                <th class="p-4">Razón</th>
                                <th class="p-4">Fecha Bloqueo</th>
                                <th class="p-4">Expira en</th>
                                <th class="p-4 text-right">Acción</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-black/5 dark:divide-white/5">
                            @forelse($blockedIps as $blocked)
                                <tr class="text-black/80 dark:text-white/80">
                                    <td class="p-4 font-mono font-bold">{{ $blocked->ip }}</td>
                                    <td class="p-4 font-medium">{{ $blocked->reason }}</td>
                                    <td class="p-4">{{ $blocked->blocked_at->format('d/m/Y H:i') }}</td>
                                    <td class="p-4">
                                        @if($blocked->expires_at)
                                            @if($blocked->expires_at->isPast())
                                                <span class="text-red-500 font-bold">Expirado</span>
                                            @else
                                                <span class="text-slate-600 dark:text-slate-400 font-semibold">{{ $blocked->expires_at->diffForHumans() }}</span>
                                            @endif
                                        @else
                                            <span class="text-red-500/80 font-bold uppercase tracking-wider text-[9px] px-2 py-0.5 rounded bg-red-500/10">Permanente</span>
                                        @endif
                                    </td>
                                    <td class="p-4 text-right">
                                        <form method="POST" action="{{ route('admin.seguridad.unblock', $blocked->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-brand font-bold hover:text-brand-light transition-colors">
                                                Desbloquear
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="p-8 text-center text-black/40 dark:text-white/40 font-medium">No hay ninguna IP en la lista negra.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- TAB: LISTA BLANCA IP -->
    <div x-show="activeTab === 'whitelist'" class="grid grid-cols-1 lg:grid-cols-3 gap-8" style="display: none;">
        <!-- Left Column: Add Whitelist form -->
        <div class="lg:col-span-1 space-y-6">
            <div class="rounded-2xl border border-black/5 dark:border-white/5 bg-white dark:bg-[#111111]/45 p-6 shadow-sm backdrop-blur-xl">
                <div class="flex items-center gap-3 mb-6 border-b border-black/5 dark:border-white/5 pb-4">
                    <div class="w-10 h-10 rounded-xl bg-green-500/10 flex items-center justify-center text-green-500">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.746 3.746 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-display font-bold text-lg text-black dark:text-white">Lista Blanca</h3>
                        <p class="text-xs text-black/40 dark:text-white/40">Evita que tu IP sea bloqueada por el cortafuegos accidentalmente.</p>
                    </div>
                </div>

                <!-- Detect current IP -->
                <div class="p-4 rounded-xl border border-blue-500/20 bg-blue-500/5 mb-6 text-xs">
                    <span class="text-slate-500 font-semibold block uppercase mb-1">Tu Dirección IP Actual</span>
                    <span class="font-mono text-blue-500 dark:text-blue-400 font-bold bg-blue-500/10 px-2 py-0.5 rounded text-sm">{{ $currentUserIp }}</span>
                    @if($currentUserIsWhitelisted)
                        <span class="block text-green-500 font-bold mt-2">✓ Ya estás en la lista blanca</span>
                    @else
                        <form method="POST" action="{{ route('admin.seguridad.whitelist') }}" class="mt-3">
                            @csrf
                            <input type="hidden" name="ip" value="{{ $currentUserIp }}">
                            <input type="hidden" name="reason" value="IP del Administrador (Detectado)">
                            <button type="submit" class="w-full rounded-lg bg-blue-600 hover:bg-blue-700 text-white py-2 text-xs font-semibold shadow transition-all">
                                Agregar mi IP a Lista Blanca
                            </button>
                        </form>
                    @endif
                </div>

                <form method="POST" action="{{ route('admin.seguridad.whitelist') }}" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-xs uppercase text-black/55 dark:text-white/50 font-bold mb-1.5">Dirección IP a agregar</label>
                        <input type="text" name="ip" placeholder="ej. 190.160.10.22" required class="w-full rounded-xl border border-black/10 dark:border-white/10 bg-white dark:bg-[#111111] px-4 py-2.5 text-sm text-black dark:text-white outline-none focus:border-brand">
                    </div>
                    <div>
                        <label class="block text-xs uppercase text-black/55 dark:text-white/50 font-bold mb-1.5">Razón / Nombre</label>
                        <input type="text" name="reason" placeholder="ej. Oficina / Computadora Desarrollador" class="w-full rounded-xl border border-black/10 dark:border-white/10 bg-white dark:bg-[#111111] px-4 py-2.5 text-sm text-black dark:text-white outline-none focus:border-brand">
                    </div>
                    <button type="submit" class="w-full rounded-xl bg-green-600 hover:bg-green-700 text-white py-3 text-sm font-semibold shadow-md transition-all">
                        Agregar a Lista Blanca
                    </button>
                </form>
            </div>
        </div>

        <!-- Right Column: Whitelist table -->
        <div class="lg:col-span-2 space-y-4">
            <h3 class="font-display font-bold text-lg text-black dark:text-white">IPs en Lista Blanca</h3>
            <div class="rounded-2xl border border-black/5 dark:border-white/5 overflow-hidden shadow-sm premium-card">
                <div class="overflow-x-auto">
                    <table class="w-full text-left premium-table text-xs">
                        <thead>
                            <tr class="bg-black/[0.02] dark:bg-white/[0.02] border-b border-black/5 dark:border-white/5 text-[10px] uppercase font-bold tracking-wider text-black/40 dark:text-white/40">
                                <th class="p-4">Dirección IP</th>
                                <th class="p-4">Razón / Identificador</th>
                                <th class="p-4">Fecha Agregado</th>
                                <th class="p-4 text-right">Acción</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-black/5 dark:divide-white/5">
                            @forelse($whitelistedIps as $white)
                                <tr class="text-black/80 dark:text-white/80">
                                    <td class="p-4 font-mono font-bold">{{ $white->ip }}</td>
                                    <td class="p-4 font-medium">{{ $white->reason }}</td>
                                    <td class="p-4">{{ $white->created_at->format('d/m/Y H:i') }}</td>
                                    <td class="p-4 text-right">
                                        <form method="POST" action="{{ route('admin.seguridad.unwhitelist', $white->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-brand font-bold hover:text-brand-light transition-colors">
                                                Eliminar
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="p-8 text-center text-black/40 dark:text-white/40 font-medium">No hay ninguna IP en la lista blanca.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- TAB 4: CONFIGURACION -->
    <div x-show="activeTab === 'config'" class="max-w-3xl space-y-6" style="display: none;">
        <div class="rounded-2xl border border-black/5 dark:border-white/5 bg-white dark:bg-[#111111]/45 p-6 md:p-8 shadow-sm backdrop-blur-xl">
            <div class="flex items-center gap-3 mb-6 border-b border-black/5 dark:border-white/5 pb-4">
                <div class="w-10 h-10 rounded-xl bg-brand/10 flex items-center justify-center text-brand">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" /><circle cx="12" cy="12" r="3" />
                    </svg>
                </div>
                <div>
                    <h3 class="font-display font-bold text-lg text-black dark:text-white">Motor de Cortafuegos WAF</h3>
                    <p class="text-xs text-black/40 dark:text-white/40">Configura las sensibilidades y reglas generales de seguridad del cortafuegos de la aplicación.</p>
                </div>
            </div>

            <form method="POST" action="{{ route('admin.seguridad.settings') }}" class="space-y-6">
                @csrf

                <!-- Toggle WAF Enabled -->
                <label class="flex items-start gap-3 rounded-xl border border-black/5 dark:border-white/5 bg-black/[0.01] dark:bg-surface/20 p-4 select-none cursor-pointer">
                    <input type="checkbox" name="waf_enabled" value="1" {{ $settings->waf_enabled ? 'checked' : '' }} class="rounded border-black/10 dark:border-white/10 text-brand focus:ring-brand mt-1">
                    <div>
                        <span class="block text-sm font-semibold text-black dark:text-white">Habilitar Web Application Firewall</span>
                        <span class="block text-xs text-black/50 dark:text-white/40 mt-1">Al activar esta opción, el WAF inspeccionará activamente cada solicitud al servidor web para detectar e identificar amenazas de seguridad comunes.</span>
                    </div>
                </label>

                <!-- Toggle Blocking mode -->
                <label class="flex items-start gap-3 rounded-xl border border-black/5 dark:border-white/5 bg-black/[0.01] dark:bg-surface/20 p-4 select-none cursor-pointer">
                    <input type="checkbox" name="block_mode" value="1" {{ $settings->block_mode ? 'checked' : '' }} class="rounded border-black/10 dark:border-white/10 text-brand focus:ring-brand mt-1">
                    <div>
                        <span class="block text-sm font-semibold text-black dark:text-white">Habilitar Modo Bloqueo Activo</span>
                        <span class="block text-xs text-black/50 dark:text-white/40 mt-1">Si está desmarcado, el WAF opera en modo auditoría (solo registra e identifica los ataques sin interrumpir al visitante). Al activarlo, el cortafuegos bloqueará de forma autónoma con un error 403 a las IPs atacantes.</span>
                    </div>
                </label>

                <!-- Toggle Bot Protection -->
                <label class="flex items-start gap-3 rounded-xl border border-black/5 dark:border-white/5 bg-black/[0.01] dark:bg-surface/20 p-4 select-none cursor-pointer">
                    <input type="checkbox" name="bot_protection" value="1" {{ $settings->bot_protection ? 'checked' : '' }} class="rounded border-black/10 dark:border-white/10 text-brand focus:ring-brand mt-1">
                    <div>
                        <span class="block text-sm font-semibold text-black dark:text-white">Bloqueo de Scanners y Evil Bots</span>
                        <span class="block text-xs text-black/50 dark:text-white/40 mt-1">Detecta, audita e identifica herramientas maliciosas automatizadas (como sqlmap, nmap, nikto) y bloquea sus escaneos de vulnerabilidades de inmediato.</span>
                    </div>
                </label>

                <!-- Rate Limit settings -->
                <div>
                    <label class="block text-xs uppercase text-black/55 dark:text-white/50 font-bold mb-1.5">Límite de Peticiones por Minuto</label>
                    <input type="number" name="max_requests_per_minute" value="{{ $settings->max_requests_per_minute }}" class="w-full rounded-xl border border-black/10 dark:border-white/10 bg-white dark:bg-[#111111] px-4 py-2.5 text-sm text-black dark:text-white outline-none focus:border-brand">
                    <p class="text-[11px] text-black/40 dark:text-white/30 mt-1">Límite de solicitudes máximas por dirección IP antes de ser auditado. Rango sugerido: 60 - 200.</p>
                </div>

                <div class="pt-4 border-t border-black/5 dark:border-white/5 text-right">
                    <button type="submit" class="rounded-xl bg-brand hover:bg-brand-dark text-white px-8 py-3 text-sm font-semibold shadow-md transition-all">
                        Guardar Configuración
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Load Chart.js and render graphs -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const isDark = document.documentElement.classList.contains('dark');
        const textColor = isDark ? '#94a3b8' : '#64748b';
        const gridColor = isDark ? 'rgba(255,255,255,0.05)' : 'rgba(0,0,0,0.05)';

        // 1. Trend Line Chart
        const trendCtx = document.getElementById('trendChart').getContext('2d');
        const trendData = {!! json_encode(array_values($trendsData)) !!};
        const trendLabels = {!! json_encode(array_keys($trendsData)) !!};

        new Chart(trendCtx, {
            type: 'line',
            data: {
                labels: trendLabels.map(d => {
                    const date = new Date(d);
                    return date.toLocaleDateString('es-ES', { day: '2-digit', month: 'short' });
                }),
                datasets: [{
                    label: 'Ataques/Amenazas',
                    data: trendData,
                    borderColor: '#E8508A',
                    backgroundColor: 'rgba(232, 80, 138, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    x: {
                        grid: { display: false },
                        ticks: { color: textColor }
                    },
                    y: {
                        grid: { color: gridColor },
                        ticks: { color: textColor, precision: 0 }
                    }
                }
            }
        });

        // 2. Threat distribution Donut
        @if(count($threatDistribution) > 0)
            const threatCtx = document.getElementById('threatChart').getContext('2d');
            const threatLabels = {!! json_encode(array_keys($threatDistribution)) !!};
            const threatData = {!! json_encode(array_values($threatDistribution)) !!};

            new Chart(threatCtx, {
                type: 'doughnut',
                data: {
                    labels: threatLabels,
                    datasets: [{
                        data: threatData,
                        backgroundColor: ['#ef4444', '#f59e0b', '#3b82f6', '#10b981', '#8b5cf6', '#ec4899'],
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                color: textColor,
                                boxWidth: 10,
                                font: { size: 9 }
                            }
                        }
                    },
                    cutout: '65%'
                }
            });
        @endif
    });
</script>
@endsection
