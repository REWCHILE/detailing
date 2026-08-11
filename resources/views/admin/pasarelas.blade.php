@extends('layouts.admin')

@section('title', 'Pasarelas de Pago | High Contrast Detailing')
@section('title_section', 'Pasarelas de Pago')

@section('content')
<div class="max-w-3xl space-y-6">
    @if(session('success'))
        <div class="rounded-xl border border-green-500/20 bg-green-500/10 p-4 text-sm text-green-600 dark:text-green-400">
            {{ session('success') }}
        </div>
    @endif

    <div class="rounded-2xl border border-black/5 dark:border-white/5 bg-white dark:bg-surface/30 p-6 md:p-8 shadow-sm backdrop-blur-xl">
        <div class="flex items-center gap-3 mb-6 border-b border-black/5 dark:border-white/5 pb-4">
            <div class="w-10 h-10 rounded-xl bg-brand/10 flex items-center justify-center text-brand">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                </svg>
            </div>
            <div>
                <h3 class="font-display font-bold text-lg text-black dark:text-white">Mercado Pago</h3>
                <p class="text-xs text-black/40 dark:text-white/40">Integra cobros en línea de forma automática para las citas de detailing.</p>
            </div>
        </div>

        <form method="POST" action="{{ route('admin.pasarelas') }}" class="space-y-6">
            @csrf

            <!-- Toggle Activation -->
            <label class="flex items-start gap-3 rounded-xl border border-black/5 dark:border-white/5 bg-black/[0.01] dark:bg-surface/20 p-4 select-none cursor-pointer">
                <input type="checkbox" name="payment_gateway_enabled" value="1" {{ $profile->payment_gateway_enabled ? 'checked' : '' }} class="rounded border-black/10 dark:border-white/10 text-brand focus:ring-brand mt-1">
                <div>
                    <span class="block text-sm font-semibold text-black dark:text-white">Habilitar cobros online</span>
                    <span class="block text-xs text-black/50 dark:text-white/40 mt-1">Al activar esta opción, los clientes deberán realizar el pago a través de Mercado Pago para confirmar su reserva.</span>
                </div>
            </label>

            <!-- Mode Selector -->
            <div>
                <label class="block text-xs uppercase text-black/55 dark:text-white/50 font-bold mb-1.5">Modo de Operación</label>
                <select name="payment_gateway_mode" class="w-full rounded-xl border border-black/10 dark:border-white/10 bg-white dark:bg-[#111111] px-4 py-2.5 text-sm text-black dark:text-white outline-none focus:border-brand">
                    <option value="TEST" {{ $profile->payment_gateway_mode === 'TEST' ? 'selected' : '' }}>Pruebas (Sandbox)</option>
                    <option value="PRODUCTION" {{ $profile->payment_gateway_mode === 'PRODUCTION' ? 'selected' : '' }}>Producción (En vivo)</option>
                </select>
                <p class="text-[11px] text-black/40 dark:text-white/30 mt-1">Usa el modo sandbox para validar flujos antes de recibir pagos reales.</p>
            </div>

            <!-- Credentials Test -->
            <div class="space-y-4 border-t border-black/5 dark:border-white/5 pt-4">
                <h4 class="font-display font-semibold text-sm text-black/80 dark:text-white/80">Credenciales de Pruebas (Sandbox)</h4>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs text-black/50 dark:text-white/40 mb-1">Public Key (Test)</label>
                        <input type="text" name="mercado_pago_public_key_test" value="{{ $profile->mercado_pago_public_key_test }}" class="w-full rounded-xl border border-black/10 dark:border-white/10 bg-black/[0.02] dark:bg-surface/50 px-4 py-2.5 text-xs text-black dark:text-white outline-none focus:border-brand">
                    </div>
                    <div>
                        <label class="block text-xs text-black/50 dark:text-white/40 mb-1">Access Token (Test)</label>
                        <input type="password" name="mercado_pago_access_token_test" value="{{ $profile->mercado_pago_access_token_test }}" class="w-full rounded-xl border border-black/10 dark:border-white/10 bg-black/[0.02] dark:bg-surface/50 px-4 py-2.5 text-xs text-black dark:text-white outline-none focus:border-brand">
                    </div>
                </div>
            </div>

            <!-- Credentials Production -->
            <div class="space-y-4 border-t border-black/5 dark:border-white/5 pt-4">
                <h4 class="font-display font-semibold text-sm text-black/80 dark:text-white/80">Credenciales de Producción (En vivo)</h4>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs text-black/50 dark:text-white/40 mb-1">Public Key (Production)</label>
                        <input type="text" name="mercado_pago_public_key_production" value="{{ $profile->mercado_pago_public_key_production }}" class="w-full rounded-xl border border-black/10 dark:border-white/10 bg-black/[0.02] dark:bg-surface/50 px-4 py-2.5 text-xs text-black dark:text-white outline-none focus:border-brand">
                    </div>
                    <div>
                        <label class="block text-xs text-black/50 dark:text-white/40 mb-1">Access Token (Production)</label>
                        <input type="password" name="mercado_pago_access_token_production" value="{{ $profile->mercado_pago_access_token_production }}" class="w-full rounded-xl border border-black/10 dark:border-white/10 bg-black/[0.02] dark:bg-surface/50 px-4 py-2.5 text-xs text-black dark:text-white outline-none focus:border-brand">
                    </div>
                </div>
            </div>

            <!-- Webhook notification warning -->
            <div class="rounded-xl border border-brand/20 bg-brand/5 p-4 text-xs leading-relaxed text-black/60 dark:text-white/50">
                <p class="font-bold text-brand mb-1">Nota sobre Webhooks de Notificación:</p>
                Asegúrate de registrar la siguiente URL en tu panel de desarrollador de Mercado Pago (sección Webhooks) para recibir actualizaciones de estados de pago automáticamente:
                <code class="block font-mono bg-black/10 dark:bg-black/30 p-2 rounded mt-1.5 select-all overflow-x-auto text-black dark:text-white">
                    {{ rtrim(env('APP_URL', url('/')), '/') }}/api/payments/webhook
                </code>
            </div>

            <!-- Show Prices Toggle (when gateway is disabled) -->
            <div class="rounded-xl border p-4" x-data="{ showPrices: {{ $profile->show_prices ? 'true' : 'false' }}, gatewayEnabled: {{ $profile->payment_gateway_enabled ? 'true' : 'false' }} }"
                 :class="showPrices ? 'border-brand/20 bg-brand/5' : 'border-amber-500/20 bg-amber-500/5'">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div class="flex-1">
                        <h4 class="font-bold text-sm flex items-center gap-2 mb-1"
                            :class="showPrices ? 'text-brand' : 'text-amber-600 dark:text-amber-300'">
                            <template x-if="showPrices">
                                <span class="flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    Precios Visibles
                                </span>
                            </template>
                            <template x-if="!showPrices">
                                <span>⚠️ Modo Catálogo Activo</span>
                            </template>
                        </h4>
                        <p class="text-xs text-black/60 dark:text-white/50 leading-relaxed" x-show="showPrices">
                            Los precios se muestran en el sitio público aunque las pasarelas de pago estén desactivadas. Los clientes podrán ver tarifas y agendar citas, pero sin pago en línea.
                        </p>
                        <p class="text-xs text-black/60 dark:text-white/50 leading-relaxed" x-show="!showPrices">
                            Las pasarelas de pago están desactivadas. Los precios se encuentran ocultos y los clientes verán "Cotizar" en su lugar. Activa el toggle para mostrar precios sin cobro en línea.
                        </p>
                    </div>
                    <label class="shrink-0 flex items-center gap-2.5 px-5 py-3 rounded-xl font-semibold text-sm transition-all duration-300 border cursor-pointer select-none"
                           :class="showPrices ? 'bg-brand/10 border-brand/30 text-brand hover:bg-brand/20' : 'bg-black/5 dark:bg-white/5 border-black/10 dark:border-white/10 text-black/50 dark:text-white/50 hover:bg-black/10 dark:hover:bg-white/10'">
                        <input type="checkbox" name="show_prices" value="1" x-model="showPrices" class="hidden">
                        <!-- Toggle icon -->
                        <svg x-show="showPrices" class="w-5 h-5 text-brand" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <svg x-show="!showPrices" class="w-5 h-5 text-black/30 dark:text-white/30" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="9"/><line x1="8" y1="12" x2="16" y2="12"/></svg>
                        <span x-text="showPrices ? 'Precios ON' : 'Precios OFF'"></span>
                    </label>
                </div>
            </div>

            <div class="pt-4 border-t border-black/5 dark:border-white/5 text-right">
                <button type="submit" class="rounded-xl bg-brand hover:bg-brand-dark text-white px-8 py-3 text-sm font-semibold shadow-md transition-all">
                    Guardar Configuración
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
