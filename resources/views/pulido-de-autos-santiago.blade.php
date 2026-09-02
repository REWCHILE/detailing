@extends('layouts.public')

@section('title', 'Pulido de Autos en Santiago | Eliminación de Rayas y Brillo 8K')
@section('meta_description', 'Servicio profesional de pulido de autos en Santiago. Eliminación de rayas, corrección de pintura multi-etapa y restauración de brillo. ¡Resultados de exhibición garantizados!')
@section('meta_keywords', 'pulido de autos santiago, correccion de pintura santiago, eliminar rayas auto chile, brillo espejo auto colina, pulido de autos chicureo, pulido tecnico')

@section('content')
<main class="overflow-hidden bg-white dark:bg-surface-900 text-black dark:text-white transition-colors duration-300">
    <!-- Hero Section -->
    <section class="relative min-h-screen flex items-center justify-center overflow-hidden bg-[#0A0A0A]">
        <div class="absolute inset-0 bg-[#0A0A0A]">
            <video autoplay muted loop playsinline class="w-full h-full object-cover opacity-50">
                <source src="/assets/videos/bmwblanco-horizontal.mp4" type="video/mp4">
            </video>
            <div class="absolute inset-0 bg-gradient-to-b from-[#0A0A0A]/80 via-transparent to-[#0A0A0A]"></div>
            <div class="absolute inset-0 bg-gradient-to-r from-[#0A0A0A]/60 via-transparent to-[#0A0A0A]/60"></div>
        </div>

        <div class="container-custom relative z-10 text-center px-4">
            <div class="max-w-5xl mx-auto">
                <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-brand/10 border border-brand/20 text-brand text-xs font-bold uppercase tracking-[0.2em] mb-8">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-brand"><path d="m12 3-1.912 5.886L4 9l4.912.863L12 15l1.912-5.137L20 9l-4.912-.114z"/></svg>
                    Restauración Estética Automotriz
                </span>
                <h1 class="font-display text-5xl md:text-8xl font-bold text-white mb-8 leading-[1.1]">
                    Pulido de autos <br> <span class="text-gradient">en Santiago</span>
                </h1>
                <p class="text-white/70 text-lg md:text-2xl leading-relaxed mb-12 max-w-3xl mx-auto font-light">
                    Eliminamos el 95% de los rayones, devolvemos la profundidad al color y entregamos un acabado espejo espectacular. Pulido profesional con tecnología de corte avanzada.
                </p>
                <div class="flex flex-col sm:flex-row items-center justify-center gap-6">
                    <a href="/reserva?category=pulido" class="px-12 py-5 bg-brand hover:bg-brand-dark text-white font-bold rounded-full text-lg transition-all shadow-xl shadow-brand/30 hover:scale-105">
                        Agendar Evaluación
                    </a>
                    <a href="#precios" class="px-12 py-5 border border-white/20 hover:border-brand/40 text-white font-semibold rounded-full text-lg transition-all backdrop-blur-sm">
                        Ver Niveles de Pulido
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Section: Eliminación de Rayones (Particles Rosa) -->
    <section class="section-padding bg-gray-50 dark:bg-surface-900 relative transition-colors duration-300">
        <x-interactive-particles density="100" color="#FB2C6B" />
        <div class="container-custom relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-20 items-center">
                <div>
                    <h2 class="font-display text-3xl md:text-5xl font-bold text-black dark:text-white mb-8 transition-colors">
                        Eliminación de <span class="text-brand">rayones y marcas</span> de lavado
                    </h2>
                    <div class="space-y-6 text-black/60 dark:text-white/50 text-lg leading-relaxed transition-colors">
                        <p>
                            En el <strong>pulido de autos</strong>, el mayor desafío son las famosas "marcas de remolino" o swirls. Estos son miles de micro-rayas circulares causadas por lavados deficientes que opacan la laca y roban el brillo de tu vehículo.
                        </p>
                        <p>
                            Nuestro proceso de <strong>pulido automotriz profesional</strong> utiliza polimentos abrasivos de alta tecnología que nivelan microscópicamente el barniz, eliminando los rayones de forma definitiva en lugar de solo rellenarlos con cera.
                        </p>
                        <p>
                            Si buscas <strong>eliminar rayones de auto</strong> de forma segura, realizamos una medición técnica del espesor de laca (PTG) para asegurar que el trabajo no comprometa la integridad de la pintura a largo plazo.
                        </p>
                    </div>
                </div>
                <div class="relative w-full h-[500px] min-h-[500px] rounded-[36px] overflow-hidden border border-black/10 dark:border-white/10 shadow-2xl relative group bg-surface-800" style="height: 500px; min-height: 500px;">
                    <video autoplay muted loop playsinline class="w-full h-full object-cover opacity-90 group-hover:scale-105 transition-transform duration-700">
                        <source src="/assets/videos/bmwblanco_actualizado.mp4" type="video/mp4">
                    </video>
                    <!-- Bottom Dark Vignette Gradient -->
                    <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/20 to-transparent pointer-events-none"></div>
                    <!-- Overlay info badge -->
                    <div class="absolute inset-x-0 bottom-0 p-8 z-10">
                        <p class="text-white font-display font-black text-2xl mb-1">Corrección Multi-Etapa</p>
                        <p class="text-white/70 text-xs font-bold uppercase tracking-widest">Eliminación de defectos severos</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section: ¿Qué es el pulido? (Static Black) -->
    <section class="section-padding bg-white dark:bg-surface-900 border-y border-black/5 dark:border-white/5 transition-colors duration-300">
        <div class="container-custom">
            <div class="max-w-4xl mx-auto">
                <div class="text-center mb-16">
                    <h2 class="font-display text-3xl md:text-5xl font-bold text-black dark:text-white mb-6 transition-colors">¿Qué es realmente el <span class="text-gradient">pulido de autos</span>?</h2>
                    <p class="text-black/60 dark:text-white/50 text-lg leading-relaxed transition-colors">
                        A diferencia del encerado, el pulido es un tratamiento correctivo. Consiste en la aplicación de compuestos abrasivos que, mediante máquinas rotativas u orbitales, remueven una capa infinitesimal de barniz para dejar la superficie perfectamente plana. Es esta planitud lo que genera el efecto espejo.
                    </p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    @foreach([
                        ['title' => 'Pulido Mecánico', 'desc' => 'Uso de máquinas Dual Action para una corrección segura y libre de hologramas.'],
                        ['title' => 'Pulido y Encerado', 'desc' => 'Combinación ideal para recuperar el color y sellarlo con una barrera protectora inmediata.'],
                        ['title' => 'Restauración de Pintura', 'desc' => 'Devuelve la claridad a barnices oxidados o amarillentos por el sol de Santiago.'],
                        ['title' => 'Acabado Espejo', 'desc' => 'Reflejo nítido y profundidad de color espectacular, especialmente en colores oscuros.']
                    ] as $item)
                        <div class="p-8 rounded-3xl bg-black/[0.02] dark:bg-white/[0.02] border border-black/5 dark:border-white/5">
                            <h4 class="text-black dark:text-white font-bold mb-3 transition-colors">{{ $item['title'] }}</h4>
                            <p class="text-black/60 dark:text-white/40 text-sm leading-relaxed transition-colors">{{ $item['desc'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- Section: Corrección de Pintura (Particles White) -->
    <section id="correccion-pintura" class="section-padding bg-gray-50 dark:bg-surface-800 relative overflow-hidden transition-colors border-b border-black/5 dark:border-white/5 duration-300">
        <x-interactive-particles density="120" color="#ffffff" class="opacity-10" />
        <div class="container-custom relative z-10">
            <div class="text-center mb-20">
                <h2 class="font-display text-4xl md:text-6xl font-bold text-black dark:text-white mb-8 transition-colors">
                    Corrección de <span class="text-gradient">Pintura Automotriz</span>
                </h2>
                <p class="text-black/60 dark:text-white/40 max-w-3xl mx-auto text-xl leading-relaxed font-light transition-colors">
                    Utilizamos los mejores insumos del mundo (Sonax, Menzerna, Koch-Chemie) para garantizar un resultado de nivel internacional en cada vehículo.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10 text-center">
                @foreach([
                    ['title' => 'Inspección Lumínica', 'desc' => 'Usamos luces Scangrip de alta fidelidad para revelar hasta el defecto más pequeño.', 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>'],
                    ['title' => 'Seguridad para tu Auto', 'desc' => 'No quemamos bordes ni desgastamos innecesariamente la laca original.', 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="m9 12 2 2 4-4"/></svg>'],
                    ['title' => 'Certificación Pro', 'desc' => 'Expertos entrenados en las técnicas más avanzadas de corrección de pintura.', 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="7"/><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"/></svg>']
                ] as $item)
                    <div class="group">
                        <div class="w-20 h-20 rounded-3xl bg-brand/10 flex items-center justify-center mx-auto mb-8 group-hover:scale-110 transition-transform duration-300">
                            <span class="text-brand">{!! $item['icon'] !!}</span>
                        </div>
                        <h3 class="text-2xl font-bold text-black dark:text-white mb-4 transition-colors">{{ $item['title'] }}</h3>
                        <p class="text-black/60 dark:text-white/40 leading-relaxed max-w-xs mx-auto transition-colors">{{ $item['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section id="precios" class="section-padding bg-surface-900 relative overflow-hidden transition-colors duration-300">
        <div class="container-custom relative z-10">
            <div class="text-center mb-16">
                <p class="text-brand text-sm font-bold tracking-[0.2em] uppercase mb-4">Sistemas de Corrección</p>
                <h2 class="font-display text-4xl md:text-6xl font-bold text-white mb-6">
                    Niveles de <span class="text-gradient">Pulido Profesional</span>
                </h2>
                <p class="text-white/50 max-w-2xl mx-auto text-lg leading-relaxed font-light">
                    Utilizamos máquinas de última generación y pulimentos de grado tecnológico para restaurar la vida de tu pintura sin comprometer su espesor.
                </p>
            </div>

            @php
                if (!function_exists('parseServiceFeatures')) {
                    function parseServiceFeatures($longDesc) {
                        if (empty($longDesc)) return [];
                        $text = preg_replace('/<(br|p|li|div)[^>]*>/i', "\n", $longDesc);
                        $text = strip_tags($text);
                        $lines = preg_split('/[\r\n]+/', $text);
                        $features = [];
                        foreach ($lines as $line) {
                            $clean = trim($line);
                            $clean = preg_replace('/^[-•*]\s*/u', '', $clean);
                            if (!empty($clean)) {
                                $features[] = $clean;
                            }
                        }
                        return $features;
                    }
                }

                $categoryServices = \App\Models\Service::with('vehicleTypes')
                    ->whereIn('category', ['pulido', 'correccion'])
                    ->where('is_active', true)
                    ->where('slug', '!=', 'restauracion-de-focos')
                    ->orderBy('display_order')
                    ->take(3)
                    ->get();
                
                $servicesData = $categoryServices->map(function($s) {
                    $features = parseServiceFeatures($s->long_description);
                    $vPrices = [];
                    foreach($s->vehicleTypes as $vt) {
                        $vPrices[] = [
                            'name' => $vt->name,
                            'slug' => $vt->slug,
                            'price' => (int)$vt->pivot->price,
                        ];
                    }
                    $minPrice = !empty($vPrices) ? min(array_column($vPrices, 'price')) : (int)$s->base_price;
                    return [
                        'id' => $s->id,
                        'name' => $s->name,
                        'slug' => $s->slug,
                        'min_price' => $minPrice,
                        'features' => array_values($features),
                        'vehicle_prices' => $vPrices,
                    ];
                });
            @endphp

            <div x-data="{
                modalService: null,
                services: @js($servicesData->values()),
                openModal(slug) {
                    this.modalService = this.services.find(s => s.slug === slug) || null;
                },
                closeModal() {
                    this.modalService = null;
                },
                formatCLP(val) {
                    return '$' + (val || 0).toLocaleString('es-CL');
                }
            }">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-7xl mx-auto items-stretch justify-center">
                    @foreach($categoryServices as $srv)
                        @php
                            $srvVideo = '/assets/videos/pulido-rupes.mp4';
                            $slug = $srv->slug;
                            if (str_contains($slug, 'multi-etapa')) {
                                $srvVideo = '/assets/videos/bmwblanco_actualizado.mp4';
                            } elseif (str_contains($slug, 'una-etapa') || str_contains($slug, 'un-paso')) {
                                $srvVideo = '/assets/videos/pulido-correccion.mp4';
                            } elseif (str_contains($slug, 'focos')) {
                                $srvVideo = '/assets/videos/correcion-pintura-1080p.mp4';
                            }
                            $minPrice = $srv->vehicleTypes->min('pivot.price') ?? $srv->base_price;
                        @endphp
                        <div style="height: 600px; min-height: 600px;" class="relative flex flex-col justify-between h-[600px] rounded-[40px] overflow-hidden p-8 sm:p-9 md:p-10 transition-all duration-500 group border-2 border-white/15 hover:border-brand/70 hover:shadow-2xl hover:scale-[1.015] bg-zinc-950 shadow-2xl">
                            <!-- Panoramic Video Background with Dark Tint and Cinematic Vignettes -->
                            <div class="absolute inset-0 z-0 overflow-hidden pointer-events-none">
                                <video autoplay loop muted playsinline class="w-full h-full object-cover opacity-60 group-hover:opacity-80 group-hover:scale-105 transition-all duration-700">
                                    <source src="{{ $srvVideo }}" type="video/mp4">
                                </video>
                                <div class="absolute inset-0 bg-black/45 pointer-events-none z-10"></div>
                                <div class="absolute inset-x-0 top-0 h-44 bg-gradient-to-b from-black/90 via-black/50 to-transparent pointer-events-none z-10"></div>
                                <div class="absolute inset-x-0 bottom-0 h-56 bg-gradient-to-t from-black/95 via-black/75 to-transparent pointer-events-none z-10"></div>
                            </div>

                            <!-- Top Area: Centered Title in Pure White -->
                            <div class="relative z-20 text-center w-full">
                                <h3 class="font-display font-black text-xl sm:text-2xl text-white uppercase tracking-tight drop-shadow-[0_4px_16px_rgba(0,0,0,1)] leading-tight text-center">
                                    {{ $srv->name }}
                                </h3>
                            </div>

                            <!-- Middle Spacer to let the video shine -->
                            <div class="flex-grow pointer-events-none"></div>

                            <!-- Bottom Area: Starting Price & Action Buttons -->
                            <div class="relative z-20 pt-4">
                                <!-- Price Display -->
                                <div class="flex items-center gap-2 mb-6">
                                    <span class="text-white/60 text-xs sm:text-sm font-bold uppercase tracking-wider leading-none">Desde</span>
                                    <span class="font-display font-black text-3xl sm:text-4xl md:text-5xl text-white drop-shadow-[0_2px_12px_rgba(0,0,0,1)] leading-none">
                                        ${{ number_format($minPrice, 0, ',', '.') }}
                                    </span>
                                </div>

                                <!-- Action Buttons: Details + Agendar CTA -->
                                <div class="flex items-center justify-between gap-3 pt-4 border-t border-white/15">
                                    <button 
                                        type="button" 
                                        @click="openModal('{{ $srv->slug }}')"
                                        class="px-5 py-3 rounded-full bg-black/80 hover:bg-zinc-900 border border-white/20 hover:border-brand/60 text-white hover:text-brand text-xs sm:text-sm font-bold uppercase tracking-wider transition-all duration-200 backdrop-blur-md shadow-lg flex items-center gap-2 group/btn cursor-pointer"
                                    >
                                        <span>Detalles</span>
                                        <svg class="w-4 h-4 text-brand group-hover/btn:translate-x-0.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                                    </button>

                                    <a 
                                        href="/reserva?category=pulido&service={{ $srv->slug }}"
                                        class="flex items-center gap-2 text-xs sm:text-sm font-black uppercase tracking-wider text-brand group/cta hover:text-white transition-colors shrink-0"
                                    >
                                        <span>Agendar</span>
                                        <div class="w-11 h-11 sm:w-12 sm:h-12 rounded-full bg-brand text-white flex items-center justify-center group-hover/cta:scale-110 shadow-xl shadow-brand/40 transition-transform duration-300">
                                            <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- MODAL DE DETALLES DEL SERVICIO PULIDO / CORRECCIÓN -->
                <template x-teleport="body">
                    <div 
                        x-show="modalService" 
                        x-cloak
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0"
                        x-transition:enter-end="opacity-100"
                        x-transition:leave="transition ease-in duration-200"
                        x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0"
                        class="fixed inset-0 z-[999999] bg-black/90 backdrop-blur-xl flex items-center justify-center p-4 sm:p-6"
                        style="z-index: 999999; display: none;"
                    >
                        <div 
                            @click.away="closeModal()"
                            x-show="modalService"
                            x-transition:enter="transition ease-out duration-300 transform"
                            x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-200 transform"
                            x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                            x-transition:leave-end="opacity-0 scale-95 translate-y-4"
                            class="bg-zinc-900 border-2 border-white/20 rounded-[2.5rem] max-w-2xl w-full shadow-2xl relative text-white max-h-[88vh] flex flex-col my-auto overflow-hidden"
                            style="z-index: 1000000;"
                        >
                            <!-- Header -->
                            <div class="p-6 sm:p-8 pb-4 border-b border-white/10 shrink-0 relative text-center">
                                <button 
                                    type="button" 
                                    @click="closeModal()"
                                    class="absolute top-6 right-6 w-10 h-10 rounded-full bg-white/10 hover:bg-brand text-white flex items-center justify-center transition-all shadow-md cursor-pointer"
                                >
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                                </button>

                                <h3 class="text-brand font-display font-black text-2xl sm:text-3xl mb-1 uppercase tracking-tight">
                                    Detalles del servicio
                                </h3>
                                <h4 class="text-white/90 font-display font-bold text-base sm:text-lg" x-text="modalService ? modalService.name : ''"></h4>
                            </div>

                            <!-- Content with inner scroll -->
                            <div class="p-6 sm:p-8 overflow-y-auto overflow-x-hidden flex-1 custom-scrollbar space-y-6">
                                <!-- Vehicle Price Breakdown Table -->
                                <template x-if="modalService && modalService.vehicle_prices && modalService.vehicle_prices.length > 0">
                                    <div>
                                        <h5 class="text-xs font-bold text-white/50 uppercase tracking-widest mb-3">Precios por Tamaño de Vehículo</h5>
                                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                                            <template x-for="vp in modalService.vehicle_prices" :key="vp.name">
                                                <div class="p-3.5 rounded-2xl bg-black/50 border border-white/10 text-center">
                                                    <span class="text-xs text-white/70 block font-semibold mb-1" x-text="vp.name"></span>
                                                    <span class="font-display font-black text-lg text-white" x-text="formatCLP(vp.price)"></span>
                                                </div>
                                            </template>
                                        </div>
                                    </div>
                                </template>

                                <!-- Features List -->
                                <div>
                                    <h5 class="text-xs font-bold text-white/50 uppercase tracking-widest mb-3">Incluye Cobertura & Procedimiento</h5>
                                    <ul class="space-y-3 text-left">
                                        <template x-for="(point, pIdx) in (modalService ? modalService.features : [])" :key="pIdx">
                                            <li class="flex items-start gap-3.5 p-3.5 rounded-2xl bg-black/50 border border-white/10 hover:border-brand/40 transition-colors">
                                                <div class="w-5 h-5 rounded-full bg-brand/20 border border-brand/60 text-brand flex items-center justify-center shrink-0 mt-0.5 text-xs font-black shadow-[0_0_8px_rgba(251,44,107,0.4)]">
                                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3.5">
                                                        <polyline points="20 6 9 17 4 12"/>
                                                    </svg>
                                                </div>
                                                <span class="font-sans text-sm sm:text-base text-white/95 leading-relaxed font-medium html-content" x-html="point"></span>
                                            </li>
                                        </template>
                                    </ul>
                                </div>
                            </div>

                            <!-- Footer -->
                            <div class="p-6 sm:p-8 pt-4 border-t border-white/15 shrink-0 bg-zinc-900 flex flex-col sm:flex-row items-center justify-between gap-4">
                                <div class="text-center sm:text-left">
                                    <span class="text-xs uppercase tracking-wider text-white/50 block font-bold">Desde</span>
                                    <span class="text-white font-display font-black text-2xl sm:text-3xl md:text-4xl" x-text="modalService ? formatCLP(modalService.min_price) : '$0'"></span>
                                </div>

                                <div class="flex items-center gap-3 w-full sm:w-auto">
                                    <button 
                                        type="button" 
                                        @click="closeModal()"
                                        class="px-6 py-3.5 rounded-full font-bold text-sm uppercase tracking-wider bg-zinc-800 hover:bg-zinc-700 text-white/80 hover:text-white border border-white/20 transition-all duration-300 w-1/2 sm:w-auto text-center cursor-pointer"
                                    >
                                        Cerrar
                                    </button>

                                    <a 
                                        :href="'/reserva?category=pulido&service=' + (modalService ? modalService.slug : '')"
                                        class="px-8 py-3.5 rounded-full font-display font-black text-sm uppercase tracking-wider bg-brand hover:bg-brand-dark text-white shadow-xl shadow-brand/40 transition-all duration-300 w-1/2 sm:w-auto text-center cursor-pointer flex items-center justify-center gap-2"
                                    >
                                        <span>AGENDAR</span>
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>
            </div>

            <div class="mt-16 text-center">
                <div class="inline-flex items-center gap-4 px-6 py-3 rounded-full bg-white/5 border border-white/10">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-brand"><circle cx="12" cy="12" r="10"/><line x1="12" x2="12" y1="16" y2="12"/><line x1="12" x2="12.01" y1="8" y2="8"/></svg>
                    <p class="text-xs text-white/50">
                        * El resultado final depende del estado inicial de la laca. Se realiza inspección visual gratuita previa al servicio.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Section: Beneficios (Particles Rosa) -->
    <section class="section-padding bg-white dark:bg-surface-850 relative transition-colors duration-300 border-b border-black/5 dark:border-white/5">
        <x-interactive-particles density="100" color="#FB2C6B" />
        <div class="container-custom relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-20 items-center">
                <div class="order-2 lg:order-1 grid grid-cols-2 gap-4">
                    @foreach([
                        ['title' => 'Sin Swirls', 'desc' => 'Elimina marcas circulares', 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m12 3-1.912 5.886L4 9l4.912.863L12 15l1.912-5.137L20 9l-4.912-.114z"/></svg>'],
                        ['title' => 'Brillo Profundo', 'desc' => 'Color vibrante original', 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M8.5 14.5A2.5 2.5 0 0 0 11 12c0-1.38-.5-2-1-3-1.072-2.143-.224-4.054 2-6 .5 2.5 2 4.9 4 6.5 2 1.6 3 3.5 3 5.5a7 7 0 1 1-14 0c0-1.153.433-2.294 1-3a2.5 2.5 0 0 0 2.5 2.5z"/></svg>'],
                        ['title' => 'Tacto Suave', 'desc' => 'Pintura libre de poros', 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22a7 7 0 0 0 5-2c2.5-2.5 2.5-6.5 0-9L12 6 7 11c-2.5 2.5-2.5 6.5 0 9a7 7 0 0 0 5 2z"/></svg>'],
                        ['title' => 'Plusvalía', 'desc' => 'Aumenta valor de reventa', 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" x2="18" y1="20" y2="10"/><line x1="12" x2="12" y1="20" y2="4"/><line x1="6" x2="6" y1="20" y2="14"/></svg>']
                    ] as $item)
                        <div class="p-8 rounded-[2.5rem] bg-black/5 dark:bg-white/[0.03] border border-black/5 dark:border-white/5 flex flex-col items-center text-center">
                            <span class="text-brand mb-4">{!! $item['icon'] !!}</span>
                            <h4 class="text-black dark:text-white font-bold text-sm mb-1 transition-colors">{{ $item['title'] }}</h4>
                            <p class="text-black/50 dark:text-white/20 text-[10px] uppercase tracking-widest transition-colors">{{ $item['desc'] }}</p>
                        </div>
                    @endforeach
                </div>
                
                <div class="order-1 lg:order-2">
                    <h2 class="font-display text-4xl md:text-5xl font-bold text-black dark:text-white mb-8 transition-colors">
                        Beneficios del <br> <span class="text-gradient">pulido automotriz profesional</span>
                    </h2>
                    <div class="space-y-6 text-black/70 dark:text-white/50 text-lg leading-relaxed transition-colors">
                        <p>
                            Realizar un **pulido de autos profesional** no es solo un capricho estético. La acumulación de contaminantes y rayas actúan como una lija microscópica que degrada el barniz con el tiempo.
                        </p>
                        <p>
                            Un vehículo con corrección de pintura es mucho más fácil de lavar, ya que la suciedad no tiene donde anclarse. Además, mejora significativamente la visualización de la silueta y los relieves del diseño de tu auto.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section id="faq" class="section-padding bg-gray-50 dark:bg-surface-900 relative transition-colors duration-300 border-t border-black/5 dark:border-white/5">
        <x-interactive-particles density="60" color="#ffffff" class="opacity-10" />
        <div class="container-custom relative z-10">
            <div class="mb-20">
                <h2 class="font-display text-4xl md:text-6xl font-bold text-black dark:text-white mb-6 transition-colors">
                    Preguntas <span class="text-gradient">Frecuentes</span>
                </h2>
                <p class="text-black/60 dark:text-white/40 transition-colors">Resolvemos tus dudas sobre el pulido de autos en Santiago.</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-x-16 gap-y-10 max-w-6xl">
                @php
                    $faqs = [
                        [
                            'question' => '¿El pulido elimina todos los rayones?',
                            'answer' => 'El pulido profesional puede eliminar entre el 80% y el 95% de los defectos visibles según el nivel de corrección elegido. Rayas que han atravesado el barniz y llegan a la pintura o primer podrían no salir por completo, pero mejorarán drásticamente su visibilidad.',
                        ],
                        [
                            'question' => '¿Cuánto cuesta pulir un auto en Santiago?',
                            'answer' => 'El precio varía según el tamaño del vehículo y el nivel de corrección. Nuestros servicios comienzan desde los $120.000 para un pulido de abrillantado básico, hasta servicios de corrección multi-etapa para restauraciones completas.',
                        ],
                        [
                            'question' => '¿Cada cuánto se recomienda pulir el auto?',
                            'answer' => 'No recomendamos polir el auto con frecuencia ya que cada proceso remueve una micro-capa de barniz. Lo ideal es realizar una corrección profesional una sola vez y protegerla con sellado cerámico para evitar nuevos daños por años.',
                        ],
                        [
                            'question' => '¿Se puede pulir cualquier auto?',
                            'answer' => 'Sí, casi cualquier vehículo con barniz transparente se puede pulir. Sin embargo, realizamos una medición de espesor de pintura previa para asegurar que queda suficiente material para trabajar de forma segura y profesional.',
                        ],
                        [
                            'question' => '¿Qué diferencia hay entre pulido y encerado?',
                            'answer' => 'El pulido es un proceso abrasivo técnico que remueve físicamente los defectos del barniz para nivelar la superficie. El encerado es simplemente una capa protectora temporal que rellena poros y aporta brillo pero no elimina rayas.',
                        ]
                    ];
                @endphp

                @foreach($faqs as $faq)
                    <div class="group p-8 rounded-[35px] bg-white dark:bg-white/[0.02] border border-black/10 dark:border-white/5 hover:border-brand/30 dark:hover:border-brand/30 transition-all duration-500 shadow-md dark:shadow-none">
                        <h3 class="text-xl font-bold text-black dark:text-white mb-6 flex items-start gap-4 transition-colors">
                            <span class="flex-shrink-0 w-8 h-8 rounded-full bg-brand/20 flex items-center justify-center text-brand text-sm">?</span>
                            {{ $faq['question'] }}
                        </h3>
                        <p class="text-black/60 dark:text-white/40 leading-relaxed pl-12 text-base italic transition-colors">
                            "{{ $faq['answer'] }}"
                        </p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Final CTA -->
    <section class="py-24 md:py-32 relative overflow-hidden bg-white dark:bg-surface-900 transition-colors duration-300 border-t border-black/5 dark:border-white/5">
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[800px] bg-brand/5 rounded-full blur-[150px] pointer-events-none"></div>

        <div class="container-custom relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <!-- Left Side: Content -->
                <div class="text-center lg:text-left">
                    <p class="text-brand text-sm font-semibold tracking-[0.2em] uppercase mb-6">Restauración de Pintura</p>
                    <h2 class="font-display text-4xl md:text-5xl lg:text-6xl font-bold text-black dark:text-white mb-6 leading-tight transition-colors">
                        El brillo que tu auto <span class="text-gradient">se merece</span>
                    </h2>
                    <p class="text-black/60 dark:text-white/50 text-lg mb-10 max-w-xl mx-auto lg:mx-0 transition-colors">
                        Agenda tu inspección técnica hoy mismo y descubre todo el potencial estético de tu vehículo con nuestro servicio de corrección de pintura profesional.
                    </p>

                    <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-6">
                        <a href="/reserva?category=pulido" class="w-full sm:w-auto px-8 py-4 bg-brand hover:bg-brand-dark text-white font-semibold rounded-2xl text-lg transition-all duration-300 shadow-lg shadow-brand/30 hover:shadow-brand/50 flex items-center justify-center gap-2 hover:scale-[1.02]">
                            <span>Cotizar Pulido Ahora</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="shrink-0"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                        </a>
                        <div class="flex items-center gap-3 text-black/60 dark:text-white/60 shrink-0 font-medium">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-brand"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="m9 12 2 2 4-4"/></svg>
                            <span class="text-sm">Nivelación microscópica de barniz</span>
                        </div>
                    </div>
                </div>

                <!-- Right Side: Video Frame -->
                <div class="relative group">
                    <div class="relative aspect-video rounded-[2.5rem] overflow-hidden border border-black/10 dark:border-white/10 shadow-2xl transition-all duration-500 hover:scale-[1.01] hover:border-brand/30 bg-black">
                        <video autoplay muted loop playsinline class="w-full h-full object-cover">
                            <source src="/assets/videos/pulido-correccion.mp4" type="video/mp4">
                        </video>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent pointer-events-none"></div>
                        <div class="absolute bottom-3 left-3 right-3 md:bottom-6 md:left-6 md:right-6 p-2.5 md:p-4 rounded-xl md:rounded-2xl bg-black/50 md:bg-black/60 backdrop-blur-sm md:backdrop-blur-md border border-white/5 md:border-white/10">
                            <p class="text-white text-[10px] md:text-xs font-bold uppercase tracking-widest mb-0.5 md:mb-1 flex items-center gap-1.5">
                                <span class="h-1.5 w-1.5 md:h-2 md:w-2 rounded-full bg-brand animate-pulse"></span>
                                Corrección Óptica
                            </p>
                            <p class="text-white/60 text-[9px] md:text-[10px] leading-tight">Remoción de rayas superficiales y marcas de remolino bajo luz técnica.</p>
                        </div>
                    </div>
                    
                    <!-- Decorative Glow -->
                    <div class="absolute -inset-2 bg-gradient-to-r from-brand to-brand-dark rounded-[2.7rem] blur-2xl opacity-10 group-hover:opacity-20 transition-opacity duration-500 pointer-events-none -z-10"></div>
                </div>
            </div>
        </div>
    </section>
</main>

@endsection

@section('scripts')
@include('partials.schema-pulido')
@endsection

@section('styles')
<style>
    /* WYSIWYG HTML Content Styling */
    .html-content {
        line-height: 1.6;
    }
    .html-content p {
        margin-bottom: 0.5rem;
    }
    .html-content p:last-child {
        margin-bottom: 0;
    }
    .html-content strong {
        font-weight: 700;
        color: inherit;
    }
    .html-content u {
        text-decoration: underline;
    }
    .html-content em {
        font-style: italic;
    }
    .html-content ul {
        list-style-type: disc;
        margin-left: 1.25rem;
        margin-bottom: 0.75rem;
        padding-left: 0.25rem;
    }
    .html-content ol {
        list-style-type: decimal;
        margin-left: 1.25rem;
        margin-bottom: 0.75rem;
        padding-left: 0.25rem;
    }
    .html-content li {
        margin-bottom: 0.25rem;
    }
    .html-content li:last-child {
        margin-bottom: 0;
    }
</style>
@endsection

