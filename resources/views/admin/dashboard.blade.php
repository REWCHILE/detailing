@extends('layouts.admin')

@section('title', 'Dashboard | High Contrast Detailing')
@section('title_section', 'Dashboard')

@section('content')
@php
    function formatCLP($amount) {
        return '$' . number_format($amount, 0, ',', '.');
    }
    
    $statusColors = [
        'PENDING' => 'bg-yellow-500/10 text-yellow-500 dark:text-yellow-400 border-yellow-500/20',
        'CONFIRMED' => 'bg-green-500/10 text-green-600 dark:text-green-400 border-green-500/20',
        'IN_PROGRESS' => 'bg-blue-500/10 text-blue-600 dark:text-blue-400 border-blue-500/20',
        'COMPLETED' => 'bg-brand/10 text-brand border-brand/20',
        'CANCELLED' => 'bg-red-500/10 text-red-600 dark:text-red-400 border-red-500/20',
        'EXPIRED' => 'bg-gray-500/10 text-gray-500 dark:text-gray-400 border-gray-500/20',
        'NO_SHOW' => 'bg-purple-500/10 text-purple-600 dark:text-purple-400 border-purple-500/20',
    ];

    $statusLabels = [
        'PENDING' => 'Pendiente',
        'CONFIRMED' => 'Confirmada',
        'IN_PROGRESS' => 'En Progreso',
        'COMPLETED' => 'Completada',
        'CANCELLED' => 'Cancelada',
        'EXPIRED' => 'Expirada',
        'NO_SHOW' => 'No Asistió',
    ];
@endphp

<div class="space-y-8">
    <!-- Stats Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Stat Card 1 -->
        <div class="p-6 rounded-2xl border border-black/5 dark:border-white/5 shadow-sm premium-card">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 rounded-xl bg-brand/10 flex items-center justify-center text-brand stat-icon transition-all duration-300">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
            </div>
            <p class="text-black/40 dark:text-white/40 text-sm mb-1 font-medium">Citas hoy</p>
            <p class="font-display text-3xl font-extrabold text-black dark:text-white">{{ $todayCount }}</p>
        </div>

        <!-- Stat Card 2 -->
        <div class="p-6 rounded-2xl border border-black/5 dark:border-white/5 shadow-sm premium-card">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 rounded-xl bg-yellow-500/10 flex items-center justify-center text-yellow-500 dark:text-yellow-400 stat-icon transition-all duration-300">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
            <p class="text-black/40 dark:text-white/40 text-sm mb-1 font-medium">Pendientes</p>
            <p class="font-display text-3xl font-extrabold text-black dark:text-white">{{ $pendingCount }}</p>
        </div>

        <!-- Stat Card 3 -->
        <div class="p-6 rounded-2xl border border-black/5 dark:border-white/5 shadow-sm premium-card">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 rounded-xl bg-green-500/10 flex items-center justify-center text-green-500 dark:text-green-400 stat-icon transition-all duration-300">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
            <p class="text-black/40 dark:text-white/40 text-sm mb-1 font-medium">Completadas</p>
            <p class="font-display text-3xl font-extrabold text-black dark:text-white">{{ $completedCount }}</p>
        </div>

        <!-- Stat Card 4 -->
        <div class="p-6 rounded-2xl border border-black/5 dark:border-white/5 shadow-sm premium-card">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 rounded-xl bg-brand/10 flex items-center justify-center text-brand stat-icon transition-all duration-300">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M12 16V5"/>
                    </svg>
                </div>
            </div>
            <p class="text-black/40 dark:text-white/40 text-sm mb-1 font-medium">Ingresos totales</p>
            <p class="font-display text-3xl font-extrabold text-black dark:text-white">{{ formatCLP($totalRevenue) }}</p>
        </div>
    </div>

    <!-- Recent Appointments Table -->
    <div>
        <div class="flex items-center justify-between mb-4">
            <h2 class="font-display text-lg font-bold text-black dark:text-white">Citas recientes</h2>
            <a href="/admin/citas" class="text-brand text-sm font-semibold hover:text-brand-light transition-colors">
                Ver todas
            </a>
        </div>

        <div class="rounded-2xl border border-black/5 dark:border-white/5 overflow-hidden shadow-sm premium-card">
            <div class="overflow-x-auto">
                <table class="w-full text-left premium-table">
                    <thead>
                        <tr class="border-b border-black/5 dark:border-white/5 bg-gray-50/50 dark:bg-surface/10">
                            <th class="text-xs text-black/50 dark:text-white/40 font-semibold px-6 py-4">Cliente</th>
                            <th class="text-xs text-black/50 dark:text-white/40 font-semibold px-6 py-4">Servicio</th>
                            <th class="text-xs text-black/50 dark:text-white/40 font-semibold px-6 py-4">Fecha</th>
                            <th class="text-xs text-black/50 dark:text-white/40 font-semibold px-6 py-4">Total</th>
                            <th class="text-xs text-black/50 dark:text-white/40 font-semibold px-6 py-4">Estado</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-black/5 dark:divide-white/5">
                        @forelse($recentBookings as $booking)
                            <tr class="hover:bg-black/[0.01] dark:hover:bg-white/[0.01] transition-colors">
                                <td class="px-6 py-4">
                                    <p class="text-black dark:text-white text-sm font-semibold">
                                        {{ $booking->customer->first_name ?? 'Cliente' }} {{ $booking->customer->last_name ?? '' }}
                                    </p>
                                    <p class="text-black/40 dark:text-white/30 text-xs">
                                        Patente: {{ strtoupper($booking->customerVehicle->license_plate ?? 'S/P') }}
                                    </p>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="text-black/80 dark:text-white/70 text-sm font-medium">
                                        {{ $booking->service_name_snapshot }}
                                    </p>
                                    <p class="text-black/40 dark:text-white/30 text-xs">
                                        Vehículo: {{ $booking->vehicle_type_name_snapshot }}
                                    </p>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="text-black/80 dark:text-white/70 text-sm font-medium">
                                        {{ $booking->start_at->translatedFormat('d M Y') }}
                                    </p>
                                    <p class="text-black/40 dark:text-white/30 text-xs">
                                        {{ $booking->start_at->translatedFormat('H:i') }} hrs
                                    </p>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="text-brand font-bold text-sm">
                                        {{ formatCLP($booking->total_amount) }}
                                    </p>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex px-3 py-1 rounded-full text-xs font-semibold border {{ $statusColors[$booking->status?->value ?? 'PENDING'] }}">
                                        {{ $statusLabels[$booking->status?->value ?? 'PENDING'] }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colSpan="5" class="px-6 py-12 text-center text-sm text-black/40 dark:text-white/40">
                                    No hay reservas registradas todavía.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
