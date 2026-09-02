@extends('layouts.public')

@section('title', 'Tratamiento Cerámico 9H en Las Condes, Colina y Huechuraba | High Contrast')
@section('meta_description', 'Tratamiento cerámico 9H y Gtechniq para autos en Las Condes, Chicureo Colina y Huechuraba. Protección extrema de pintura contra micro-rayas, químicos y rayos UV con garantía oficial de hasta 9 años.')
@section('meta_keywords', 'tratamiento ceramico las condes, sellado ceramico colina, ceramic coating chicureo, ceramico autos huechuraba, proteccion pintura 9h santiago, gtechniq chile las condes, ceramico autos vitacura, crystal serum ultra santiago')

@section('content')
<main class="overflow-hidden bg-white dark:bg-surface-900 text-black dark:text-white transition-colors duration-300">
    <!-- Hero Section -->
    <section class="relative min-h-screen flex items-center justify-center overflow-hidden bg-[#0A0A0A]">
        <div class="absolute inset-0 bg-[#0A0A0A]">
            <video autoplay muted loop playsinline class="w-full h-full object-cover opacity-50">
                <source src="/assets/videos/bmwblanco-horizontal.mp4" type="video/mp4">
            </video>
            <div class="absolute inset-0 bg-gradient-to-b from-[#0A0A0A]/85 via-transparent to-[#0A0A0A]"></div>
            <div class="absolute inset-0 bg-gradient-to-r from-[#0A0A0A]/60 via-transparent to-[#0A0A0A]/60"></div>
        </div>

        <div class="container-custom relative z-10 text-center px-4 pt-24 pb-16">
            <div class="max-w-5xl mx-auto">
                <!-- Local SEO Geolocation Pill -->
                <div class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-brand/10 border border-brand/20 text-brand text-xs font-black uppercase tracking-[0.25em] mb-8 shadow-lg shadow-brand/10 backdrop-blur-md">
                    <span class="w-2 h-2 rounded-full bg-brand animate-pulse"></span>
                    <span>Centro Acreditado Gtechniq: Las Condes • Chicureo / Colina • Huechuraba</span>
                </div>
                
                <h1 class="font-display text-4xl sm:text-6xl md:text-7xl lg:text-8xl font-black text-white mb-8 leading-[1.08] tracking-tight uppercase">
                    Tratamiento Cerámico <br>
                    <span class="text-gradient">9H & Crystal Serum</span>
                </h1>
                
                <p class="text-white/80 text-base sm:text-xl md:text-2xl leading-relaxed mb-12 max-w-3xl mx-auto font-light">
                    Blindaje nanotecnológico permanente para la pintura de tu vehículo. Máxima dureza 9H/10H, hidrofobia extrema, brillo óptico profundo y resistencia contra el sol y químicos.
                </p>

                <div class="flex flex-col sm:flex-row items-center justify-center gap-5">
                    <a href="/reserva?category=ceramico" class="w-full sm:w-auto px-10 py-5 bg-brand hover:bg-brand-dark text-white font-display font-black text-base sm:text-lg uppercase tracking-wider rounded-full transition-all duration-300 shadow-xl shadow-brand/40 hover:scale-105 flex items-center justify-center gap-3">
                        <span>Cotizar Tratamiento Cerámico</span>
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                    <a href="#beneficios" class="w-full sm:w-auto px-10 py-5 border border-white/20 hover:border-brand/50 text-white font-bold text-base sm:text-lg rounded-full transition-all duration-300 backdrop-blur-md hover:bg-white/5">
                        Conocer Beneficios
                    </a>
                </div>

                <!-- Trust Badges -->
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mt-16 max-w-4xl mx-auto pt-10 border-t border-white/10 text-left">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-brand shrink-0 font-bold">
                            💎
                        </div>
                        <div>
                            <p class="text-white font-bold text-sm">Dureza 9H / 10H</p>
                            <p class="text-white/50 text-xs">Anti micro-rayas y swirls</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-brand shrink-0 font-bold">
                            💧
                        </div>
                        <div>
                            <p class="text-white font-bold text-sm">Hidrofobia 115°</p>
                            <p class="text-white/50 text-xs">Efecto loto y autolimpieza</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-brand shrink-0 font-bold">
                            ☀️
                        </div>
                        <div>
                            <p class="text-white font-bold text-sm">Protección UV Total</p>
                            <p class="text-white/50 text-xs">Evita desgaste y oxidación</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-brand shrink-0 font-bold">
                            📜
                        </div>
                        <div>
                            <p class="text-white font-bold text-sm">Garantía 2 a 9 Años</p>
                            <p class="text-white/50 text-xs">Certificación oficial</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 1: Por qué elegir Cerámico vs Ceras tradicionales -->
    <section id="beneficios" class="section-padding bg-gray-50 dark:bg-surface-900/60 relative transition-colors border-b border-black/5 dark:border-white/5">
        <div class="container-custom">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">
                <div>
                    <span class="text-brand text-xs font-bold uppercase tracking-[0.3em] mb-4 block">Ingeniería Nanométrica</span>
                    <h2 class="font-display text-3xl sm:text-4xl md:text-5xl font-black text-black dark:text-white mb-6 leading-tight">
                        Protección definitiva para vehículos en <br>
                        <span class="text-gradient">Las Condes, Chicureo y Huechuraba</span>
                    </h2>
                    <p class="text-black/70 dark:text-white/60 text-base sm:text-lg mb-6 leading-relaxed">
                        El clima de Santiago somete la pintura de tu auto a una alta radiación ultravioleta, lluvia ácida, polvo abrasivo y deposiciones de aves con alto contenido alcalino que corroen el barniz original.
                    </p>
                    <p class="text-black/70 dark:text-white/60 text-base sm:text-lg mb-8 leading-relaxed">
                        A diferencia de una cera que dura semanas, el <strong>tratamiento cerámico (Ceramic Coating)</strong> se enlaza químicamente a nivel molecular con la laca del vehículo, creando una segunda capa de vidrio de cuarzo transparente e inorgánica que no se lava ni se degrada.
                    </p>

                    <div class="space-y-4">
                        @foreach([
                            ['title' => 'Resistencia a Químicos pH 2 a pH 13', 'desc' => 'Inmune a detergentes agresivos, agentes descongelantes, savia de árboles y excrementos de pájaros.'],
                            ['title' => 'Lavados 3 Veces Más Rápidos', 'desc' => 'La tensión superficial extrema no permite que el barro ni el alquitrán se adhieran fuertemente.'],
                            ['title' => 'Máxima Preservación del Valor de Reventa', 'desc' => 'Un automóvil con pintura sellada bajo estándar Gtechniq mantiene su estética de vitrina intacta por años.']
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
                        <source src="/assets/videos/bmw-horizontal.mp4" type="video/mp4">
                    </video>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/30 to-transparent pointer-events-none"></div>
                    
                    <div class="absolute bottom-0 inset-x-0 p-8 z-10">
                        <span class="px-3.5 py-1.5 rounded-full bg-brand/20 border border-brand/40 text-brand text-[11px] font-black uppercase tracking-wider inline-block mb-3">
                            Gtechniq Accredited
                        </span>
                        <h3 class="font-display font-black text-2xl sm:text-3xl text-white uppercase tracking-tight mb-2">
                            Brillo Espejo & Repelencia Extrema
                        </h3>
                        <p class="text-white/80 text-xs sm:text-sm leading-relaxed font-light">
                            Instalación en cabina climatizada libre de partículas para un curado cerámico perfecto.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 2: Niveles de Protección Cerámica -->
    <section class="section-padding bg-white dark:bg-surface-900 relative transition-colors border-b border-black/5 dark:border-white/5">
        <div class="container-custom">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <span class="text-brand text-xs font-bold uppercase tracking-[0.3em] mb-3 block">Gamas de Tratamiento</span>
                <h2 class="font-display text-3xl sm:text-5xl font-black text-black dark:text-white uppercase tracking-tight mb-4">
                    Niveles de <span class="text-gradient">Coating Cerámico</span>
                </h2>
                <p class="text-black/60 dark:text-white/50 text-base sm:text-lg">
                    Opciones configuradas para el uso en ciudad, autopistas o exigencia de coleccionista.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Nivel 1 -->
                <div class="p-8 rounded-[36px] bg-zinc-50 dark:bg-zinc-950 border border-black/5 dark:border-white/10 hover:border-brand/50 transition-all flex flex-col justify-between">
                    <div>
                        <span class="text-brand font-black text-xs uppercase tracking-widest block mb-2">Nivel 1 • Entry Level</span>
                        <h3 class="font-display font-black text-2xl text-black dark:text-white mb-2">Protección 2 Años</h3>
                        <p class="text-black/60 dark:text-white/50 text-sm mb-6">Recubrimiento cerámico 9H para vehículos de uso diario en ciudad.</p>
                        
                        <ul class="space-y-3 text-xs sm:text-sm text-black/80 dark:text-white/80 mb-8">
                            <li class="flex items-center gap-2">✓ 1 capa de cerámico 9H en carrocería</li>
                            <li class="flex items-center gap-2">✓ Pulido de corrección ligera previo</li>
                            <li class="flex items-center gap-2">✓ Sellado de parabrisas e hidrofobia</li>
                            <li class="flex items-center gap-2">✓ Detailing interior de cortesía</li>
                        </ul>
                    </div>
                    <a href="/reserva?category=ceramico" class="w-full py-4 rounded-full bg-zinc-900 hover:bg-brand text-white text-center font-bold text-xs uppercase tracking-wider transition-colors border border-white/10">
                        Cotizar Nivel 1
                    </a>
                </div>

                <!-- Nivel 2 (Destacado) -->
                <div class="p-8 rounded-[36px] bg-zinc-900 border-2 border-brand shadow-2xl shadow-brand/25 relative flex flex-col justify-between scale-[1.02]">
                    <div class="absolute -top-4 left-1/2 -translate-x-1/2 px-4 py-1 rounded-full bg-brand text-white font-black text-[11px] uppercase tracking-wider">
                        Más Solicitado
                    </div>
                    <div>
                        <span class="text-brand font-black text-xs uppercase tracking-widest block mb-2">Nivel 2 • Platinum Pro</span>
                        <h3 class="font-display font-black text-2xl text-white mb-2">Protección 5 Años</h3>
                        <p class="text-white/60 text-sm mb-6">Sistema multicapa con Top Coat para brillo espejo y repelencia extrema.</p>
                        
                        <ul class="space-y-3 text-xs sm:text-sm text-white/90 mb-8">
                            <li class="flex items-center gap-2">✓ 1 capa base de alta dureza 9H</li>
                            <li class="flex items-center gap-2">✓ 1 capa superior EXO Top Coat Ultra Brillo</li>
                            <li class="flex items-center gap-2">✓ Sellado cerámico en caras de llantas</li>
                            <li class="flex items-center gap-2">✓ Protección cerámica en plásticos exteriores</li>
                            <li class="flex items-center gap-2">✓ Garantía oficial de 5 años</li>
                        </ul>
                    </div>
                    <a href="/reserva?category=ceramico" class="w-full py-4 rounded-full bg-brand hover:bg-brand-dark text-white text-center font-black text-xs uppercase tracking-wider transition-all shadow-lg shadow-brand/40">
                        Cotizar Nivel 2 Platinum
                    </a>
                </div>

                <!-- Nivel 3 -->
                <div class="p-8 rounded-[36px] bg-zinc-50 dark:bg-zinc-950 border border-black/5 dark:border-white/10 hover:border-brand/50 transition-all flex flex-col justify-between">
                    <div>
                        <span class="text-brand font-black text-xs uppercase tracking-widest block mb-2">Nivel 3 • Flagship 10H</span>
                        <h3 class="font-display font-black text-2xl text-black dark:text-white mb-2">Crystal Serum Ultra 9 Años</h3>
                        <p class="text-black/60 dark:text-white/50 text-sm mb-6">La cumbre mundial en recubrimientos nanocerámicos de grado élite.</p>
                        
                        <ul class="space-y-3 text-xs sm:text-sm text-black/80 dark:text-white/80 mb-8">
                            <li class="flex items-center gap-2">✓ Dureza 10H certificada en laboratorio</li>
                            <li class="flex items-center gap-2">✓ Estructura de nanopartículas duras y flexibles</li>
                            <li class="flex items-center gap-2">✓ Sellado cerámico integral (vidrios, llantas, plásticos)</li>
                            <li class="flex items-center gap-2">✓ Acreditación y certificado oficial internacional</li>
                            <li class="flex items-center gap-2">✓ Garantía de 9 años</li>
                        </ul>
                    </div>
                    <a href="/reserva?category=ceramico" class="w-full py-4 rounded-full bg-zinc-900 hover:bg-brand text-white text-center font-bold text-xs uppercase tracking-wider transition-colors border border-white/10">
                        Cotizar Nivel 3 Ultra
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 3: Cobertura Local (Las Condes, Colina, Huechuraba) -->
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
                        Ideal para sedanes de lujo y deportivos. Protege el barniz contra la contaminación urbana de Santiago y los lavados frecuentes.
                    </p>
                    <a href="/reserva?category=ceramico" class="text-brand font-black text-xs uppercase tracking-wider hover:underline flex items-center gap-1">
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
                        Protección indispensable contra la alta radiación solar del valle de Chicureo, polvo en suspensión y aguas duras con sarro.
                    </p>
                    <a href="/reserva?category=ceramico" class="text-brand font-black text-xs uppercase tracking-wider hover:underline flex items-center gap-1">
                        Cotizar en Chicureo →
                    </a>
                </div>

                <!-- Card Huechuraba -->
                <div class="p-8 rounded-3xl bg-zinc-900 border border-white/15 hover:border-brand transition-all">
                    <div class="flex items-center gap-3 mb-4">
                        <span class="text-2xl">📍</span>
                        <h3 class="font-display font-black text-2xl text-white">Huechuraba & Sector Norte</h3>
                    </div>
                    <p class="text-white/60 text-sm leading-relaxed mb-6">
                        A solo 15 minutos por Autopista Radial Nororiente. Tratamientos ejecutivos y familiares con entrega puntual.
                    </p>
                    <a href="/reserva?category=ceramico" class="text-brand font-black text-xs uppercase tracking-wider hover:underline flex items-center gap-1">
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
                            'q' => '¿Cuánto tiempo demora la aplicación de un sellado cerámico?',
                            'a' => 'El proceso completo toma entre 24 y 48 horas, ya que incluye descontaminado profundo, pulido de corrección y el tiempo de curado térmico obligatorio en cabina.'
                        ],
                        [
                            'q' => '¿Un auto 0 km nuevo necesita sellado cerámico?',
                            'a' => 'Absolutamente. Los autos nuevos salen de fábrica con un barniz desprotegido. Aplicar cerámico inmediatamente sella la pintura virgen y evita que sufra el primer daño por sol o lavado.'
                        ],
                        [
                            'q' => '¿El cerámico evita todas las rayas?',
                            'a' => 'El cerámico agrega una capa de dureza 9H/10H que resiste drásticamente las micro-rayas de lavado (swirls), pero no sustituye a un PPF contra impactos fuertes de piedras a alta velocidad.'
                        ],
                        [
                            'q' => '¿Cómo se mantiene un auto con tratamiento cerámico?',
                            'a' => 'Se lava con shampoo pH neutro y microfibras limpias. La suciedad se desprende con agua a presión sin necesidad de fregar fuertemente.'
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
                Protege tu Inversión con <span class="text-gradient">Gtechniq 9H</span>
            </h2>
            <p class="text-white/70 text-base sm:text-lg mb-8 leading-relaxed">
                Agenda tu evaluación en nuestro centro acreditado. Cotiza online con disponibilidad en tiempo real.
            </p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="/reserva?category=ceramico" class="w-full sm:w-auto px-10 py-4.5 bg-brand hover:bg-brand-dark text-white font-display font-black text-base uppercase tracking-wider rounded-full shadow-xl shadow-brand/40 transition-all hover:scale-105">
                    Cotizar Cerámico Ahora
                </a>
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $profile->phone ?? '56912345678') }}?text={{ urlencode('Hola! Quisiera consultar por Tratamiento Cerámico 9H para mi vehículo en Las Condes/Chicureo.') }}" target="_blank" rel="noopener noreferrer" class="w-full sm:w-auto px-8 py-4.5 bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-base rounded-full shadow-lg transition-all flex items-center justify-center gap-2">
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
        'name' => 'Tratamiento Cerámico 9H y Gtechniq',
        'serviceType' => 'Ceramic Coating Application and Paint Protection',
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
        'description' => 'Tratamiento cerámico 9H y Gtechniq para autos en Las Condes, Chicureo Colina y Huechuraba. Protección extrema de pintura contra micro-rayas, químicos y rayos UV con garantía oficial de hasta 9 años.'
    ];
@endphp
<script type="application/ld+json">
{!! json_encode($jsonLd, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
</script>
@endsection
