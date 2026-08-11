@extends('layouts.admin')

@section('title', 'Carrusel Hero | High Contrast Detailing')
@section('title_section', 'Carrusel Hero')

@section('content')
<div x-data="slidersCrud()" class="space-y-6">
    <!-- Notifications -->
    @if(session('success'))
        <div class="p-4 rounded-xl bg-green-500/10 border border-green-500/20 text-green-600 dark:text-green-400 text-sm font-semibold mb-6">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="p-4 rounded-xl bg-red-500/10 border border-red-500/20 text-red-600 dark:text-red-400 text-sm font-semibold mb-6">
            {{ session('error') }}
        </div>
    @endif

    <!-- Top actions -->
    <div class="flex justify-between items-center">
        <p class="text-sm text-black/50 dark:text-white/40">Administra los slides dinámicos del carrusel en la página de inicio.</p>
        <button @click="openCreateModal()" class="rounded-xl bg-brand hover:bg-brand-dark text-white px-4 py-2.5 text-sm font-semibold shadow-md transition-all">
            + Nuevo Slide
        </button>
    </div>

    <!-- Sliders List -->
    <div class="rounded-2xl bg-white dark:bg-surface/20 border border-black/5 dark:border-white/5 overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b border-black/5 dark:border-white/5 bg-gray-50 dark:bg-[#151515]">
                        <th class="text-xs text-black/50 dark:text-white/40 font-semibold px-6 py-4">Orden</th>
                        <th class="text-xs text-black/50 dark:text-white/40 font-semibold px-6 py-4">Fondo (Media)</th>
                        <th class="text-xs text-black/50 dark:text-white/40 font-semibold px-6 py-4">Contenido</th>
                        <th class="text-xs text-black/50 dark:text-white/40 font-semibold px-6 py-4">Botón Principal</th>
                        <th class="text-xs text-black/50 dark:text-white/40 font-semibold px-6 py-4">Estado</th>
                        <th class="text-xs text-black/50 dark:text-white/40 font-semibold px-6 py-4 text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-black/5 dark:divide-white/5">
                    @forelse($slides as $slide)
                        <tr class="hover:bg-black/[0.01] dark:hover:bg-white/[0.01] transition-colors">
                            <td class="px-6 py-4 font-bold text-sm text-black/60 dark:text-white/50">
                                #{{ $slide->display_order }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-20 h-12 rounded-lg bg-black/10 dark:bg-black/40 border border-black/5 dark:border-white/5 overflow-hidden flex items-center justify-center">
                                        @if($slide->media_type === 'image')
                                            @if($slide->media_path)
                                                <img src="{{ asset($slide->media_path) }}" class="object-cover w-full h-full" alt="slide media">
                                            @else
                                                <span class="text-[9px] text-black/40 dark:text-white/30 font-bold uppercase">Sin img</span>
                                            @endif
                                        @else
                                            @if($slide->media_path)
                                                <video src="{{ asset($slide->media_path) }}" class="object-cover w-full h-full" muted playsinline preload="metadata"></video>
                                            @else
                                                <div class="flex items-center gap-1 text-brand">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                                                    <span class="text-[9px] font-bold uppercase">Video</span>
                                                </div>
                                            @endif
                                        @endif
                                    </div>
                                    <div class="text-[10px] text-black/50 dark:text-white/40 max-w-[150px] truncate">
                                        {{ basename($slide->media_path) ?: 'Ruta externa' }}
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-black dark:text-white text-sm font-semibold leading-snug">
                                    {{ $slide->title }} <span class="text-brand">{{ $slide->title_gradient }}</span>
                                </p>
                                <p class="text-black/40 dark:text-white/30 text-xs line-clamp-1 max-w-sm mt-0.5">
                                    {{ $slide->subtitle }}
                                </p>
                            </td>
                            <td class="px-6 py-4 text-xs">
                                @if($slide->button_primary_text)
                                    <span class="font-medium text-black/75 dark:text-white/70 bg-black/5 dark:bg-white/5 px-2.5 py-1 rounded-md">
                                        {{ $slide->button_primary_text }}
                                    </span>
                                @else
                                    <span class="text-black/30 dark:text-white/20 italic">Ninguno</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex px-2.5 py-0.5 rounded-full text-[10px] font-semibold border {{ $slide->is_active ? 'bg-green-500/10 border-green-500/20 text-green-600 dark:text-green-400' : 'bg-red-500/10 border-red-500/20 text-red-600 dark:text-red-400' }}">
                                    {{ $slide->is_active ? 'Activo' : 'Inactivo' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right space-x-3">
                                <button @click="openEditModal({{ json_encode($slide) }})" class="text-xs text-blue-600 dark:text-blue-400 font-bold hover:underline">
                                    Editar
                                </button>
                                <form method="POST" action="/admin/sliders/{{ $slide->id }}" class="inline-block" onsubmit="return confirm('¿Seguro que deseas eliminar este slide?')">
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
                            <td colSpan="6" class="px-6 py-12 text-center text-sm text-black/40 dark:text-white/40">
                                No hay sliders subidos todavía. La web mostrará sliders predeterminados de fallback.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Create/Edit Modal -->
    <div x-show="isOpen" 
         x-transition:enter="transition ease-out duration-200" 
         x-transition:enter-start="opacity-0 scale-95" 
         x-transition:enter-end="opacity-100 scale-100" 
         x-transition:leave="transition ease-in duration-150" 
         x-transition:leave-start="opacity-100 scale-100" 
         x-transition:leave-end="opacity-0 scale-95" 
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm"
         style="display: none;">
        <div class="w-full max-w-3xl max-h-[90vh] flex flex-col rounded-2xl border border-black/10 dark:border-white/10 bg-white dark:bg-[#111111] shadow-2xl transition-all" @click.away="isOpen = false">
            <!-- Header -->
            <div class="flex justify-between items-center px-6 py-4 border-b border-black/5 dark:border-white/5">
                <h3 class="font-display font-bold text-lg text-black dark:text-white" x-text="isEdit ? 'Editar Slide' : 'Nuevo Slide'"></h3>
                <button @click="isOpen = false" class="text-black/40 dark:text-white/40 hover:text-black dark:hover:text-white">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            
            <!-- Form -->
            <form :action="isEdit ? '/admin/sliders/' + form.id : '/admin/sliders'" method="POST" enctype="multipart/form-data" class="flex flex-col flex-1 overflow-hidden">
                @csrf
                <template x-if="isEdit">
                    <input type="hidden" name="_method" value="PUT">
                </template>

                <!-- Scrollable Body -->
                <div class="flex-1 overflow-y-auto p-6 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Columna Izquierda: Contenido e Info -->
                        <div class="space-y-4">
                            <div>
                                <label class="block text-xs uppercase text-black/55 dark:text-white/50 font-bold mb-1.5">Título del Slide (Blanco)</label>
                                <input type="text" name="title" x-model="form.title" required class="w-full rounded-xl border border-black/10 dark:border-white/10 bg-black/[0.02] dark:bg-surface/50 px-4 py-2.5 text-sm text-black dark:text-white outline-none focus:border-brand">
                            </div>

                            <div>
                                <label class="block text-xs uppercase text-black/55 dark:text-white/50 font-bold mb-1.5">Destacado con Gradiente (Fucsia)</label>
                                <input type="text" name="title_gradient" x-model="form.title_gradient" class="w-full rounded-xl border border-black/10 dark:border-white/10 bg-black/[0.02] dark:bg-surface/50 px-4 py-2.5 text-sm text-black dark:text-white outline-none focus:border-brand" placeholder="Opcional">
                            </div>

                            <div>
                                <label class="block text-xs uppercase text-black/55 dark:text-white/50 font-bold mb-1.5">Descripción (Subtítulo)</label>
                                <textarea name="subtitle" x-model="form.subtitle" rows="3" class="w-full rounded-xl border border-black/10 dark:border-white/10 bg-black/[0.02] dark:bg-surface/50 px-4 py-2.5 text-sm text-black dark:text-white outline-none focus:border-brand" placeholder="Escribe la descripción del slide..."></textarea>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs uppercase text-black/55 dark:text-white/50 font-bold mb-1.5">Orden de Visualización</label>
                                    <input type="number" name="display_order" x-model="form.display_order" required min="0" class="w-full rounded-xl border border-black/10 dark:border-white/10 bg-black/[0.02] dark:bg-surface/50 px-4 py-2.5 text-sm text-black dark:text-white outline-none focus:border-brand">
                                </div>
                                <div class="flex items-end">
                                    <label class="flex items-center gap-2 rounded-xl border border-black/5 dark:border-white/5 bg-black/[0.01] dark:bg-surface/20 p-3 w-full select-none cursor-pointer hover:bg-black/[0.03] dark:hover:bg-surface/40 transition-colors h-[46px]">
                                        <input type="checkbox" name="is_active" value="1" :checked="form.is_active" class="rounded border-black/10 dark:border-white/10 text-brand focus:ring-brand">
                                        <span class="text-sm font-medium text-black/80 dark:text-white/80">Activo</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Columna Derecha: Multimedia y Botones -->
                        <div class="space-y-4">
                            <div>
                                <label class="block text-xs uppercase text-black/55 dark:text-white/50 font-bold mb-1.5">Tipo de Multimedia</label>
                                <select name="media_type" x-model="form.media_type" class="w-full rounded-xl border border-black/10 dark:border-white/10 bg-white dark:bg-[#1e1e1e] px-4 py-2.5 text-sm text-black dark:text-white outline-none focus:border-brand">
                                    <option value="image">Imagen de fondo</option>
                                    <option value="video">Video de fondo</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-xs uppercase text-black/55 dark:text-white/50 font-bold mb-1.5">Subir Archivo de Fondo</label>
                                <input type="file" name="media_file" class="w-full text-sm text-black/50 dark:text-white/40 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-brand/10 file:text-brand hover:file:bg-brand/20 file:cursor-pointer">
                                <p class="text-[10px] text-black/40 dark:text-white/30 mt-1">Soporta JPG, PNG, WEBP para imagen y MP4 para video (Máx: 50MB).</p>
                            </div>

                            <div>
                                <label class="block text-xs uppercase text-black/55 dark:text-white/50 font-bold mb-1.5">O Usar URL de Archivo (Ruta)</label>
                                <input type="text" name="media_url" x-model="form.media_url" class="w-full rounded-xl border border-black/10 dark:border-white/10 bg-black/[0.02] dark:bg-surface/50 px-4 py-2.5 text-sm text-black dark:text-white outline-none focus:border-brand" placeholder="Ej: /assets/videos/hero-banner.mp4">
                            </div>

                            <div class="border-t border-black/5 dark:border-white/5 pt-4">
                                <p class="text-xs font-bold text-black/60 dark:text-white/40 uppercase mb-3">Configuración de Botones</p>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-[10px] uppercase text-black/50 dark:text-white/40 font-bold mb-1">Botón Principal (Texto)</label>
                                        <input type="text" name="button_primary_text" x-model="form.button_primary_text" class="w-full rounded-xl border border-black/10 dark:border-white/10 bg-black/[0.02] dark:bg-surface/50 px-3 py-2 text-xs text-black dark:text-white outline-none focus:border-brand" placeholder="Cotiza tu servicio">
                                    </div>
                                    <div>
                                        <label class="block text-[10px] uppercase text-black/50 dark:text-white/40 font-bold mb-1">Botón Principal (URL)</label>
                                        <input type="text" name="button_primary_url" x-model="form.button_primary_url" class="w-full rounded-xl border border-black/10 dark:border-white/10 bg-black/[0.02] dark:bg-surface/50 px-3 py-2 text-xs text-black dark:text-white outline-none focus:border-brand" placeholder="/reserva">
                                    </div>
                                </div>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-3">
                                    <div>
                                        <label class="block text-[10px] uppercase text-black/50 dark:text-white/40 font-bold mb-1">Botón Secundario (Texto)</label>
                                        <input type="text" name="button_secondary_text" x-model="form.button_secondary_text" class="w-full rounded-xl border border-black/10 dark:border-white/10 bg-black/[0.02] dark:bg-surface/50 px-3 py-2 text-xs text-black dark:text-white outline-none focus:border-brand" placeholder="Explorar servicios">
                                    </div>
                                    <div>
                                        <label class="block text-[10px] uppercase text-black/50 dark:text-white/40 font-bold mb-1">Botón Secundario (URL)</label>
                                        <input type="text" name="button_secondary_url" x-model="form.button_secondary_url" class="w-full rounded-xl border border-black/10 dark:border-white/10 bg-black/[0.02] dark:bg-surface/50 px-3 py-2 text-xs text-black dark:text-white outline-none focus:border-brand" placeholder="#servicios">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer Actions (Responsive) -->
                <div class="flex flex-col sm:flex-row justify-end gap-3 px-6 py-4 border-t border-black/5 dark:border-white/5 bg-gray-50 dark:bg-[#151515]">
                    <button type="button" @click="isOpen = false" class="w-full sm:w-auto px-5 py-2.5 rounded-xl border border-black/10 dark:border-white/10 text-sm font-semibold text-black/70 dark:text-white/70 hover:bg-black/5 dark:hover:bg-white/5 transition-all text-center">
                        Cancelar
                    </button>
                    <button type="submit" class="w-full sm:w-auto px-5 py-2.5 rounded-xl bg-brand hover:bg-brand-dark text-white text-sm font-semibold shadow-md transition-all text-center">
                        Guardar Slide
                    </button>
                </div>           </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function slidersCrud() {
        return {
            isOpen: false,
            isEdit: false,
            form: {
                id: '',
                title: '',
                title_gradient: '',
                subtitle: '',
                media_type: 'image',
                media_url: '',
                button_primary_text: '',
                button_primary_url: '',
                button_secondary_text: '',
                button_secondary_url: '',
                display_order: 0,
                is_active: true
            },
            openCreateModal() {
                this.isEdit = false;
                this.form = {
                    id: '',
                    title: '',
                    title_gradient: '',
                    subtitle: '',
                    media_type: 'image',
                    media_url: '',
                    button_primary_text: 'Cotiza tu servicio',
                    button_primary_url: '/reserva',
                    button_secondary_text: 'Explorar servicios',
                    button_secondary_url: '#servicios',
                    display_order: 0,
                    is_active: true
                };
                this.isOpen = true;
            },
            openEditModal(slide) {
                this.isEdit = true;
                this.form = {
                    id: slide.id,
                    title: slide.title,
                    title_gradient: slide.title_gradient || '',
                    subtitle: slide.subtitle || '',
                    media_type: slide.media_type,
                    media_url: slide.media_path || '',
                    button_primary_text: slide.button_primary_text || '',
                    button_primary_url: slide.button_primary_url || '',
                    button_secondary_text: slide.button_secondary_text || '',
                    button_secondary_url: slide.button_secondary_url || '',
                    display_order: slide.display_order,
                    is_active: !!slide.is_active
                };
                this.isOpen = true;
            }
        };
    }
</script>
@endsection
