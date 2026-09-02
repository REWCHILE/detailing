@extends('layouts.public')

@section('title', 'Restauración y Pulido de Focos en Las Condes, Colina y Huechuraba | High Contrast')
@section('meta_description', 'Restauración profesional de ópticos y focos opacos en Las Condes, Chicureo Colina y Huechuraba. Lijado progresivo al agua, refinado óptico y sellado cerámico UV anti-amarillamiento con 100% de transparencia.')
@section('meta_keywords', 'restauracion de focos las condes, pulido de focos colina, pulido de opticas chicureo, restaurar focos autos huechuraba, pulir focos quemados santiago, opticas amarillas auto vitacura, revision tecnica focos santiago')

@section('content')
<main class="overflow-hidden bg-white dark:bg-surface-900 text-black dark:text-white transition-colors duration-300">
    <!-- Hero Section -->
    <section class="relative min-h-screen flex items-center justify-center overflow-hidden bg-[#0A0A0A]">
        <div class="absolute inset-0 bg-[#0A0A0A]">
            <video autoplay muted loop playsinline class="w-full h-full object-cover opacity-50">
                <source src="/assets/videos/pulido-rupes.mp4" type="video/mp4">
            </video>
            <div class="absolute inset-0 bg-gradient-to-b from-[#0A0A0A]/85 via-transparent to-[#0A0A0A]"></div>
            <div class="absolute inset-0 bg-gradient-to-r from-[#0A0A0A]/60 via-transparent to-[#0A0A0A]/60"></div>
        </div>

        <div class="container-custom relative z-10 text-center px-4 pt-24 pb-16">
            <div class="max-w-5xl mx-auto">
                <!-- Local SEO Geolocation Pill -->
                <div class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-brand/10 border border-brand/20 text-brand text-xs font-black uppercase tracking-[0.25em] mb-8 shadow-lg shadow-brand/10 backdrop-blur-md">
                    <span class="w-2 h-2 rounded-full bg-brand animate-pulse"></span>
                    <span>Restauración Óptica: Las Condes • Chicureo / Colina • Huechuraba</span>
                </div>
                
                <h1 class="font-display text-4xl sm:text-6xl md:text-7xl lg:text-8xl font-black text-white mb-8 leading-[1.08] tracking-tight uppercase">
                    Restauración de Focos <br>
                    <span class="text-gradient">& Sellado UV Cerámico</span>
                </h1>
                
                <p class="text-white/80 text-base sm:text-xl md:text-2xl leading-relaxed mb-12 max-w-3xl mx-auto font-light">
                    Recupera el 100% de la transparencia y potencia lumínica original de tus ópticos. Eliminamos la capa amarilla y quemada con sellado protector UV de larga duración.
                </p>

                <div class="flex flex-col sm:flex-row items-center justify-center gap-5">
                    <a href="/reserva?category=pulido" class="w-full sm:w-auto px-10 py-5 bg-brand hover:bg-brand-dark text-white font-display font-black text-base sm:text-lg uppercase tracking-wider rounded-full transition-all duration-300 shadow-xl shadow-brand/40 hover:scale-105 flex items-center justify-center gap-3">
                        <span>Cotizar Restauración Online</span>
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                    <a href="#proceso" class="w-full sm:w-auto px-10 py-5 border border-white/20 hover:border-brand/50 text-white font-bold text-base sm:text-lg rounded-full transition-all duration-300 backdrop-blur-md hover:bg-white/5">
                        Ver Proceso de Lijado
                    </a>
                </div>

                <!-- Trust Badges -->
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mt-16 max-w-4xl mx-auto pt-10 border-t border-white/10 text-left">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-brand shrink-0 font-bold">
                            💡
                        </div>
                        <div>
                            <p class="text-white font-bold text-sm">Transparencia 100%</p>
                            <p class="text-white/50 text-xs">Claridad óptica de fábrica</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-brand shrink-0 font-bold">
                            🛡️
                        </div>
                        <div>
                            <p class="text-white font-bold text-sm">Sellador UV Cerámico</p>
                            <p class="text-white/50 text-xs">Anti-amarillamiento</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-brand shrink-0 font-bold">
                            🚗
                        </div>
                        <div>
                            <p class="text-white font-bold text-sm">Revisión Técnica OK</p>
                            <p class="text-white/50 text-xs">Haz de luz reglamentario</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-brand shrink-0 font-bold">
                            💰
                        </div>
                        <div>
                            <p class="text-white font-bold text-sm">85% de Ahorro</p>
                            <p class="text-white/50 text-xs">Frente a comprar ópticos nuevos</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 1: Por qué se opacan los focos -->
    <section class="section-padding bg-gray-50 dark:bg-surface-900/60 relative transition-colors border-b border-black/5 dark:border-white/5">
        <div class="container-custom">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">
                <div>
                    <span class="text-brand text-xs font-bold uppercase tracking-[0.3em] mb-4 block">Seguridad & Estética</span>
                    <h2 class="font-display text-3xl sm:text-4xl md:text-5xl font-black text-black dark:text-white mb-6 leading-tight">
                        Recupera la visibilidad nocturna en <br>
                        <span class="text-gradient">Las Condes, Chicureo y Huechuraba</span>
                    </h2>
                    <p class="text-black/70 dark:text-white/60 text-base sm:text-lg mb-6 leading-relaxed">
                        Los focos modernos están fabricados en policarbonato termoplástico. Con el tiempo, la radiación solar intensa, el calor del motor y los lavados automáticos degradan la capa protectora de fábrica, causando una película opaca y amarillenta.
                    </p>
                    <p class="text-black/70 dark:text-white/60 text-base sm:text-lg mb-8 leading-relaxed">
                        Un foco opaco puede <strong>reducir hasta un 70% la potencia de tus luces</strong>, poniendo en riesgo tu seguridad al conducir por autopistas o caminos oscuros y arriesgando el rechazo en la Revisión Técnica.
                    </p>

                    <div class="space-y-4">
                        @foreach([
                            ['title' => 'Lijado Progresivo al Agua', 'desc' => 'Removemos microscópicamente el policarbonato oxidado con lijas de grano 800 a 3000 sin rayar la óptica.'],
                            ['title' => 'Compuestos de Pulido Especiales', 'desc' => 'Pulido rotorbital con pastas de corte y refinado óptico para policarbonato libre de marcas.'],
                            ['title' => 'Blindaje con Polímero Sellador UV', 'desc' => 'Aplicamos una película cerámica UV que sella los microporos y previene que el foco vuelva a ponerse amarillo.']
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
                        <source src="/assets/videos/pulido-rupes.mp4" type="video/mp4">
                    </video>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/30 to-transparent pointer-events-none"></div>
                    
                    <div class="absolute bottom-0 inset-x-0 p-8 z-10">
                        <span class="px-3.5 py-1.5 rounded-full bg-brand/20 border border-brand/40 text-brand text-[11px] font-black uppercase tracking-wider inline-block mb-3">
                            Antes / Después Sorprendente
                        </span>
                        <h3 class="font-display font-black text-2xl sm:text-3xl text-white uppercase tracking-tight mb-2">
                            Restauración Óptica 100% Cristalina
                        </h3>
                        <p class="text-white/80 text-xs sm:text-sm leading-relaxed font-light">
                            Tus ópticos vuelven a verse como recién salidos de fábrica con protección garantizada.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 2: Proceso de 4 Fases -->
    <section id="proceso" class="section-padding bg-white dark:bg-surface-900 relative transition-colors border-b border-black/5 dark:border-white/5">
        <div class="container-custom">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <span class="text-brand text-xs font-bold uppercase tracking-[0.3em] mb-3 block">Protocolo Técnico</span>
                <h2 class="font-display text-3xl sm:text-5xl font-black text-black dark:text-white uppercase tracking-tight mb-4">
                    Etapas de la <span class="text-gradient">Restauración Óptica</span>
                </h2>
                <p class="text-black/60 dark:text-white/50 text-base sm:text-lg">
                    Un procedimiento profesional que no daña la pintura colindante ni los componentes del foco.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @php
                    $steps = [
                        [
                            'num' => '01',
                            'title' => 'Enmascarado Quirúrgico',
                            'desc' => 'Protegemos con cinta de alta resistencia todo el contorno de carrocería, parachoques y gomas para trabajar con total seguridad.'
                        ],
                        [
                            'num' => '02',
                            'title' => 'Lijado Progresivo al Agua',
                            'desc' => 'Desbaste técnico de 4 a 5 etapas (granos 800, 1000, 1500, 2000 y 3000) para eliminar completamente la costra quemada y opaca.'
                        ],
                        [
                            'num' => '03',
                            'title' => 'Pulido & Refinado Óptico',
                            'desc' => 'Pulido a máquina con compuestos especiales para policarbonato, eliminando marcas de lija hasta lograr una transparencia absoluta.'
                        ],
                        [
                            'num' => '04',
                            'title' => 'Sellado Cerámico Anti-UV',
                            'desc' => 'Aplicación de recubrimiento cerámico protector UV para curar el poro del policarbonato y prevenir la oxidación por los próximos años.'
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
                        Servicio rápido para autos particulares y flotas. Recupera la estética premium de tus ópticos en menos de 1 hora.
                    </p>
                    <a href="/reserva?category=pulido" class="text-brand font-black text-xs uppercase tracking-wider hover:underline flex items-center gap-1">
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
                        En Chicureo el sol y la radiación queman los focos más rápido. Aplica sellador UV profesional para proteger tu auto.
                    </p>
                    <a href="/reserva?category=pulido" class="text-brand font-black text-xs uppercase tracking-wider hover:underline flex items-center gap-1">
                        Cotizar en Chicureo →
                    </a>
                </div>

                <!-- Card Huechuraba -->
                <div class="p-8 rounded-3xl bg-zinc-900 border border-white/15 hover:border-brand transition-all">
                    <div class="flex items-center gap-3 mb-4">
                        <span class="text-2xl">📍</span>
                        <h3 class="font-display font-black text-2xl text-white">Huechuraba & Conchalí</h3>
                    </div>
                    <p class="text-white/60 text-sm leading-relaxed mb-6">
                        Pasa la revisión técnica sin problemas de luminosidad. Agenda en línea o consulta por WhatsApp al instante.
                    </p>
                    <a href="/reserva?category=pulido" class="text-brand font-black text-xs uppercase tracking-wider hover:underline flex items-center gap-1">
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
                            'q' => '¿Cuánto tiempo dura el resultado de la restauración?',
                            'a' => 'Gracias a nuestro sellador cerámico UV, el foco se mantiene transparente entre 1 y 2 años, a diferencia de los pulidos rápidos caseros que se vuelven a poner amarillos en pocos meses.'
                        ],
                        [
                            'q' => '¿Cuánto demora el servicio de restauración de focos?',
                            'a' => 'El servicio completo para el par de focos delanteros toma habitualmente entre 45 minutos y 1 hora.'
                        ],
                        [
                            'q' => '¿Se desmontan los focos del auto?',
                            'a' => 'En el 98% de los casos no es necesario desmontar los focos. Se realiza un enmascarado multicapa de protección alrededor de la carrocería para un trabajo seguro y limpio.'
                        ],
                        [
                            'q' => '¿La opacidad puede estar por el interior del foco?',
                            'a' => 'En la gran mayoría de los casos la quemadura ocurre en la cara exterior debido al sol. Si el foco presenta humedad o suciedad interior por filtraciones, se evalúa previamente en el taller.'
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
                Recupera la Visibilidad con <span class="text-gradient">Focos Cristalinos</span>
            </h2>
            <p class="text-white/70 text-base sm:text-lg mb-8 leading-relaxed">
                Agenda tu restauración hoy mismo en nuestro centro de detallado.
            </p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="/reserva?category=pulido" class="w-full sm:w-auto px-10 py-4.5 bg-brand hover:bg-brand-dark text-white font-display font-black text-base uppercase tracking-wider rounded-full shadow-xl shadow-brand/40 transition-all hover:scale-105">
                    Cotizar Restauración de Focos
                </a>
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $profile->whatsapp ?? $profile->phone ?? '56951024782') }}?text={{ urlencode('Hola! Quisiera consultar por la Restauración de Focos en Las Condes/Chicureo.') }}" target="_blank" rel="noopener noreferrer" class="w-full sm:w-auto px-8 py-4.5 bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-base rounded-full shadow-lg transition-all flex items-center justify-center gap-2">
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
        'name' => 'Restauración y Pulido de Focos con Sellado UV',
        'serviceType' => 'Headlight Restoration and Polishing',
        'provider' => [
            '@type' => 'AutoRepair',
            'name' => $schemaProfile->business_name ?? 'High Contrast Detailing Center',
            'telephone' => $schemaProfile->phone ?? '+56 9 5102 4782',
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
        'description' => 'Restauración profesional de ópticos y focos opacos en Las Condes, Chicureo Colina y Huechuraba. Lijado progresivo al agua, refinado óptico y sellado cerámico UV anti-amarillamiento con 100% de transparencia.'
    ];
@endphp
<script type="application/ld+json">
{!! json_encode($jsonLd, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
</script>
@endsection
