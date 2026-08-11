@extends('layouts.admin')

@section('title', 'Tipos de Vehículo | High Contrast Detailing')
@section('title_section', 'Vehículos')

@section('content')
<div x-data class="space-y-6">
    <!-- Top actions -->
    <div class="flex justify-between items-center">
        <p class="text-sm text-black/50 dark:text-white/40">Configura los tipos de vehículos y sus multiplicadores de precios.</p>
        <button @click="$dispatch('open-vehicle-create')" class="rounded-xl bg-brand hover:bg-brand-dark text-white px-4 py-2.5 text-sm font-semibold shadow-md transition-all">
            + Nuevo Vehículo
        </button>
    </div>

    <!-- Vehicles list -->
    <div class="rounded-2xl bg-white dark:bg-surface/20 border border-black/5 dark:border-white/5 overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b border-black/5 dark:border-white/5 bg-gray-50 dark:bg-surface/10">
                        <th class="text-xs text-black/50 dark:text-white/40 font-semibold px-6 py-4">Orden</th>
                        <th class="text-xs text-black/50 dark:text-white/40 font-semibold px-6 py-4">Tipo de Vehículo</th>
                        <th class="text-xs text-black/50 dark:text-white/40 font-semibold px-6 py-4">Estado</th>
                        <th class="text-xs text-black/50 dark:text-white/40 font-semibold px-6 py-4 text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-black/5 dark:divide-white/5">
                    @forelse($vehicles as $vt)
                        <tr class="hover:bg-black/[0.01] dark:hover:bg-white/[0.01] transition-colors">
                            <td class="px-6 py-4 font-bold text-sm text-black/60 dark:text-white/50">
                                #{{ $vt->display_order }}
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-black dark:text-white text-sm font-semibold flex items-center gap-2">
                                    <span class="text-lg bg-black/[0.03] dark:bg-white/[0.05] w-8 h-8 rounded-lg inline-flex items-center justify-center border border-black/5 dark:border-white/5">{{ $vt->emoji ?? '🚗' }}</span>
                                    <span>{{ $vt->name }}</span>
                                </p>
                                <p class="text-black/40 dark:text-white/30 text-xs line-clamp-1">
                                    {{ $vt->description }}
                                </p>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex px-2 py-0.5 rounded-full text-[10px] font-semibold border {{ $vt->is_active ? 'bg-green-500/10 border-green-500/20 text-green-600 dark:text-green-400' : 'bg-red-500/10 border-red-500/20 text-red-600 dark:text-red-400' }}">
                                    {{ $vt->is_active ? 'Activo' : 'Inactivo' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right space-x-2">
                                <button @click="$dispatch('open-vehicle-edit', { vt: {{ json_encode($vt) }} })" class="text-xs text-blue-600 dark:text-blue-400 font-bold hover:underline">
                                    Editar
                                </button>
                                <form method="POST" action="/admin/vehiculos/{{ $vt->id }}" class="inline-block" onsubmit="return confirm('¿Seguro que deseas eliminar este tipo de vehículo?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-xs text-red-600 dark:text-red-400 font-bold hover:underline">
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colSpan="5" class="px-6 py-12 text-center text-sm text-black/40 dark:text-white/40">
                                No hay tipos de vehículos configurados todavía.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Create/Edit Modal -->
    <div x-data="vehiclesCrud()"
             @open-vehicle-create.window="openCreateModal()"
             @open-vehicle-edit.window="openEditModal($event.detail.vt)"
             x-show="isOpen" 
         x-transition:enter="transition ease-out duration-200" 
         x-transition:enter-start="opacity-0 scale-95" 
         x-transition:enter-end="opacity-100 scale-100" 
         x-transition:leave="transition ease-in duration-150" 
         x-transition:leave-start="opacity-100 scale-100" 
         x-transition:leave-end="opacity-0 scale-95" 
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm"
         style="display: none;">
        <div class="w-full max-w-md rounded-2xl border border-black/10 dark:border-white/10 bg-white dark:bg-[#111111] p-6 shadow-2xl transition-all" @click.away="isOpen = false">
            <div class="flex justify-between items-center mb-4 border-b border-black/5 dark:border-white/5 pb-3">
                <h3 class="font-display font-bold text-lg text-black dark:text-white" x-text="isEdit ? 'Editar Tipo de Vehículo' : 'Nuevo Tipo de Vehículo'"></h3>
                <button @click="isOpen = false" class="text-black/40 dark:text-white/40 hover:text-black dark:hover:text-white">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            
            <form :action="isEdit ? '/admin/vehiculos/' + form.id : '/admin/vehiculos'" method="POST" class="space-y-4">
                @csrf
                <template x-if="isEdit">
                    <input type="hidden" name="_method" value="PUT">
                </template>

                <div class="grid grid-cols-3 gap-4">
                    <div class="col-span-2">
                        <label class="block text-xs uppercase text-black/55 dark:text-white/50 font-bold mb-1.5">Nombre</label>
                        <input type="text" name="name" x-model="form.name" required class="w-full rounded-xl border border-black/10 dark:border-white/10 bg-black/[0.02] dark:bg-surface/50 px-4 py-2.5 text-sm text-black dark:text-white outline-none focus:border-brand">
                    </div>
                    <div>
                        <label class="block text-xs uppercase text-black/55 dark:text-white/50 font-bold mb-1.5">Emoji / Icono</label>
                        <input type="text" name="emoji" x-model="form.emoji" required placeholder="🚗" class="w-full rounded-xl border border-black/10 dark:border-white/10 bg-black/[0.02] dark:bg-surface/50 px-4 py-2.5 text-sm text-center text-black dark:text-white outline-none focus:border-brand">
                    </div>
                </div>

                <div>
                    <label class="block text-xs uppercase text-black/55 dark:text-white/50 font-bold mb-1.5">Orden de Visualización</label>
                    <input type="number" name="display_order" x-model="form.display_order" required min="0" class="w-full rounded-xl border border-black/10 dark:border-white/10 bg-black/[0.02] dark:bg-surface/50 px-4 py-2.5 text-sm text-black dark:text-white outline-none focus:border-brand">
                </div>

                <label class="flex items-center gap-2 rounded-xl border border-black/5 dark:border-white/5 bg-black/[0.01] dark:bg-surface/20 p-3 select-none">
                    <input type="checkbox" name="is_active" value="1" :checked="form.is_active" class="rounded border-black/10 dark:border-white/10 text-brand focus:ring-brand">
                    <span class="text-sm font-medium text-black/80 dark:text-white/80">Activo</span>
                </label>

                <div>
                    <label class="block text-xs uppercase text-black/55 dark:text-white/50 font-bold mb-1.5">Descripción</label>
                    <textarea name="description" x-model="form.description" rows="3" class="w-full rounded-xl border border-black/10 dark:border-white/10 bg-black/[0.02] dark:bg-surface/50 px-4 py-2.5 text-sm text-black dark:text-white outline-none focus:border-brand"></textarea>
                </div>

                <div class="pt-4 border-t border-black/5 dark:border-white/5 flex gap-3">
                    <button type="button" @click="isOpen = false" class="flex-1 py-2.5 rounded-xl border border-black/10 dark:border-white/10 text-black/75 dark:text-white/75 font-semibold text-sm hover:bg-black/5 dark:hover:bg-white/5">
                        Cancelar
                    </button>
                    <button type="submit" class="flex-1 bg-brand hover:bg-brand-dark text-white font-semibold py-2.5 rounded-xl transition-all shadow-md shadow-brand/20">
                        Guardar
                    </button>
                </div>
            </form>
        </div>
</div>
@endsection

@section('scripts')
<script>
function vehiclesCrud() {
    return {
        isOpen: false,
        isEdit: false,
        form: {
            id: '',
            name: '',
            emoji: '🚗',
            price_multiplier: '1.00',
            display_order: '0',
            is_active: true,
            description: '',
        },

        openCreateModal() {
            this.isEdit = false;
            this.form = {
                id: '',
                name: '',
                emoji: '🚗',
                price_multiplier: '1.00',
                display_order: '0',
                is_active: true,
                description: '',
            };
            this.isOpen = true;
        },

        openEditModal(vt) {
            this.isEdit = true;
            this.form = {
                id: vt.id,
                name: vt.name,
                emoji: vt.emoji || '🚗',
                price_multiplier: vt.price_multiplier,
                display_order: vt.display_order,
                is_active: !!vt.is_active,
                description: vt.description || '',
            };
            this.isOpen = true;
        }
    };
}
</script>
@endsection
