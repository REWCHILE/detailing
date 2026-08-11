@extends('layouts.admin')

@section('title', isset($extra) ? 'Editar Extra' : 'Nuevo Extra')
@section('title_section', isset($extra) ? 'Editar Extra: ' . $extra->name : 'Nuevo Extra')

@section('content')
<div x-data="extraForm()" class="w-full max-w-4xl mx-auto flex flex-col rounded-2xl border border-black/10 dark:border-white/10 bg-white dark:bg-[#111111] shadow-2xl transition-all overflow-hidden min-h-[60vh]">
    <!-- Header -->
    <div class="flex justify-between items-center px-6 py-4 border-b border-black/5 dark:border-white/5">
        <h3 class="font-display font-bold text-lg text-black dark:text-white" x-text="isEdit ? 'Editar Extra' : 'Nuevo Extra'"></h3>
        <a href="{{ route('admin.extras') }}" class="text-black/40 dark:text-white/40 hover:text-black dark:hover:text-white">
            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
        </a>
    </div>
    
    <form :action="isEdit ? '/admin/extras/' + form.id : '/admin/extras'" method="POST" class="flex flex-col flex-1 overflow-hidden min-h-0">
        @csrf
        <template x-if="isEdit">
            <input type="hidden" name="_method" value="PUT">
        </template>

        <!-- Scrollable Body -->
        <div class="flex-1 overflow-y-auto p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Columna Izquierda: Datos del Extra -->
                <div class="space-y-4">
                    <div>
                        <label class="flex items-center gap-1.5 text-xs uppercase text-black/55 dark:text-white/50 font-bold mb-1.5">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                            Nombre
                        </label>
                        <input type="text" name="name" x-model="form.name" required class="w-full rounded-xl border border-black/10 dark:border-white/10 bg-black/[0.02] dark:bg-surface/50 px-4 py-2.5 text-sm text-black dark:text-white outline-none focus:border-brand">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="flex items-center gap-1.5 text-xs uppercase text-black/55 dark:text-white/50 font-bold mb-1.5">
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                Precio ($)
                            </label>
                            <input type="number" name="price" x-model="form.price" required min="0" class="w-full rounded-xl border border-black/10 dark:border-white/10 bg-black/[0.02] dark:bg-surface/50 px-4 py-2.5 text-sm text-black dark:text-white outline-none focus:border-brand">
                        </div>
                        <div>
                            <label class="flex items-center gap-1.5 text-xs uppercase text-black/55 dark:text-white/50 font-bold mb-1.5">
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                Duración (min)
                            </label>
                            <input type="number" name="duration_minutes" x-model="form.duration_minutes" required min="1" class="w-full rounded-xl border border-black/10 dark:border-white/10 bg-black/[0.02] dark:bg-surface/50 px-4 py-2.5 text-sm text-black dark:text-white outline-none focus:border-brand">
                        </div>
                    </div>

                    <div>
                        <label class="flex items-center gap-1.5 text-xs uppercase text-black/55 dark:text-white/50 font-bold mb-1.5">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12"/></svg>
                            Orden de Visualización
                        </label>
                        <input type="number" name="display_order" x-model="form.display_order" required min="0" class="w-full rounded-xl border border-black/10 dark:border-white/10 bg-black/[0.02] dark:bg-surface/50 px-4 py-2.5 text-sm text-black dark:text-white outline-none focus:border-brand">
                    </div>

                    <label class="flex items-center gap-2 rounded-xl border border-black/5 dark:border-white/5 bg-black/[0.01] dark:bg-surface/20 p-3 select-none cursor-pointer hover:bg-black/[0.03] dark:hover:bg-surface/40 transition-colors">
                        <input type="checkbox" name="is_active" value="1" :checked="form.is_active" class="rounded border-black/10 dark:border-white/10 text-brand focus:ring-brand">
                        <span class="text-sm font-medium text-black/80 dark:text-white/80">Extra Activo (Visible)</span>
                    </label>

                    <div>
                        <label class="flex items-center gap-1.5 text-xs uppercase text-black/55 dark:text-white/50 font-bold mb-1.5">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h7"/></svg>
                            Descripción
                        </label>
                        <textarea name="description" x-model="form.description" rows="3" required class="w-full rounded-xl border border-black/10 dark:border-white/10 bg-black/[0.02] dark:bg-surface/50 px-4 py-2.5 text-sm text-black dark:text-white outline-none focus:border-brand resize-none"></textarea>
                    </div>
                </div>

                <!-- Columna Derecha: Vinculación -->
                <div>
                    <label class="flex items-center gap-1.5 text-xs uppercase text-black/55 dark:text-white/50 font-bold mb-1.5">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                        Vincular a Servicios
                    </label>
                    <div class="space-y-2 max-h-[300px] overflow-y-auto p-3 rounded-xl border border-black/10 dark:border-white/10 bg-black/[0.01] dark:bg-surface/10">
                        @foreach($services as $srv)
                        <label class="flex items-center gap-2 cursor-pointer text-sm text-black/80 dark:text-white/80 hover:text-brand transition-colors p-1.5 rounded-lg hover:bg-black/[0.02] dark:hover:bg-white/[0.02]">
                            <input type="checkbox" name="services[]" value="{{ $srv->id }}" x-model="form.services" class="rounded border-black/20 text-brand focus:ring-brand">
                            <span class="truncate">{{ $srv->name }}</span>
                        </label>
                        @endforeach
                        @if($services->isEmpty())
                            <span class="text-xs text-black/40 block p-2">No hay servicios creados.</span>
                        @endif
                    </div>
                    
                    <div class="mt-4 p-3 rounded-xl border border-black/5 dark:border-white/5 bg-black/[0.01] dark:bg-surface/20 text-[11px] leading-relaxed text-black/60 dark:text-white/50">
                        <p class="font-semibold text-black/80 dark:text-white/70 mb-1 flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5 text-brand" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            Nota sobre vinculación:
                        </p>
                        <p>Al marcar un servicio aquí, este extra aparecerá disponible cuando el cliente cotice dicho servicio. Podrás configurar si es opcional, requerido o de cortesía directamente desde la pantalla de edición de cada servicio.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="px-6 py-4 border-t border-black/5 dark:border-white/5 flex gap-3 justify-end bg-gray-50 dark:bg-surface/10 rounded-b-2xl">
            <a href="{{ route('admin.extras') }}" class="px-6 py-2.5 rounded-xl border border-black/10 dark:border-white/10 text-black/75 dark:text-white/75 font-semibold text-sm hover:bg-black/5 dark:hover:bg-white/5 transition-all text-center">
                Cancelar
            </a>
            <button type="submit" class="px-8 py-2.5 bg-brand hover:bg-brand-dark text-white font-semibold rounded-xl transition-all shadow-md shadow-brand/20">
                Guardar
            </button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
function extraForm() {
    const extraData = @json(isset($extra) ? $extra : null);
    const isEditMode = extraData !== null;

    let initialForm = {
        id: '',
        name: '',
        price: '',
        duration_minutes: '',
        display_order: '0',
        is_active: true,
        description: '',
        services: [],
    };

    if (isEditMode) {
        initialForm = {
            id: extraData.id,
            name: extraData.name,
            price: extraData.price,
            duration_minutes: extraData.duration_minutes,
            display_order: extraData.display_order,
            is_active: !!extraData.is_active,
            description: extraData.description || '',
            services: extraData.services ? extraData.services.map(s => s.id) : [],
        };
    }

    return {
        isEdit: isEditMode,
        form: initialForm,
        searchExtra: '',
    };
}
</script>
@endsection
