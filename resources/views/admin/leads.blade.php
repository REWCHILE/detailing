@extends('layouts.admin')

@section('title', 'Leads en Vivo & Cotizaciones | Panel Administrativo')

@section('content')
<div class="space-y-8 animate-fade-in" x-data="leadsManager()">
    
    <!-- Top Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse"></span>
                <span class="text-xs font-bold text-emerald-600 dark:text-emerald-400 uppercase tracking-wider">Live Tracking Activo</span>
            </div>
            <h1 class="font-display font-extrabold text-2xl sm:text-3xl text-black dark:text-white tracking-tight">
                Leads & Cotizaciones en Vivo
            </h1>
            <p class="text-xs sm:text-sm text-black/50 dark:text-white/40 mt-1">
                Seguimiento en tiempo real de clientes que interactúan con el cotizador online. Contacta de inmediato para cerrar ventas.
            </p>
        </div>

        <div class="flex items-center gap-3">
            <button 
                type="button" 
                @click="window.location.reload()" 
                class="px-4 py-2.5 rounded-xl border border-black/10 dark:border-white/10 bg-white dark:bg-surface/30 hover:bg-black/5 dark:hover:bg-white/5 text-xs font-bold text-black dark:text-white flex items-center gap-2 transition-all shadow-sm cursor-pointer"
            >
                <svg class="w-4 h-4 text-brand" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                </svg>
                <span>Actualizar Lista</span>
            </button>
            <a 
                href="/reserva" 
                target="_blank" 
                class="px-4 py-2.5 rounded-xl bg-brand hover:bg-brand-dark text-white text-xs font-bold flex items-center gap-2 transition-all shadow-lg shadow-brand/20"
            >
                <span>Ver Cotizador Online</span>
                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                </svg>
            </a>
        </div>
    </div>

    <!-- KPI Metric Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
        
        <!-- Card 1: Leads Activos Hoy -->
        <div class="p-6 rounded-2xl border border-black/5 dark:border-white/5 bg-white dark:bg-surface/30 shadow-sm backdrop-blur-xl flex items-center justify-between">
            <div>
                <p class="text-xs font-bold uppercase tracking-wider text-black/50 dark:text-white/40">Activos Hoy</p>
                <p class="text-3xl font-black font-display text-black dark:text-white mt-1">{{ $activeTodayCount }}</p>
                <p class="text-[11px] text-emerald-600 dark:text-emerald-400 font-semibold mt-1">Interacciones en últimas 24h</p>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 border border-emerald-500/20 flex items-center justify-center text-xl shrink-0">
                ⚡
            </div>
        </div>

        <!-- Card 2: Con Teléfono Contactables -->
        <div class="p-6 rounded-2xl border border-black/5 dark:border-white/5 bg-white dark:bg-surface/30 shadow-sm backdrop-blur-xl flex items-center justify-between">
            <div>
                <p class="text-xs font-bold uppercase tracking-wider text-black/50 dark:text-white/40">Listos p/ Contactar</p>
                <p class="text-3xl font-black font-display text-emerald-600 dark:text-emerald-400 mt-1">{{ $totalWithPhone }}</p>
                <p class="text-[11px] text-black/50 dark:text-white/40 font-semibold mt-1">Con teléfono registrado</p>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-brand/10 text-brand border border-brand/20 flex items-center justify-center text-xl shrink-0">
                📱
            </div>
        </div>

        <!-- Card 3: Monto en Riesgo / Borradores -->
        <div class="p-6 rounded-2xl border border-black/5 dark:border-white/5 bg-white dark:bg-surface/30 shadow-sm backdrop-blur-xl flex items-center justify-between">
            <div>
                <p class="text-xs font-bold uppercase tracking-wider text-black/50 dark:text-white/40">Monto en Riesgo</p>
                <p class="text-2xl sm:text-3xl font-black font-display text-amber-600 dark:text-amber-400 mt-1">
                    ${{ number_format($totalDraftValue, 0, ',', '.') }}
                </p>
                <p class="text-[11px] text-amber-600/80 dark:text-amber-400/80 font-semibold mt-1">CLP en cotizaciones pendientes</p>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-amber-500/10 text-amber-600 dark:text-amber-400 border border-amber-500/20 flex items-center justify-center text-xl shrink-0">
                💰
            </div>
        </div>

        <!-- Card 4: Recuperados & Contactados -->
        <div class="p-6 rounded-2xl border border-black/5 dark:border-white/5 bg-white dark:bg-surface/30 shadow-sm backdrop-blur-xl flex items-center justify-between">
            <div>
                <p class="text-xs font-bold uppercase tracking-wider text-black/50 dark:text-white/40">Gestionados</p>
                <p class="text-3xl font-black font-display text-blue-600 dark:text-blue-400 mt-1">{{ $recoveredCount + $contactedCount }}</p>
                <p class="text-[11px] text-black/50 dark:text-white/40 font-semibold mt-1">{{ $recoveredCount }} cerrados • {{ $contactedCount }} contactados</p>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-blue-500/10 text-blue-600 dark:text-blue-400 border border-blue-500/20 flex items-center justify-center text-xl shrink-0">
                🎯
            </div>
        </div>

    </div>

    <!-- Filters & Search Bar -->
    <div class="p-5 sm:p-7 rounded-3xl border border-black/5 dark:border-white/5 bg-white dark:bg-surface/30 shadow-sm backdrop-blur-xl space-y-4">
        
        <div class="flex flex-col lg:flex-row items-stretch lg:items-center justify-between gap-4">
            
            <!-- Filter Tabs (Clean Flex-Wrap, No Overflow Scrollbars) -->
            <div class="flex flex-wrap items-center gap-2 sm:gap-2.5 flex-1">
                <a 
                    href="{{ route('admin.leads', ['filter' => 'all', 'search' => $search]) }}" 
                    class="px-4 py-2 rounded-full text-xs font-bold tracking-wide transition-all duration-200 flex items-center gap-2 border {{ $filter === 'all' ? 'bg-brand border-brand text-white shadow-lg shadow-brand/25' : 'bg-black/5 dark:bg-white/5 border-black/10 dark:border-white/10 text-black/70 dark:text-white/70 hover:border-brand/40 hover:text-brand hover:bg-brand/5' }}"
                >
                    <span>Todos</span>
                    <span class="px-2 py-0.5 rounded-full text-[10px] font-black {{ $filter === 'all' ? 'bg-white/20 text-white' : 'bg-black/10 dark:bg-white/10 text-black/60 dark:text-white/60' }}">{{ $totalLeads }}</span>
                </a>

                <a 
                    href="{{ route('admin.leads', ['filter' => 'with_phone', 'search' => $search]) }}" 
                    class="px-4 py-2 rounded-full text-xs font-bold tracking-wide transition-all duration-200 flex items-center gap-2 border {{ $filter === 'with_phone' ? 'bg-brand border-brand text-white shadow-lg shadow-brand/25' : 'bg-black/5 dark:bg-white/5 border-black/10 dark:border-white/10 text-black/70 dark:text-white/70 hover:border-brand/40 hover:text-brand hover:bg-brand/5' }}"
                >
                    <span>📱 Con Teléfono</span>
                    <span class="px-2 py-0.5 rounded-full text-[10px] font-black {{ $filter === 'with_phone' ? 'bg-white/20 text-white' : 'bg-emerald-500/15 text-emerald-600 dark:text-emerald-400' }}">{{ $totalWithPhone }}</span>
                </a>

                <a 
                    href="{{ route('admin.leads', ['filter' => 'draft', 'search' => $search]) }}" 
                    class="px-4 py-2 rounded-full text-xs font-bold tracking-wide transition-all duration-200 flex items-center gap-2 border {{ $filter === 'draft' ? 'bg-amber-500 border-amber-500 text-white shadow-lg shadow-amber-500/25' : 'bg-black/5 dark:bg-white/5 border-black/10 dark:border-white/10 text-black/70 dark:text-white/70 hover:border-amber-500/40 hover:text-amber-500 hover:bg-amber-500/5' }}"
                >
                    <span>🟡 Borradores / Abandonados</span>
                </a>

                <a 
                    href="{{ route('admin.leads', ['filter' => 'contacted', 'search' => $search]) }}" 
                    class="px-4 py-2 rounded-full text-xs font-bold tracking-wide transition-all duration-200 flex items-center gap-2 border {{ $filter === 'contacted' ? 'bg-blue-600 border-blue-600 text-white shadow-lg shadow-blue-600/25' : 'bg-black/5 dark:bg-white/5 border-black/10 dark:border-white/10 text-black/70 dark:text-white/70 hover:border-blue-500/40 hover:text-blue-500 hover:bg-blue-500/5' }}"
                >
                    <span>💬 Contactados</span>
                    <span class="px-2 py-0.5 rounded-full text-[10px] font-black {{ $filter === 'contacted' ? 'bg-white/20 text-white' : 'bg-blue-500/15 text-blue-600 dark:text-blue-400' }}">{{ $contactedCount }}</span>
                </a>

                <a 
                    href="{{ route('admin.leads', ['filter' => 'recovered', 'search' => $search]) }}" 
                    class="px-4 py-2 rounded-full text-xs font-bold tracking-wide transition-all duration-200 flex items-center gap-2 border {{ $filter === 'recovered' ? 'bg-emerald-600 border-emerald-600 text-white shadow-lg shadow-emerald-600/25' : 'bg-black/5 dark:bg-white/5 border-black/10 dark:border-white/10 text-black/70 dark:text-white/70 hover:border-emerald-500/40 hover:text-emerald-500 hover:bg-emerald-500/5' }}"
                >
                    <span>🟢 Enviados / Cerrados</span>
                    <span class="px-2 py-0.5 rounded-full text-[10px] font-black {{ $filter === 'recovered' ? 'bg-white/20 text-white' : 'bg-emerald-500/15 text-emerald-600 dark:text-emerald-400' }}">{{ $recoveredCount }}</span>
                </a>
            </div>

            <!-- Search Form -->
            <form method="GET" action="{{ route('admin.leads') }}" class="w-full lg:w-72 relative shrink-0">
                <input type="hidden" name="filter" value="{{ $filter }}">
                <input 
                    type="text" 
                    name="search" 
                    value="{{ $search }}" 
                    placeholder="Buscar cliente, teléfono..." 
                    class="w-full pl-10 pr-4 py-2.5 rounded-full border border-black/10 dark:border-white/10 bg-gray-50 dark:bg-black/30 text-xs text-black dark:text-white placeholder-black/40 dark:placeholder-white/40 focus:border-brand outline-none transition-all shadow-inner"
                >
                <div class="absolute left-3.5 top-3 text-black/40 dark:text-white/40 pointer-events-none">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="8"/>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"/>
                    </svg>
                </div>
            </form>

        </div>

    </div>

    <!-- Leads Table / Grid -->
    <div class="rounded-2xl border border-black/5 dark:border-white/5 bg-white dark:bg-surface/30 overflow-hidden shadow-sm backdrop-blur-xl">
        
        <div class="overflow-x-auto">
            <table class="w-full text-left premium-table">
                <thead>
                    <tr class="border-b border-black/5 dark:border-white/5 bg-gray-50/50 dark:bg-surface/10">
                        <th class="text-xs font-bold text-black/60 dark:text-white/50 px-6 py-4">Cliente & Contacto</th>
                        <th class="text-xs font-bold text-black/60 dark:text-white/50 px-6 py-4">Servicio & Vehículo</th>
                        <th class="text-xs font-bold text-black/60 dark:text-white/50 px-6 py-4 text-center">Monto Cotizado</th>
                        <th class="text-xs font-bold text-black/60 dark:text-white/50 px-6 py-4 text-center">Progreso</th>
                        <th class="text-xs font-bold text-black/60 dark:text-white/50 px-6 py-4 text-center">Estado</th>
                        <th class="text-xs font-bold text-black/60 dark:text-white/50 px-6 py-4 text-center">Acción Directa</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-black/5 dark:divide-white/5">
                    @forelse($leads as $lead)
                        @php
                            $cleanPhone = preg_replace('/[^0-9]/', '', $lead->customer_phone ?? '');
                            if (str_starts_with($cleanPhone, '9') && strlen($cleanPhone) === 9) {
                                $cleanPhone = '56' . $cleanPhone;
                            }
                            $clientFirstName = $lead->customer_name ? strtok($lead->customer_name, " ") : "estimado(a)";
                            $serviceName = $lead->service_name ?? 'detallado automotriz';
                            $vehicleName = $lead->vehicle_type_name ?? 'vehículo';
                            $totalStr = $lead->total_price > 0 ? (' (estimado $' . number_format($lead->total_price, 0, ',', '.') . ' CLP)') : '';
                            
                            $whatsappMsg = rawurlencode("Hola {$clientFirstName}, te escribimos de High Contrast Detailing Center en Chicureo. Vimos que estabas cotizando {$serviceName} para tu {$vehicleName}{$totalStr}. ¿Te gustaría coordinar tu cita o tienes alguna consulta técnica que podamos resolver?");
                            $whatsappUrl = "https://wa.me/{$cleanPhone}?text={$whatsappMsg}";
                            
                            $timeAgo = $lead->last_activity_at ? $lead->last_activity_at->diffForHumans() : 'Reciente';
                        @endphp
                        <tr class="hover:bg-black/[0.01] dark:hover:bg-white/[0.02] transition-colors" id="lead-row-{{ $lead->id }}">
                            
                            <!-- Columna 1: Cliente & Contacto -->
                            <td class="px-6 py-4">
                                <div class="flex items-start gap-3">
                                    <div class="w-9 h-9 rounded-full bg-brand/10 border border-brand/30 text-brand flex items-center justify-center font-black text-sm shrink-0 mt-0.5">
                                        {{ $lead->customer_name ? strtoupper(substr($lead->customer_name, 0, 1)) : '?' }}
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-black dark:text-white leading-snug">
                                            {{ $lead->customer_name ?: 'Prospecto Anónimo' }}
                                        </p>
                                        @if($lead->customer_phone)
                                            <p class="text-xs font-mono font-bold text-brand mt-0.5 flex items-center gap-1">
                                                <span>📱</span>
                                                <a href="tel:{{ $lead->customer_phone }}" class="hover:underline">{{ $lead->customer_phone }}</a>
                                            </p>
                                        @else
                                            <span class="text-[10px] text-black/40 dark:text-white/30 italic">Sin teléfono ingresado</span>
                                        @endif
                                        
                                        @if($lead->customer_email)
                                            <p class="text-[11px] text-black/50 dark:text-white/40 font-mono mt-0.5">{{ $lead->customer_email }}</p>
                                        @endif

                                        @if($lead->commune)
                                            <span class="inline-flex items-center gap-1 text-[10px] px-2 py-0.5 rounded-full bg-black/5 dark:bg-white/10 text-black/60 dark:text-white/50 font-semibold mt-1.5">
                                                📍 {{ $lead->commune }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </td>

                            <!-- Columna 2: Servicio & Vehículo -->
                            <td class="px-6 py-4">
                                <div>
                                    <p class="text-sm font-extrabold text-black dark:text-white">
                                        {{ $lead->service_name ?: 'Servicio en selección...' }}
                                    </p>
                                    <p class="text-xs text-black/60 dark:text-white/50 mt-0.5">
                                        Tamaño: <span class="font-bold text-black dark:text-white">{{ $lead->vehicle_type_name ?: 'No definido' }}</span>
                                    </p>
                                    @if(!empty($lead->extras) && is_array($lead->extras))
                                        <div class="mt-1.5 flex flex-wrap gap-1">
                                            @foreach($lead->extras as $extra)
                                                <span class="text-[10px] px-2 py-0.5 rounded-md bg-brand/10 border border-brand/20 text-brand font-semibold">
                                                    + {{ is_string($extra) ? $extra : ($extra['name'] ?? 'Extra') }}
                                                </span>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </td>

                            <!-- Columna 3: Monto Cotizado -->
                            <td class="px-6 py-4 text-center">
                                @if($lead->total_price > 0)
                                    <span class="inline-flex px-3.5 py-1 rounded-full text-xs font-black font-display bg-brand/10 text-brand border border-brand/30 shadow-sm">
                                        ${{ number_format($lead->total_price, 0, ',', '.') }} CLP
                                    </span>
                                @else
                                    <span class="text-xs text-black/30 dark:text-white/30">$0</span>
                                @endif
                            </td>

                            <!-- Columna 4: Progreso en Cotizador -->
                            <td class="px-6 py-4 text-center">
                                <div class="flex flex-col items-center gap-1">
                                    <span class="inline-flex px-2.5 py-1 rounded-lg text-xs font-bold {{ $lead->last_step_reached >= 2 ? 'bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 border border-emerald-500/20' : 'bg-black/5 dark:bg-white/10 text-black/70 dark:text-white/60' }}">
                                        {{ $lead->last_step_reached === 1 ? 'Paso 1: Servicio' : 'Paso 2: Datos & Vehículo' }}
                                    </span>
                                    <span class="text-[10px] text-black/40 dark:text-white/40">
                                        {{ $timeAgo }}
                                    </span>
                                </div>
                            </td>

                            <!-- Columna 5: Estado -->
                            <td class="px-6 py-4 text-center">
                                <select 
                                    @change="updateStatus('{{ $lead->id }}', $event.target.value)" 
                                    class="text-xs font-bold rounded-xl px-2.5 py-1.5 border border-black/10 dark:border-white/10 bg-white dark:bg-surface/40 text-black dark:text-white outline-none cursor-pointer"
                                >
                                    <option value="DRAFT" {{ $lead->status === 'DRAFT' ? 'selected' : '' }}>🟡 Borrador</option>
                                    <option value="CONTACTED" {{ $lead->status === 'CONTACTED' ? 'selected' : '' }}>💬 Contactado</option>
                                    <option value="RECOVERED" {{ $lead->status === 'RECOVERED' ? 'selected' : '' }}>🟢 Enviado / Cerrado</option>
                                    <option value="CANCELLED" {{ $lead->status === 'CANCELLED' ? 'selected' : '' }}>⚪ Descartado</option>
                                </select>
                            </td>

                            <!-- Columna 6: Acción 1-Clic WhatsApp -->
                            <td class="px-6 py-4 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    @if($lead->customer_phone)
                                        <a 
                                            href="{{ $whatsappUrl }}" 
                                            target="_blank" 
                                            class="px-3 py-1.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-bold flex items-center gap-1.5 shadow-md shadow-emerald-600/30 transition-all hover:scale-105"
                                            title="Abrir chat de WhatsApp con mensaje personalizado"
                                        >
                                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                                <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.711 2.598 2.664-.698c.993.585 1.771.884 2.802.884l.006.001c3.18 0 5.767-2.586 5.768-5.766 0-3.18-2.587-5.772-5.78-5.772zm3.393 8.245c-.144.405-.837.774-1.17.824-.312.045-.694.073-1.905-.429-1.547-.643-2.534-2.213-2.61-2.316-.076-.103-.625-.833-.625-1.59 0-.756.397-1.127.538-1.282.14-.156.307-.195.41-.195.102 0 .205.001.294.005.093.004.218-.035.34.258.125.297.424 1.036.46 1.112.038.077.063.167.013.268-.052.102-.078.166-.155.257-.078.09-.163.2-.234.269-.078.077-.16.16-.068.318.092.158.408.672.875 1.088.6.536 1.106.702 1.264.78.158.077.25-.067.34-.171.092-.104.394-.462.499-.619.104-.157.208-.13.348-.078.14.052.888.419 1.04.496.152.078.254.116.29.181.037.065.037.377-.107.782z"/>
                                            </svg>
                                            <span>WhatsApp</span>
                                        </a>
                                    @else
                                        <span class="text-xs text-black/30 dark:text-white/20 italic">Sin teléfono</span>
                                    @endif

                                    <button 
                                        type="button" 
                                        @click="deleteLead('{{ $lead->id }}')" 
                                        class="p-1.5 rounded-lg text-black/30 dark:text-white/30 hover:text-red-500 hover:bg-red-500/10 transition-colors"
                                        title="Eliminar lead"
                                    >
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-black/40 dark:text-white/40">
                                <div class="flex flex-col items-center justify-center gap-3">
                                    <div class="w-12 h-12 rounded-full bg-black/5 dark:bg-white/5 flex items-center justify-center text-2xl">
                                        🔍
                                    </div>
                                    <p class="text-sm font-semibold">No se encontraron leads con los filtros seleccionados.</p>
                                    @if($search || $filter !== 'all')
                                        <a href="{{ route('admin.leads') }}" class="text-xs text-brand hover:underline font-bold">Limpiar filtros</a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($leads->hasPages())
            <div class="p-4 border-t border-black/5 dark:border-white/5 bg-gray-50/50 dark:bg-surface/10">
                {{ $leads->links() }}
            </div>
        @endif

    </div>

</div>

@push('scripts')
<script>
function leadsManager() {
    return {
        async updateStatus(leadId, newStatus) {
            try {
                const res = await fetch(`/api/admin/leads/${leadId}/status`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                    },
                    body: JSON.stringify({ status: newStatus })
                });
                const data = await res.json();
                if (!res.ok) throw new Error(data.message || 'Error al actualizar estado');
            } catch (err) {
                alert('No se pudo actualizar el estado: ' + err.message);
            }
        },

        async deleteLead(leadId) {
            if (!confirm('¿Estás seguro de que deseas eliminar este lead?')) return;
            try {
                const res = await fetch(`/api/admin/leads/${leadId}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                    }
                });
                const data = await res.json();
                if (!res.ok) throw new Error(data.message || 'Error al eliminar');
                const row = document.getElementById(`lead-row-${leadId}`);
                if (row) {
                    row.style.opacity = '0';
                    setTimeout(() => row.remove(), 300);
                }
            } catch (err) {
                alert('Error: ' + err.message);
            }
        }
    };
}
</script>
@endpush
@endsection
