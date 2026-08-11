@extends('layouts.admin')

@section('title', 'Citas y Reservas | High Contrast Detailing')
@section('title_section', 'Citas y Reservas')

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

<div class="space-y-6" x-data="adminBookings()">
    <!-- Filter Toolbar -->
    <div class="rounded-2xl bg-white dark:bg-surface/30 border border-black/5 dark:border-white/5 p-4 shadow-sm backdrop-blur-xl">
        <form method="GET" action="{{ route('admin.citas') }}" class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
            <!-- Search bar -->
            <div class="relative">
                <input type="text" name="search" value="{{ $search }}" placeholder="Buscar por cliente, patente, ID..." class="w-full rounded-xl border border-black/10 dark:border-white/10 bg-black/[0.02] dark:bg-surface/50 pl-10 pr-4 py-2.5 text-sm text-black dark:text-white outline-none focus:border-brand">
                <div class="absolute left-3 top-3.5 text-black/40 dark:text-white/40">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
            </div>

            <!-- Status filter -->
            <div>
                <select name="status" class="w-full rounded-xl border border-black/10 dark:border-white/10 bg-white dark:bg-[#111111] px-4 py-2.5 text-sm text-black dark:text-white outline-none focus:border-brand">
                    <option value="">Todos los Estados</option>
                    @foreach($statusLabels as $key => $label)
                        <option value="{{ $key }}" {{ $status === $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Buttons -->
            <div class="flex items-center gap-3">
                <button type="submit" class="flex-1 rounded-xl bg-brand hover:bg-brand-dark text-white py-2.5 text-sm font-semibold shadow-md transition-all">
                    Filtrar
                </button>
                <a href="{{ route('admin.citas') }}" class="flex-1 text-center rounded-xl border border-black/10 dark:border-white/10 text-black/75 dark:text-white/75 py-2.5 text-sm font-semibold hover:bg-black/5 dark:hover:bg-white/5 transition-all">
                    Limpiar
                </a>
            </div>
        </form>
    </div>

    <!-- Booking Table Card -->
    <div class="rounded-2xl bg-white dark:bg-surface/20 border border-black/5 dark:border-white/5 overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b border-black/5 dark:border-white/5 bg-gray-50 dark:bg-surface/10">
                        <th class="text-xs text-black/50 dark:text-white/40 font-semibold px-6 py-4">ID / Cliente</th>
                        <th class="text-xs text-black/50 dark:text-white/40 font-semibold px-6 py-4">Servicio</th>
                        <th class="text-xs text-black/50 dark:text-white/40 font-semibold px-6 py-4">Fecha y Hora</th>
                        <th class="text-xs text-black/50 dark:text-white/40 font-semibold px-6 py-4">Total</th>
                        <th class="text-xs text-black/50 dark:text-white/40 font-semibold px-6 py-4">Estados</th>
                        <th class="text-xs text-black/50 dark:text-white/40 font-semibold px-6 py-4 text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-black/5 dark:divide-white/5">
                    @forelse($bookings as $booking)
                        <tr class="hover:bg-black/[0.01] dark:hover:bg-white/[0.01] transition-colors">
                            <td class="px-6 py-4">
                                <p class="text-xs text-brand font-semibold tracking-wider mb-1" title="Public ID">{{ $booking->public_id }}</p>
                                <p class="text-black dark:text-white text-sm font-semibold">
                                    {{ $booking->customer->first_name ?? 'Cliente' }} {{ $booking->customer->last_name ?? '' }}
                                </p>
                                <p class="text-black/40 dark:text-white/30 text-xs">
                                    Tel: {{ $booking->customer->phone ?? '' }}
                                </p>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-black/80 dark:text-white/70 text-sm font-medium">
                                    {{ $booking->service_name_snapshot }}
                                </p>
                                <p class="text-black/40 dark:text-white/30 text-xs">
                                    Patente: {{ strtoupper($booking->customerVehicle->license_plate ?? 'S/P') }} ({{ $booking->vehicle_type_name_snapshot }})
                                </p>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-black/80 dark:text-white/70 text-sm font-medium">
                                    {{ $booking->start_at->translatedFormat('d M Y') }}
                                </p>
                                <p class="text-black/40 dark:text-white/30 text-xs">
                                    {{ $booking->start_at->translatedFormat('H:i') }} a {{ $booking->end_at->translatedFormat('H:i') }} hrs
                                </p>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-brand font-bold text-sm">
                                    {{ formatCLP($booking->total_amount) }}
                                </p>
                            </td>
                            <td class="px-6 py-4 space-y-1">
                                <div>
                                    <span class="inline-flex px-2 py-0.5 rounded-full text-[10px] font-semibold border {{ $statusColors[$booking->status?->value ?? 'PENDING'] }}">
                                        Cita: {{ $statusLabels[$booking->status?->value ?? 'PENDING'] }}
                                    </span>
                                </div>
                                <div>
                                    <span class="inline-flex px-2 py-0.5 rounded-full text-[10px] font-semibold border {{ $booking->payment_status?->value === 'PAID' ? 'bg-green-500/10 border-green-500/20 text-green-600 dark:text-green-400' : 'bg-yellow-500/10 border-yellow-500/20 text-yellow-600 dark:text-yellow-400' }}">
                                        Pago: {{ $booking->payment_status?->value === 'PAID' ? 'Pagado' : 'Pendiente' }}
                                    </span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end gap-3">
                                    <a href="/reserva/{{ $booking->public_id }}" target="_blank" class="inline-flex items-center gap-1 text-xs text-brand font-bold hover:text-brand-light transition-colors">
                                        Ficha
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                    </a>
                                    <button @click="openModal('{{ $booking->id }}', '{{ $booking->public_id }}', '{{ $booking->status?->value ?? 'PENDING' }}', '{{ $booking->payment_status?->value ?? 'PENDING' }}')" class="inline-flex items-center gap-1 text-xs text-black/60 dark:text-white/60 hover:text-black dark:hover:text-white transition-colors font-bold">
                                        Administrar
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colSpan="6" class="px-6 py-12 text-center text-sm text-black/40 dark:text-white/40">
                                No se encontraron reservas que coincidan con los filtros.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination links -->
        <div class="px-6 py-4 bg-gray-50 dark:bg-surface/10 border-t border-black/5 dark:border-white/5">
            {{ $bookings->appends(request()->query())->links() }}
        </div>
    </div>

    <!-- Admin Modal -->
    <div x-show="showModal" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
            <div x-show="showModal" x-transition.opacity class="fixed inset-0 transition-opacity bg-black/50 backdrop-blur-sm" @click="closeModal()"></div>

            <div x-show="showModal" x-transition class="relative inline-block w-full max-w-md p-6 overflow-hidden text-left align-middle transition-all transform bg-white dark:bg-[#111111] border border-black/10 dark:border-white/10 shadow-xl rounded-2xl">
                <div class="flex items-center justify-between mb-5">
                    <h3 class="text-lg font-bold text-black dark:text-white">Administrar Cita</h3>
                    <button @click="closeModal()" class="text-black/40 hover:text-black dark:text-white/40 dark:hover:text-white">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
                
                <div class="mb-4 text-sm text-black/60 dark:text-white/60">
                    ID de Reserva: <strong class="text-brand" x-text="booking.public_id"></strong>
                </div>

                <div class="space-y-4">
                    <!-- Status -->
                    <div>
                        <label class="block mb-1 text-sm font-semibold text-black/70 dark:text-white/70">Estado de la Cita</label>
                        <select x-model="form.status" class="w-full px-3 py-2 text-sm border rounded-lg outline-none border-black/10 dark:border-white/10 bg-black/[0.02] dark:bg-surface/50 text-black dark:text-white focus:border-brand">
                            @foreach($statusLabels as $key => $label)
                                <option value="{{ $key }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Payment Status -->
                    <div>
                        <label class="block mb-1 text-sm font-semibold text-black/70 dark:text-white/70">Estado del Pago</label>
                        <select x-model="form.payment_status" class="w-full px-3 py-2 text-sm border rounded-lg outline-none border-black/10 dark:border-white/10 bg-black/[0.02] dark:bg-surface/50 text-black dark:text-white focus:border-brand">
                            <option value="PENDING">Pendiente</option>
                            <option value="PAID">Pagado</option>
                        </select>
                    </div>

                    <!-- Notify Client -->
                    <div class="flex items-center gap-2 pt-2">
                        <input type="checkbox" id="send_email" x-model="form.send_email" class="w-4 h-4 text-brand bg-white border-gray-300 rounded focus:ring-brand">
                        <label for="send_email" class="text-sm text-black/70 dark:text-white/70">Enviar notificación por correo al cliente</label>
                    </div>
                </div>

                <div class="flex items-center justify-between mt-8">
                    <button @click="confirmDelete = true" x-show="!confirmDelete" class="px-4 py-2 text-sm font-bold text-red-500 hover:text-red-600 transition-colors">
                        Eliminar Cita
                    </button>
                    <div x-show="confirmDelete" class="flex items-center gap-2">
                        <button @click="deleteBooking()" :disabled="loading" class="px-3 py-1.5 text-xs font-bold text-white bg-red-500 rounded-lg hover:bg-red-600 transition-colors disabled:opacity-50">
                            Sí, Eliminar
                        </button>
                        <button @click="confirmDelete = false" class="text-xs text-black/50 dark:text-white/50 hover:text-black dark:hover:text-white transition-colors">
                            Cancelar
                        </button>
                    </div>
                    
                    <button @click="saveChanges()" :disabled="loading" class="px-6 py-2 text-sm font-bold text-white transition-all rounded-full bg-brand hover:bg-brand-dark shadow-md disabled:opacity-50">
                        <span x-show="!loading">Guardar Cambios</span>
                        <span x-show="loading">Guardando...</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Script -->
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('adminBookings', () => ({
                showModal: false,
                loading: false,
                confirmDelete: false,
                booking: {
                    id: '',
                    public_id: ''
                },
                form: {
                    status: 'PENDING',
                    payment_status: 'PENDING',
                    send_email: false
                },
                openModal(id, publicId, status, paymentStatus) {
                    this.booking.id = id;
                    this.booking.public_id = publicId;
                    this.form.status = status;
                    this.form.payment_status = paymentStatus;
                    this.form.send_email = false;
                    this.confirmDelete = false;
                    this.showModal = true;
                },
                closeModal() {
                    this.showModal = false;
                },
                async saveChanges() {
                    this.loading = true;
                    try {
                        const res = await fetch(`/api/admin/bookings/${this.booking.id}/status`, {
                            method: 'PUT',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            },
                            body: JSON.stringify(this.form)
                        });
                        const data = await res.json();
                        if (data.success) {
                            window.location.reload();
                        } else {
                            alert(data.message || 'Error al guardar.');
                        }
                    } catch (e) {
                        alert('Error de conexión.');
                    }
                    this.loading = false;
                },
                async deleteBooking() {
                    this.loading = true;
                    try {
                        const res = await fetch(`/api/admin/bookings/${this.booking.id}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            }
                        });
                        const data = await res.json();
                        if (data.success) {
                            window.location.reload();
                        } else {
                            alert(data.message || 'Error al eliminar.');
                        }
                    } catch (e) {
                        alert('Error de conexión.');
                    }
                    this.loading = false;
                }
            }));
        });
    </script>
</div>
@endsection
