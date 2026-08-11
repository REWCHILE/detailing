@extends('layouts.public')

@section('title', 'Nuestra Historia | High Contrast Detailing Center')
@section('meta_description', 'Conoce la historia de High Contrast Detailing Center, desde nuestros inicios en Estados Unidos hasta convertirnos en el centro de detailing de referencia en Santiago de Chile.')
@section('meta_keywords', 'detailing santiago history, certificacion gtechniq chile, exoshield chile, centro detailing chicureo, historia high contrast')

@section('content')
<style>
    /* Premium Nosotros Styles & Animations */
    .premium-brand-card {
        background: linear-gradient(135deg, #18181b 0%, #09090b 100%);
        border: 1px solid rgba(255, 255, 255, 0.05);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
    }
    .premium-brand-card::after {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(circle at center, rgba(232, 80, 138, 0.15) 0%, transparent 70%);
        opacity: 0;
        transition: opacity 0.4s ease;
    }
    .premium-brand-card:hover {
        transform: translateY(-8px);
        border-color: rgba(232, 80, 138, 0.4);
        box-shadow: 0 20px 30px -10px rgba(0, 0, 0, 0.3), 0 0 15px 1px rgba(232, 80, 138, 0.1);
    }
    .premium-brand-card:hover::after {
        opacity: 1;
    }
    .premium-brand-card img {
        transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        z-index: 10;
    }
    .group:hover .premium-brand-card img {
        transform: scale(1.08);
    }
    
    /* Value Cards styling */
    .premium-value-card {
        transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .premium-value-card:hover {
        transform: translateY(-5px);
        background: white;
        border-color: rgba(232, 80, 138, 0.25) !important;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05);
    }
    .dark .premium-value-card:hover {
        background: rgba(255, 255, 255, 0.03) !important;
        box-shadow: 0 20px 30px -10px rgba(0, 0, 0, 0.5);
    }
</style>

<main class="bg-white dark:bg-surface-900 min-h-screen text-black dark:text-white transition-colors duration-300">
    <!-- Hero Section -->
    <section class="relative h-screen flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0 bg-[#0A0A0A]">
            <video autoplay muted loop playsinline class="absolute inset-0 w-full h-full object-cover opacity-60">
                <source src="/assets/videos/hero-banner.mp4" type="video/mp4">
            </video>
            <div class="absolute inset-0 bg-gradient-to-b from-[#0A0A0A]/80 via-transparent to-[#0A0A0A]"></div>
            <div class="absolute inset-0 bg-gradient-to-r from-[#0A0A0A]/40 via-transparent to-[#0A0A0A]/40"></div>
        </div>

        <div class="relative z-10 container-custom text-center px-4">
            <div>
                <h1 class="font-display text-5xl md:text-8xl lg:text-9xl font-black text-white mb-6 tracking-tighter leading-none">
                    NUESTRA <span class="text-gradient">HISTORIA</span>
                </h1>
                <p class="text-lg md:text-2xl text-white/70 max-w-2xl mx-auto font-light leading-relaxed">
                    De las calles de Estados Unidos a la excelencia absoluta en Santiago.
                    Conoce el origen de <span class="text-white font-medium">High Contrast</span>.
                </p>
            </div>

            <div class="absolute bottom-10 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2">
                <span class="text-white/30 text-[10px] uppercase tracking-[0.3em] font-bold">Descubre más</span>
                <div class="text-white/30 animate-bounce">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                </div>
            </div>
        </div>
    </section>

    <!-- Story Split Section -->
    <section class="section-padding relative overflow-hidden bg-white dark:bg-surface-900 transition-colors duration-300">
        <div class="container-custom">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div>
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-brand/10 border border-brand/20 text-brand text-xs font-bold uppercase tracking-widest mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="2" x2="22" y1="12" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
                        Origen Global & Certificado
                    </div>
                    <h2 class="font-display text-4xl md:text-6xl font-bold text-black dark:text-white mb-8 leading-tight transition-colors">
                        Pasión que nació en el <span class="text-gradient">corazón del detailing</span>.
                    </h2>
                    <p class="text-black/70 dark:text-white/60 text-lg mb-8 leading-relaxed transition-colors">
                        Nuestra trayectoria comenzó en Estados Unidos, donde nos sumergimos en la cultura del detallado automotriz más exigente del mundo. Allí, nos formamos y certificamos con los líderes de la industria: <span class="text-black dark:text-white font-medium">Gtechniq</span> y <span class="text-black dark:text-white font-medium">ExoShield</span>.
                    </p>
                    <p class="text-black/70 dark:text-white/60 text-lg mb-10 leading-relaxed transition-colors">
                        Trabajamos codo a codo con los desarrolladores de estas tecnologías en EE.UU., perfeccionando técnicas que hoy traemos a Chile. No solo usamos los productos; entendemos la ciencia detrás de ellos para garantizar resultados que superan cualquier expectativa.
                    </p>

                    <div class="flex flex-col sm:flex-row gap-6">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-xl bg-gray-50 dark:bg-surface-800 flex items-center justify-center shrink-0 border border-black/5 dark:border-white/5 shadow-sm dark:shadow-none transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-brand"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                            </div>
                            <div>
                                <h4 class="text-black dark:text-white font-bold mb-1 transition-colors">USA Heritage</h4>
                                <p class="text-black/60 dark:text-white/40 text-sm transition-colors">Técnicas aprendidas en el mercado más competitivo.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-xl bg-gray-50 dark:bg-surface-800 flex items-center justify-center shrink-0 border border-black/5 dark:border-white/5 shadow-sm dark:shadow-none transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-brand"><path d="m12 3-1.912 5.886L4 9l4.912.863L12 15l1.912-5.137L20 9l-4.912-.114z"/></svg>
                            </div>
                            <div>
                                <h4 class="text-black dark:text-white font-bold mb-1 transition-colors">Expertise Real</h4>
                                <p class="text-black/60 dark:text-white/40 text-sm transition-colors">Años de experiencia práctica en cada panel.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="relative">
                    <div class="aspect-[4/5] rounded-[2rem] overflow-hidden border border-black/10 dark:border-white/10 shadow-2xl relative group bg-surface-900">
                        <video autoplay muted loop playsinline class="absolute inset-0 w-full h-full object-cover opacity-60 transition-transform duration-700 group-hover:scale-110">
                            <source src="/assets/videos/pulido-correccion.mp4" type="video/mp4">
                        </video>
                        <div class="absolute inset-0 bg-gradient-to-t from-surface-900 via-transparent to-transparent opacity-60"></div>
                        <div class="absolute bottom-8 left-8 right-8 p-6 bg-white/90 dark:bg-[#111111]/90 backdrop-blur-md rounded-2xl border border-black/10 dark:border-white/10">
                            <div class="flex items-center gap-3 mb-2">
                                <div class="h-2 w-2 rounded-full bg-brand animate-pulse"></div>
                                <span class="text-black dark:text-white text-xs font-bold uppercase tracking-widest transition-colors">Estándar Americano</span>
                            </div>
                            <p class="text-black/70 dark:text-white/70 text-sm font-light transition-colors">
                                "No buscamos que brille, buscamos que sea perfecto bajo cualquier luz."
                            </p>
                        </div>
                    </div>
                    
                    <!-- Floating Element -->
                    <div class="absolute -top-10 -right-10 w-40 h-40 bg-brand/10 rounded-full blur-3xl animate-pulse"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Values Section -->
    <section class="py-24 relative overflow-hidden bg-gray-50 dark:bg-surface-900/40 border-y border-black/5 dark:border-white/5 transition-colors">
        <div class="container-custom">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                @foreach([
                    ['title' => 'Precisión Técnica', 'desc' => 'Aplicamos cada producto con la rigurosidad aprendida en los laboratorios de Gtechniq.', 'icon' => '01'],
                    ['title' => 'Pasión Real', 'desc' => 'Tratamos cada vehículo como si fuera nuestra propia colección privada.', 'icon' => '02'],
                    ['title' => 'Compromiso Total', 'desc' => 'Nuestra garantía no es solo un papel, es nuestro honor profesional.', 'icon' => '03']
                ] as $value)
                    <div class="relative group p-8 rounded-3xl bg-white dark:bg-white/[0.02] border border-black/5 dark:border-white/5 premium-value-card shadow-sm dark:shadow-none">
                        <span class="absolute -top-4 -left-4 text-6xl font-display font-black text-black/5 dark:text-white/5 group-hover:text-brand/10 transition-colors">
                            {{ $value['icon'] }}
                        </span>
                        <h3 class="text-2xl font-bold text-black dark:text-white mb-4 relative z-10 transition-colors">{{ $value['title'] }}</h3>
                        <p class="text-black/60 dark:text-white/40 leading-relaxed relative z-10 transition-colors">{{ $value['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Certifications & Brands -->
    <section class="section-padding bg-gray-50 dark:bg-surface-800/50 transition-colors border-b border-black/5 dark:border-white/5">
        <div class="container-custom">
            <div class="text-center mb-16">
                <h2 class="font-display text-3xl md:text-5xl font-bold text-black dark:text-white mb-4 transition-colors">
                    Nuestras <span class="text-gradient">Certificaciones</span>
                </h2>
                <p class="text-black/60 dark:text-white/40 transition-colors">Avalados por los estándares más altos a nivel mundial.</p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 items-center">
                @foreach([
                    ['name' => 'Gtechniq', 'logo' => '/assets/logos/Gtechniq-Logo.png', 'sub' => 'Accredited Detailer'],
                    ['name' => 'ExoShield', 'logo' => '/assets/logos/Red ExoShield Logo.png', 'sub' => 'Certified Installer'],
                    ['name' => 'Rupes', 'logo' => '/assets/logos/RUPES-CMYK.png', 'sub' => 'Professional Use'],
                    ['name' => 'High Contrast', 'logo' => '/assets/logos/sin.efecto1.png', 'sub' => 'Master Standard']
                ] as $brand)
                    <div class="flex flex-col items-center gap-4 group">
                        <div class="h-24 w-full flex items-center justify-center p-6 premium-brand-card rounded-2xl overflow-hidden">
                            <img 
                                src="{{ $brand['logo'] }}" 
                                alt="{{ $brand['name'] }}" 
                                class="max-h-full max-w-full object-contain filter brightness-110"
                            >
                        </div>
                        <div class="text-center">
                            <p class="text-black dark:text-white font-bold text-sm group-hover:text-brand transition-colors duration-300">{{ $brand['name'] }}</p>
                            <p class="text-brand text-[10px] uppercase tracking-widest font-medium">{{ $brand['sub'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Luxury Experience Section -->
    <section class="section-padding bg-white dark:bg-surface-800/30 relative overflow-hidden transition-colors">
        <div class="container-custom relative z-10">
            <div class="text-center max-w-3xl mx-auto mb-20">
                <div>
                    <h2 class="font-display text-4xl md:text-5xl font-bold text-black dark:text-white mb-6 transition-colors">
                        Expertos en <span class="text-gradient">Autos de Lujo</span>
                    </h2>
                    <p class="text-black/70 dark:text-white/60 text-lg transition-colors">
                        Nuestra experiencia en el extranjero nos permitió trabajar con las marcas más prestigiosas y los clientes más exigentes. Entendemos el valor y la delicadeza que requiere un vehículo de alta gama.
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach([
                    ['title' => 'Protección Total', 'desc' => 'Aplicamos los mismos estándares de seguridad y cuidado que las grandes colecciones privadas.', 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-brand"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>'],
                    ['title' => 'Atención al Detalle', 'desc' => 'Cada rincón, cada costura y cada micra de pintura es tratada con precisión quirúrgica.', 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-brand"><path d="m12 3-1.912 5.886L4 9l4.912.863L12 15l1.912-5.137L20 9l-4.912-.114z"/></svg>'],
                    ['title' => 'Certificación', 'desc' => 'Utilizamos productos de grado profesional que garantizan resultados de exhibición.', 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-brand"><circle cx="12" cy="8" r="7"/><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"/></svg>']
                ] as $item)
                    <div class="p-8 rounded-3xl bg-gray-50 dark:bg-surface-900 border border-black/5 dark:border-white/5 premium-value-card group shadow-sm dark:shadow-none">
                        <div class="w-14 h-14 rounded-2xl bg-brand/10 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                            {!! $item['icon'] !!}
                        </div>
                        <h3 class="text-xl font-bold text-black dark:text-white mb-4 transition-colors">{{ $item['title'] }}</h3>
                        <p class="text-black/60 dark:text-white/40 text-sm leading-relaxed transition-colors">{{ $item['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Commitment Section -->
    <section class="section-padding container-custom">
        <div class="rounded-[3rem] overflow-hidden bg-brand relative">
            <div class="absolute inset-0 bg-gradient-to-br from-brand-dark to-brand opacity-90"></div>

            <div class="relative z-10 px-8 py-12 md:px-16 md:py-20">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                    <!-- Left Column: Content -->
                    <div class="lg:col-span-7 text-center lg:text-left">
                        <h2 class="font-display text-4xl md:text-5xl lg:text-6xl font-black text-white mb-6 tracking-tight leading-tight">
                            ¿LISTO PARA LLEVAR TU AUTO <br class="hidden lg:block">AL SIGUIENTE NIVEL?
                        </h2>
                        <p class="text-white/90 text-lg md:text-xl mb-10 max-w-2xl mx-auto lg:mx-0 font-light leading-relaxed">
                            Únete a la familia High Contrast y experimenta el detallado automotriz como nunca antes lo habías visto en Chile.
                        </p>
                        <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-6">
                            <a 
                                href="/reserva"
                                class="w-full sm:w-auto px-8 py-4 bg-white text-brand font-bold rounded-2xl text-lg hover:scale-[1.02] transition-all duration-300 shadow-2xl flex items-center justify-center gap-2 hover:bg-slate-50"
                            >
                                <span>Cotizar mi servicio</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="shrink-0"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                            </a>
                            <div class="flex items-center gap-3 text-white/95 shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="shrink-0"><circle cx="12" cy="12" r="10"/><path d="m9 12 2 2 4-4"/></svg>
                                <span class="font-semibold text-sm">Resultados 100% garantizados</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Right Column: Video Frame -->
                    <div class="lg:col-span-5 relative group">
                        <div class="relative aspect-video lg:aspect-[4/3] rounded-[2rem] overflow-hidden border border-white/20 shadow-2xl bg-black transition-all duration-500 hover:scale-[1.01] hover:border-white/40">
                            <video autoplay muted loop playsinline class="w-full h-full object-cover">
                                <source src="/assets/videos/2.mp4" type="video/mp4">
                            </video>
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent pointer-events-none"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

@endsection

@section('scripts')
@include('partials.schema-local-business')
@endsection

