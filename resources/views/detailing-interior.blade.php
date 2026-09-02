@extends('layouts.public')

@section('title', 'Detailing Interior a Vapor en Las Condes, Colina y Huechuraba | High Contrast')
@section('meta_description', 'Servicio profesional de detailing interior a vapor en Las Condes, Chicureo Colina y Huechuraba. Desinfección profunda a 160°C, lavado de tapices por inyección-extracción, nutrición de cueros y esterilización con ozono.')
@section('meta_keywords', 'detailing interior las condes, detailing interior colina, detailing interior chicureo, limpieza tapiz autos huechuraba, lavado a vapor autos las condes, limpieza interior autos vitacura, desinfeccion autos santiago, lavado de tapiz a domicilio')

@section('content')
<main class="overflow-hidden bg-white dark:bg-surface-900 text-black dark:text-white transition-colors duration-300">
    <!-- Hero Section -->
    <section class="relative min-h-screen flex items-center justify-center overflow-hidden bg-[#0A0A0A]">
        <div class="absolute inset-0 bg-[#0A0A0A]">
            <video autoplay muted loop playsinline class="w-full h-full object-cover opacity-50">
                <source src="/assets/videos/detailing-terminacion.mp4" type="video/mp4">
            </video>
            <div class="absolute inset-0 bg-gradient-to-b from-[#0A0A0A]/85 via-transparent to-[#0A0A0A]"></div>
            <div class="absolute inset-0 bg-gradient-to-r from-[#0A0A0A]/60 via-transparent to-[#0A0A0A]/60"></div>
        </div>

        <div class="container-custom relative z-10 text-center px-4 pt-24 pb-16">
            <div class="max-w-5xl mx-auto">
                <!-- Local SEO Geolocation Pill -->
                <div class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-brand/10 border border-brand/20 text-brand text-xs font-black uppercase tracking-[0.25em] mb-8 shadow-lg shadow-brand/10 backdrop-blur-md">
                    <span class="w-2 h-2 rounded-full bg-brand animate-pulse"></span>
                    <span>Cobertura Premium: Las Condes • Chicureo / Colina • Huechuraba</span>
                </div>
                
                <h1 class="font-display text-4xl sm:text-6xl md:text-7xl lg:text-8xl font-black text-white mb-8 leading-[1.08] tracking-tight uppercase">
                    Detailing Interior <br>
                    <span class="text-gradient">a Vapor & Desinfección</span>
                </h1>
                
                <p class="text-white/80 text-base sm:text-xl md:text-2xl leading-relaxed mb-12 max-w-3xl mx-auto font-light">
                    Restauramos el habitáculo de tu vehículo a un estándar de fábrica. Higienización profunda a vapor a 160°C, extracción de manchas en tapices, acondicionamiento de cueros y eliminación definitiva de olores.
                </p>

                <div class="flex flex-col sm:flex-row items-center justify-center gap-5">
                    <a href="/reserva?category=limpieza" class="w-full sm:w-auto px-10 py-5 bg-brand hover:bg-brand-dark text-white font-display font-black text-base sm:text-lg uppercase tracking-wider rounded-full transition-all duration-300 shadow-xl shadow-brand/40 hover:scale-105 flex items-center justify-center gap-3">
                        <span>Cotizar Detailing Online</span>
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                    <a href="#procedimiento" class="w-full sm:w-auto px-10 py-5 border border-white/20 hover:border-brand/50 text-white font-bold text-base sm:text-lg rounded-full transition-all duration-300 backdrop-blur-md hover:bg-white/5">
                        Ver Procedimiento
                    </a>
                </div>

                <!-- Trust Badges -->
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mt-16 max-w-4xl mx-auto pt-10 border-t border-white/10 text-left">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-brand shrink-0">
                            🌡️
                        </div>
                        <div>
                            <p class="text-white font-bold text-sm">Vapor 160°C</p>
                            <p class="text-white/50 text-xs">Elimina 99.9% bacterias</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-brand shrink-0">
                            💺
                        </div>
                        <div>
                            <p class="text-white font-bold text-sm">Inyección / Extracción</p>
                            <p class="text-white/50 text-xs">Tapices y alfombras</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-brand shrink-0">
                            🛡️
                        </div>
                        <div>
                            <p class="text-white font-bold text-sm">Tratamiento Cuero</p>
                            <p class="text-white/50 text-xs">Nutrición & Sellado UV</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-brand shrink-0">
                            💨
                        </div>
                        <div>
                            <p class="text-white font-bold text-sm">Choque de Ozono</p>
                            <p class="text-white/50 text-xs">Neutraliza olores y ácaros</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 1: Por qué el vapor profesional marca la diferencia -->
    <section class="section-padding bg-gray-50 dark:bg-surface-900/60 relative transition-colors border-b border-black/5 dark:border-white/5">
        <div class="container-custom">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">
                <div>
                    <span class="text-brand text-xs font-bold uppercase tracking-[0.3em] mb-4 block">Tecnología de Grado Clínico</span>
                    <h2 class="font-display text-3xl sm:text-4xl md:text-5xl font-black text-black dark:text-white mb-6 leading-tight">
                        Desinfección real para clientes de <br>
                        <span class="text-gradient">Las Condes, Chicureo y Huechuraba</span>
                    </h2>
                    <p class="text-black/70 dark:text-white/60 text-base sm:text-lg mb-6 leading-relaxed">
                        El uso diario del vehículo acumula sudor, polvo en suspensión, restos orgánicos, alérgenos y bacterias en los poros de los tapices y conductos de ventilación.
                    </p>
                    <p class="text-black/70 dark:text-white/60 text-base sm:text-lg mb-8 leading-relaxed">
                        A diferencia de un lavado tradicional que solo moja la superficie, nuestro sistema de <strong>vapor seco termodinámico a alta presión</strong> penetra profundamente en las fibras textiles y plásticos, disolviendo la grasa y destruyendo microorganismos sin saturar de agua el interior.
                    </p>

                    <div class="space-y-4">
                        @foreach([
                            ['title' => 'Secado Rápido y Seguro', 'desc' => 'Al utilizar vapor de bajo contenido de humedad, tu auto queda completamente seco y listo para usar el mismo día.'],
                            ['title' => 'Cero Residuos Químicos Tóxicos', 'desc' => 'Productos pH neutro biodegradables de alta gama certificados por Gtechniq y marcas europeas.'],
                            ['title' => 'Cuidado Especial para Autos de Alta Gama', 'desc' => 'Tratamiento especializado para cueros Nappa, Alcántara, costuras contrastadas y molduras en piano black.']
                        ] as $item)
                            <div class="flex items-start gap-4 p-4 rounded-2xl bg-white dark:bg-zinc-950 border border-black/5 dark:border-white/10 shadow-sm">
                                <div class="w-8 h-8 rounded-full bg-brand/10 text-brand flex items-center justify-center shrink-0 font-bold text-xs mt-0.5">
                                    ✓
                                </div>
                                <div>
                                    <h3 class="font-bold text-sm text-black dark:text-white">{{ $item['title'] }}</h3>
                                    <p class="text-xs sm:text-sm text-black/60 dark:text-white/50 leading-relaxed">{{ $item['desc'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Video Showcase Card -->
                <div class="relative w-full h-[480px] sm:h-[540px] rounded-[36px] overflow-hidden border border-black/10 dark:border-white/15 shadow-2xl bg-zinc-950 group">
                    <video autoplay muted loop playsinline class="w-full h-full object-cover opacity-90 group-hover:scale-105 transition-transform duration-700">
                        <source src="/assets/videos/detailing-terminacion.mp4" type="video/mp4">
                    </video>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/30 to-transparent pointer-events-none"></div>
                    
                    <div class="absolute bottom-0 inset-x-0 p-8 z-10">
                        <span class="px-3.5 py-1.5 rounded-full bg-brand/20 border border-brand/40 text-brand text-[11px] font-black uppercase tracking-wider inline-block mb-3">
                            Resultado Impecable
                        </span>
                        <h3 class="font-display font-black text-2xl sm:text-3xl text-white uppercase tracking-tight mb-2">
                            Terminación Satinada Original
                        </h3>
                        <p class="text-white/80 text-xs sm:text-sm leading-relaxed font-light">
                            Sin siliconas aceitosas ni brillos falsos. Las superficies quedan suaves, limpias y con aroma fresco natural.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 2: Procedimiento Paso a Paso (6 Etapas) -->
    <section id="procedimiento" class="section-padding bg-white dark:bg-surface-900 relative transition-colors border-b border-black/5 dark:border-white/5">
        <div class="container-custom">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <span class="text-brand text-xs font-bold uppercase tracking-[0.3em] mb-3 block">Proceso Meticuloso</span>
                <h2 class="font-display text-3xl sm:text-5xl font-black text-black dark:text-white uppercase tracking-tight mb-4">
                    Protocolo de <span class="text-gradient">Detailing Interior</span>
                </h2>
                <p class="text-black/60 dark:text-white/50 text-base sm:text-lg">
                    Cada rincón de tu vehículo recibe atención artesanal bajo estándares profesionales.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @php
                    $steps = [
                        [
                            'num' => '01',
                            'title' => 'Aspirado Técnico y Desincrustado',
                            'desc' => 'Aspirado de alta potencia con turbina y aire comprimido para expulsar la arena y suciedad atrapada debajo de rieles y rincones inaccesibles.'
                        ],
                        [
                            'num' => '02',
                            'title' => 'Sanitización a Vapor Térmico',
                            'desc' => 'Aplicación de vapor a 160°C en ranuras, conductos de aire acondicionado, pedaleras, cinturones de seguridad y descansabrazos.'
                        ],
                        [
                            'num' => '03',
                            'title' => 'Lavado de Tapices e Inyección',
                            'desc' => 'Inyección de limpiador enzimático de alta penetración y extracción simultánea de suciedad, manchas de café, grasa y líquidos derramados.'
                        ],
                        [
                            'num' => '04',
                            'title' => 'Nutrición & Hidratación de Cuero',
                            'desc' => 'Limpieza con cepillo de cerdas naturales de crin y aplicación de crema acondicionadora con bloqueador UV para prevenir trizaduras y resequedad.'
                        ],
                        [
                            'num' => '05',
                            'title' => 'Tratamiento Antiestático de Plásticos',
                            'desc' => 'Protección y acondicionamiento satinado de tablero, consola central y paneles de puerta. Acabado hidrofóbico que repele el polvo.'
                        ],
                        [
                            'num' => '06',
                            'title' => 'Ozonización & Purificación de Aire',
                            'desc' => 'Generador de gas ozono de choque para esterilizar el habitáculo completo, eliminando virus, hongos, bacterias y olor a tabaco o mascotas.'
                        ]
                    ];
                @endphp

                @foreach($steps as $step)
                    <div class="p-8 rounded-[32px] bg-zinc-50 dark:bg-zinc-950 border border-black/5 dark:border-white/10 hover:border-brand/50 transition-all duration-300 group shadow-lg hover:shadow-2xl">
                        <span class="font-display font-black text-4xl text-brand/30 group-hover:text-brand transition-colors block mb-4">
                            {{ $step['num'] }}
                        </span>
                        <h3 class="font-display font-black text-xl text-black dark:text-white mb-3 group-hover:text-brand transition-colors">
                            {{ $step['title'] }}
                        </h3>
                        <p class="text-black/60 dark:text-white/50 text-sm leading-relaxed">
                            {{ $step['desc'] }}
                        </p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Section 3: Cobertura Local y Retiro (Las Condes, Colina, Huechuraba) -->
    <section class="section-padding bg-zinc-950 text-white relative overflow-hidden">
        <div class="container-custom relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Card Las Condes -->
                <div class="p-8 rounded-3xl bg-zinc-900 border border-white/15 hover:border-brand transition-all">
                    <div class="flex items-center gap-3 mb-4">
                        <span class="text-2xl">📍</span>
                        <h3 class="font-display font-black text-2xl text-white">Las Condes & Vitacura</h3>
                    </div>
                    <p class="text-white/60 text-sm leading-relaxed mb-6">
                        Atención preferencial para clientes del sector oriente (El Golf, San Damián, Los Dominicos, Santa María de Manquehue).
                    </p>
                    <ul class="space-y-2 text-xs text-white/80 mb-6">
                        <li class="flex items-center gap-2">✓ Retiro y entrega coordinada de vehículos</li>
                        <li class="flex items-center gap-2">✓ Atención en taller cerrado con seguridad 24/7</li>
                    </ul>
                    <a href="/reserva?category=limpieza" class="text-brand font-black text-xs uppercase tracking-wider hover:underline flex items-center gap-1">
                        Cotizar para Las Condes →
                    </a>
                </div>

                <!-- Card Colina & Chicureo -->
                <div class="p-8 rounded-3xl bg-zinc-900 border-2 border-brand/60 shadow-2xl shadow-brand/20">
                    <div class="flex items-center gap-3 mb-4">
                        <span class="text-2xl">📍</span>
                        <h3 class="font-display font-black text-2xl text-white">Colina & Chicureo</h3>
                    </div>
                    <p class="text-white/60 text-sm leading-relaxed mb-6">
                        Ubicación central en Chicureo. Tratamientos especiales para vehículos expuestos a polvo de caminos y radiación solar intensa.
                    </p>
                    <ul class="space-y-2 text-xs text-white/80 mb-6">
                        <li class="flex items-center gap-2">✓ Piedra Roja, Chamisero, Santa Elena y Brisas</li>
                        <li class="flex items-center gap-2">✓ Descontaminado profundo de tapices con tierra</li>
                    </ul>
                    <a href="/reserva?category=limpieza" class="text-brand font-black text-xs uppercase tracking-wider hover:underline flex items-center gap-1">
                        Cotizar en Chicureo →
                    </a>
                </div>

                <!-- Card Huechuraba -->
                <div class="p-8 rounded-3xl bg-zinc-900 border border-white/15 hover:border-brand transition-all">
                    <div class="flex items-center gap-3 mb-4">
                        <span class="text-2xl">📍</span>
                        <h3 class="font-display font-black text-2xl text-white">Huechuraba & Providencia</h3>
                    </div>
                    <p class="text-white/60 text-sm leading-relaxed mb-6">
                        Fácil acceso por Radial Nororiente y Autopista Vespucio Norte. Servicio express para ejecutivos y particulares.
                    </p>
                    <ul class="space-y-2 text-xs text-white/80 mb-6">
                        <li class="flex items-center gap-2">✓ Ciudad Empresarial y Pedro Fontova</li>
                        <li class="flex items-center gap-2">✓ Sanitización certificada contra alergias</li>
                    </ul>
                    <a href="/reserva?category=limpieza" class="text-brand font-black text-xs uppercase tracking-wider hover:underline flex items-center gap-1">
                        Cotizar para Huechuraba →
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="section-padding bg-white dark:bg-surface-900 relative transition-colors border-t border-black/5 dark:border-white/5">
        <div class="container-custom max-w-5xl">
            <h2 class="font-display text-3xl sm:text-5xl font-black text-black dark:text-white mb-12 text-center uppercase">
                Preguntas <span class="text-gradient">Frecuentes</span>
            </h2>

            <div class="space-y-6">
                @php
                    $faqs = [
                        [
                            'q' => '¿Cuánto tiempo demora el detailing interior completo?',
                            'a' => 'Un detailing interior completo y profesional toma habitualmente entre 3 y 5 horas según el tamaño del vehículo y el nivel de suciedad o presencia de pelos de mascota.'
                        ],
                        [
                            'q' => '¿El vapor puede dañar las pantallas digitales o componentes electrónicos?',
                            'a' => 'No. Utilizamos vapor seco con control preciso de presión y temperatura, además de proteger y sellar previamente pantallas táctiles, tableros digitales y botones con microfibras especializadas.'
                        ],
                        [
                            'q' => '¿Eliminan manchas difíciles como café, tinta o comida acumulada?',
                            'a' => 'Sí. Con nuestra máquina de inyección y extracción en conjunto con limpiadores enzimáticos profesionales logramos remover la gran mayoría de manchas profundas en alfombras y telas.'
                        ],
                        [
                            'q' => '¿Cómo funciona la reserva para clientes de Las Condes o Huechuraba?',
                            'a' => 'Puedes cotizar y seleccionar tu hora en línea a través de nuestro cotizador web inteligente en 2 simples pasos o escribirnos directamente a WhatsApp.'
                        ]
                    ];
                @endphp

                @foreach($faqs as $faq)
                    <div class="p-8 rounded-3xl bg-gray-50 dark:bg-zinc-950 border border-black/5 dark:border-white/10">
                        <h3 class="font-display font-black text-lg sm:text-xl text-black dark:text-white mb-3">
                            {{ $faq['q'] }}
                        </h3>
                        <p class="text-black/60 dark:text-white/60 text-sm leading-relaxed">
                            {{ $faq['a'] }}
                        </p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- CTA Bottom Section -->
    <section class="py-20 relative bg-zinc-950 text-white overflow-hidden text-center border-t border-white/10">
        <div class="container-custom relative z-10 max-w-3xl mx-auto px-4">
            <h2 class="font-display text-3xl sm:text-5xl font-black text-white uppercase tracking-tight mb-6">
                Devuélvele la frescura a tu <span class="text-gradient">Vehículo</span>
            </h2>
            <p class="text-white/70 text-base sm:text-lg mb-8 leading-relaxed">
                Agenda tu cita hoy mismo. Cotiza online con precios transparentes y disponibilidad en tiempo real.
            </p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="/reserva?category=limpieza" class="w-full sm:w-auto px-10 py-4.5 bg-brand hover:bg-brand-dark text-white font-display font-black text-base uppercase tracking-wider rounded-full shadow-xl shadow-brand/40 transition-all hover:scale-105">
                    Cotizar Detailing Ahora
                </a>
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $profile->phone ?? '56912345678') }}?text={{ urlencode('Hola! Quisiera consultar por el servicio de Detailing Interior a Vapor en Las Condes/Chicureo.') }}" target="_blank" rel="noopener noreferrer" class="w-full sm:w-auto px-8 py-4.5 bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-base rounded-full shadow-lg transition-all flex items-center justify-center gap-2">
                    <span>Consultar por WhatsApp</span>
                </a>
            </div>
        </div>
    </section>
</main>

<!-- Schema.org Rich Snippet -->
@php
    $schemaProfile = \App\Models\BusinessProfile::first();
    $jsonLd = [
        '@context' => 'https://schema.org',
        '@type' => 'Service',
        'name' => 'Detailing Interior a Vapor y Desinfección',
        'serviceType' => 'Auto Interior Detailing and Sanitization',
        'provider' => [
            '@type' => 'AutoRepair',
            'name' => $schemaProfile->business_name ?? 'High Contrast Detailing Center',
            'telephone' => $schemaProfile->phone ?? '+56912345678',
            'address' => [
                '@type' => 'PostalAddress',
                'streetAddress' => $schemaProfile->address ?? 'Chicureo',
                'addressLocality' => 'Colina',
                'addressRegion' => 'Región Metropolitana',
                'addressCountry' => 'CL'
            ]
        ],
        'areaServed' => [
            ['@type' => 'City', 'name' => 'Las Condes'],
            ['@type' => 'City', 'name' => 'Colina'],
            ['@type' => 'City', 'name' => 'Chicureo'],
            ['@type' => 'City', 'name' => 'Huechuraba'],
            ['@type' => 'City', 'name' => 'Vitacura'],
            ['@type' => 'City', 'name' => 'Lo Barnechea'],
            ['@type' => 'City', 'name' => 'Santiago']
        ],
        'description' => 'Servicio profesional de detailing interior a vapor en Las Condes, Chicureo Colina y Huechuraba. Desinfección profunda a vapor 160°C, extracción de manchas en tapiz, nutrición de cueros y eliminación de olores con ozono.'
    ];
@endphp
<script type="application/ld+json">
{!! json_encode($jsonLd, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
</script>
@endsection
