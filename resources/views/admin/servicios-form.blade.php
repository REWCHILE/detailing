@extends('layouts.admin')

@section('title', isset($service) ? 'Editar Servicio' : 'Nuevo Servicio')
@section('title_section', isset($service) ? 'Editar Servicio' : 'Nuevo Servicio')

@section('content')
<div x-data="serviceForm()" class="w-full max-w-6xl mx-auto flex flex-col rounded-2xl border border-black/10 dark:border-white/10 bg-white dark:bg-[#111111] shadow-2xl transition-all overflow-hidden min-h-[70vh]">
    <!-- Header -->
    <div class="flex justify-between items-center px-6 py-4 border-b border-black/5 dark:border-white/5">
        <h3 class="font-display font-bold text-lg text-black dark:text-white" x-text="isEdit ? 'Editar Servicio' : 'Nuevo Servicio'"></h3>
        <a href="{{ route('admin.servicios') }}" class="text-black/40 dark:text-white/40 hover:text-black dark:hover:text-white">
            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
        </a>
    </div>
    
    <!-- Form -->
    <form :action="isEdit ? '/admin/servicios/' + form.id : '/admin/servicios'" method="POST" class="flex flex-col flex-1">
        @csrf
        <template x-if="isEdit">
            <input type="hidden" name="_method" value="PUT">
        </template>

        <!-- Scrollable Body -->
        <div class="flex-1 p-6 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Columna Izquierda: Datos Básicos -->
                <div class="space-y-4">
                    <div>
                        <label class="flex items-center gap-1.5 text-xs uppercase text-black/55 dark:text-white/50 font-bold mb-1.5">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                            Nombre del Servicio
                        </label>
                        <input type="text" name="name" x-model="form.name" required class="w-full rounded-xl border border-black/10 dark:border-white/10 bg-black/[0.02] dark:bg-surface/50 px-4 py-2.5 text-sm text-black dark:text-white outline-none focus:border-brand">
                    </div>

                    <div>
                        <label class="flex items-center gap-1.5 text-xs uppercase text-black/55 dark:text-white/50 font-bold mb-1.5">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/></svg>
                            Categoría en Cotizador
                        </label>
                        <select name="category" x-model="form.category" required class="w-full rounded-xl border border-black/10 dark:border-white/10 bg-black/[0.02] dark:bg-surface/50 px-4 py-2.5 text-sm text-black dark:text-white outline-none focus:border-brand">
                            <option value="limpieza">🧽 Limpieza & Detallado</option>
                            <option value="correccion">✨ Corrección de Pintura</option>
                            <option value="ceramico">🛡️ Ceramic Coating</option>
                            <option value="especiales">🔧 Especiales & Parabrisas</option>
                        </select>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="flex items-center gap-1.5 text-xs uppercase text-black/55 dark:text-white/50 font-bold mb-1.5">
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                Duración (minutos)
                            </label>
                            <input type="number" name="duration_minutes" x-model="form.duration_minutes" required min="1" class="w-full rounded-xl border border-black/10 dark:border-white/10 bg-black/[0.02] dark:bg-surface/50 px-4 py-2.5 text-sm text-black dark:text-white outline-none focus:border-brand">
                        </div>
                        <div>
                            <label class="flex items-center gap-1.5 text-xs uppercase text-black/55 dark:text-white/50 font-bold mb-1.5">
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12"/></svg>
                                Orden de Visualización
                            </label>
                            <input type="number" name="display_order" x-model="form.display_order" required min="0" class="w-full rounded-xl border border-black/10 dark:border-white/10 bg-black/[0.02] dark:bg-surface/50 px-4 py-2.5 text-sm text-black dark:text-white outline-none focus:border-brand">
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <label class="flex items-center gap-2 rounded-xl border border-black/5 dark:border-white/5 bg-black/[0.01] dark:bg-surface/20 p-3 select-none cursor-pointer hover:bg-black/[0.03] dark:hover:bg-surface/40 transition-colors">
                            <input type="checkbox" name="is_active" value="1" :checked="form.is_active" class="rounded border-black/10 dark:border-white/10 text-brand focus:ring-brand">
                            <span class="text-sm font-medium text-black/80 dark:text-white/80">Activo</span>
                        </label>
                        <label class="flex items-center gap-2 rounded-xl border border-black/5 dark:border-white/5 bg-black/[0.01] dark:bg-surface/20 p-3 select-none cursor-pointer hover:bg-black/[0.03] dark:hover:bg-surface/40 transition-colors">
                            <input type="checkbox" name="is_featured" value="1" :checked="form.is_featured" class="rounded border-black/10 dark:border-white/10 text-brand focus:ring-brand">
                            <span class="text-sm font-medium text-black/80 dark:text-white/80">Destacado</span>
                        </label>
                    </div>

                    <!-- Pricing by Vehicle Type -->
                    <div class="pt-2">
                        <label class="block text-xs uppercase text-brand font-extrabold tracking-wider mb-4">Precios por Tipo de Automóvil ($)</label>
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                            @foreach($vehicleTypes as $vt)
                                <div>
                                    <label class="block text-[11px] text-black/60 dark:text-white/55 font-bold mb-1.5">{{ $vt->name }}</label>
                                    <input type="number" 
                                           name="prices[{{ $vt->id }}]" 
                                           x-model="form.prices['{{ $vt->id }}']" 
                                           required 
                                           min="0" 
                                           class="w-full rounded-xl border border-black/10 dark:border-white/10 bg-black/[0.02] dark:bg-surface/50 px-3.5 py-2.5 text-sm text-black dark:text-white outline-none focus:border-brand">
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="mt-4 p-4 rounded-xl border border-black/10 dark:border-white/10 bg-black/[0.01] dark:bg-surface/20 text-[11px] leading-relaxed text-black/70 dark:text-white/70 space-y-2">
                        <p class="font-bold text-black dark:text-white flex items-center gap-1.5 uppercase tracking-wider text-[10px]">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><line x1="12" x2="12.01" y1="17" y2="17"/></svg>
                            Límites y especificaciones:
                        </p>
                        <ul class="list-disc pl-4 space-y-1.5 mt-1 text-[11px]">
                            <li><strong>Nombre:</strong> Máx. 255 caracteres. Se usa para generar la URL amigable del servicio.</li>
                            <li><strong>Precios por Automóvil:</strong> Se configuran de manera independiente en la sección horizontal inferior.</li>
                            <li><strong>Duración:</strong> En minutos (ej: 90 = 1.5 horas). Define el tamaño del bloque reservado en la agenda.</li>
                            <li><strong>Orden de Visualización:</strong> Número entero. Define la posición en la lista (del más bajo al más alto).</li>
                            <li><strong>Activo:</strong> Determina si el servicio está visible para ser cotizado y agendado por los clientes.</li>
                            <li><strong>Destacado:</strong> Resalta visualmente el servicio en el cotizador con un distintivo.</li>
                        </ul>
                    </div>
                </div>

                <!-- Columna Derecha: Descripciones y Extras -->
                <div class="space-y-4">
                    <div>
                        <label class="flex items-center gap-1.5 text-xs uppercase text-black/55 dark:text-white/50 font-bold mb-1.5">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h7"/></svg>
                            Descripción Corta
                        </label>
                        <input type="hidden" name="short_description" :value="form.short_description">
                        <div id="short_description_editor" class="w-full text-sm text-black dark:text-white" style="min-height: 100px;"></div>
                    </div>

                    <div>
                        <label class="flex items-center gap-1.5 text-xs uppercase text-black/55 dark:text-white/50 font-bold mb-1.5">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            Descripción Detallada
                        </label>
                        <input type="hidden" name="long_description" :value="form.long_description">
                        <div id="long_description_editor" class="w-full text-sm text-black dark:text-white" style="min-height: 180px;"></div>
                    </div>

                    <!-- Extras Seleccionables -->
                    <div class="flex flex-col h-full max-h-[400px]">
                        <label class="flex items-center justify-between gap-1.5 text-xs uppercase text-black/55 dark:text-white/50 font-bold mb-1.5">
                            <span class="flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                                Servicios Extras Disponibles
                            </span>
                        </label>
                        
                        <!-- Buscador de Extras -->
                        <div class="relative mb-2">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-black/40 dark:text-white/40">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </div>
                            <input type="text" x-model="searchExtra" placeholder="Buscar extra por nombre..." class="w-full rounded-lg border border-black/10 dark:border-white/10 bg-black/[0.02] dark:bg-surface/50 pl-9 pr-3 py-1.5 text-[13px] text-black dark:text-white outline-none focus:border-brand">
                        </div>

                        <div class="flex-1 border border-black/10 dark:border-white/10 rounded-xl p-2 bg-black/[0.01] dark:bg-surface/10 overflow-y-auto">
                            @foreach($extras as $extra)
                                <div x-show="searchExtra === '' || '{{ strtolower(addslashes($extra->name)) }}'.includes(searchExtra.toLowerCase())" class="flex items-center justify-between gap-4 py-0.5 border-b border-black/5 dark:border-white/5 last:border-0">
                                    <label class="flex items-center gap-2 select-none cursor-pointer hover:text-brand transition-colors flex-1 min-w-0 py-1">
                                        <input type="checkbox" 
                                               name="extras[{{ $extra->id }}][enabled]" 
                                               value="1" 
                                               :checked="form.extras_data['{{ $extra->id }}'].enabled" 
                                               @change="form.extras_data['{{ $extra->id }}'].enabled = $event.target.checked" 
                                               class="rounded border-black/10 dark:border-white/10 text-brand focus:ring-brand scale-90">
                                        <span class="text-[13px] text-black/80 dark:text-white/80 truncate">{{ $extra->name }}</span>
                                    </label>
                                    
                                    <div x-show="form.extras_data['{{ $extra->id }}'] && form.extras_data['{{ $extra->id }}'].enabled" x-transition x-cloak>
                                        <select name="extras[{{ $extra->id }}][mode]" 
                                                x-model="form.extras_data['{{ $extra->id }}'].mode" 
                                                class="rounded border border-black/10 dark:border-white/10 bg-white dark:bg-[#1A1A1A] px-1 py-0.5 text-[10px] font-semibold uppercase tracking-wider text-black/70 dark:text-white/70 outline-none focus:border-brand">
                                            <option value="optional">Opcional</option>
                                            <option value="recommended">Recomendado</option>
                                            <option value="required">Requerido</option>
                                            <option value="courtesy">Cortesía</option>
                                            <option value="included">Incluido en el Servicio</option>
                                        </select>
                                    </div>
                                </div>
                            @endforeach
                            @if($extras->isEmpty())
                                <span class="text-xs text-black/40 block p-2">No hay extras creados.</span>
                            @endif
                            <div x-show="searchExtra !== ''" x-cloak class="p-2 text-center text-xs text-black/40" style="display: none;">
                                <span x-text="'Buscando: ' + searchExtra"></span>
                            </div>
                        </div>

                        <!-- Ayuda / Infografía de Configuración -->
                        <div class="mt-3 p-3 rounded-xl border border-brand/20 bg-brand/5 text-[11px] leading-relaxed text-black/70 dark:text-white/70 space-y-1">
                            <p class="font-bold text-brand flex items-center gap-1.5 uppercase tracking-wider text-[10px]">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg>
                                Guía de configuración de extras:
                            </p>
                            <ul class="list-disc pl-4 space-y-1 mt-1 text-[11px]">
                                <li><strong>Opcional:</strong> El cliente puede añadirlo manualmente en el cotizador (aparece desmarcado).</li>
                                <li><strong>Recomendado:</strong> Aparece pre-seleccionado en el cotizador por defecto, pero el cliente puede desmarcarlo.</li>
                                <li><strong>Requerido:</strong> Es obligatorio. Aparece marcado con candado y no se puede desmarcar.</li>
                                <li><strong>Cortesía:</strong> Incluido sin costo extra. Aparece marcado con un regalo y muestra "Cortesía".</li>
                                <li><strong>Incluido en el Servicio:</strong> Como la cortesía, pero muestra "Incluido" con un ícono clásico. Costo $0.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="px-6 py-4 border-t border-black/5 dark:border-white/5 flex gap-3 justify-end bg-gray-50 dark:bg-surface/10 rounded-b-2xl">
            <a href="{{ route('admin.servicios') }}" class="px-6 py-2.5 rounded-xl border border-black/10 dark:border-white/10 text-black/75 dark:text-white/75 font-semibold text-sm hover:bg-black/5 dark:hover:bg-white/5 transition-all text-center">
                Cancelar
            </a>
            <button type="submit" class="px-8 py-2.5 bg-brand hover:bg-brand-dark text-white font-semibold rounded-xl transition-all shadow-md shadow-brand/20">
                Guardar
            </button>
        </div>
    </form>
</div>
@endsection

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />
<style>
    /* Dark mode Quill styles */
    .dark .ql-toolbar.ql-snow {
        background-color: #1a1a1a;
        border-color: rgba(255, 255, 255, 0.1);
    }
    .dark .ql-container.ql-snow {
        border-color: rgba(255, 255, 255, 0.1);
        background-color: #111111;
        color: #ffffff;
    }
    .dark .ql-stroke {
        stroke: #e2e8f0;
    }
    .dark .ql-fill {
        fill: #e2e8f0;
    }
    .dark .ql-picker {
        color: #e2e8f0;
    }
    .dark .ql-picker-options {
        background-color: #1a1a1a !important;
        border-color: rgba(255, 255, 255, 0.1) !important;
    }
    /* Snow theme custom styles */
    .ql-toolbar.ql-snow {
        border-top-left-radius: 12px;
        border-top-right-radius: 12px;
        border-color: rgba(0, 0, 0, 0.1);
    }
    .ql-container.ql-snow {
        border-bottom-left-radius: 12px;
        border-bottom-right-radius: 12px;
        border-color: rgba(0, 0, 0, 0.1);
        font-family: inherit;
        font-size: 0.875rem;
    }
</style>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
<script>
function serviceForm() {
    // Inject the data from PHP
    const allExtras = @json($extras);
    const allVehicles = @json($vehicleTypes);
    const serviceData = @json(isset($service) ? $service : null);
    const serviceExtras = @json(isset($service) ? $service->extras : []);
    const isEditMode = serviceData !== null;

    // Default empty form
    let initialForm = {
        id: '',
        name: '',
        category: 'especiales',
        prices: {},
        duration_minutes: '',
        display_order: '0',
        is_active: true,
        is_featured: false,
        short_description: '',
        long_description: '',
        extras_data: {},
    };

    allVehicles.forEach(vt => {
        initialForm.prices[vt.id] = '';
    });
    allExtras.forEach(extra => {
        initialForm.extras_data[extra.id] = { enabled: !isEditMode, mode: 'optional' };
    });

    // Populate if editing
    if (isEditMode) {
        initialForm.id = serviceData.id;
        initialForm.name = serviceData.name;
        initialForm.category = serviceData.category || 'especiales';
        initialForm.duration_minutes = serviceData.duration_minutes;
        initialForm.display_order = serviceData.display_order;
        initialForm.is_active = !!serviceData.is_active;
        initialForm.is_featured = !!serviceData.is_featured;
        initialForm.short_description = serviceData.short_description || '';
        initialForm.long_description = serviceData.long_description || '';
        
        const vehicleTypesList = serviceData.vehicle_types || serviceData.vehicleTypes || [];
        allVehicles.forEach(vt => {
            const vtPrice = vehicleTypesList.find(v => v.id === vt.id);
            initialForm.prices[vt.id] = vtPrice ? (vtPrice.pivot ? vtPrice.pivot.price : (vtPrice.price || '')) : '';
        });
        allExtras.forEach(extra => {
            const link = serviceExtras.find(se => se.id === extra.id);
            if (link) {
                let mode = 'optional';
                if (link.pivot && link.pivot.is_included) mode = 'included';
                else if (link.pivot && link.pivot.is_courtesy) mode = 'courtesy';
                else if (link.pivot && link.pivot.is_required) mode = 'required';
                else if (link.pivot && link.pivot.is_default) mode = 'recommended';
                initialForm.extras_data[extra.id] = { enabled: true, mode: mode };
            }
        });
    }

    return {
        isEdit: isEditMode,
        form: initialForm,
        searchExtra: '',
        init() {
            this.$nextTick(() => {
                const quillShort = new Quill('#short_description_editor', {
                    theme: 'snow',
                    modules: {
                        toolbar: [
                            ['bold', 'italic', 'underline'],
                            [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                            ['clean']
                        ]
                    }
                });
                
                const quillLong = new Quill('#long_description_editor', {
                    theme: 'snow',
                    modules: {
                        toolbar: [
                            ['bold', 'italic', 'underline'],
                            [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                            ['clean']
                        ]
                    }
                });
                
                if (this.form.short_description) {
                    quillShort.root.innerHTML = this.form.short_description;
                }
                if (this.form.long_description) {
                    quillLong.root.innerHTML = this.form.long_description;
                }
                
                quillShort.on('text-change', () => {
                    this.form.short_description = quillShort.root.innerHTML === '<p><br></p>' ? '' : quillShort.root.innerHTML;
                });
                
                quillLong.on('text-change', () => {
                    this.form.long_description = quillLong.root.innerHTML === '<p><br></p>' ? '' : quillLong.root.innerHTML;
                });
            });
        }
    };
}
</script>
@endsection
