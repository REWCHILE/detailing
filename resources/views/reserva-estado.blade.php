@extends('layouts.public')

@section('title', 'Estado de tu Reserva | High Contrast Detailing Center')
@section('meta_description', 'Consulta el estado actual del pago y los detalles de tu reserva online.')
@section('meta_robots', 'noindex, nofollow')

@section('content')
@php
    // Internal user verification
    $isInternal = auth()->check() && (auth()->user()->isAdmin() || auth()->user()->isStaff());

    if (!function_exists('getVehicleIcon')) {
        function getVehicleIcon($slug) {
            $icons = [
                'sedan' => '🚗',
                'hatchback' => '🚙',
                'suv' => '🚙',
                'camioneta' => '🛻',
                'deportivo' => '🏎️',
                'moto' => '🏍️'
            ];
            return $icons[$slug] ?? '🚗';
        }
    }

    if (!function_exists('maskPhone')) {
        function maskPhone($phone) {
            $digits = preg_replace('/\D/', '', $phone);
            if (strlen($digits) <= 4) {
                return $phone;
            }
            $visibleDigits = substr($digits, -4);
            return "*** *** " . $visibleDigits;
        }
    }

    if (!function_exists('maskEmail')) {
        function maskEmail($email) {
            if (!$email) return null;
            $parts = explode('@', $email);
            if (count($parts) !== 2) return $email;
            [$localPart, $domain] = $parts;
            $visibleStart = substr($localPart, 0, min(2, strlen($localPart)));
            $maskedLength = max(strlen($localPart) - strlen($visibleStart), 2);
            return $visibleStart . str_repeat('*', $maskedLength) . '@' . $domain;
        }
    }

    if (!function_exists('maskCustomerName')) {
        function maskCustomerName($firstName, $lastName) {
            $lastInitial = substr(trim($lastName), 0, 1);
            return trim($firstName . ($lastInitial ? " {$lastInitial}." : ""));
        }
    }

    if (!function_exists('formatCLP')) {
        function formatCLP($amount) {
            return '$' . number_format($amount, 0, ',', '.');
        }
    }

    if (!function_exists('formatDuration')) {
        function formatDuration($minutes) {
            $hours = floor($minutes / 60);
            $mins = $minutes % 60;
            if ($hours == 0) return "{$mins} min";
            if ($mins == 0) return "{$hours}h";
            return "{$hours}h {$mins}min";
        }
    }

    $latestPayment = $booking->payments->first();
    $displayEmail = $isInternal ? $booking->customer->email : maskEmail($booking->customer->email);
    $formattedDate = ucfirst(\Carbon\Carbon::parse($booking->start_at)->locale('es')->translatedFormat('l, d \d\e F \d\e Y, H:i \h\r\s'));
@endphp

<style>
    /* Premium Detail Page Styles & Animations */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(24px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .fade-in-up {
        opacity: 0;
        animation: fadeInUp 0.7s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }

    .premium-detail-card {
        transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .premium-detail-card:hover {
        transform: translateY(-5px);
        border-color: rgba(232, 80, 138, 0.3) !important;
        box-shadow: 0 20px 30px -10px rgba(0, 0, 0, 0.04), 0 0 15px rgba(232, 80, 138, 0.03);
    }
    
    .dark .premium-detail-card:hover {
        box-shadow: 0 20px 35px -10px rgba(0, 0, 0, 0.5), 0 0 20px rgba(232, 80, 138, 0.06);
    }

    /* Icon micro-interactions */
    .premium-detail-card:hover .detail-icon {
        transform: scale(1.18) rotate(4deg);
        color: #E8508A !important;
    }

    .detail-icon {
        transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275), color 0.3s ease;
    }

    /* Status glow pulse effect */
    .glow-dot-green {
        box-shadow: 0 0 0 0 rgba(34, 197, 94, 0.4);
        animation: pulseGreen 2s infinite;
    }

    .glow-dot-yellow {
        box-shadow: 0 0 0 0 rgba(234, 179, 8, 0.4);
        animation: pulseYellow 2s infinite;
    }

    @keyframes pulseGreen {
        0% {
            transform: scale(0.95);
            box-shadow: 0 0 0 0 rgba(34, 197, 94, 0.7);
        }
        70% {
            transform: scale(1);
            box-shadow: 0 0 0 8px rgba(34, 197, 94, 0);
        }
        100% {
            transform: scale(0.95);
            box-shadow: 0 0 0 0 rgba(34, 197, 94, 0);
        }
    }

    @keyframes pulseYellow {
        0% {
            transform: scale(0.95);
            box-shadow: 0 0 0 0 rgba(234, 179, 8, 0.7);
        }
        70% {
            transform: scale(1);
            box-shadow: 0 0 0 8px rgba(234, 179, 8, 0);
        }
        100% {
            transform: scale(0.95);
            box-shadow: 0 0 0 0 rgba(234, 179, 8, 0);
        }
    }
</style>

<main class="min-h-screen bg-gray-50 dark:bg-surface-900 text-black dark:text-white transition-colors duration-300 pt-28 pb-20">
    <div class="container-custom max-w-4xl px-4">
        <!-- Main Card -->
        <div class="rounded-[2.5rem] border border-black/10 dark:border-white/10 bg-white/80 dark:bg-surface-800/40 p-8 md:p-12 shadow-2xl backdrop-blur-xl transition-all fade-in-up" style="animation-delay: 100ms;">
            
            <!-- Header/Meta -->
            <p class="text-brand text-sm font-semibold tracking-[0.2em] uppercase mb-3">
                Reserva {{ $booking->public_id }}
            </p>
            <h1 class="font-display text-4xl md:text-5xl font-extrabold text-black dark:text-white mb-4 transition-colors tracking-tight">
                Estado de tu reserva
            </h1>
            <p class="text-black/60 dark:text-white/50 text-lg mb-10 transition-colors">
                Tu reserva quedó registrada. Aquí puedes revisar el servicio, el horario y el estado actual del pago.
            </p>

            <!-- Status Indicator Grid -->
            <div class="grid gap-6 md:grid-cols-2 mb-10 fade-in-up" style="animation-delay: 200ms;">
                <!-- Status card -->
                <div class="rounded-2xl border border-black/5 dark:border-white/5 bg-black/[0.01] dark:bg-black/15 p-6 transition-all duration-300">
                    <p class="text-black/40 dark:text-white/40 text-xs uppercase tracking-wider font-bold mb-2.5">Estado de la Reserva</p>
                    <div class="flex items-center gap-3">
                        @if($booking->status?->value === 'CONFIRMED')
                            <span class="w-3.5 h-3.5 rounded-full bg-green-500 glow-dot-green"></span>
                            <span class="text-green-600 dark:text-green-400 font-extrabold text-lg">Confirmada</span>
                        @elseif($booking->status?->value === 'CANCELLED')
                            <span class="w-3.5 h-3.5 rounded-full bg-red-500"></span>
                            <span class="text-red-600 dark:text-red-400 font-extrabold text-lg">Cancelada</span>
                        @else
                            <span class="w-3.5 h-3.5 rounded-full bg-yellow-500 glow-dot-yellow"></span>
                            <span class="text-yellow-600 dark:text-yellow-400 font-extrabold text-lg">Pendiente de Confirmación</span>
                        @endif
                    </div>
                </div>

                <!-- Payment status card -->
                <div class="rounded-2xl border border-black/5 dark:border-white/5 bg-black/[0.01] dark:bg-black/15 p-6 transition-all duration-300">
                    <p class="text-black/40 dark:text-white/40 text-xs uppercase tracking-wider font-bold mb-2.5">Estado del Pago</p>
                    <div class="flex items-center gap-3">
                        @if($booking->payment_status?->value === 'PAID')
                            <span class="w-3.5 h-3.5 rounded-full bg-green-500"></span>
                            <span class="text-green-600 dark:text-green-400 font-extrabold text-lg">Pagado</span>
                        @elseif($booking->payment_status?->value === 'REFUNDED')
                            <span class="w-3.5 h-3.5 rounded-full bg-gray-500"></span>
                            <span class="text-gray-600 dark:text-gray-400 font-extrabold text-lg">Reembolsado</span>
                        @else
                            <span class="w-3.5 h-3.5 rounded-full bg-yellow-500 glow-dot-yellow"></span>
                            <span class="text-yellow-600 dark:text-yellow-400 font-extrabold text-lg">Pendiente de Pago</span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Details Grid -->
            <div class="grid gap-6 md:grid-cols-2">
                <!-- Service Detail -->
                <div class="rounded-2xl border border-black/5 dark:border-white/5 bg-black/[0.01] dark:bg-white/[0.01] p-6 premium-detail-card fade-in-up group" style="animation-delay: 300ms;">
                    <div class="flex items-center justify-between mb-4">
                        <p class="text-black/40 dark:text-white/40 text-xs uppercase tracking-wider font-bold">Servicio</p>
                        <div class="detail-icon text-brand/75 group-hover:text-brand transition-all">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 17h2c.6 0 1-.4 1-1v-3c0-.9-.7-1.7-1.5-1.9C18.7 10.6 16 10 16 10s-1.3-1.4-2.2-2.3C13 6.8 11.5 6 10 6H4C2.5 6 1 7.5 1 9v7c0 .6.4 1 1 1h2" />
                                <circle cx="7" cy="17" r="2" />
                                <circle cx="16" cy="17" r="2" />
                            </svg>
                        </div>
                    </div>
                    <p class="text-black dark:text-white text-xl font-bold font-display group-hover:text-brand transition-colors duration-250">{{ $booking->service_name_snapshot }}</p>
                    <p class="text-black/50 dark:text-white/50 text-sm mt-3 flex items-center gap-2">
                        <span class="text-xl">{{ $booking->customerVehicle->vehicleType->emoji ?? '🚗' }}</span>
                        <span class="font-semibold">{{ $booking->vehicle_type_name_snapshot }}</span>
                    </p>
                    @if($onlinePaymentsActive)
                        <p class="text-brand text-2xl font-black mt-4 font-display">{{ formatCLP($booking->total_amount) }}</p>
                    @else
                        <p class="text-brand text-lg font-bold mt-4 font-display">Reserva: Cupo Garantizado</p>
                    @endif
                </div>

                <!-- Date & Time Detail -->
                <div class="rounded-2xl border border-black/5 dark:border-white/5 bg-black/[0.01] dark:bg-white/[0.01] p-6 premium-detail-card fade-in-up group" style="animation-delay: 400ms;">
                    <div class="flex items-center justify-between mb-4">
                        <p class="text-black/40 dark:text-white/40 text-xs uppercase tracking-wider font-bold">Horario</p>
                        <div class="detail-icon text-brand/75 group-hover:text-brand transition-all">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
                                <line x1="16" y1="2" x2="16" y2="6" />
                                <line x1="8" y1="2" x2="8" y2="6" />
                                <line x1="3" y1="10" x2="21" y2="10" />
                            </svg>
                        </div>
                    </div>
                    <p class="text-black dark:text-white text-lg font-bold leading-snug group-hover:text-brand transition-colors duration-250">
                        {{ $formattedDate }}
                    </p>
                    <p class="text-black/50 dark:text-white/50 text-sm mt-3 font-semibold">
                        Duración estimada: {{ formatDuration($booking->duration_minutes) }}
                    </p>
                </div>

                <!-- Customer Detail -->
                <div class="rounded-2xl border border-black/5 dark:border-white/5 bg-black/[0.01] dark:bg-white/[0.01] p-6 premium-detail-card fade-in-up group" style="animation-delay: 500ms;">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center gap-2">
                            <p class="text-black/40 dark:text-white/40 text-xs uppercase tracking-wider font-bold">Cliente</p>
                            @if($isInternal)
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[9px] font-extrabold uppercase tracking-wider bg-brand/10 text-brand border border-brand/20">
                                    Vista Interna
                                </span>
                            @endif
                        </div>
                        <div class="detail-icon text-brand/75 group-hover:text-brand transition-all">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                    </div>
                    <p class="text-black dark:text-white text-lg font-bold group-hover:text-brand transition-colors duration-250">
                        {{ $isInternal ? ($booking->customer->first_name . ' ' . $booking->customer->last_name) : maskCustomerName($booking->customer->first_name, $booking->customer->last_name) }}
                    </p>
                    <p class="text-black/60 dark:text-white/60 text-sm mt-2 font-semibold">
                        {{ $isInternal ? $booking->customer->phone : maskPhone($booking->customer->phone) }}
                    </p>
                    @if($displayEmail)
                        <p class="text-black/60 dark:text-white/60 text-sm font-semibold">{{ $displayEmail }}</p>
                    @endif
                    <p class="text-black/50 dark:text-white/40 text-xs mt-3 italic font-semibold">
                        Patente: {{ strtoupper($booking->customerVehicle->license_plate ?? 'S/P') }}
                    </p>
                </div>

                <!-- Payment Action Detail -->
                <div class="rounded-2xl border border-black/5 dark:border-white/5 bg-black/[0.01] dark:bg-white/[0.01] p-6 premium-detail-card fade-in-up group flex flex-col justify-between" style="animation-delay: 600ms;">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <p class="text-black/40 dark:text-white/40 text-xs uppercase tracking-wider font-bold">
                                {{ $onlinePaymentsActive ? "Detalles del Pago" : "Pago y Cotización" }}
                            </p>
                            <div class="detail-icon text-brand/75 group-hover:text-brand transition-all">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <rect x="3" y="5" width="18" height="14" rx="2" />
                                    <line x1="3" y1="10" x2="21" y2="10" />
                                    <rect x="7" y="14" width="3" height="2" />
                                </svg>
                            </div>
                        </div>
                        
                        @if($onlinePaymentsActive)
                            <p class="text-black dark:text-white text-lg font-bold group-hover:text-brand transition-colors duration-250">
                                {{ $latestPayment && $latestPayment->status?->value === 'PAID' ? 'Pago Aprobado' : 'Esperando Pago' }}
                            </p>
                            @if($booking->payment_status?->value !== 'PAID' && $latestPayment && $latestPayment->checkout_url)
                                <p class="text-black/55 dark:text-white/50 text-xs mt-2 font-medium">
                                    Completa la transacción de forma segura vía MercadoPago.
                                </p>
                            @else
                                <p class="text-black/55 dark:text-white/50 text-xs mt-2 font-medium">
                                    Tu pago ha sido procesado correctamente. ¡Te esperamos!
                                </p>
                            @endif
                        @else
                            <p class="text-black dark:text-white text-lg font-bold group-hover:text-brand transition-colors duration-250">Coordinación Manual</p>
                            <p class="text-black/55 dark:text-white/50 text-xs mt-2 font-medium">
                                El pago online está desactivado. Tu reserva quedó confirmada y la cotización final se coordinará directamente con el administrador.
                            </p>
                        @endif
                    </div>

                    @if($onlinePaymentsActive && $booking->payment_status?->value !== 'PAID' && $latestPayment && $latestPayment->checkout_url)
                        <div class="mt-4">
                            <a href="{{ $latestPayment->checkout_url }}"
                               class="inline-flex w-full items-center justify-center px-6 py-3 rounded-full bg-brand hover:bg-brand-dark text-white font-semibold shadow-lg shadow-brand/20 hover:shadow-brand/40 transition-all duration-300 hover:scale-[1.02]">
                                Continuar al pago
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Extras Details -->
            @if($booking->extras->count() > 0)
                <div class="mt-8 rounded-2xl border border-black/5 dark:border-white/5 bg-black/[0.01] dark:bg-white/[0.01] p-6 premium-detail-card fade-in-up group" style="animation-delay: 700ms;">
                    <div class="flex items-center gap-2 mb-4">
                        <div class="detail-icon text-brand/75 group-hover:text-brand transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM17 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2h-2zM5 15a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM17 15a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2h-2z" />
                            </svg>
                        </div>
                        <p class="text-black/40 dark:text-white/40 text-xs uppercase tracking-wider font-bold">Servicios Extras Adicionales</p>
                    </div>
                    <div class="space-y-3 divide-y divide-black/5 dark:divide-white/5">
                        @foreach($booking->extras as $extra)
                            <div class="flex items-center justify-between text-sm py-2 first:pt-0 last:pb-0">
                                <div class="flex flex-col">
                                    <span class="text-black/85 dark:text-white/85 font-bold">{{ $extra->name_snapshot ?? $extra->extra->name ?? '' }}</span>
                                    <span class="text-black/40 dark:text-white/40 text-xs font-semibold">Duración: +{{ formatDuration($extra->duration_minutes_snapshot ?? $extra->extra->duration_minutes ?? 0) }}</span>
                                </div>
                                @php
                                    $extraPrice = $extra->price_snapshot ?? $extra->extra->price ?? 0;
                                    $isIncluded = $extra->is_included_snapshot ?? $extra->extra->is_included ?? false;
                                    $isCourtesy = $extra->is_courtesy_snapshot ?? $extra->extra->is_courtesy ?? false;
                                @endphp
                                @if($onlinePaymentsActive && $extraPrice > 0 && !$isIncluded && !$isCourtesy)
                                    <span class="text-brand font-extrabold">+{{ formatCLP($extraPrice) }}</span>
                                @else
                                    <span class="text-brand font-bold uppercase text-sm flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        INCLUIDO
                                    </span>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Back to home -->
            <div class="mt-12 text-center fade-in-up" style="animation-delay: 800ms;">
                <a href="/" class="inline-flex items-center gap-2 text-black/55 dark:text-white/50 hover:text-brand dark:hover:text-brand transition-colors text-sm font-semibold">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                    Volver a Inicio
                </a>
            </div>

        </div>
    </div>
</main>
@endsection
