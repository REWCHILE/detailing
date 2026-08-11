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
                <source src="/assets/videos/pulido-correccion.mp4" type="video/mp4">
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
                    <a href="/reserva" class="px-12 py-5 bg-brand hover:bg-brand-dark text-white font-bold rounded-full text-lg transition-all shadow-xl shadow-brand/30 hover:scale-105">
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
                            Si buscas **eliminar rayones de auto** de forma segura, realizamos una medición técnica del espesor de laca (PTG) para asegurar que el trabajo no comprometa la integridad de la pintura a largo plazo.
                        </p>
                    </div>
                </div>
                <div class="relative aspect-video rounded-[3rem] overflow-hidden border border-white/10 group bg-black transition-colors">
                    <video autoplay muted loop playsinline class="w-full h-full object-cover opacity-90">
                        <source src="/assets/videos/pulido-correccion-2.mp4" type="video/mp4">
                    </video>
                    <!-- Image overlay mock -->
                    <div class="absolute inset-x-0 bottom-0 p-8 bg-black/80 border-t border-white/10 backdrop-blur-md">
                        <p class="text-white font-bold mb-1 transition-colors">Corrección Multi-Etapa</p>
                        <p class="text-white/60 text-xs uppercase tracking-widest transition-colors">Eliminación de defectos severos</p>
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
    <section class="section-padding bg-gray-50 dark:bg-surface-800 relative overflow-hidden transition-colors border-b border-black/5 dark:border-white/5 duration-300">
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
                $categoryServices = $services->where('category', 'correccion')->sortBy('display_order');
            @endphp

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                @foreach($categoryServices as $srv)
                    <div class="relative flex flex-col h-full bg-white border {{ $srv->is_featured ? 'border-brand shadow-2xl shadow-brand/10 scale-[1.02]' : 'border-slate-100' }} rounded-[40px] p-8 md:p-10 transition-all duration-500 hover:border-brand hover:shadow-lg group">
                        @if($srv->is_featured)
                            <div class="absolute -top-4 left-1/2 -translate-x-1/2 bg-brand text-white text-[10px] font-bold uppercase tracking-widest px-4 py-1.5 rounded-full z-10">
                                Destacado
                            </div>
                        @endif

                        <div class="mb-8">
                            <div class="w-14 h-14 rounded-2xl bg-brand/10 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-brand"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                            </div>
                            <span class="text-brand text-xs font-bold uppercase tracking-widest mb-2 block">
                                {{ $srv->duration_minutes }} MINUTOS
                            </span>
                            <h3 class="text-2xl font-display font-bold text-slate-900 mb-4">
                                {{ $srv->name }}
                            </h3>
                            <p class="text-slate-500 text-sm leading-relaxed min-h-[3rem] html-content">
                                {!! $srv->short_description !!}
                            </p>
                        </div>

                        <div class="space-y-3 mb-8">
                            @foreach($vehicleTypes as $vt)
                                <div class="flex items-center justify-between p-3 rounded-2xl bg-slate-50 border border-slate-100 transition-colors">
                                    <div class="flex items-center gap-3">
                                        <span class="text-xl leading-none">{{ $vt->emoji ?? '🚗' }}</span>
                                        <span class="text-xs text-slate-600 font-semibold">{{ $vt->name }}</span>
                                    </div>
                                    <span class="text-base font-display font-bold text-slate-900">
                                        @if($onlinePaymentsActive)
                                            ${{ number_format($srv->getPriceForVehicleType($vt->id), 0, ',', '.') }}
                                        @else
                                            Cotizar
                                        @endif
                                    </span>
                                </div>
                            @endforeach
                        </div>

                        <div class="flex-grow text-slate-700">
                            @php
                                preg_match_all('/<(p|li)[^>]*>(.*?)<\/\1>/s', $srv->long_description, $matches);
                                $features = !empty($matches[2]) ? array_filter(array_map('trim', $matches[2])) : [];
                                if (empty($features)) {
                                    $features = array_filter(array_map('trim', explode("\n", $srv->long_description)));
                                }
                            @endphp
                            <ul class="space-y-4 mb-8">
                                @foreach($features as $feature)
                                    @if(str_contains(strtolower($feature), 'todo lo incluido'))
                                        <li class="relative flex items-start gap-3 text-sm p-3 rounded-lg bg-brand/5 border border-brand/20 text-brand font-bold mb-4 group/tooltip cursor-help">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="text-brand mt-0.5 shrink-0"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                                            <span class="transition-colors border-b border-dashed border-brand/40 pb-0.5 html-content">{!! $feature !!}</span>
                                            
                                            <!-- Tooltip -->
                                            <div class="absolute bottom-full left-1/2 -translate-x-1/2 mb-3 w-64 p-4 bg-white dark:bg-surface-900 border border-black/10 dark:border-white/10 rounded-xl shadow-2xl opacity-0 invisible group-hover/tooltip:opacity-100 group-hover/tooltip:visible transition-all duration-300 z-50 text-left">
                                                <div class="text-[10px] font-black text-black dark:text-white uppercase tracking-widest mb-2 border-b border-black/5 dark:border-white/5 pb-2">Características Nivel Anterior:</div>
                                                <div class="text-xs text-black/60 dark:text-white/60">Incluye todas las características del nivel anterior.</div>
                                                <!-- Triangle Pointer -->
                                                <div class="absolute top-full left-1/2 -translate-x-1/2 -mt-[1px] border-8 border-transparent border-t-white dark:border-t-surface-900"></div>
                                            </div>
                                        </li>
                                    @else
                                        <li class="flex items-start gap-3 text-sm font-medium text-slate-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-brand mt-1 shrink-0"><polyline points="20 6 9 17 4 12"/></svg>
                                            <span class="html-content">{!! $feature !!}</span>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>

                        <a
                            href="/reserva?service={{ $srv->slug }}"
                            class="w-full py-5 rounded-2xl font-bold transition-all duration-300 text-sm tracking-wider uppercase text-center {{ $srv->is_featured ? 'bg-brand text-white shadow-lg shadow-brand/30 hover:bg-brand-dark hover:scale-[1.02]' : 'bg-slate-100 text-slate-800 hover:bg-slate-200 border border-slate-200 hover:border-brand/40' }}"
                        >
                            Solicitar este nivel
                        </a>
                    </div>
                @endforeach
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
                        <a href="/reserva" class="w-full sm:w-auto px-8 py-4 bg-brand hover:bg-brand-dark text-white font-semibold rounded-2xl text-lg transition-all duration-300 shadow-lg shadow-brand/30 hover:shadow-brand/50 flex items-center justify-center gap-2 hover:scale-[1.02]">
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

