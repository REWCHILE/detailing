@extends('layouts.public')

@section('title', 'Limpieza y Detallado Automotriz en Chicureo | Detailing Premium')
@section('meta_description', 'Servicio profesional de lavado de autos y detailing automotriz en Chicureo. Limpieza profunda, lavado premium con snow foam y detallado interior. ¡Resultados de exhibición!')
@section('meta_keywords', 'lavado premium chicureo, limpieza de tapiz colina, detailing de interior chicureo, lavado snow foam santiago, limpieza de motor vapor, lavado de autos colina')

@section('content')
<main class="overflow-hidden bg-white dark:bg-surface-900 text-black dark:text-white transition-colors duration-300">
    <!-- Hero Section -->
    <section class="relative pt-32 pb-24 md:pt-48 md:pb-32 min-h-[80vh] flex items-center overflow-hidden bg-[#0A0A0A]">
        <!-- Background Video -->
        <div class="absolute inset-0 bg-[#0A0A0A]">
            <video autoplay muted loop playsinline class="w-full h-full object-cover opacity-40">
                <source src="/assets/videos/lavado-premium.mp4" type="video/mp4">
            </video>
            <!-- Gradients for readability -->
            <div class="absolute inset-0 bg-gradient-to-b from-[#0A0A0A]/80 via-transparent to-[#0A0A0A]"></div>
            <div class="absolute inset-0 bg-gradient-to-r from-[#0A0A0A]/60 via-transparent to-transparent"></div>
        </div>

        <div class="container-custom relative z-10">
            <div class="max-w-4xl px-4">
                <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-brand/10 border border-brand/20 text-brand text-xs font-bold uppercase tracking-[0.2em] mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="animate-spin-slow"><path d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364-.707.707M6.343 17.657l-.707.707m0-12.728.707.707m11.314 11.314-.707-.707"/></svg>
                    Lavado de autos premium
                </span>
                <h1 class="font-display text-4xl md:text-7xl font-bold text-white mb-8 leading-[1.1]">
                    Limpieza y Detallado <span class="text-gradient">Automotriz</span> en Chicureo
                </h1>
                <p class="text-white/70 text-lg md:text-xl leading-relaxed mb-10 max-w-2xl font-light">
                    Mucho más que un simple lavado. Ofrecemos un servicio de <strong>detailing profesional</strong> enfocado en la restauración estética y protección profunda de cada superficie de tu vehículo.
                </p>
                <div class="flex flex-wrap gap-4 items-center justify-center sm:justify-start">
                    <a 
                        href="/reserva?category=limpieza" 
                        class="w-full sm:w-auto px-10 py-4 bg-brand text-white font-semibold hover:bg-black dark:hover:bg-white dark:hover:text-black transition-all shadow-lg shadow-brand/20 text-center rounded-full"
                    >
                        Reservar Ahora
                    </a>
                    <a href="#proceso" class="w-full sm:w-auto px-10 py-4 border border-white/20 hover:border-brand/40 text-white font-semibold rounded-full transition-all text-center">
                        Nuestro Proceso
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Value Props -->
    <section class="py-20 border-y border-black/5 dark:border-white/5 bg-gray-50/50 dark:bg-surface-900/30 transition-colors">
        <div class="container-custom">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8">
                @foreach([
                    ['title' => 'Protección UV', 'desc' => 'Sellado de superficies', 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>'],
                    ['title' => 'Detalle Extremo', 'desc' => 'Limpieza minuciosa', 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="m16.2 7.8-8.4 8.4"/><circle cx="12" cy="12" r="2"/></svg>'],
                    ['title' => 'Calidad Premium', 'desc' => 'Insumos de élite', 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>'],
                    ['title' => 'Eficiencia', 'desc' => 'Resultados garantizados', 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>']
                ] as $item)
                    <div class="flex items-center gap-4 group">
                        <div class="w-12 h-12 rounded-2xl bg-brand/5 border border-brand/10 flex items-center justify-center group-hover:bg-brand group-hover:scale-110 transition-all duration-500">
                            <span class="text-brand group-hover:text-white transition-colors">{!! $item['icon'] !!}</span>
                        </div>
                        <div>
                            <h3 class="font-bold text-black dark:text-white text-sm uppercase tracking-wider transition-colors">{{ $item['title'] }}</h3>
                            <p class="text-black/60 dark:text-white/40 text-xs transition-colors">{{ $item['desc'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Section: Quienes somos / Por qué elegirnos -->
    <section id="proceso" class="section-padding relative bg-white dark:bg-black transition-colors duration-300">
        <x-interactive-particles density="80" color="#FB2C6B" />
        <div class="container-custom relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div>
                    <h2 class="font-display text-3xl md:text-4xl font-bold text-black dark:text-white mb-6 transition-colors">
                        Expertos en <span class="text-gradient">detailing automotriz</span> y estética vehicular
                    </h2>
                    <div class="space-y-6 text-black/70 dark:text-white/60 leading-relaxed text-lg transition-colors">
                        <p>
                            En el mundo del <strong>lavado autos</strong>, la diferencia está en los detalles. El detallado automotriz no es solo mojar y secar; es un proceso técnico que requiere conocimiento de superficies, materiales y química aplicada.
                        </p>
                        <p>
                            Utilizamos productos especializados, desde snow foam con pH neutro hasta descontaminantes férricos y sellantes con nanotecnología. Nuestra misión es devolver a tu vehículo ese aspecto de "recién salido de fábrica".
                        </p>
                        <ul class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-4">
                            @foreach([
                                "Lavado de autos profesional",
                                "Detailing interior auto",
                                "Limpieza profunda de autos",
                                "Lavado completo de auto",
                                "Descontaminación mecánica",
                                "Protección hidrofóbica"
                            ] as $feature)
                                <li class="flex items-center gap-2 text-sm text-black/70 dark:text-white/70">
                                    <div class="w-5 h-5 rounded-full bg-brand/20 flex items-center justify-center shrink-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-brand"><polyline points="20 6 9 17 4 12"/></svg>
                                    </div>
                                    <span class="transition-colors">{{ $feature }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                
                <div style="height: 500px; min-height: 500px;" class="relative w-full h-[500px] min-h-[500px] rounded-[36px] overflow-hidden border border-black/10 dark:border-white/10 group shadow-2xl shadow-brand/5">
                    <img 
                        src="/assets/images/galeria/Wash.jpg" 
                        alt="Servicio de lavado de autos profesional en Chicureo" 
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                    >
                    <div class="absolute inset-0 bg-gradient-to-t from-surface-900 via-transparent to-transparent opacity-60"></div>
                    <div class="absolute bottom-8 left-8 right-8 p-6 bg-white/90 dark:bg-[#111111]/90 border border-black/10 dark:border-white/10 backdrop-blur-md rounded-2xl">
                        <p class="text-black dark:text-white font-bold text-sm transition-colors">#1 Detailing Center en Chicureo</p>
                        <p class="text-brand text-xs font-semibold uppercase tracking-widest mt-1">Acabado de alta gama</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Packages Section -->
    <section id="paquetes" class="section-padding bg-white dark:bg-surface-800/50 relative transition-colors duration-300">
        <div class="container-custom">
            <div class="text-center mb-16">
                <p class="text-brand text-sm font-bold tracking-[0.2em] uppercase mb-4">Nuestras Tarifas</p>
                <h2 class="font-display text-3xl md:text-5xl font-bold text-black dark:text-white mb-6 transition-colors">
                    Paquetes de <span class="text-gradient">Limpieza y Detallado</span>
                </h2>
                <p class="text-black/60 dark:text-white/50 max-w-2xl mx-auto transition-colors">
                    Selecciona el nivel de cuidado que tu vehículo necesita. Precios transparentes basados en el tamaño y la complejidad del trabajo.
                </p>
            </div>

            @php
                $profile = \App\Models\BusinessProfile::first();
                    $onlinePaymentsActive = $profile ? ($profile->payment_gateway_enabled || $profile->show_prices) : false;
                    
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
                @endphp

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

                    // Ensure the 3 standard services for limpieza are always present without duplicates
                    $usedIds = [];
                    $categoryServices = collect();

                    // 1. Tier 1: Lavado Básico / Premium
                    $tier1 = $services->get('paquete-lavado')
                        ?? $services->get('lavado-premium')
                        ?? $services->get('paquete-lavado-premium')
                        ?? $services->first(fn($s) => in_array($s->slug, ['paquete-lavado', 'lavado-premium', 'paquete-lavado-premium']))
                        ?? $services->first(fn($s) => ($s->category === 'limpieza' || str_contains($s->slug, 'lavado')) && !str_contains($s->slug, 'avanzado') && !str_contains($s->slug, 'interior') && !in_array($s->id, $usedIds))
                        ?? \App\Models\Service::with('vehicleTypes')->whereIn('slug', ['paquete-lavado', 'lavado-premium'])->first();

                    if (!$tier1) {
                        $tier1 = new \App\Models\Service([
                            'id' => '01kwfafhqzp9pn17fgt5y6fhrb',
                            'name' => 'Lavado Premium',
                            'slug' => 'paquete-lavado',
                            'category' => 'limpieza',
                            'base_price' => 35000,
                            'short_description' => 'Lavado técnico artesanal con método de dos baldes, shampoo pH neutro, descontaminado de llantas y acondicionador.',
                            'long_description' => "- Lavado a mano artesanal con shampoo neutro\n- Limpieza profunda de llantas y calipers\n- Limpieza de cristales y espejos\n- Aplicación de dressing protector en neumáticos\n- Aspirado interior básico y protección de plásticos"
                        ]);
                        $tier1->vehicleTypes = collect([
                            (object)['name' => 'Pequeños', 'slug' => 'autos', 'pivot' => (object)['price' => 35000]],
                            (object)['name' => 'Medianos', 'slug' => 'medianos', 'pivot' => (object)['price' => 45000]],
                            (object)['name' => 'Grandes', 'slug' => 'grandes', 'pivot' => (object)['price' => 55000]],
                        ]);
                    }
                    $categoryServices->push($tier1);
                    $usedIds[] = $tier1->id;

                    // 2. Tier 2: Lavado Avanzado
                    $tier2 = $services->get('paquete-lavado-avanzado')
                        ?? $services->get('lavado-avanzado')
                        ?? $services->first(fn($s) => !in_array($s->id, $usedIds) && (str_contains($s->slug, 'avanzado') || str_contains(strtolower($s->name), 'avanzado')))
                        ?? \App\Models\Service::with('vehicleTypes')->where('slug', 'paquete-lavado-avanzado')->first();

                    if ($tier2 && !in_array($tier2->id, $usedIds)) {
                        $categoryServices->push($tier2);
                        $usedIds[] = $tier2->id;
                    }

                    // 3. Tier 3: Detallado Interior
                    $tier3 = $services->get('paquete-detallado-interior')
                        ?? $services->get('detailing-interior')
                        ?? $services->first(fn($s) => !in_array($s->id, $usedIds) && (str_contains($s->slug, 'interior') || str_contains(strtolower($s->name), 'interior')))
                        ?? \App\Models\Service::with('vehicleTypes')->where('slug', 'paquete-detallado-interior')->first();

                    if ($tier3 && !in_array($tier3->id, $usedIds)) {
                        $categoryServices->push($tier3);
                        $usedIds[] = $tier3->id;
                    }
                    
                    $servicesData = $categoryServices->map(function($s) {
                        $features = parseServiceFeatures($s->long_description);
                        $vPrices = [];
                        if ($s->vehicleTypes) {
                            foreach($s->vehicleTypes as $vt) {
                                $vPrices[] = [
                                    'name' => $vt->name,
                                    'slug' => $vt->slug,
                                    'price' => (int)$vt->pivot->price,
                                ];
                            }
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
                                $srvVideo = '/assets/videos/lavado-premium.mp4';
                                $slug = $srv->slug;
                                if (str_contains($slug, 'avanzado')) {
                                    $srvVideo = '/assets/videos/lavado-avanzado.mp4';
                                } elseif (str_contains($slug, 'interior')) {
                                    $srvVideo = file_exists(public_path('assets/videos/interior.mp4')) 
                                        ? '/assets/videos/interior.mp4' 
                                        : (file_exists(public_path('assets/videos/interior_nuevo.mp4')) ? '/assets/videos/interior_nuevo.mp4' : '/assets/videos/interior.mp4');
                                } elseif (str_contains($slug, 'completo')) {
                                    $srvVideo = '/assets/videos/pulido-correccion-2.mp4';
                                }
                                $minPrice = $srv->vehicleTypes->min('pivot.price') ?? $srv->base_price;
                            @endphp
                            <div style="height: 600px; min-height: 600px;" class="relative flex flex-col justify-between h-[600px] rounded-[40px] overflow-hidden p-8 sm:p-9 md:p-10 transition-all duration-500 group border-2 border-white/15 hover:border-brand/70 hover:shadow-2xl hover:scale-[1.015] bg-zinc-950 shadow-2xl">
                                <!-- Panoramic Video Background with Dark Tint and Cinematic Vignettes -->
                                <div class="absolute inset-0 z-0 overflow-hidden pointer-events-none">
                                    <video autoplay loop muted playsinline poster="/assets/images/cotizador_banner.png" class="w-full h-full object-cover opacity-60 group-hover:opacity-80 group-hover:scale-105 transition-all duration-700">
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
                                            href="/reserva?category=limpieza&service={{ $srv->slug }}"
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

                    <!-- MODAL DE DETALLES DEL SERVICIO LIMPIEZA -->
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
                                            :href="'/reserva?category=limpieza&service=' + (modalService ? modalService.slug : '')"
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

            <div class="mt-12 p-6 rounded-3xl bg-brand/5 border border-brand/10 flex items-start gap-4 max-w-3xl mx-auto">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-brand shrink-0 mt-0.5"><circle cx="12" cy="12" r="10"/><line x1="12" x2="12" y1="16" y2="12"/><line x1="12" x2="12.01" y1="8" y2="8"/></svg>
                <p class="text-sm text-black/70 dark:text-white/60 leading-relaxed transition-colors">
                    * Los precios indicados son referenciales y pueden variar según el estado real de suciedad o tamaño específico del vehículo. El detallado automotriz consiste en una limpieza profunda y minuciosa para una restauración estética de alto nivel.
                </p>
            </div>
        </div>
    </section>

    <!-- Section: Beneficios -->
    <section class="section-padding bg-gray-50 dark:bg-surface-900 relative transition-colors duration-300">
        <x-interactive-particles density="120" color="#FB2C6B" />
        <div class="container-custom relative z-10">
            <div class="text-center mb-16">
                <h2 class="font-display text-3xl md:text-5xl font-bold text-black dark:text-white mb-6 transition-colors">
                    Beneficios de una <span class="text-gradient">limpieza profunda</span> de autos
                </h2>
                <p class="text-black/60 dark:text-white/50 max-w-2xl mx-auto transition-colors">
                    No se trata solo de estética. El cuidado premium protege los materiales y aumenta la vida útil de cada componente.
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach([
                    ['title' => 'Conservación de Pintura', 'desc' => 'Eliminamos contaminantes que dañan el barniz permanentemente, manteniendo la profundidad del color.', 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-brand"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>'],
                    ['title' => 'Interior Saludable', 'desc' => 'La limpieza profunda de autos elimina ácaros, bacterias y olores, creando un ambiente más puro.', 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-brand"><path d="m13 2-2 10h9L11 22l2-10H4L13 2z"/></svg>'],
                    ['title' => 'Mayor Valor de Reventa', 'desc' => 'Un vehículo con mantenimiento de detallado profesional se deprecia mucho menos que uno con lavados regulares.', 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-brand"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>']
                ] as $benefit)
                    <div class="p-10 rounded-[40px] bg-white dark:bg-white/[0.02] border border-black/5 dark:border-white/5 hover:border-brand/30 transition-all shadow-md dark:shadow-none">
                        <div class="w-14 h-14 rounded-2xl bg-brand/10 flex items-center justify-center mb-6">
                            {!! $benefit['icon'] !!}
                        </div>
                        <h3 class="text-xl font-bold text-black dark:text-white mb-4 transition-colors">{{ $benefit['title'] }}</h3>
                        <p class="text-black/60 dark:text-white/40 leading-relaxed transition-colors">{{ $benefit['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section id="faq" class="section-padding bg-white dark:bg-surface-800 transition-colors duration-300">
        <div class="container-custom">
            <div class="mb-16 text-center">
                <h2 class="font-display text-3xl md:text-5xl font-bold text-black dark:text-white mb-4 transition-colors">
                    Preguntas <span class="text-gradient">Frecuentes</span>
                </h2>
                <p class="text-black/60 dark:text-white/40 transition-colors">Todo lo que necesitas saber sobre nuestro servicio de detailing.</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-x-12 gap-y-6 max-w-5xl mx-auto">
                @php
                    $faqs = [
                        [
                            'question' => '¿Qué incluye un servicio de detailing automotriz?',
                            'answer' => 'El detallado automotriz consiste en una limpieza profunda y minuciosa del vehículo y en el tratamiento de sus superficies. Incluye descontaminación de pintura, limpieza profunda de llantas, protección con sellantes, detallado de plásticos y una restauración estética integral de interior y exterior.',
                        ],
                        [
                            'question' => '¿Cuál es la diferencia entre lavado normal y lavado avanzado?',
                            'answer' => 'A diferencia de un lavado de autos tradicional, el lavado avanzado incorpora snow foam pH neutro, descontaminación mecánica de la pintura para eliminar impurezas incrustadas, y protección con sellantes sintéticos que duran hasta 3 meses, además de un cuidado superior de plásticos y gomas.',
                        ],
                        [
                            'question' => '¿Qué incluye el detallado interior?',
                            'answer' => 'Nuestro detailing interior auto incluye aspirado profundo, limpieza con vapor a alta presión, descontaminación y acondicionamiento de plásticos y cueros, lavado de alfombras con inyección/extracción, eliminación de olores y protección cerámica en tablero y textiles.',
                        ],
                        [
                            'question' => '¿Cuánto demora el servicio?',
                            'answer' => 'Dependiendo del nivel de suciedad y el paquete elegido, un servicio de lavado premium puede tomar desde 2 horas, mientras que un detallado interior profundo puede requerir entre 4 a 6 horas para garantizar los estándares de calidad de High Contrast.',
                        ],
                        [
                            'question' => '¿Cada cuánto conviene hacer una limpieza profunda del auto?',
                            'answer' => 'Recomendamos un lavado completo de auto de forma profunda cada 3 a 6 meses. Esto ayuda a prevenir que contaminantes dañen el barniz y mantiene los materiales interiores en óptimas condiciones, protegiendo el valor de reventa de tu vehículo.',
                        ],
                        [
                            'question' => '¿El servicio ayuda a conservar mejor el interior y la pintura?',
                            'answer' => 'Absolutamente. El lavado de autos profesional no solo limpia, sino que aplica protecciones UV e hidrofóbicas que evitan que el sol reseque los plásticos o el cuero, y que los contaminantes ambientales se adhieran a la pintura, facilitando lavados futuros y preservando la estética original.',
                        ]
                    ];
                @endphp

                @foreach($faqs as $faq)
                    <div class="p-8 rounded-3xl bg-gray-50 dark:bg-white/[0.02] border border-black/5 dark:border-white/5 hover:border-brand/20 transition-colors shadow-sm dark:shadow-none">
                        <h3 class="text-black dark:text-white font-bold mb-4 flex items-center gap-3 transition-colors">
                            <div class="w-2 h-2 rounded-full bg-brand"></div>
                            {{ $faq['question'] }}
                        </h3>
                        <p class="text-black/60 dark:text-white/40 text-sm leading-relaxed pl-5 transition-colors">
                            {{ $faq['answer'] }}
                        </p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-24 md:py-32 relative overflow-hidden bg-white dark:bg-surface-900 transition-colors duration-300 border-t border-black/5 dark:border-white/5">
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[800px] bg-brand/5 rounded-full blur-[120px] pointer-events-none"></div>

        <div class="container-custom relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <!-- Left Side: Content -->
                <div class="text-center lg:text-left">
                    <p class="text-brand text-sm font-semibold tracking-[0.2em] uppercase mb-6">Detailing de Élite</p>
                    <h2 class="font-display text-4xl md:text-5xl lg:text-6xl font-bold text-black dark:text-white mb-6 leading-tight transition-colors">
                        ¿Listo para ver tu auto <br><span class="text-gradient">como nuevo?</span>
                    </h2>
                    <p class="text-black/60 dark:text-white/50 text-lg mb-10 max-w-xl mx-auto lg:mx-0 transition-colors">
                        Agenda tu servicio de detailing hoy mismo y experimenta la diferencia High Contrast.
                    </p>

                    <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-6">
                        <a href="/reserva?category=limpieza" class="w-full sm:w-auto px-8 py-4 bg-brand hover:bg-brand-dark text-white font-semibold rounded-2xl text-lg transition-all duration-300 shadow-lg shadow-brand/30 hover:shadow-brand/50 flex items-center justify-center gap-2 hover:scale-[1.02]">
                            <span>Cotizar Limpieza Profunda</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="shrink-0"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                        </a>
                        <div class="flex items-center gap-3 text-black/60 dark:text-white/60 shrink-0 font-medium">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-brand"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                            <span class="text-sm">Ubicados en Chicureo</span>
                        </div>
                    </div>
                </div>

                <!-- Right Side: Video Frame -->
                <div class="relative group">
                    <div class="relative aspect-video rounded-[2.5rem] overflow-hidden border border-black/10 dark:border-white/10 shadow-2xl transition-all duration-500 hover:scale-[1.01] hover:border-brand/30 bg-black">
                        <video autoplay muted loop playsinline class="w-full h-full object-cover">
                            <source src="/assets/videos/lavado-premium.mp4" type="video/mp4">
                        </video>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent pointer-events-none"></div>
                        <div class="absolute bottom-3 left-3 right-3 md:bottom-6 md:left-6 md:right-6 p-2.5 md:p-4 rounded-xl md:rounded-2xl bg-black/50 md:bg-black/60 backdrop-blur-sm md:backdrop-blur-md border border-white/5 md:border-white/10">
                            <p class="text-white text-[10px] md:text-xs font-bold uppercase tracking-widest mb-0.5 md:mb-1 flex items-center gap-1.5">
                                <span class="h-1.5 w-1.5 md:h-2 md:w-2 rounded-full bg-brand animate-pulse"></span>
                                Limpieza Activa
                            </p>
                            <p class="text-white/60 text-[9px] md:text-[10px] leading-tight">Proceso completo de lavado Snow Foam y descontaminación.</p>
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
@include('partials.schema-limpieza')
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
