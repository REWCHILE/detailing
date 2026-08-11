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
                        href="/reserva?service=lavado-premium" 
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
                
                <div class="relative aspect-video rounded-[40px] overflow-hidden border border-white/10 group shadow-2xl shadow-brand/5">
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

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-stretch">
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
                    $categoryServices = $services->where('category', 'limpieza')->sortBy('display_order');
                @endphp

                @foreach($categoryServices as $srv)
                    <div class="relative flex flex-col h-full bg-gray-50 dark:bg-surface-700/50 border {{ $srv->is_featured ? 'border-brand/40 shadow-2xl shadow-brand/10 dark:shadow-brand/10' : 'border-black/5 dark:border-white/5 shadow-sm dark:shadow-none' }} rounded-[40px] p-8 md:p-10 transition-all duration-500 hover:border-brand/40 group">
                        @if($srv->is_featured)
                            <div class="absolute -top-4 left-1/2 -translate-x-1/2 bg-brand text-white text-[10px] font-bold uppercase tracking-widest px-4 py-1.5 rounded-full z-10">
                                Destacado
                            </div>
                        @endif

                        <div class="mb-8">
                            <span class="text-brand text-xs font-bold uppercase tracking-widest mb-2 block">
                                @php
                                    $hours = $srv->duration_minutes / 60;
                                    $hoursStr = str_replace('.0', '', number_format($hours, 1, '.', ''));
                                @endphp
                                {{ $hours >= 1 ? $hoursStr . ' HORA' . ($hours > 1 ? 'S' : '') : $srv->duration_minutes . ' MINUTOS' }}
                            </span>
                            <h3 class="text-3xl font-display font-bold text-black dark:text-white mb-4 group-hover:text-brand transition-colors">
                                {{ $srv->name }}
                            </h3>
                            <p class="text-black/60 dark:text-white/50 text-sm leading-relaxed min-h-[3rem] transition-colors html-content">
                                {!! $srv->short_description !!}
                            </p>
                        </div>

                        <div class="space-y-3 mb-8">
                            @foreach($vehicleTypes as $vt)
                                <div class="flex items-center justify-between p-3 rounded-2xl bg-white dark:bg-white/[0.03] border border-black/5 dark:border-white/5 shadow-sm dark:shadow-none transition-colors">
                                    <div class="flex items-center gap-3">
                                        <span class="text-xl leading-none">{{ $vt->emoji ?? '🚗' }}</span>
                                        <span class="text-xs text-black/70 dark:text-white/60 font-medium transition-colors">{{ $vt->name }}</span>
                                    </div>
                                    <span class="text-base font-display font-bold text-black dark:text-white transition-colors">
                                        @if($onlinePaymentsActive)
                                            ${{ number_format($srv->getPriceForVehicleType($vt->id), 0, ',', '.') }}
                                        @else
                                            Cotizar
                                        @endif
                                    </span>
                                </div>
                            @endforeach
                        </div>

                        <div class="flex-grow text-black/70 dark:text-white/70">
                            <div class="text-xs font-bold text-black/40 dark:text-white/30 uppercase tracking-widest mb-4 border-b border-black/5 dark:border-white/5 pb-2 transition-colors">
                                ¿Qué incluye?
                            </div>
                            @php
                                preg_match_all('/<(p|li)[^>]*>(.*?)<\/\1>/s', $srv->long_description, $matches);
                                $features = !empty($matches[2]) ? array_filter(array_map('trim', $matches[2])) : [];
                                if (empty($features)) {
                                    $features = array_filter(array_map('trim', explode("\n", $srv->long_description)));
                                }
                            @endphp
                            <ul class="space-y-4 mb-10">
                                @foreach($features as $feature)
                                    <li class="flex items-start gap-3">
                                        <div class="mt-1 w-5 h-5 rounded-full bg-brand/10 flex items-center justify-center shrink-0 group-hover:bg-brand group-hover:text-white transition-colors">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="text-brand group-hover:text-white"><polyline points="20 6 9 17 4 12"/></svg>
                                        </div>
                                        <span class="text-sm leading-relaxed html-content">{!! $feature !!}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <a 
                            href="/reserva?service={{ $srv->slug }}" 
                            class="w-full block py-4 text-center font-bold uppercase tracking-widest text-xs transition-all duration-300 {{ $srv->is_featured ? 'bg-brand text-white shadow-lg shadow-brand/20 hover:bg-brand-dark' : 'bg-black/5 dark:bg-white/5 text-black dark:text-white hover:bg-brand hover:text-white' }}"
                        >
                            Agendar Turno
                        </a>
                    </div>
                @endforeach
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
                        <a href="/reserva" class="w-full sm:w-auto px-8 py-4 bg-brand hover:bg-brand-dark text-white font-semibold rounded-2xl text-lg transition-all duration-300 shadow-lg shadow-brand/30 hover:shadow-brand/50 flex items-center justify-center gap-2 hover:scale-[1.02]">
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
