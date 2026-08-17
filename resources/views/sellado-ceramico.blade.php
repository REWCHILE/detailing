@extends('layouts.public')

@section('title', 'Sellado Cerámico en Santiago | Protección y Brillo Extremo 9H')
@section('meta_description', 'El mejor sellado cerámico en Santiago. Protección cerámica profesional Gtechniq para autos. Brillo permanente, hidrofobicidad y protección UV. ¡Cotiza tu ceramic coating ahora!')
@section('meta_keywords', 'sellado ceramico santiago, ceramic coating santiago, coating 9h chile, sellado ceramico chicureo, gtechniq chile, proteccion pintura autos, sellado de autos')

@section('content')
<style>
    /* Custom Styling for Sellado Ceramico Premium Page */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(24px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .fade-in-up {
        opacity: 0;
        animation: fadeInUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }

    /* CSS Bottle Styling */
    .bottle-glass-glare {
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.15) 0%, transparent 50%, rgba(255, 255, 255, 0.05) 100%);
        opacity: 0.8;
        z-index: 5;
        pointer-events: none;
    }

    .group:hover .bottle-glow {
        filter: blur(12px);
        opacity: 0.9;
        transform: scale(1.1);
    }
    
    .bottle-glow {
        transition: all 0.5s ease;
    }

    /* Pricing card styling */
    .premium-pricing-card {
        background: rgba(255, 255, 255, 0.8);
        border: 1px solid rgba(0, 0, 0, 0.04);
        transition: all 0.45s cubic-bezier(0.16, 1, 0.3, 1);
        backdrop-filter: blur(12px);
    }
    .dark .premium-pricing-card {
        background: rgba(20, 20, 25, 0.5);
        border: 1px solid rgba(255, 255, 255, 0.02);
    }
    .premium-pricing-card:hover {
        transform: translateY(-8px);
        border-color: rgba(232, 80, 138, 0.3) !important;
        box-shadow: 0 30px 50px -15px rgba(0, 0, 0, 0.08), 0 0 25px rgba(232, 80, 138, 0.02);
    }
    .dark .premium-pricing-card:hover {
        box-shadow: 0 30px 60px -15px rgba(0, 0, 0, 0.6), 0 0 30px rgba(232, 80, 138, 0.06);
    }

    /* Popular Pricing highlight styling */
    .popular-pricing-card {
        background: white;
        border: 2px solid #E8508A !important;
        box-shadow: 0 20px 45px -10px rgba(232, 80, 138, 0.12);
    }
    .dark .popular-pricing-card {
        background: rgba(25, 18, 24, 0.45);
        border: 2px solid #E8508A !important;
        box-shadow: 0 25px 50px -10px rgba(232, 80, 138, 0.18);
    }

    /* FAQ cards styling */
    .premium-faq-card {
        transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .premium-faq-card:hover {
        transform: translateY(-4px);
        border-color: rgba(232, 80, 138, 0.25) !important;
        background: white;
        box-shadow: 0 15px 30px -10px rgba(0, 0, 0, 0.04);
    }
    .dark .premium-faq-card:hover {
        background: rgba(255, 255, 255, 0.02) !important;
        box-shadow: 0 15px 35px -10px rgba(0, 0, 0, 0.4);
    }

    /* Video frame outline */
    .premium-video-wrapper {
        position: relative;
        transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .premium-video-wrapper::before {
        content: '';
        position: absolute;
        inset: -2px;
        background: linear-gradient(135deg, rgba(232, 80, 138, 0.3), transparent, rgba(232, 80, 138, 0.1));
        border-radius: 26px;
        z-index: -1;
        opacity: 0.6;
        transition: opacity 0.4s ease;
    }
    .premium-video-wrapper:hover {
        transform: scale(1.02) translateY(-4px);
        box-shadow: 0 30px 60px -15px rgba(0, 0, 0, 0.25), 0 0 25px rgba(232, 80, 138, 0.05);
    }

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

<main class="overflow-hidden bg-white dark:bg-surface-900 text-black dark:text-white transition-colors duration-300">
    <!-- Hero Section -->
    <section class="relative min-h-screen flex items-center justify-center overflow-hidden bg-[#0A0A0A]">
        <div class="absolute inset-0 bg-[#0A0A0A]">
            <video autoplay muted loop playsinline class="w-full h-full object-cover opacity-50">
                <source src="/assets/videos/hero-gtechniq.mp4" type="video/mp4">
            </video>
            <div class="absolute inset-0 bg-gradient-to-b from-[#0A0A0A]/85 via-transparent to-[#0A0A0A]"></div>
            <div class="absolute inset-0 bg-gradient-to-r from-[#0A0A0A]/60 via-transparent to-[#0A0A0A]/60"></div>
        </div>

        <div class="container-custom relative z-10 text-center px-4 fade-in-up">
            <div>
                <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-brand/10 border border-brand/20 text-brand text-xs font-extrabold uppercase tracking-[0.25em] mb-8">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="text-brand"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="m9 12 2 2 4-4"/></svg>
                    Protección Cerámica 9H
                </span>
                <h1 class="font-display text-5xl md:text-8xl font-black text-white mb-8 leading-[1.1] tracking-tight">
                    Sellado Cerámico <br> <span class="text-gradient">Gtechniq</span>
                </h1>
                <div class="flex flex-col sm:flex-row items-center justify-center gap-6">
                    <a href="/reserva" class="px-12 py-5 bg-brand hover:bg-brand-dark text-white font-bold rounded-full text-lg transition-all shadow-xl shadow-brand/35 hover:scale-105">
                        Agendar Evaluación
                    </a>
                    <a href="#precios" class="px-12 py-5 border border-white/20 hover:border-brand/40 text-white font-semibold rounded-full text-lg transition-all backdrop-blur-sm">
                        Ver Paquetes
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Gtechniq Science Showcase -->
    <section class="bg-gray-50 dark:bg-surface-900/60 overflow-hidden transition-colors border-b border-black/5 dark:border-white/5">
        <div class="section-padding container-custom">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div class="fade-in-up" style="animation-delay: 150ms;">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="bg-black p-3 px-5 rounded-2xl inline-block flex items-center justify-center">
                            <img 
                                src="/assets/logos/Gtechniq-Logo.png" 
                                alt="Gtechniq Logo" 
                                class="h-8 object-contain"
                            >
                        </div>
                        <div class="h-8 w-px bg-black/10 dark:bg-white/10"></div>
                        <span class="text-brand text-xs font-bold uppercase tracking-[0.3em]">Platinum System</span>
                    </div>
                    
                    <h2 class="font-display text-4xl md:text-5xl lg:text-6xl font-black text-black dark:text-white mb-8 leading-tight transition-colors">
                        Ciencia detrás del <br><span class="text-gradient">Brillo Extremo</span>
                    </h2>
                    
                    <p class="text-black/70 dark:text-white/60 text-lg mb-8 leading-relaxed max-w-xl transition-colors">
                        Gtechniq es la solución de alto rendimiento para tu vehículo, impulsada por los expertos en recubrimientos cerámicos del Reino Unido. No es solo brillo; es ingeniería molecular diseñada para proteger tu inversión.
                    </p>

                    <div class="space-y-6 mb-12">
                        @foreach([
                            ['title' => 'Garantía de 5 Años', 'desc' => 'Protección duradera respaldada por la red oficial de Gtechniq.', 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>'],
                            ['title' => 'Resistencia a Swirls', 'desc' => 'Minimiza las micro-rayas causadas por el lavado regular.', 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m13 2-2 10h9L11 22l2-10H4L13 2z"/></svg>'],
                            ['title' => 'Brillo Intenso', 'desc' => 'Formulado para ser 100% ópticamente claro para un acabado profundo.', 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22a7 7 0 0 0 5-2c2.5-2.5 2.5-6.5 0-9L12 6 7 11c-2.5 2.5-2.5 6.5 0 9a7 7 0 0 0 5 2z"/></svg>']
                        ] as $item)
                            <div class="flex gap-4">
                                <div class="w-10 h-10 rounded-lg bg-brand/10 flex items-center justify-center shrink-0">
                                    <span class="text-brand">{!! $item['icon'] !!}</span>
                                </div>
                                <div>
                                    <h4 class="text-black dark:text-white font-extrabold text-sm mb-1 transition-colors">{{ $item['title'] }}</h4>
                                    <p class="text-black/60 dark:text-white/40 text-xs leading-relaxed transition-colors">{{ $item['desc'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="relative premium-video-wrapper rounded-3xl" style="animation-delay: 300ms;">
                    <div class="aspect-video rounded-3xl overflow-hidden border border-black/10 dark:border-white/10 shadow-2xl relative group bg-surface-800">
                        <iframe 
                            class="w-full h-full"
                            src="https://www.youtube.com/embed/CAvWW-cx9is?autoplay=0&mute=1&loop=1" 
                            title="Gtechniq"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                            allowfullscreen
                        ></iframe>
                    </div>
                    
                    <!-- Floating Badge -->
                    <div class="absolute -bottom-6 -right-6 bg-white/95 dark:bg-[#111111]/95 p-5 rounded-2xl border border-black/10 dark:border-white/10 shadow-2xl">
                        <p class="text-brand text-xs font-black uppercase tracking-widest mb-1">Accredited</p>
                        <p class="text-black dark:text-white text-lg font-display font-black leading-none transition-colors">DETAILER</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Gtechniq Heritage & Science -->
    <section class="section-padding bg-white dark:bg-surface-900 relative overflow-hidden transition-colors border-b border-black/5 dark:border-white/5">
        <div class="absolute top-0 left-0 w-full h-px bg-gradient-to-r from-transparent via-brand/20 to-transparent"></div>
        
        <div class="container-custom">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-20 items-center">
                <div class="order-2 lg:order-1 fade-in-up">
                    <span class="text-brand text-xs font-bold uppercase tracking-[0.3em] mb-6 block">Nuestra Herencia</span>
                    <h2 class="font-display text-4xl md:text-5xl font-black text-black dark:text-white mb-8 leading-tight transition-colors">
                        Basado en <span class="text-gradient">Ciencia e Innovación</span>
                    </h2>
                    <div class="space-y-6 text-black/60 dark:text-white/50 text-lg leading-relaxed transition-colors">
                        <p>
                            La marca Gtechniq nació de la mano del físico <strong>Drew Gill</strong> en 2001, tras descubrir que los recubrimientos de la época no cumplían con sus promesas de marketing.
                        </p>
                        <p>
                            Desde su laboratorio en el Reino Unido, Gtechniq ha acortado la brecha entre la innovación teórica y la realidad del cuidado automotriz, ingenierizando los mejores productos de protección de superficies del mundo.
                        </p>
                    </div>

                    <div class="grid grid-cols-2 gap-8 mt-12">
                        <div class="flex flex-col gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-brand"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="6"/><circle cx="12" cy="12" r="2"/></svg>
                            <h4 class="text-black dark:text-white font-bold transition-colors">Precisión</h4>
                            <p class="text-black/50 dark:text-white/30 text-xs italic transition-colors">Ingeniería molecular exacta.</p>
                        </div>
                        <div class="flex flex-col gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-brand"><circle cx="12" cy="12" r="10"/><line x1="2" x2="22" y1="12" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
                            <h4 class="text-black dark:text-white font-bold transition-colors">Global</h4>
                            <p class="text-black/50 dark:text-white/30 text-xs italic transition-colors">Presente en más de 50 países.</p>
                        </div>
                    </div>
                </div>

                <div class="order-1 lg:order-2 relative fade-in-up" style="animation-delay: 200ms;">
                    <!-- Video Container -->
                    <div class="aspect-video rounded-[40px] overflow-hidden border border-black/10 dark:border-white/10 shadow-xl dark:shadow-2xl relative group bg-black/5 dark:bg-black/50">
                        <!-- YouTube Embed iframe -->
                        <iframe 
                            class="absolute inset-0 w-full h-full"
                            src="https://www.youtube.com/embed/FGfZnpPiZ8Q?controls=1&amp;rel=0" 
                            title="Gtechniq Smart Surface Science" 
                            frameborder="0" 
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                            referrerpolicy="strict-origin-when-cross-origin" 
                            allowfullscreen>
                        </iframe>
                        
                        <!-- Overlay gradients (pointer-events-none so we can click the video) -->
                        <div class="absolute inset-0 bg-gradient-to-tr from-brand/10 to-transparent pointer-events-none mix-blend-overlay"></div>
                    </div>
                    
                    <!-- Floating Gtechniq Badge -->
                    <div class="absolute -bottom-6 -right-6 md:-right-10 bg-white/95 dark:bg-[#111111]/95 backdrop-blur-xl px-6 py-4 rounded-2xl border border-black/10 dark:border-white/10 shadow-2xl z-20 flex items-center gap-4 hover:-translate-y-2 transition-transform duration-300">
                        <img src="/assets/logos/Gtechniq-Logo.png" alt="Gtechniq" class="h-6 object-contain dark:brightness-110">
                        <div class="h-6 w-px bg-black/10 dark:bg-white/10"></div>
                        <span class="text-brand text-xs font-black uppercase tracking-widest">Official Video</span>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-- Section: Beneficios Detallados -->
    <section class="section-padding bg-gray-50 dark:bg-surface-800 relative transition-colors border-b border-black/5 dark:border-white/5">
        <x-interactive-particles density="100" color="#FB2C6B" />
        <div class="container-custom relative z-10">
            <div class="text-center mb-20 fade-in-up">
                <h2 class="font-display text-4xl md:text-6xl font-black text-black dark:text-white mb-8 transition-colors">
                    Beneficios del <span class="text-gradient">Cerámico para Autos</span>
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                @foreach([
                    ['title' => 'Protección contra Rayas', 'desc' => 'Dureza 9H que absorbe micro-rayas y marcas de lavado.', 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m12 3-1.912 5.886L4 9l4.912.863L12 15l1.912-5.137L20 9l-4.912-.114z"/></svg>'],
                    ['title' => 'Resistencia Química', 'desc' => 'Protege contra lluvia ácida y deposiciones de aves.', 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M8.5 14.5A2.5 2.5 0 0 0 11 12c0-1.38-.5-2-1-3-1.072-2.143-.224-4.054 2-6 .5 2.5 2 4.9 4 6.5 2 1.6 3 3.5 3 5.5a7 7 0 1 1-14 0c0-1.153.433-2.294 1-3a2.5 2.5 0 0 0 2.5 2.5z"/></svg>'],
                    ['title' => 'Fácil Limpieza', 'desc' => 'La suciedad no se adhiere, lavados un 70% más rápidos.', 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22a7 7 0 0 0 5-2c2.5-2.5 2.5-6.5 0-9L12 6 7 11c-2.5 2.5-2.5 6.5 0 9a7 7 0 0 0 5 2z"/></svg>'],
                    ['title' => 'Filtro UV Permanente', 'desc' => 'Mantiene el color vivo y evita el quemado del sol.', 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="m9 12 2 2 4-4"/></svg>'],
                    ['title' => 'Brillo Profundo', 'desc' => 'Añade un gloss cristalino espectacular.', 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="7"/><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"/></svg>'],
                    ['title' => 'Valor de Reventa', 'desc' => 'Mantiene el estado original de la pintura por años.', 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" x2="18" y1="20" y2="10"/><line x1="12" x2="12" y1="20" y2="4"/><line x1="6" x2="6" y1="20" y2="14"/></svg>']
                ] as $benefit)
                    <div class="group p-10 rounded-[40px] bg-white dark:bg-surface-700/50 border border-black/5 dark:border-white/5 hover:border-brand/40 hover:-translate-y-1.5 transition-all shadow-md dark:shadow-none duration-300">
                        <div class="w-16 h-16 rounded-2xl bg-brand/10 flex items-center justify-center mb-8 group-hover:bg-brand transition-colors duration-300">
                            <span class="text-brand group-hover:text-white transition-colors">{!! $benefit['icon'] !!}</span>
                        </div>
                        <h3 class="text-2xl font-bold text-black dark:text-white mb-6 leading-tight transition-colors">{{ $benefit['title'] }}</h3>
                        <p class="text-black/60 dark:text-white/40 leading-relaxed transition-colors font-medium">{{ $benefit['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Section: Direct Comparison -->
    <section class="section-padding relative transition-colors border-y border-white/10 bg-cover bg-center bg-fixed" style="background-image: url('/assets/images/ceramic_bg.png');">
        <!-- Overlay -->
        <div class="absolute inset-0 bg-black/85 backdrop-blur-[4px]"></div>
        
        <div class="container-custom relative z-10">
            <div class="text-center mb-16 fade-in-up">
                <p class="text-brand text-sm font-bold tracking-[0.2em] uppercase mb-4">Combate Frente a Frente</p>
                <h2 class="font-display text-4xl md:text-5xl font-black text-white mb-6 transition-colors drop-shadow-lg">
                    Comparación <span class="text-brand">Directa</span>
                </h2>
                <p class="text-white/60 transition-colors text-lg max-w-2xl mx-auto">Gtechniq vs Ceras Convencionales</p>
            </div>

            <div class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8 relative">
                <!-- Ceras Tradicionales -->
                <div class="p-10 rounded-[3rem] bg-black/40 backdrop-blur-xl border-2 border-red-500/30 hover:-translate-y-1 transition-all duration-300">
                    <h3 class="text-2xl font-bold text-white/90 mb-8 transition-colors flex items-center gap-3">
                        <svg class="w-6 h-6 text-red-500/70" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/>
                        </svg>
                        Ceras & Sellantes
                    </h3>
                    <ul class="space-y-6">
                        @foreach(["Durabilidad corta (1-3 meses)", "Se degrada con lavados e hidro-lavadoras", "Resistencia química nula ante agentes corrosivos", "Dureza superficial blanda propensa a micro-rayas", "Requiere re-aplicación constante y costosa"] as $t)
                            <li class="flex items-center gap-4 text-white/50 text-sm transition-colors font-medium">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-red-500/50 shrink-0"><line x1="18" x2="6" y1="6" y2="18"/><line x1="6" x2="18" y1="6" y2="18"/></svg>
                                {{ $t }}
                            </li>
                        @endforeach
                    </ul>
                </div>

                <!-- VS Badge -->
                <div class="hidden md:flex absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-14 h-14 bg-brand text-white rounded-full items-center justify-center font-black text-xl italic shadow-[0_0_20px_rgba(232,80,138,0.5)] z-10 border-4 border-white dark:border-surface-900 transition-colors">
                    VS
                </div>

                <!-- Platinum Gtechniq -->
                <div class="p-10 rounded-[3rem] bg-white dark:bg-surface-800 border-2 border-brand shadow-xl hover:-translate-y-1.5 transition-all duration-300 relative overflow-hidden group">
                    <div class="absolute -top-10 -right-10 w-40 h-40 bg-brand/10 rounded-full blur-3xl"></div>
                    <h3 class="text-2xl font-bold text-black dark:text-white mb-8 transition-colors flex items-center gap-3">
                        <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10"/><path d="m9 12 2 2 4-4"/>
                        </svg>
                        Gtechniq
                    </h3>
                    <ul class="space-y-6">
                        @foreach(["Durabilidad extrema de hasta 9 años", "Resistente a químicos de pH extremo (pH2 - pH12)", "Escudo cerámico ultra-duro con dureza molecular 9H/10H", "Protección permanente contra rayos UV e hidrofobicidad", "Garantía oficial documentada a nivel global"] as $t)
                            <li class="flex items-center gap-4 text-black dark:text-white text-sm font-semibold transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-brand shrink-0"><polyline points="20 6 9 17 4 12"/></svg>
                                {{ $t }}
                            </li>
                        @endforeach
                    </ul>
                    <div class="mt-12 p-4 bg-brand/10 rounded-2xl border border-brand/20 text-center relative overflow-hidden group-hover:scale-[1.01] transition-all">
                        <p class="text-brand text-xs font-black uppercase tracking-widest">Inversión Inteligente Asegurada</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section: Proceso de Aplicación -->
    <section class="section-padding relative bg-gray-50 dark:bg-black transition-colors duration-300">
        <x-interactive-particles density="150" color="#ffffff" class="opacity-20" />
        <div class="container-custom relative z-10 text-center mb-20 fade-in-up">
            <h2 class="font-display text-4xl md:text-6xl font-black text-black dark:text-white mb-8 transition-colors">
                Nuestro <span class="text-gradient">Proceso Maestro</span>
            </h2>
        </div>
        <div class="container-custom grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 relative z-10">
            @foreach([
                ['step' => '01', 'title' => 'Limpieza', 'desc' => 'Lavado detallado y descontaminación.'],
                ['step' => '02', 'title' => 'Corrección', 'desc' => 'Pulido para eliminar defectos y dar brillo.'],
                ['step' => '03', 'title' => 'Preparación', 'desc' => 'Limpieza con Panel Wipe para asegurar anclaje.'],
                ['step' => '04', 'title' => 'Sellado', 'desc' => 'Aplicación controlada de Gtechniq.']
            ] as $item)
                <div class="p-8 rounded-3xl bg-white dark:bg-white/[0.03] border border-black/5 dark:border-white/5 relative group hover:border-brand/40 hover:-translate-y-1.5 transition-all shadow-sm dark:shadow-none duration-300">
                    <span class="text-6xl font-display font-black text-black/5 dark:text-white/5 absolute -top-4 -left-2 group-hover:text-brand/10 transition-colors">{{ $item['step'] }}</span>
                    <h4 class="text-xl font-bold text-brand mb-4 relative z-10 transition-colors">{{ $item['title'] }}</h4>
                    <p class="text-black/60 dark:text-white/40 text-sm relative z-10 transition-colors font-medium">{{ $item['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Pricing Section -->
    <section id="precios" class="section-padding bg-white dark:bg-surface-800 relative overflow-hidden transition-colors duration-300 border-t border-black/5 dark:border-white/5">
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-brand/5 rounded-full blur-[120px] -mr-64 -mt-64"></div>
        
        <div class="container-custom relative z-10">
            <div class="text-center mb-16 fade-in-up">
                <p class="text-brand text-sm font-bold tracking-[0.2em] uppercase mb-4">Sistemas de Recubrimiento</p>
                <h2 class="font-display text-3xl md:text-5xl font-black text-black dark:text-white mb-6 transition-colors">
                    Niveles de <span class="text-gradient">Sellado Cerámico</span>
                </h2>
                <p class="text-black/60 dark:text-white/50 max-w-2xl mx-auto transition-colors text-lg font-light">
                    Utilizamos exclusivamente tecnología Gtechniq para garantizar un acabado perfecto y una durabilidad que se mide en años, no en meses.
                </p>
            </div>

                        @php
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

                $profile = \App\Models\BusinessProfile::first();
                $onlinePaymentsActive = $profile ? ($profile->payment_gateway_enabled || $profile->show_prices) : false;
                $vehicleTypes = \App\Models\VehicleType::where('is_active', true)->orderBy('display_order')->get();
                $categoryServices = \App\Models\Service::with('vehicleTypes')->where('category', 'ceramico')->where('is_active', true)->orderBy('display_order')->get();
            @endphp

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                @foreach($categoryServices as $srv)
                    <div class="relative flex flex-col h-full rounded-[40px] p-8 md:p-10 transition-all duration-500 group premium-pricing-card {{ $srv->is_featured ? 'popular-pricing-card' : '' }}">
                        @if(str_contains(strtoupper($srv->name), 'NIVEL 3'))
                            <div class="absolute left-1/2 -translate-x-1/2 bg-brand text-white text-[9px] sm:text-[10px] font-black uppercase tracking-widest px-5 py-2 rounded-full z-10 shadow-lg shadow-brand/40 flex items-center gap-2 border border-white/20 w-max" style="top: -1.25rem;">
                                <img src="/assets/logos/Gtechniq-Logo.png" class="h-3.5 brightness-0 invert" alt="Gtechniq">
                                <div class="w-px h-3 bg-white/30"></div>
                                <span>ACCREDITED DETAILER</span>
                            </div>
                        @elseif($srv->is_featured)
                            <div class="absolute left-1/2 -translate-x-1/2 bg-brand text-white text-[10px] font-black uppercase tracking-widest px-4 py-1.5 rounded-full z-10 shadow-lg" style="top: -1rem;">
                                Destacado
                            </div>
                        @endif

                        <div class="mb-8">
                            <div class="flex items-center justify-between mb-6">
                                <div class="w-14 h-14 rounded-2xl bg-brand/10 flex items-center justify-center group-hover:scale-110 transition-transform duration-300 shadow-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-brand"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                                </div>
                                <div class="bg-brand/10 text-brand border border-brand/20 px-3 py-1.5 rounded-full text-xs font-black uppercase tracking-widest flex items-center gap-1.5 shadow-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="text-brand"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                                    @php
                                        $h = floor($srv->duration_minutes / 60);
                                        $m = $srv->duration_minutes % 60;
                                        $durationText = '';
                                        if ($h > 0) $durationText .= $h . ' HR' . ($h > 1 ? 'S' : '');
                                        if ($m > 0) $durationText .= ($h > 0 ? ' ' : '') . $m . ' MIN';
                                        if ($srv->duration_minutes == 0) $durationText = '--';
                                    @endphp
                                    {{ $durationText }}
                                </div>
                            </div>
                            <h3 class="text-2xl font-display font-bold text-black dark:text-white mb-4 transition-colors">
                                {{ $srv->name }}
                            </h3>
                            <p class="text-black/60 dark:text-white/50 text-sm leading-relaxed min-h-[3rem] transition-colors font-medium html-content">
                                {!! $srv->short_description !!}
                            </p>
                        </div>

                        <div class="space-y-3 mb-8">
                            @foreach($vehicleTypes as $vt)
                                <div class="flex items-center justify-between p-3 rounded-2xl bg-white/80 dark:bg-white/[0.02] border border-black/5 dark:border-white/5 shadow-sm transition-all duration-300 hover:border-brand/20 hover:bg-white dark:hover:bg-white/[0.04]">
                                    <div class="flex items-center gap-3">
                                        <span class="text-xl leading-none">{{ getVehicleIcon($vt->slug) }}</span>
                                        <span class="text-xs text-black/60 dark:text-white/60 transition-colors font-semibold">{{ $vt->name }}</span>
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

                        <div class="flex-grow">
                            <div class="text-xs font-bold text-black/40 dark:text-white/30 uppercase tracking-widest mb-4 border-b border-black/5 dark:border-white/5 pb-2 transition-colors">
                                Incluye Cobertura
                            </div>
                            @php
                                preg_match_all('/<(p|li)[^>]*>(.*?)<\/\1>/s', $srv->long_description, $matches);
                                $features = !empty($matches[2]) ? array_filter(array_map('trim', $matches[2])) : [];
                                if (empty($features)) {
                                    $features = array_filter(array_map('trim', explode("\n", $srv->long_description)));
                                }
                            @endphp
                            <ul class="space-y-3 mb-10">
                                @foreach($features as $feature)
                                    <li class="flex items-start gap-3 text-sm text-black/70 dark:text-white/60">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-brand mt-1 shrink-0"><polyline points="20 6 9 17 4 12"/></svg>
                                        <span class="transition-colors font-medium html-content">{!! $feature !!}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <a 
                            href="/reserva?service={{ $srv->slug }}" 
                            class="w-full py-5 rounded-2xl font-bold transition-all duration-300 text-sm tracking-wider uppercase text-center {{ $srv->is_featured ? 'bg-brand text-white shadow-lg shadow-brand/30 hover:bg-brand-dark hover:scale-[1.02]' : 'bg-black/5 dark:bg-white/5 text-black dark:text-white hover:bg-black/10 dark:hover:bg-white/10 hover:border-brand/40 border border-black/10 dark:border-white/10' }}"
                        >
                            Agendar Turno
                        </a>
                    </div>
                @endforeach
            </div>


            <div class="mt-16 text-center">
                <div class="inline-flex items-center gap-4 px-6 py-3 rounded-full bg-black/5 dark:bg-white/5 border border-black/10 dark:border-white/10">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-brand"><circle cx="12" cy="12" r="10"/><line x1="12" x2="12" y1="16" y2="12"/><line x1="12" x2="12.01" y1="8" y2="8"/></svg>
                    <p class="text-xs text-black/60 dark:text-white/50 transition-colors font-semibold">
                        * El sellado cerámico requiere una superficie libre de defectos. Si tu pintura presenta rayas profundas, podría requerir una corrección previa.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section id="faq" class="section-padding bg-white dark:bg-surface-900 relative transition-colors duration-300 border-t border-black/5 dark:border-white/5">
        <div class="container-custom relative z-10">
            <h2 class="font-display text-4xl md:text-6xl font-black text-black dark:text-white mb-20 text-center transition-colors">Preguntas <span class="text-gradient">Frecuentes</span></h2>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 max-w-6xl mx-auto">
                @php
                    $faqs = [
                        [
                            'question' => '¿Cuánto dura el sellado cerámico?',
                            'answer' => 'La duración depende del tipo de recubrimiento elegido. Ofrecemos opciones que van desde los 2 años hasta los 9 años con Gtechniq Crystal Serum Ultra.',
                        ],
                        [
                            'question' => '¿Vale la pena el sellado cerámico?',
                            'answer' => 'Absolutamente. Proporciona un brillo superior y protege la pintura contra contaminantes, UV y químicos, manteniendo el valor de tu vehículo.',
                        ],
                        [
                            'question' => '¿El sellado cerámico protege contra rayas?',
                            'answer' => 'Añade una capa de sacrificio 9H que ayuda a prevenir micro-rayas de lavado, pero no protege contra golpes fuertes de piedras.',
                        ],
                        [
                            'question' => '¿Qué diferencia hay con la cera tradicional?',
                            'answer' => 'El cerámico se vincula químicamente con el barniz, creando una capa permanente mucho más dura y brillante que la cera.',
                        ],
                        [
                            'question' => '¿Cada cuánto se recomienda aplicar un sellado cerámico?',
                            'answer' => 'Con Gtechniq Crystal Serum Ultra, la protección dura hasta 9 años. Solo se recomiendan mantenciones periódicas.',
                        ]
                    ];
                @endphp

                @foreach($faqs as $faq)
                    <div class="p-8 rounded-[35px] bg-black/[0.01] dark:bg-white/[0.01] border border-black/5 dark:border-white/5 premium-faq-card shadow-sm dark:shadow-none">
                        <h3 class="text-xl font-extrabold text-black dark:text-white mb-4 transition-colors leading-tight">{{ $faq['question'] }}</h3>
                        <p class="text-black/60 dark:text-white/40 leading-relaxed transition-colors font-medium">"{{ $faq['answer'] }}"</p>
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
                    <p class="text-brand text-sm font-semibold tracking-[0.2em] uppercase mb-6">Protección Extrema 9H</p>
                    <h2 class="font-display text-4xl md:text-5xl lg:text-6xl font-bold text-black dark:text-white mb-6 leading-tight transition-colors">
                        Protege tu <span class="text-gradient">inversión</span>
                    </h2>
                    <p class="text-black/60 dark:text-white/50 text-lg mb-10 max-w-xl mx-auto lg:mx-0 transition-colors">
                        Asegura el brillo, repelencia al agua y protección de larga duración con nuestros tratamientos de sellado cerámico Gtechniq de grado profesional.
                    </p>

                    <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-6">
                        <a href="/reserva" class="w-full sm:w-auto px-8 py-4 bg-brand hover:bg-brand-dark text-white font-semibold rounded-2xl text-lg transition-all duration-300 shadow-lg shadow-brand/30 hover:shadow-brand/50 flex items-center justify-center gap-2 hover:scale-[1.02]">
                            <span>Cotizar Sellado Cerámico</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="shrink-0"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                        </a>
                        <div class="flex items-center gap-3 text-black/60 dark:text-white/60 shrink-0 font-medium">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-brand"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="m9 12 2 2 4-4"/></svg>
                            <span class="text-sm">Acreditador Autorizado Gtechniq</span>
                        </div>
                    </div>
                </div>

                <!-- Right Side: Video Frame -->
                <div class="relative group">
                    <div class="relative aspect-video rounded-[2.5rem] overflow-hidden border border-black/10 dark:border-white/10 shadow-2xl transition-all duration-500 hover:scale-[1.01] hover:border-brand/30 bg-black">
                        <video autoplay muted loop playsinline class="w-full h-full object-cover">
                            <source src="/assets/videos/sellado-ceramico.mp4" type="video/mp4">
                        </video>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent pointer-events-none"></div>
                        <div class="absolute bottom-3 left-3 right-3 md:bottom-6 md:left-6 md:right-6 p-2.5 md:p-4 rounded-xl md:rounded-2xl bg-black/50 md:bg-black/60 backdrop-blur-sm md:backdrop-blur-md border border-white/5 md:border-white/10">
                            <p class="text-white text-[10px] md:text-xs font-bold uppercase tracking-widest mb-0.5 md:mb-1 flex items-center gap-1.5">
                                <span class="h-1.5 w-1.5 md:h-2 md:w-2 rounded-full bg-brand animate-pulse"></span>
                                Cerámico en Progreso
                            </p>
                            <p class="text-white/60 text-[9px] md:text-[10px] leading-tight">Curado químico y aplicación minuciosa de recubrimiento hidrofóbico.</p>
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
@include('partials.schema-sellado')
@endsection

