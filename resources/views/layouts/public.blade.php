<!DOCTYPE html>
<html lang="es" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#E8508A">
    <link rel="manifest" href="/manifest.json">
    @php
        $profile = \App\Models\BusinessProfile::first();
        
        // Resolve dynamic SEO from database
        $__seoRouteMap = [
            'home' => 'home',
            'nosotros' => 'nosotros',
            'limpieza-y-detallado' => 'limpieza-y-detallado',
            'sellado-ceramico' => 'sellado-ceramico',
            'pulido-de-autos' => 'pulido-de-autos',
            'proteccion-parabrisas' => 'proteccion-parabrisas',
            'detailing-interior' => 'detailing-interior',
            'tratamiento-ceramico' => 'tratamiento-ceramico',
            'restauracion-de-focos' => 'restauracion-de-focos',
            'booking.reserva' => 'reserva',
        ];
        $__currentRoute = \Illuminate\Support\Facades\Route::currentRouteName();
        $__seoKey = $__seoRouteMap[$__currentRoute] ?? null;
        $__seo = null;
        if ($__seoKey) {
            try {
                $__seo = \App\Models\PageSeo::where('route_key', $__seoKey)->first();
            } catch (\Exception $e) {
                // Table may not exist yet
            }
        }
    @endphp
    @if($__seo && $__seo->seo_title)
        <title>{{ $__seo->seo_title }}</title>
    @else
        <title>@yield('title', 'High Contrast Detailing Center | Car Detailing Premium en Chicureo')</title>
    @endif
    <link rel="icon" type="image/png" href="{{ $profile && $profile->logo ? asset($profile->logo) : asset('assets/logos/main-logo.png') }}">
    
    <!-- Meta tags for SEO -->
    @if($__seo && $__seo->seo_description)
        <meta name="description" content="{{ $__seo->seo_description }}">
    @else
        <meta name="description" content="@yield('meta_description', 'Centro de detailing automotriz premium en Chicureo, Chile. Pulido profesional, tratamiento cerámico, detailing interior y exterior.')">
    @endif
    <meta name="keywords" content="@yield('meta_keywords', 'car detailing, detailing chicureo, pulido de autos, tratamiento cerámico, detailing premium, lavado premium, corrección de pintura, High Contrast Detailing')">
    <meta name="robots" content="@yield('meta_robots', 'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1')">
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="High Contrast Detailing Center">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ $__seo && $__seo->seo_title ? $__seo->seo_title : 'High Contrast Detailing Center | Car Detailing Premium en Chicureo' }}">
    <meta property="og:description" content="{{ $__seo && $__seo->seo_description ? $__seo->seo_description : 'Centro de detailing automotriz premium en Chicureo, Chile. Pulido profesional, tratamiento cerámico 9H, ExoShield y detailing integral.' }}">
    <meta property="og:image" content="{{ asset('assets/images/galeria/HCD-70.jpg') }}">
    <meta property="og:locale" content="es_CL">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ url()->current() }}">
    <meta name="twitter:title" content="{{ $__seo && $__seo->seo_title ? $__seo->seo_title : 'High Contrast Detailing Center' }}">
    <meta name="twitter:description" content="{{ $__seo && $__seo->seo_description ? $__seo->seo_description : 'Centro de detailing automotriz premium en Chicureo, Chile.' }}">
    <meta name="twitter:image" content="{{ asset('assets/images/galeria/HCD-70.jpg') }}">

    <!-- Schema.org JSON-LD Structured Data -->
    <script type="application/ld+json">
    {!! json_encode([
      '@context' => 'https://schema.org',
      '@type' => 'AutoRepair',
      'name' => 'High Contrast Detailing Center',
      'image' => asset('assets/images/galeria/HCD-70.jpg'),
      '@id' => 'https://highcontrastdetailingcenter.cl',
      'url' => 'https://highcontrastdetailingcenter.cl',
      'telephone' => $profile->phone ?? '+56912345678',
      'priceRange' => '$$$',
      'address' => [
        '@type' => 'PostalAddress',
        'streetAddress' => $profile->address_line1 ?? 'Chicureo',
        'addressLocality' => 'Colina',
        'addressRegion' => 'Región Metropolitana',
        'addressCountry' => 'CL'
      ],
      'geo' => [
        '@type' => 'GeoCoordinates',
        'latitude' => -33.2750,
        'longitude' => -70.6750
      ],
      'openingHoursSpecification' => [
        '@type' => 'OpeningHoursSpecification',
        'dayOfWeek' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
        'opens' => '08:30',
        'closes' => '18:30'
      ],
      'sameAs' => [
        'https://www.instagram.com/' . ltrim($profile->instagram ?? 'highcontrastdc', '@')
      ]
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
    </script>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @yield('styles')
    
    <!-- Initial script to prevent theme flash -->
    <script>
        try {
            if (localStorage.getItem('public_theme') === 'dark') {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        } catch(e) {}
    </script>

    @if($profile && !empty($profile->google_analytics_id))
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ $profile->google_analytics_id }}"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', '{{ $profile->google_analytics_id }}');
        </script>
    @endif

    @if($profile && !empty($profile->google_tag_manager_id))
        <!-- Google Tag Manager -->
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','{{ $profile->google_tag_manager_id }}');</script>
        <!-- End Google Tag Manager -->
    @endif

    <!-- Microsoft Clarity -->
    <script type="text/javascript">
        (function(c,l,a,r,i,t,y){
            c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
            t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
            y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
        })(window, document, "clarity", "script", "xv64mf9ddi");
    </script>

    @if($profile && !empty($profile->header_scripts))
        {!! $profile->header_scripts !!}
    @endif
</head>
<body class="antialiased bg-gray-50 text-black dark:bg-[#0A0A0A] dark:text-[#F5F5F5] transition-colors duration-300" x-data="{ isMobileOpen: false }">
    @if($profile && !empty($profile->google_tag_manager_id))
        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id={{ $profile->google_tag_manager_id }}"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->
    @endif
    @php
        $whatsappNumber = preg_replace('/\D/', '', $profile->whatsapp ?? '56912345678');
        $whatsappMsg = urlencode('Hola, me gustaría cotizar un servicio de detailing para mi vehículo.');
        $forceSolidNav = !request()->is('/') 
            && !request()->is('nosotros') 
            && !request()->is('limpieza-y-detallado') 
            && !request()->is('sellado-ceramico') 
            && !request()->is('pulido-de-autos-santiago') 
            && !request()->is('proteccion-parabrisas-santiago');
        $isServicesActive = request()->is('limpieza-y-detallado') 
            || request()->is('sellado-ceramico') 
            || request()->is('pulido-de-autos-santiago') 
            || request()->is('proteccion-parabrisas-santiago');
    @endphp

    <!-- Navbar -->
    <nav x-data="{ 
        isScrolled: {{ $forceSolidNav ? 'true' : 'false' }}, 
        isServicesOpen: false 
    }" 
    @scroll.window="isScrolled = {{ $forceSolidNav ? 'true' : 'window.pageYOffset > 50' }}"
    :class="isScrolled ? 'bg-white/90 dark:bg-[#111111]/95 border-b border-black/5 dark:border-white/5 py-3 shadow-sm backdrop-blur-md' : 'bg-transparent py-5'"
    class="fixed left-0 right-0 top-0 z-[60] transition-all duration-500"
    style="z-index: 99999 !important;">
        <div class="max-w-7xl mx-auto px-4 md:px-6 lg:px-8 flex items-center justify-between">
            <!-- Brand Logo -->
            <a href="/" class="group flex items-center gap-3">
                <div class="relative h-10 w-10">
                    <img src="{{ $profile->logo ? asset($profile->logo) : asset('assets/logos/main-logo.png') }}" alt="{{ $profile->business_name ?? 'High Contrast' }}" class="object-contain w-full h-full">
                </div>
                <div class="flex flex-col">
                    <span :class="isScrolled ? 'text-black dark:text-white' : 'text-white'" class="font-display text-lg font-bold leading-tight tracking-tight transition-colors group-hover:text-brand">
                        HIGH CONTRAST
                    </span>
                    <span :class="isScrolled ? 'text-black/50 dark:text-white/40' : 'text-white/60'" class="text-[9px] font-medium uppercase tracking-[0.3em]">
                        Detailing Center
                    </span>
                </div>
            </a>

            <!-- Desktop Links -->
            <div class="hidden md:flex items-center gap-2">
                <a href="/" :class="isScrolled ? '{{ request()->is('/') ? 'text-brand font-bold' : 'text-black/70 dark:text-white/70 hover:text-brand dark:hover:text-brand' }}' : '{{ request()->is('/') ? 'text-brand font-bold' : 'text-white/70 hover:text-white' }}'" class="px-4 py-2 text-sm font-medium transition-all">Inicio</a>
                <a href="/nosotros" :class="isScrolled ? '{{ request()->is('nosotros') ? 'text-brand font-bold' : 'text-black/70 dark:text-white/70 hover:text-brand dark:hover:text-brand' }}' : '{{ request()->is('nosotros') ? 'text-brand font-bold' : 'text-white/70 hover:text-white' }}'" class="px-4 py-2 text-sm font-medium transition-all">Nosotros</a>
                
                <!-- Dropdown Services (Simple Menu) -->
                <div class="relative" @mouseenter="isServicesOpen = true" @mouseleave="isServicesOpen = false">
                    <button :class="isScrolled ? '{{ $isServicesActive ? 'text-brand font-bold' : 'text-black/70 dark:text-white/70 hover:text-brand dark:hover:text-brand' }}' : '{{ $isServicesActive ? 'text-brand font-bold' : 'text-white/70 hover:text-white' }}'" class="flex items-center gap-1 px-4 py-2 text-sm font-medium transition-all">
                        Servicios
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform duration-300" :class="isServicesOpen ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                    </button>
                    <div x-show="isServicesOpen" x-transition class="absolute left-1/2 -translate-x-1/2 top-full pt-3" style="width: 320px; display: none; z-index: 50;">
                        <div class="overflow-hidden rounded-2xl border border-black/10 dark:border-white/10 bg-white/95 dark:bg-[#1A1A1A]/95 shadow-xl backdrop-blur-xl" style="padding: 10px;">
                            
                            @php
                                $catDetails = [
                                    'limpieza' => [
                                        'label' => 'Limpieza & Detallado', 
                                        'url' => '/limpieza-y-detallado', 
                                        'bg_raw' => 'rgba(59, 130, 246, 0.08)',
                                        'color_raw' => '#3b82f6',
                                        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2.69l5.66 5.66a8 8 0 1 1-11.31 0z" /></svg>'
                                    ],
                                    'correccion' => [
                                        'label' => 'Corrección de Pintura', 
                                        'url' => '/pulido-de-autos-santiago', 
                                        'bg_raw' => 'rgba(245, 158, 11, 0.08)',
                                        'color_raw' => '#f59e0b',
                                        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3v3M12 18v3M3 12H6M21 12h-3"/><path d="M5.6 5.6l2.1 2.1M16.3 16.3l2.1 2.1M5.6 18.4l2.1-2.1M16.3 7.7l2.1-2.1"/><circle cx="12" cy="12" r="3.5"/></svg>'
                                    ],
                                    'ceramico' => [
                                        'label' => 'Ceramic Coating', 
                                        'url' => '/sellado-ceramico', 
                                        'bg_raw' => 'rgba(16, 185, 129, 0.08)',
                                        'color_raw' => '#10b981',
                                        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>'
                                    ],
                                    'especiales' => [
                                        'label' => 'Protección ExoShield', 
                                        'url' => '/proteccion-parabrisas-santiago', 
                                        'bg_raw' => 'rgba(139, 92, 246, 0.08)',
                                        'color_raw' => '#8b5cf6',
                                        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M2 18h20L19 7H5L2 18z"/><path d="M12 18A6 6 0 0 0 6 12"/></svg>'
                                    ],
                                ];
                            @endphp

                            <div class="flex flex-col" style="gap: 6px;">
                                @if(isset($navCategoryOrder))
                                    @foreach($navCategoryOrder as $catId)
                                        @if(isset($catDetails[$catId]))
                                            @php $detail = $catDetails[$catId]; @endphp
                                            <a href="{{ $detail['url'] }}" class="flex items-center rounded-xl hover:bg-black/5 dark:hover:bg-white/5 transition-all duration-200 group" style="padding: 10px; gap: 14px;">
                                                <div class="rounded-lg transition-all duration-300 group-hover:scale-110 flex items-center justify-center shrink-0" style="width: 38px; height: 38px; background-color: {{ $detail['bg_raw'] }}; color: {{ $detail['color_raw'] }}">
                                                    {!! $detail['icon'] !!}
                                                </div>
                                                <div class="font-display font-bold text-sm tracking-tight text-black dark:text-white transition-colors duration-200" style="white-space: nowrap; --hover-color: {{ $detail['color_raw'] }}">
                                                    <span class="group-hover:text-[var(--hover-color)] transition-colors">
                                                        {{ $detail['label'] }}
                                                    </span>
                                                </div>
                                            </a>
                                        @endif
                                    @endforeach
                                @endif
                            </div>

                        </div>
                    </div>
                </div>

                <a href="/#galeria" :class="isScrolled ? 'text-black/70 dark:text-white/70 hover:text-brand dark:hover:text-brand' : 'text-white/70 hover:text-white'" class="px-4 py-2 text-sm font-medium transition-all">Galeria</a>
                <a href="/#testimonios" :class="isScrolled ? 'text-black/70 dark:text-white/70 hover:text-brand dark:hover:text-brand' : 'text-white/70 hover:text-white'" class="px-4 py-2 text-sm font-medium transition-all">Testimonios</a>
                <a href="/#faq" :class="isScrolled ? 'text-black/70 dark:text-white/70 hover:text-brand dark:hover:text-brand' : 'text-white/70 hover:text-white'" class="px-4 py-2 text-sm font-medium transition-all">Preguntas</a>

                <!-- Navigation Actions (Mi portal & Cotiza ahora) -->
                <div class="flex items-center gap-3 ml-4">
                    @if(auth()->check() && (auth()->user()->isAdmin() || auth()->user()->isStaff()))
                        <a href="{{ route('admin.dashboard') }}" 
                           :class="isScrolled ? 'bg-black/5 dark:bg-white/10 text-black dark:text-white hover:bg-black/10 dark:hover:bg-white/20 border border-black/10 dark:border-white/10' : 'bg-white/15 text-white hover:bg-white/25 border border-white/25 backdrop-blur-md shadow-lg shadow-black/20'" 
                           class="rounded-full px-4 py-2 text-xs sm:text-sm font-bold transition-all duration-300 flex items-center gap-2 shadow-sm shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="text-brand shrink-0"><rect width="7" height="9" x="3" y="3" rx="1"/><rect width="7" height="5" x="14" y="3" rx="1"/><rect width="7" height="9" x="14" y="12" rx="1"/><rect width="7" height="5" x="3" y="16" rx="1"/></svg>
                            <span class="font-bold">Mi portal</span>
                        </a>
                    @endif
                    <a href="/reserva" class="rounded-full bg-brand px-6 py-2.5 text-sm font-semibold text-white transition-all duration-300 hover:bg-brand-dark hover:shadow-lg hover:shadow-brand/30">
                        Cotiza ahora
                    </a>
                </div>
            </div>

            <!-- Mobile Menu Toggle -->
            <div class="flex items-center gap-3 md:hidden">
                <button @click="isMobileOpen = !isMobileOpen" :class="isScrolled ? 'text-black/70 dark:text-white/70' : 'text-white/70'" class="p-2" aria-label="Menu">
                    <svg x-show="!isMobileOpen" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="4" x2="20" y1="12" y2="12"/><line x1="4" x2="20" y1="6" y2="6"/><line x1="4" x2="20" y1="18" y2="18"/></svg>
                    <svg x-show="isMobileOpen" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display: none;"><line x1="18" x2="6" y1="6" y2="18"/><line x1="6" x2="18" y1="6" y2="18"/></svg>
                </button>
            </div>
        </div>

    </nav>

    <!-- Mobile Navigation Slide-Over Drawer (Right to Left) -->
    <div x-show="isMobileOpen" 
         class="md:hidden fixed inset-0 z-[99999] overflow-hidden" 
         style="display: none;"
         x-cloak>
        
        <!-- Backdrop Overlay -->
        <div x-show="isMobileOpen"
             x-transition:enter="transition-opacity ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @click="isMobileOpen = false"
             class="fixed inset-0 bg-black/80 backdrop-blur-md"></div>

        <!-- Slide-in Drawer Container -->
        <div x-show="isMobileOpen"
             x-transition:enter="transform transition ease-out duration-300"
             x-transition:enter-start="translate-x-full"
             x-transition:enter-end="translate-x-0"
             x-transition:leave="transform transition ease-in duration-200"
             x-transition:leave-start="translate-x-0"
             x-transition:leave-end="translate-x-full"
             class="fixed inset-y-0 right-0 w-full max-w-[360px] sm:max-w-sm bg-[#0E0E0E]/98 border-l border-white/10 shadow-2xl backdrop-blur-2xl flex flex-col justify-between overflow-y-auto px-6 py-7 text-center items-center">
            
            <!-- Drawer Header (Close Button & Logo) -->
            <div class="w-full flex items-center justify-between pb-4 border-b border-white/10">
                <div class="flex items-center gap-2.5">
                    <img src="{{ $profile->logo ? asset($profile->logo) : asset('assets/logos/main-logo.png') }}" alt="{{ $profile->business_name ?? 'High Contrast' }}" class="h-8 w-8 object-contain">
                    <span class="font-display font-bold text-white text-sm tracking-tight">HIGH CONTRAST</span>
                </div>
                <button @click="isMobileOpen = false" class="p-2 rounded-full bg-white/5 hover:bg-white/10 text-white/70 hover:text-white transition-colors" aria-label="Cerrar menú">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" x2="6" y1="6" y2="18"/><line x1="6" x2="18" y1="6" y2="18"/></svg>
                </button>
            </div>

            <!-- Drawer Center Content (Centered Navigation) -->
            <div class="w-full my-auto py-5 flex flex-col items-center justify-center space-y-3.5">
                <a href="/" @click="isMobileOpen = false" class="w-full py-1.5 font-display text-xl sm:text-2xl font-bold tracking-tight text-white/90 hover:text-brand transition-colors {{ request()->is('/') ? 'text-brand' : '' }}">
                    Inicio
                </a>
                <a href="/nosotros" @click="isMobileOpen = false" class="w-full py-1.5 font-display text-xl sm:text-2xl font-bold tracking-tight text-white/90 hover:text-brand transition-colors {{ request()->is('nosotros') ? 'text-brand' : '' }}">
                    Nosotros
                </a>

                <!-- Services Box (Centered Grid/List) -->
                <div class="w-full rounded-2xl bg-white/[0.03] border border-white/[0.08] p-3.5 text-center">
                    <div class="text-[10px] font-bold uppercase tracking-[0.2em] text-brand/80 mb-2.5">Nuestros Servicios</div>
                    <div class="grid grid-cols-1 gap-1.5">
                        @if(isset($navCategoryOrder))
                            @foreach($navCategoryOrder as $catId)
                                @if(isset($catDetails[$catId]))
                                    @php $detail = $catDetails[$catId]; @endphp
                                    <a href="{{ $detail['url'] }}" @click="isMobileOpen = false" class="flex items-center justify-center gap-2.5 p-2 rounded-xl bg-white/[0.02] hover:bg-white/[0.08] text-white/85 hover:text-brand transition-all text-xs sm:text-sm font-semibold">
                                        <span class="w-6 h-6 rounded-md flex items-center justify-center shrink-0" style="background-color: {{ $detail['bg_raw'] }}; color: {{ $detail['color_raw'] }}">
                                            {!! $detail['icon'] !!}
                                        </span>
                                        <span>{{ $detail['label'] }}</span>
                                    </a>
                                @endif
                            @endforeach
                        @endif
                    </div>
                </div>

                <a href="/#galeria" @click="isMobileOpen = false" class="w-full py-1 font-display text-base font-bold text-white/80 hover:text-brand transition-colors">Galería</a>
                <a href="/#testimonios" @click="isMobileOpen = false" class="w-full py-1 font-display text-base font-bold text-white/80 hover:text-brand transition-colors">Testimonios</a>
                <a href="/#faq" @click="isMobileOpen = false" class="w-full py-1 font-display text-base font-bold text-white/80 hover:text-brand transition-colors">Preguntas</a>

                <!-- Portal Link if authenticated -->
                @if(auth()->check() && (auth()->user()->isAdmin() || auth()->user()->isStaff()))
                    <a href="{{ route('admin.dashboard') }}" @click="isMobileOpen = false" class="w-full rounded-full bg-white/10 border border-white/20 px-6 py-2.5 text-center text-xs sm:text-sm font-bold text-white shadow-md flex items-center justify-center gap-2 hover:bg-white/20 transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-brand"><rect width="7" height="9" x="3" y="3" rx="1"/><rect width="7" height="5" x="14" y="3" rx="1"/><rect width="7" height="9" x="14" y="12" rx="1"/><rect width="7" height="5" x="3" y="16" rx="1"/></svg>
                        Mi portal
                    </a>
                @endif

                <!-- CTA Button -->
                <a href="/reserva" @click="isMobileOpen = false" class="w-full rounded-full bg-brand hover:bg-brand-dark px-6 py-3 text-center text-sm sm:text-base font-bold text-white shadow-xl shadow-brand/25 transition-all">
                    Cotiza ahora
                </a>
            </div>

            <!-- Drawer Footer (Social / Contact Info) -->
            <div class="w-full pt-3.5 border-t border-white/10 flex flex-col items-center gap-1.5 text-xs text-white/40 font-light">
                <a href="https://instagram.com/{{ ltrim($profile->instagram ?? 'highcontrastdc', '@') }}" target="_blank" rel="noopener noreferrer" class="text-white/60 hover:text-brand font-medium flex items-center gap-1.5 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-brand"><rect width="20" height="20" x="2" y="2" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" x2="17.51" y1="6.5" y2="6.5"/></svg>
                    <span>{{ '@' . ltrim($profile->instagram ?? 'highcontrastdc', '@') }}</span>
                </a>
                <p class="text-[11px]">© {{ date('Y') }} High Contrast Detailing Center</p>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <main class="min-h-screen">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-[#070707] text-white border-t border-white/10 relative overflow-hidden transition-colors duration-300">
        <!-- Ambient Glow Accent -->
        <div class="absolute -top-24 left-1/2 -translate-x-1/2 w-[800px] h-[300px] bg-brand/10 rounded-full blur-[140px] pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-16 pb-12 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-16">
                <!-- Brand Info -->
                <div class="lg:col-span-1">
                    <div class="flex items-center gap-3.5 mb-5">
                        <div class="w-12 h-12 rounded-2xl bg-white/5 border border-white/15 p-2 flex items-center justify-center shadow-xl backdrop-blur-md">
                            <img src="{{ $profile->logo ? asset($profile->logo) : asset('assets/logos/main-logo.png') }}" alt="{{ $profile->business_name ?? 'High Contrast' }}" class="object-contain w-full h-full">
                        </div>
                        <div>
                            <p class="font-display font-extrabold text-white tracking-tight text-lg">
                                {{ strtoupper($profile->business_name ?? 'High Contrast') }}
                            </p>
                            <p class="text-[9px] tracking-[0.3em] text-brand uppercase font-bold">
                                Detailing Center
                            </p>
                        </div>
                    </div>
                    <p class="text-white/60 text-sm leading-relaxed mb-6 font-light">
                        Centro de detailing automotriz premium en Chicureo. Aplicadores autorizados Gtechniq. Perfección artesanal en cada detalle.
                    </p>
                    <a href="https://instagram.com/{{ ltrim($profile->instagram ?? 'highcontrastdc', '@') }}"
                       target="_blank"
                       rel="noopener noreferrer"
                       class="inline-flex items-center gap-2.5 px-4 py-2 rounded-full bg-white/5 border border-white/15 text-white/80 hover:text-brand hover:bg-white/10 transition-all text-xs font-bold uppercase tracking-wider">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-brand"><rect width="20" height="20" x="2" y="2" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" x2="17.51" y1="6.5" y2="6.5"/></svg>
                        <span>{{ '@' . ltrim($profile->instagram ?? 'highcontrastdc', '@') }}</span>
                    </a>
                </div>

                <!-- Services Links -->
                <div>
                    <h3 class="font-display font-bold text-white mb-5 text-xs uppercase tracking-[0.2em] text-brand">
                        Nuestros Servicios
                    </h3>
                    <ul class="space-y-2.5">
                        <li><a href="/limpieza-y-detallado" class="text-white/60 hover:text-brand transition-colors text-sm font-light">Limpieza & Detallado</a></li>
                        <li><a href="/sellado-ceramico" class="text-white/60 hover:text-brand transition-colors text-sm font-light">Sellado Cerámico Gtechniq</a></li>
                        <li><a href="/pulido-de-autos-santiago" class="text-white/60 hover:text-brand transition-colors text-sm font-light">Corrección de Pintura</a></li>
                        <li><a href="/proteccion-parabrisas-santiago" class="text-white/60 hover:text-brand transition-colors text-sm font-light">Protección ExoShield SPRINT</a></li>
                        <li><a href="/detailing-interior" class="text-white/60 hover:text-brand transition-colors text-sm font-light">Detailing Interior a Vapor</a></li>
                        <li><a href="/tratamiento-ceramico" class="text-white/60 hover:text-brand transition-colors text-sm font-light">Tratamiento Cerámico 9H</a></li>
                        <li><a href="/restauracion-de-focos" class="text-white/60 hover:text-brand transition-colors text-sm font-light">Restauración de Focos</a></li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div>
                    <h3 class="font-display font-bold text-white mb-5 text-xs uppercase tracking-[0.2em] text-brand">
                        Contacto & Ubicación
                    </h3>
                    <ul class="space-y-3.5">
                        <li class="flex items-start gap-3 text-white/60 text-sm font-light">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-brand shrink-0 mt-0.5"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                            <span>{{ ($profile->address_line1 ?? 'Chicureo') . ($profile->address_line2 ? ', ' . $profile->address_line2 : '') . ', ' . ($profile->city ?? 'Colina') }}</span>
                        </li>
                        <li>
                            <a href="tel:{{ preg_replace('/\s+/', '', $profile->phone ?? '+56912345678') }}" class="flex items-center gap-3 text-white/60 hover:text-brand transition-colors text-sm font-light">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-brand shrink-0"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                                {{ $profile->phone ?? '+56 9 1234 5678' }}
                            </a>
                        </li>
                        <li>
                            <a href="mailto:{{ $profile->email ?? 'info@highcontrastdetailing.cl' }}" class="flex items-center gap-3 text-white/60 hover:text-brand transition-colors text-sm font-light">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-brand shrink-0"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                                {{ $profile->email ?? 'info@highcontrastdetailing.cl' }}
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Access Links -->
                <div>
                    <h3 class="font-display font-bold text-white mb-5 text-xs uppercase tracking-[0.2em] text-brand">
                        Acceso Rápido
                    </h3>
                    <ul class="space-y-2.5">
                        <li><a href="/reserva" class="text-white/60 hover:text-brand transition-colors text-sm font-light">Cotizador Online</a></li>
                        <li><a href="/nosotros" class="text-white/60 hover:text-brand transition-colors text-sm font-light">Nuestra Historia</a></li>
                        <li><a href="/#galeria" class="text-white/60 hover:text-brand transition-colors text-sm font-light">Galería de Trabajos</a></li>
                        <li><a href="/#faq" class="text-white/60 hover:text-brand transition-colors text-sm font-light">Preguntas Frecuentes</a></li>
                    </ul>
                </div>
            </div>

            <!-- Footer Bottom with Powered by REW.CL -->
            <div class="pt-8 border-t border-white/10 flex flex-col md:flex-row items-center justify-between gap-4">
                <p class="text-white/40 text-xs font-light">
                    © {{ date('Y') }} <span class="text-brand font-bold tracking-wide">{{ $profile->business_name ?? 'High Contrast Detailing Center' }}</span>. Todos los derechos reservados. Chicureo, Chile.
                </p>
                <div class="flex items-center gap-2 text-xs font-mono text-white/50">
                    <span>Powered by</span>
                    <a href="https://rew.cl" target="_blank" rel="noopener noreferrer" class="text-brand font-extrabold tracking-widest uppercase hover:underline transition-colors">
                        REW.CL
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Left-side Scroll Progress Bar & Go to Top Button -->
    <div x-data="{ 
        scrollProgress: 0, 
        showBackToTop: false,
        updateScroll() {
            const winScroll = window.pageYOffset || document.documentElement.scrollTop;
            const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
            this.scrollProgress = height > 0 ? Math.min(100, Math.max(0, (winScroll / height) * 100)) : 0;
            this.showBackToTop = this.scrollProgress >= 50 || winScroll > 900;
        },
        scrollToTop() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
    }" 
    @scroll.window="updateScroll()" 
    x-init="updateScroll()"
    class="pointer-events-none">
        
        <!-- Vertical Pink Progress Track on Left Edge -->
        <div class="fixed left-0 top-0 bottom-0 w-1 bg-black/10 z-40">
            <div class="w-full bg-brand transition-all duration-100 ease-out shadow-[0_0_10px_#FB2C6B]"
                 :style="`height: ${scrollProgress}%;`"></div>
        </div>

        <!-- Floating 'Go To Top' Anchor at Bottom-Left (Appears when scrolled down) -->
        <div x-show="showBackToTop"
             x-transition:enter="transition ease-out duration-300 transform"
             x-transition:enter-start="opacity-0 -translate-x-6 scale-90"
             x-transition:enter-end="opacity-100 translate-x-0 scale-100"
             x-transition:leave="transition ease-in duration-200 transform"
             x-transition:leave-start="opacity-100 translate-x-0 scale-100"
             x-transition:leave-end="opacity-0 -translate-x-6 scale-90"
             class="fixed bottom-6 left-6 z-40 pointer-events-auto"
             style="display: none;">
            <button @click="scrollToTop()"
                    class="group flex items-center gap-2 px-3.5 py-2.5 rounded-full bg-[#111111]/90 hover:bg-brand text-white border border-white/15 shadow-2xl backdrop-blur-xl transition-all duration-300 hover:scale-105 hover:shadow-brand/40"
                    aria-label="Volver arriba">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-brand group-hover:text-white transition-colors duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                </svg>
                <span class="text-xs font-bold uppercase tracking-wider font-display text-white">Top</span>
            </button>
        </div>
    </div>

    <!-- WhatsApp Floating Button -->
    <div x-data="{ isTooltipOpen: false }" class="fixed bottom-6 right-6 z-50">
        <div x-show="isTooltipOpen"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 translate-y-2 scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 scale-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0 scale-100"
             x-transition:leave-end="opacity-0 translate-y-2 scale-95"
             class="absolute bottom-full right-0 mb-3 w-72"
             style="display: none;">
            <div class="p-5 rounded-2xl bg-[#1A1A1A] border border-white/10 shadow-2xl shadow-black/50">
                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center gap-2">
                        <div class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></div>
                        <span class="text-white font-semibold text-sm">High Contrast</span>
                    </div>
                    <button @click="isTooltipOpen = false" class="text-white/30 hover:text-white/60 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                    </button>
                </div>
                <p class="text-white/50 text-sm mb-4 leading-relaxed">
                    ¡Hola! 👋 ¿Necesitas cotizar un servicio? Escríbenos por WhatsApp y te respondemos en minutos.
                </p>
                <a href="https://wa.me/{{ $whatsappNumber }}?text={{ $whatsappMsg }}"
                   target="_blank"
                   rel="noopener noreferrer"
                   class="flex items-center justify-center gap-2 w-full px-4 py-3 bg-[#25D366] hover:bg-[#20BD5A] text-white font-semibold rounded-xl transition-all duration-300 text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg>
                    Abrir conversación
                </a>
            </div>
            <div class="absolute bottom-0 right-6 translate-y-1/2 w-3 h-3 bg-[#1A1A1A] border-r border-b border-white/10 rotate-45"></div>
        </div>

        <button @click="isTooltipOpen = !isTooltipOpen"
                class="w-14 h-14 rounded-full bg-[#25D366] hover:bg-[#20BD5A] flex items-center justify-center shadow-lg shadow-[#25D366]/30 transition-all duration-300 group relative"
                aria-label="WhatsApp">
            <svg x-show="isTooltipOpen" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white" style="display: none;"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
            <svg x-show="!isTooltipOpen" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg>
        </button>

        <span x-show="!isTooltipOpen" class="absolute top-0 right-0 flex h-3 w-3">
            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-[#25D366] opacity-75"></span>
            <span class="relative inline-flex rounded-full h-3 w-3 bg-[#25D366]"></span>
        </span>
    </div>

    <!-- Brand Mouse Cursor Follower Dot -->
    <div id="brand-cursor-dot" class="pointer-events-none fixed top-0 left-0"></div>
    <script>
        (function() {
            if (window.matchMedia('(hover: none) or (pointer: coarse)').matches) return;
            
            const dot = document.getElementById('brand-cursor-dot');
            if (!dot) return;

            let mouseX = -100;
            let mouseY = -100;
            let currentX = mouseX;
            let currentY = mouseY;
            let isVisible = false;

            window.addEventListener('mousemove', function(e) {
                mouseX = e.clientX;
                mouseY = e.clientY;
                if (!isVisible) {
                    isVisible = true;
                    dot.classList.add('active');
                }
            });

            document.addEventListener('mouseleave', function() {
                isVisible = false;
                dot.classList.remove('active');
            });

            document.addEventListener('mouseover', function(e) {
                const target = e.target.closest('a, button, input, select, textarea, [role="button"], .interactive, .cursor-pointer');
                if (target) {
                    dot.classList.add('hovered');
                } else {
                    dot.classList.remove('hovered');
                }
            });

            function animateCursor() {
                if (isVisible) {
                    currentX += (mouseX - currentX) * 0.18;
                    currentY += (mouseY - currentY) * 0.18;
                    dot.style.left = currentX.toFixed(2) + 'px';
                    dot.style.top = currentY.toFixed(2) + 'px';
                }
                requestAnimationFrame(animateCursor);
            }

            requestAnimationFrame(animateCursor);
        })();
    </script>

    @if($profile && !empty($profile->footer_scripts))
        {!! $profile->footer_scripts !!}
    @endif

    @yield('scripts')
    @stack('scripts')
</body>
</html>

