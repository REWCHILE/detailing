@extends('layouts.admin')

@section('title', 'Calendario de Citas | High Contrast Detailing')
@section('title_section', 'Calendario')

@section('styles')
<style>
    /* Premium FullCalendar Customizations */
    .fc {
        --fc-border-color: rgba(0, 0, 0, 0.05);
        --fc-today-bg-color: rgba(251, 44, 107, 0.04);
        --fc-button-bg-color: #FB2C6B;
        --fc-button-border-color: #FB2C6B;
        --fc-button-hover-bg-color: #D41B53;
        --fc-button-hover-border-color: #D41B53;
        --fc-button-active-bg-color: #D41B53;
        --fc-button-active-border-color: #D41B53;
        --fc-event-bg-color: #FB2C6B;
        --fc-event-border-color: #FB2C6B;
        font-family: 'Inter', system-ui, sans-serif;
    }
    
    .dark .fc {
        --fc-border-color: rgba(255, 255, 255, 0.06);
        --fc-today-bg-color: rgba(251, 44, 107, 0.08);
    }
    
    .fc .fc-toolbar-title {
        font-family: 'Outfit', sans-serif;
        font-weight: 700;
        font-size: 1.25rem;
    }
    
    .fc .fc-col-header-cell-cushion {
        font-size: 0.85rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: inherit;
        padding: 8px 0;
    }
    
    .fc .fc-daygrid-day-number {
        font-size: 0.9rem;
        font-weight: 500;
        color: inherit;
        padding: 8px;
    }
    
    .fc-theme-standard .fc-scrollgrid {
        border-radius: 1rem;
        overflow: hidden;
        border: 1px solid rgba(0, 0, 0, 0.05);
    }
    
    .dark .fc-theme-standard .fc-scrollgrid {
        border: 1px solid rgba(255, 255, 255, 0.06);
    }
    
    .fc-event {
        cursor: pointer;
        padding: 2px 4px;
        font-size: 0.8rem;
        font-weight: 600;
        border-radius: 6px !important;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        transition: all 0.2s;
    }
    
    .fc-event:hover {
        transform: scale(1.02);
        opacity: 0.95;
    }
    
    /* Hide calendar license elements if any */
    .fc-license-message {
        display: none !important;
    }

    /* Responsive FullCalendar Toolbar & Grid */
    @media (max-width: 640px) {
        .fc .fc-toolbar {
            flex-direction: column;
            gap: 0.75rem;
            align-items: center;
        }
        .fc .fc-toolbar-chunk {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 0.35rem;
            width: 100%;
        }
        .fc .fc-button-group {
            display: inline-flex !important;
        }
        .fc .fc-button {
            padding: 0.35rem 0.6rem !important;
            font-size: 0.75rem !important;
        }
        .fc .fc-toolbar-title {
            font-size: 1.1rem !important;
            text-align: center;
            width: 100%;
            margin: 0.15rem 0;
        }
        .fc .fc-col-header-cell-cushion {
            font-size: 0.75rem;
            padding: 4px 0;
        }
        .fc .fc-daygrid-day-number {
            font-size: 0.75rem;
            padding: 4px;
        }
        .fc-list-event-title {
            font-size: 0.8rem !important;
            font-weight: 600 !important;
        }
        .fc-list-event-time {
            font-size: 0.75rem !important;
        }
    }
</style>
@endsection

@section('content')
<div x-data="adminCalendar()" class="h-full flex flex-col space-y-6">
    <!-- Top toolbar actions -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <p class="text-sm text-black/50 dark:text-white/40">Visualiza y administra todas las citas y bloqueos de horarios.</p>
        </div>
        <div class="flex items-center gap-3">
            <button @click="openBlockModal()" class="flex items-center gap-2 rounded-xl bg-red-600 hover:bg-red-700 text-white px-4 py-2.5 text-sm font-semibold shadow-md transition-all">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
                Bloquear Horario
            </button>
        </div>
    </div>

    <!-- Calendar Card Container -->
    <div class="rounded-2xl border border-black/5 dark:border-white/5 bg-white dark:bg-surface/30 p-3 md:p-6 shadow-sm backdrop-blur-xl flex-1 relative">
        <div id="calendar-el" class="w-full"></div>

        <!-- Context Menu -->
        <div x-show="isContextMenuOpen"
             id="context-menu-el"
             class="absolute z-50 rounded-xl border border-black/10 dark:border-white/10 bg-white dark:bg-[#111111] p-1.5 shadow-2xl w-48 text-sm"
             :style="'left: ' + contextMenuPos.x + 'px; top: ' + contextMenuPos.y + 'px; display: none;'">
            <button @click="openCreateBookingModal()" class="w-full text-left px-3 py-2 rounded-lg text-black dark:text-white hover:bg-brand hover:text-white transition-all flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                Agregar Cita
            </button>
            <button @click="openBlockModalFromContext()" class="w-full text-left px-3 py-2 rounded-lg text-black dark:text-white hover:bg-red-600 hover:text-white transition-all flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                Bloquear Horario
            </button>
        </div>
    </div>

    <!-- Event details modal -->
    <div x-show="isDetailModalOpen" 
         x-transition:enter="transition ease-out duration-200" 
         x-transition:enter-start="opacity-0 scale-95" 
         x-transition:enter-end="opacity-100 scale-100" 
         x-transition:leave="transition ease-in duration-150" 
         x-transition:leave-start="opacity-100 scale-100" 
         x-transition:leave-end="opacity-0 scale-95" 
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm"
         style="display: none;">
        <div class="w-full max-w-md rounded-2xl border border-black/10 dark:border-white/10 bg-white dark:bg-[#111111] p-6 shadow-2xl transition-all" @click.away="isDetailModalOpen = false">
            <div class="flex justify-between items-center mb-4 border-b border-black/5 dark:border-white/5 pb-3">
                <h3 class="font-display font-bold text-lg text-black dark:text-white">Detalle de Reserva</h3>
                <button @click="isDetailModalOpen = false" class="text-black/40 dark:text-white/40 hover:text-black dark:hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            
            <div class="space-y-4 text-sm" x-if="selectedEvent">
                <div>
                    <span class="block text-xs uppercase text-black/40 dark:text-white/30 font-semibold tracking-wider">Cliente</span>
                    <span class="text-black dark:text-white font-medium text-base" x-text="selectedEvent.customerName"></span>
                    <span class="block text-xs text-black/50 dark:text-white/50" x-text="selectedEvent.phone"></span>
                </div>
                <div>
                    <span class="block text-xs uppercase text-black/40 dark:text-white/30 font-semibold tracking-wider">Vehículo</span>
                    <span class="text-black dark:text-white font-medium" x-text="selectedEvent.vehicle"></span>
                </div>
                <div>
                    <span class="block text-xs uppercase text-black/40 dark:text-white/30 font-semibold tracking-wider">Servicio</span>
                    <span class="text-black dark:text-white font-medium" x-text="selectedEvent.service"></span>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <span class="block text-xs uppercase text-black/40 dark:text-white/30 font-semibold tracking-wider">Monto Total</span>
                        <span class="text-brand font-bold text-base" x-text="selectedEvent.amount"></span>
                    </div>
                    <div>
                        <span class="block text-xs uppercase text-black/40 dark:text-white/30 font-semibold tracking-wider">Estado de Pago</span>
                        <span class="inline-block px-2.5 py-0.5 rounded-full text-xs font-semibold mt-1 border"
                              :class="selectedEvent.paymentStatus === 'PAID' ? 'bg-green-500/10 border-green-500/20 text-green-600 dark:text-green-400' : 'bg-yellow-500/10 border-yellow-500/20 text-yellow-600 dark:text-yellow-400'"
                              x-text="selectedEvent.paymentStatus === 'PAID' ? 'Pagado' : 'Pendiente'"></span>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <span class="block text-xs uppercase text-black/40 dark:text-white/30 font-semibold tracking-wider">Horario Inicio</span>
                        <span class="text-black dark:text-white font-medium" x-text="formatDateStr(selectedEvent.start)"></span>
                    </div>
                    <div>
                        <span class="block text-xs uppercase text-black/40 dark:text-white/30 font-semibold tracking-wider">Horario Fin</span>
                        <span class="text-black dark:text-white font-medium" x-text="formatDateStr(selectedEvent.end)"></span>
                    </div>
                </div>

                <div class="pt-4 border-t border-black/5 dark:border-white/5 flex gap-3">
                    <a :href="'/reserva/' + selectedEvent.publicId" 
                       class="flex-1 text-center bg-brand hover:bg-brand-dark text-white font-semibold py-2.5 rounded-xl transition-all shadow-md shadow-brand/20">
                        Ver Detalles Online
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Block Details modal -->
    <div x-show="isBlockDetailModalOpen" 
         x-transition:enter="transition ease-out duration-200" 
         x-transition:enter-start="opacity-0 scale-95" 
         x-transition:enter-end="opacity-100 scale-100" 
         x-transition:leave="transition ease-in duration-150" 
         x-transition:leave-start="opacity-100 scale-100" 
         x-transition:leave-end="opacity-0 scale-95" 
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm"
         style="display: none;">
        <div class="w-full max-w-sm rounded-2xl border border-black/10 dark:border-white/10 bg-white dark:bg-[#111111] p-6 shadow-2xl transition-all" @click.away="isBlockDetailModalOpen = false">
            <div class="flex justify-between items-center mb-4 border-b border-black/5 dark:border-white/5 pb-3">
                <h3 class="font-display font-bold text-lg text-black dark:text-white flex items-center gap-2">
                    <svg class="w-5 h-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                    Detalle de Bloqueo
                </h3>
                <button @click="isBlockDetailModalOpen = false" class="text-black/40 dark:text-white/40 hover:text-black dark:hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            
            <div class="space-y-4 text-sm" x-if="selectedBlock">
                <div>
                    <span class="block text-xs uppercase text-black/40 dark:text-white/30 font-semibold tracking-wider">Motivo / Título</span>
                    <span class="text-black dark:text-white font-medium text-base" x-text="selectedBlock.title.replace('🔒 ', '')"></span>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <span class="block text-xs uppercase text-black/40 dark:text-white/30 font-semibold tracking-wider">Horario Inicio</span>
                        <span class="text-black dark:text-white font-medium" x-text="formatDateStr(selectedBlock.start)"></span>
                    </div>
                    <div>
                        <span class="block text-xs uppercase text-black/40 dark:text-white/30 font-semibold tracking-wider">Horario Fin</span>
                        <span class="text-black dark:text-white font-medium" x-text="formatDateStr(selectedBlock.end)"></span>
                    </div>
                </div>

                <div class="pt-4 border-t border-black/5 dark:border-white/5 flex gap-3">
                    <button type="button" @click="isBlockDetailModalOpen = false" class="flex-1 py-2.5 rounded-xl border border-black/10 dark:border-white/10 text-black/75 dark:text-white/75 font-semibold text-sm hover:bg-black/5 dark:hover:bg-white/5">
                        Cerrar
                    </button>
                    <button type="button" @click="deleteBlock()" :disabled="isDeletingBlock" class="flex-1 bg-red-600 hover:bg-red-700 text-white font-semibold py-2.5 rounded-xl transition-all shadow-md shadow-red-600/20 disabled:opacity-50">
                        <span x-show="!isDeletingBlock">Eliminar Bloqueo</span>
                        <span x-show="isDeletingBlock">Eliminando...</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Blocking Schedule Modal -->
    <div x-show="isBlockModalOpen" 
         x-transition:enter="transition ease-out duration-200" 
         x-transition:enter-start="opacity-0 scale-95" 
         x-transition:enter-end="opacity-100 scale-100" 
         x-transition:leave="transition ease-in duration-150" 
         x-transition:leave-start="opacity-100 scale-100" 
         x-transition:leave-end="opacity-0 scale-95" 
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm"
         style="display: none;">
        <div class="w-full max-w-md rounded-2xl border border-black/10 dark:border-white/10 bg-white dark:bg-[#111111] p-6 shadow-2xl transition-all" @click.away="isBlockModalOpen = false">
            <div class="flex justify-between items-center mb-4 border-b border-black/5 dark:border-white/5 pb-3">
                <h3 class="font-display font-bold text-lg text-black dark:text-white">Bloquear Rango Horario</h3>
                <button @click="isBlockModalOpen = false" class="text-black/40 dark:text-white/40 hover:text-black dark:hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            
            <form @submit.prevent="submitBlock" class="space-y-4">
                <div>
                    <label class="block text-xs uppercase text-black/55 dark:text-white/50 font-bold mb-1.5">Título / Motivo</label>
                    <input type="text" x-model="blockForm.title" required class="w-full rounded-xl border border-black/10 dark:border-white/10 bg-black/[0.02] dark:bg-surface/50 px-4 py-2.5 text-sm text-black dark:text-white outline-none focus:border-brand">
                </div>
                <div>
                    <label class="block text-xs uppercase text-black/55 dark:text-white/50 font-bold mb-1.5">Fecha</label>
                    <input type="date" x-model="blockForm.date" required class="w-full rounded-xl border border-black/10 dark:border-white/10 bg-black/[0.02] dark:bg-surface/50 px-4 py-2.5 text-sm text-black dark:text-white outline-none focus:border-brand">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs uppercase text-black/55 dark:text-white/50 font-bold mb-1.5">Hora Inicio</label>
                        <input type="time" x-model="blockForm.startTime" required class="w-full rounded-xl border border-black/10 dark:border-white/10 bg-black/[0.02] dark:bg-surface/50 px-4 py-2.5 text-sm text-black dark:text-white outline-none focus:border-brand">
                    </div>
                    <div>
                        <label class="block text-xs uppercase text-black/55 dark:text-white/50 font-bold mb-1.5">Hora Fin</label>
                        <input type="time" x-model="blockForm.endTime" required class="w-full rounded-xl border border-black/10 dark:border-white/10 bg-black/[0.02] dark:bg-surface/50 px-4 py-2.5 text-sm text-black dark:text-white outline-none focus:border-brand">
                    </div>
                </div>

                <div x-show="blockFormError" x-text="blockFormError" class="text-xs text-red-500 font-semibold mt-2"></div>

                <div class="pt-4 border-t border-black/5 dark:border-white/5 flex gap-3">
                    <button type="button" @click="isBlockModalOpen = false" class="flex-1 py-2.5 rounded-xl border border-black/10 dark:border-white/10 text-black/75 dark:text-white/75 font-semibold text-sm hover:bg-black/5 dark:hover:bg-white/5">
                        Cancelar
                    </button>
                    <button type="submit" :disabled="isSubmittingBlock" class="flex-1 bg-brand hover:bg-brand-dark text-white font-semibold py-2.5 rounded-xl transition-all shadow-md shadow-brand/20 disabled:opacity-50">
                        <span x-show="!isSubmittingBlock">Crear Bloqueo</span>
                        <span x-show="isSubmittingBlock">Procesando...</span>
                    </button>
                </div>
            </form>
        </div>
    </div>


    <!-- Create Appointment Modal -->
    <div x-show="isCreateModalOpen" 
         x-transition:enter="transition ease-out duration-200" 
         x-transition:enter-start="opacity-0 scale-95" 
         x-transition:enter-end="opacity-100 scale-100" 
         x-transition:leave="transition ease-in duration-150" 
         x-transition:leave-start="opacity-100 scale-100" 
         x-transition:leave-end="opacity-0 scale-95" 
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm"
         style="display: none;">
        <div class="w-full max-w-4xl rounded-2xl border border-black/10 dark:border-white/10 bg-white dark:bg-[#111111] p-6 shadow-2xl transition-all" @click.away="isCreateModalOpen = false">
            <div class="flex justify-between items-center mb-4 border-b border-black/5 dark:border-white/5 pb-3">
                <h3 class="font-display font-bold text-lg text-black dark:text-white">Nueva Cita (Administrador)</h3>
                <button @click="isCreateModalOpen = false" class="text-black/40 dark:text-white/40 hover:text-black dark:hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            
            <form @submit.prevent="submitBooking" class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Column 1: Client Information -->
                    <div class="space-y-4">
                        <h4 class="text-xs uppercase font-bold tracking-wider text-brand mb-2 border-b border-black/5 dark:border-white/5 pb-1">Información del Cliente</h4>
                        <div>
                            <label class="block text-xs uppercase text-black/55 dark:text-white/50 font-bold mb-1.5">Nombre</label>
                            <input type="text" x-model="bookingForm.firstName" required placeholder="Juan" class="w-full rounded-xl border border-black/10 dark:border-white/10 bg-black/[0.02] dark:bg-surface/50 px-4 py-2.5 text-sm text-black dark:text-white outline-none focus:border-brand">
                        </div>
                        <div>
                            <label class="block text-xs uppercase text-black/55 dark:text-white/50 font-bold mb-1.5">Apellido</label>
                            <input type="text" x-model="bookingForm.lastName" required placeholder="Pérez" class="w-full rounded-xl border border-black/10 dark:border-white/10 bg-black/[0.02] dark:bg-surface/50 px-4 py-2.5 text-sm text-black dark:text-white outline-none focus:border-brand">
                        </div>
                        <div>
                            <label class="block text-xs uppercase text-black/55 dark:text-white/50 font-bold mb-1.5">Teléfono</label>
                            <input type="text" x-model="bookingForm.phone" required placeholder="+56951024782" class="w-full rounded-xl border border-black/10 dark:border-white/10 bg-black/[0.02] dark:bg-surface/50 px-4 py-2.5 text-sm text-black dark:text-white outline-none focus:border-brand">
                        </div>
                        <div>
                            <label class="block text-xs uppercase text-black/55 dark:text-white/50 font-bold mb-1.5">Email</label>
                            <input type="email" x-model="bookingForm.email" required placeholder="juan@email.com" class="w-full rounded-xl border border-black/10 dark:border-white/10 bg-black/[0.02] dark:bg-surface/50 px-4 py-2.5 text-sm text-black dark:text-white outline-none focus:border-brand">
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs uppercase text-black/55 dark:text-white/50 font-bold mb-1.5">Patente</label>
                                <input type="text" x-model="bookingForm.licensePlate" required placeholder="ABCD12" class="w-full rounded-xl border border-black/10 dark:border-white/10 bg-black/[0.02] dark:bg-surface/50 px-4 py-2.5 text-sm text-black dark:text-white outline-none focus:border-brand">
                            </div>
                            <div>
                                <label class="block text-xs uppercase text-black/55 dark:text-white/50 font-bold mb-1.5">Comuna</label>
                                <input type="text" x-model="bookingForm.commune" placeholder="Chicureo" class="w-full rounded-xl border border-black/10 dark:border-white/10 bg-black/[0.02] dark:bg-surface/50 px-4 py-2.5 text-sm text-black dark:text-white outline-none focus:border-brand">
                            </div>
                        </div>
                    </div>

                    <!-- Column 2: Service/Appointment Details -->
                    <div class="space-y-4">
                        <h4 class="text-xs uppercase font-bold tracking-wider text-brand mb-2 border-b border-black/5 dark:border-white/5 pb-1">Detalles del Servicio</h4>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs uppercase text-black/55 dark:text-white/50 font-bold mb-1.5">Tipo de Vehículo</label>
                                <select x-model="bookingForm.vehicleTypeId" @change="validateAvailability()" required class="w-full rounded-xl border border-black/10 dark:border-white/10 bg-black/[0.02] dark:bg-surface/50 px-4 py-2.5 text-sm text-black dark:text-white outline-none focus:border-brand">
                                    <option value="">Selecciona...</option>
                                    @foreach($vehicleTypes as $vt)
                                        <option value="{{ $vt->id }}">{{ $vt->name }} (x{{ number_format($vt->price_multiplier, 2) }})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-xs uppercase text-black/55 dark:text-white/50 font-bold mb-1.5">Servicio Principal</label>
                                <select x-model="bookingForm.serviceId" @change="onServiceChange()" required class="w-full rounded-xl border border-black/10 dark:border-white/10 bg-black/[0.02] dark:bg-surface/50 px-4 py-2.5 text-sm text-black dark:text-white outline-none focus:border-brand">
                                    <option value="">Selecciona...</option>
                                    @foreach($services as $srv)
                                        <option value="{{ $srv->id }}">{{ $srv->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Dynamic Extras Checklist -->
                        <div x-show="availableExtras.length > 0" class="p-3 rounded-xl border border-black/5 dark:border-white/5 bg-black/[0.01] dark:bg-white/[0.02] max-h-28 overflow-y-auto" style="display: none;">
                            <span class="block text-xs uppercase text-black/55 dark:text-white/50 font-bold mb-1.5">Servicios Adicionales (Extras)</span>
                            <div class="grid grid-cols-1 gap-2">
                                <template x-for="extra in availableExtras" :key="extra.id">
                                    <label class="flex items-center gap-2 text-xs text-black/80 dark:text-white/80 cursor-pointer">
                                        <input type="checkbox" :value="extra.id" x-model="bookingForm.extraIds" @change="validateAvailability()" class="rounded border-black/10 text-brand focus:ring-brand">
                                        <span x-text="extra.name + ' (+ $' + new Intl.NumberFormat('es-CL').format(extra.price) + ')'"></span>
                                    </label>
                                </template>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs uppercase text-black/55 dark:text-white/50 font-bold mb-1.5">Fecha</label>
                                <input type="date" x-model="bookingForm.date" @change="validateAvailability()" required class="w-full rounded-xl border border-black/10 dark:border-white/10 bg-black/[0.02] dark:bg-surface/50 px-4 py-2.5 text-sm text-black dark:text-white outline-none focus:border-brand">
                            </div>
                            <div>
                                <label class="block text-xs uppercase text-black/55 dark:text-white/50 font-bold mb-1.5">Hora de Inicio</label>
                                <input type="time" x-model="bookingForm.time" @change="validateAvailability()" required class="w-full rounded-xl border border-black/10 dark:border-white/10 bg-black/[0.02] dark:bg-surface/50 px-4 py-2.5 text-sm text-black dark:text-white outline-none focus:border-brand">
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs uppercase text-black/55 dark:text-white/50 font-bold mb-1.5">Asignar Bahía</label>
                                <select x-model="bookingForm.bayId" @change="validateAvailability()" class="w-full rounded-xl border border-black/10 dark:border-white/10 bg-black/[0.02] dark:bg-surface/50 px-4 py-2.5 text-sm text-black dark:text-white outline-none focus:border-brand">
                                    <option value="auto">Asignación Automática</option>
                                    @foreach($bays as $bay)
                                        <option value="{{ $bay->id }}">{{ $bay->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-xs uppercase text-black/55 dark:text-white/50 font-bold mb-1.5">Estado de Pago</label>
                                <select x-model="bookingForm.payment_status" required class="w-full rounded-xl border border-black/10 dark:border-white/10 bg-black/[0.02] dark:bg-surface/50 px-4 py-2.5 text-sm text-black dark:text-white outline-none focus:border-brand">
                                    <option value="PENDING">Pendiente</option>
                                    <option value="PAID">Pagado</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs uppercase text-black/55 dark:text-white/50 font-bold mb-1.5">Comentarios / Notas</label>
                            <textarea x-model="bookingForm.notes" rows="2" placeholder="Detalles de la cita..." class="w-full rounded-xl border border-black/10 dark:border-white/10 bg-black/[0.02] dark:bg-surface/50 px-4 py-2 text-sm text-black dark:text-white outline-none focus:border-brand resize-none"></textarea>
                        </div>
                    </div>
                </div>

                <!-- Availability Badge Indicator & Errors -->
                <div class="pt-4 border-t border-black/5 dark:border-white/5">
                    <div x-show="isValidatingAvailability" class="flex items-center gap-2 text-xs text-black/50 dark:text-white/50" style="display: none;">
                        <span class="inline-block animate-spin h-3.5 w-3.5 border-2 border-brand border-t-transparent rounded-full"></span>
                        <span>Verificando disponibilidad...</span>
                    </div>
                    <div x-show="!isValidatingAvailability && availabilityStatus === 'available'" class="text-xs text-green-500 font-bold flex items-center gap-1" style="display: none;">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Horario Disponible
                    </div>
                    <div x-show="!isValidatingAvailability && availabilityStatus === 'conflict'" class="text-xs text-yellow-500 font-bold flex items-center gap-1" style="display: none;">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                        El horario seleccionado no está disponible en las bahías comerciales.
                    </div>
                    <div x-show="bookingFormError" x-text="bookingFormError" class="text-xs text-red-500 font-semibold mt-2" style="display: none;"></div>
                </div>

                <!-- Footer buttons -->
                <div class="pt-4 border-t border-black/5 dark:border-white/5 flex justify-end gap-3">
                    <button type="button" @click="isCreateModalOpen = false" class="px-5 py-2.5 rounded-xl border border-black/10 dark:border-white/10 text-black/75 dark:text-white/75 font-semibold text-sm hover:bg-black/5 dark:hover:bg-white/5">
                        Cancelar
                    </button>
                    <button type="submit" :disabled="isSubmittingBooking || availabilityStatus === 'conflict'" class="px-6 py-2.5 bg-brand hover:bg-brand-dark text-white font-semibold rounded-xl transition-all shadow-md shadow-brand/20 disabled:opacity-50 disabled:cursor-not-allowed">
                        <span x-show="!isSubmittingBooking">Crear Cita</span>
                        <span x-show="isSubmittingBooking">Guardando...</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- Load FullCalendar Library globally -->
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/locales/es.global.min.js"></script>

<script>
function adminCalendar() {
    return {
        calendar: null,
        isDetailModalOpen: false,
        isBlockModalOpen: false,
        isCreateModalOpen: false,
        isContextMenuOpen: false,
        selectedEvent: null,
        
        // Context menu positions
        contextMenuPos: { x: 0, y: 0 },
        selectedContextDate: null,
        selectedContextTime: '09:00',
        
        // Block form
        blockForm: {
            title: 'Bloqueo manual',
            date: new Date().toISOString().split('T')[0],
            startTime: '09:00',
            endTime: '18:00',
        },
        isSubmittingBlock: false,
        blockFormError: null,

        // Block Detail Modal
        isBlockDetailModalOpen: false,
        selectedBlock: null,
        isDeletingBlock: false,

        // Create booking form
        bookingForm: {
            firstName: '',
            lastName: '',
            email: '',
            phone: '',
            vehicleTypeId: '',
            licensePlate: '',
            commune: 'Chicureo',
            serviceId: '',
            extraIds: [],
            date: '',
            time: '09:00',
            bayId: 'auto',
            payment_status: 'PENDING',
            notes: '',
        },
        availableExtras: [],
        servicesList: @json($services),
        isValidatingAvailability: false,
        availabilityStatus: 'available',
        bookingFormError: null,
        isSubmittingBooking: false,

        init() {
            const calendarEl = document.getElementById('calendar-el');
            const isMobile = window.innerWidth < 640;
            
            this.calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: isMobile ? 'listWeek' : 'dayGridMonth',
                locale: 'es',
                firstDay: 1,
                headerToolbar: isMobile ? {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'listWeek,timeGridDay,dayGridMonth'
                } : {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                height: 'auto',
                editable: false,
                selectable: false,
                events: '/api/admin/calendario/events',
                eventClick: (info) => {
                    // Check if it is a block background event
                    if (info.event.id.startsWith('block_')) {
                        this.selectedBlock = {
                            id: info.event.id,
                            title: info.event.title,
                            start: info.event.start,
                            end: info.event.end
                        };
                        this.isBlockDetailModalOpen = true;
                        return;
                    }
                    this.selectedEvent = info.event.extendedProps;
                    this.selectedEvent.start = info.event.start;
                    this.selectedEvent.end = info.event.end;
                    this.isDetailModalOpen = true;
                }
            });
            this.calendar.render();

            // Delegate right-click context menu events inside the calendar
            calendarEl.addEventListener('contextmenu', (e) => {
                const dayEl = e.target.closest('.fc-daygrid-day');
                const timeEl = e.target.closest('.fc-timegrid-slot');
                
                let dateStr = null;
                let timeStr = '09:00';
                
                if (dayEl) {
                    dateStr = dayEl.getAttribute('data-date');
                } else if (timeEl) {
                    const colEl = e.target.closest('.fc-timegrid-col');
                    if (colEl) {
                        dateStr = colEl.getAttribute('data-date');
                    }
                    const timeVal = timeEl.getAttribute('data-time');
                    if (timeVal) {
                        timeStr = timeVal.slice(0, 5);
                    }
                }
                
                if (dateStr) {
                    e.preventDefault();
                    
                    // Close menu first to trigger Alpine's reactivity cycle
                    this.isContextMenuOpen = false;
                    
                    const containerEl = calendarEl.parentElement;
                    const rect = containerEl.getBoundingClientRect();
                    
                    // Reassign the position object so Alpine deeply tracks the reference change
                    this.contextMenuPos = {
                        x: e.clientX - rect.left,
                        y: e.clientY - rect.top
                    };
                    this.selectedContextDate = dateStr;
                    this.selectedContextTime = timeStr;
                    
                    // Reopen at the new coordinates on the next tick
                    setTimeout(() => {
                        this.isContextMenuOpen = true;
                    }, 0);
                }
            });

            // Close context menu on left click outside
            document.addEventListener('click', (e) => {
                if (!e.target.closest('#context-menu-el')) {
                    this.isContextMenuOpen = false;
                }
            });

            // Close context menu on right click outside calendar
            document.addEventListener('contextmenu', (e) => {
                if (!calendarEl.contains(e.target) && !e.target.closest('#context-menu-el')) {
                    this.isContextMenuOpen = false;
                }
            });
        },

        openBlockModal() {
            this.blockForm.date = new Date().toISOString().split('T')[0];
            this.blockForm.startTime = '09:00';
            this.blockForm.endTime = '18:00';
            this.blockFormError = null;
            this.isBlockModalOpen = true;
        },

        openBlockModalFromContext() {
            this.blockForm.date = this.selectedContextDate;
            this.blockForm.startTime = this.selectedContextTime;
            const startHour = parseInt(this.selectedContextTime.split(':')[0]);
            const endHour = Math.min(23, startHour + 1);
            this.blockForm.endTime = `${String(endHour).padStart(2, '0')}:${this.selectedContextTime.split(':')[1]}`;
            this.blockFormError = null;
            this.isContextMenuOpen = false;
            this.isBlockModalOpen = true;
        },

        openCreateBookingModal() {
            // Reset form
            this.bookingForm = {
                firstName: '',
                lastName: '',
                email: '',
                phone: '',
                vehicleTypeId: '',
                licensePlate: '',
                commune: 'Chicureo',
                serviceId: '',
                extraIds: [],
                date: this.selectedContextDate,
                time: this.selectedContextTime,
                bayId: 'auto',
                payment_status: 'PENDING',
                notes: '',
            };
            this.availableExtras = [];
            this.bookingFormError = null;
            this.availabilityStatus = 'available';
            this.isContextMenuOpen = false;
            this.isCreateModalOpen = true;
        },

        onServiceChange() {
            const service = this.servicesList.find(s => s.id === this.bookingForm.serviceId);
            this.availableExtras = service ? service.extras : [];
            this.bookingForm.extraIds = [];
            this.validateAvailability();
        },

        validateAvailability() {
            if (!this.bookingForm.serviceId || !this.bookingForm.vehicleTypeId || !this.bookingForm.date || !this.bookingForm.time) {
                this.availabilityStatus = 'available';
                return;
            }
            
            this.isValidatingAvailability = true;
            this.bookingFormError = null;
            
            const params = new URLSearchParams({
                date: this.bookingForm.date,
                serviceId: this.bookingForm.serviceId,
                vehicleTypeId: this.bookingForm.vehicleTypeId
            });
            this.bookingForm.extraIds.forEach(id => {
                params.append('extraIds[]', id);
            });
            
            fetch(`/api/bookings/availability?${params.toString()}`)
                .then(res => res.json())
                .then(data => {
                    if (data.error) {
                        this.availabilityStatus = 'conflict';
                        this.bookingFormError = data.error.message;
                        return;
                    }
                    const targetStart = `${this.bookingForm.date} ${this.bookingForm.time}:00`;
                    
                    const match = data.slots.some(slot => {
                        const matchesTime = slot.startAt === targetStart;
                        const matchesBay = this.bookingForm.bayId === 'auto' || slot.bayId === this.bookingForm.bayId;
                        return matchesTime && matchesBay;
                    });
                    
                    this.availabilityStatus = match ? 'available' : 'conflict';
                })
                .catch(() => {
                    this.availabilityStatus = 'conflict';
                })
                .finally(() => {
                    this.isValidatingAvailability = false;
                });
        },

        submitBooking() {
            this.isSubmittingBooking = true;
            this.bookingFormError = null;

            fetch('/api/admin/bookings', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                },
                body: JSON.stringify(this.bookingForm)
            })
            .then(async (response) => {
                const data = await response.json();
                if (!response.ok) {
                    throw new Error(data.error?.message || 'No se pudo crear la reserva.');
                }
                this.calendar.refetchEvents();
                this.isCreateModalOpen = false;
            })
            .catch(err => {
                this.bookingFormError = err.message;
            })
            .finally(() => {
                this.isSubmittingBooking = false;
            });
        },

        submitBlock() {
            this.isSubmittingBlock = true;
            this.blockFormError = null;
            
            const payload = {
                title: this.blockForm.title,
                starts_at: `${this.blockForm.date} ${this.blockForm.startTime}:00`,
                ends_at: `${this.blockForm.date} ${this.blockForm.endTime}:00`,
                block_type: 'MANUAL',
            };

            fetch('/api/admin/schedule-blocks', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                },
                body: JSON.stringify(payload)
            })
            .then(async (response) => {
                const data = await response.json();
                if (!response.ok) {
                    throw new Error(data.error?.message || 'No se pudo crear el bloqueo.');
                }
                this.calendar.refetchEvents();
                this.isBlockModalOpen = false;
            })
            .catch(err => {
                this.blockFormError = err.message;
            })
            .finally(() => {
                this.isSubmittingBlock = false;
            });
        },

        formatDateStr(date) {
            if (!date) return '';
            const d = new Date(date);
            return d.toLocaleString('es-CL', {
                dateStyle: 'medium',
                timeStyle: 'short'
            });
        },

        deleteBlock() {
            if (!confirm('¿Estás seguro que deseas eliminar este bloqueo?')) return;
            
            this.isDeletingBlock = true;
            const blockId = this.selectedBlock.id.replace('block_', '');
            
            fetch('/api/admin/schedule-blocks/' + blockId, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                }
            })
            .then(async (response) => {
                if (!response.ok) {
                    const data = await response.json();
                    throw new Error(data.error?.message || 'Error al eliminar');
                }
                this.calendar.refetchEvents();
                this.isBlockDetailModalOpen = false;
            })
            .catch(err => {
                alert(err.message);
            })
            .finally(() => {
                this.isDeletingBlock = false;
            });
        }
    };
}
</script>
@endsection
