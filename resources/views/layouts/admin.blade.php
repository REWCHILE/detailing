<!DOCTYPE html>
<html lang="es" x-data="{ 
    theme: localStorage.getItem('admin_theme') || 'light',
    sidebarOpen: false
}" :class="theme">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel | High Contrast Detailing')</title>
    @php
        $faviconProfile = \App\Models\BusinessProfile::first();
    @endphp
    <link rel="icon" type="image/png" href="{{ $faviconProfile && $faviconProfile->logo ? asset($faviconProfile->logo) : asset('assets/logos/main-logo.png') }}">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @yield('styles')
    
    <script>
        if (localStorage.getItem('admin_theme') === 'dark') {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
    
    <style>
        /* Premium Admin Styling & Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(12px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-4px); }
        }

        .animate-fade-in {
            animation: fadeIn 0.4s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }
        
        /* Stats & Cards Glassmorphism and Hover */
        .premium-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .dark .premium-card {
            background: rgba(17, 17, 17, 0.45);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }
        
        .premium-card:hover {
            transform: translateY(-6px);
            border-color: rgba(232, 80, 138, 0.3);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05), 0 10px 10px -5px rgba(232, 80, 138, 0.03);
        }
        
        .dark .premium-card:hover {
            box-shadow: 0 20px 30px -10px rgba(0, 0, 0, 0.5), 0 0 20px 2px rgba(232, 80, 138, 0.05);
        }

        /* Icon hover animations in cards */
        .premium-card:hover .stat-icon {
            animation: float 2.5s ease-in-out infinite;
            background-color: rgba(232, 80, 138, 0.2) !important;
            color: #E8508A !important;
        }
        
        /* Sidebar Navigation Premium Layout */
        .sidebar-link {
            position: relative;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid transparent;
        }
        
        .sidebar-link::before {
            content: '';
            position: absolute;
            left: 0;
            top: 25%;
            height: 50%;
            width: 3px;
            background-color: #E8508A;
            border-radius: 0 4px 4px 0;
            transform: scaleY(0);
            transition: transform 0.2s ease;
        }
        
        .sidebar-link.active::before,
        .sidebar-link:hover::before {
            transform: scaleY(1);
        }
        
        .sidebar-link.active {
            background: rgba(232, 80, 138, 0.08) !important;
            border-color: rgba(232, 80, 138, 0.15) !important;
            color: #E8508A !important;
        }
        
        .sidebar-link {
            color: rgba(0, 0, 0, 0.5);
        }
        .dark .sidebar-link {
            color: rgba(255, 255, 255, 0.5);
        }
        
        .sidebar-link:hover {
            background: rgba(0, 0, 0, 0.02);
            color: #E8508A;
        }
        
        .dark .sidebar-link:hover {
            background: rgba(255, 255, 255, 0.02);
            color: #E8508A;
        }
        
        .sidebar-link:hover svg {
            transform: scale(1.1) rotate(3deg);
            transition: transform 0.25s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        
        .sidebar-link svg {
            transition: transform 0.25s ease;
        }
        
        /* Table hover styles */
        .premium-table tbody tr {
            transition: all 0.2s ease;
        }
        .premium-table tbody tr:hover {
            background-color: rgba(232, 80, 138, 0.01) !important;
        }
        .dark .premium-table tbody tr:hover {
            background-color: rgba(232, 80, 138, 0.02) !important;
        }
        
        /* Custom scrollbar for sidebar menu */
        aside nav::-webkit-scrollbar {
            width: 4px;
        }
        aside nav::-webkit-scrollbar-track {
            background: transparent;
        }
        aside nav::-webkit-scrollbar-thumb {
            background: rgba(232, 80, 138, 0.25);
            border-radius: 4px;
        }
        aside nav::-webkit-scrollbar-thumb:hover {
            background: #E8508A;
        }
    </style>
</head>
<body class="antialiased bg-gray-100 text-black dark:bg-[#0A0A0A] dark:text-[#F5F5F5] transition-colors duration-300">
    <div class="min-h-screen flex">
        <!-- Sidebar for Desktop -->
        <aside class="hidden lg:flex w-64 shrink-0 flex-col bg-white dark:bg-[#111111] border-r border-black/5 dark:border-white/5 sticky top-0 h-screen transition-colors duration-300 z-10">
            <div class="p-6 border-b border-black/5 dark:border-white/5">
                <a href="/" class="flex items-center gap-3 group">
                    <div class="w-8 h-8 relative shrink-0">
                        <img src="{{ $shopProfile->logo ? asset($shopProfile->logo) : asset('assets/logos/main-logo.png') }}" alt="{{ $shopProfile->business_name }}" class="object-contain w-full h-full">
                    </div>
                    <div>
                        <p class="font-display font-bold text-black dark:text-white text-sm leading-tight transition-colors uppercase">
                            {{ $shopProfile->business_name }}
                        </p>
                        <p class="text-[8px] tracking-[0.2em] text-black/40 dark:text-white/40 uppercase font-medium">
                            Admin Panel
                        </p>
                    </div>
                </a>
            </div>

            @php
                $currentRoute = request()->path();
                $navItems = [
                    ['href' => 'admin', 'label' => 'Dashboard', 'icon' => '<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="9" rx="1"/><rect x="14" y="3" width="7" height="5" rx="1"/><rect x="14" y="12" width="7" height="9" rx="1"/><rect x="3" y="16" width="7" height="5" rx="1"/></svg>'],
                    ['href' => 'admin/calendario', 'label' => 'Calendario', 'icon' => '<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>'],
                    ['href' => 'admin/citas', 'label' => 'Citas', 'icon' => '<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>'],
                    ['href' => 'admin/leads', 'label' => 'Leads Cotizador', 'icon' => '<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>'],
                    ['href' => 'admin/clientes', 'label' => 'Clientes', 'icon' => '<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>'],
                    ['href' => 'admin/servicios', 'label' => 'Servicios', 'icon' => '<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><circle cx="12" cy="12" r="3"/></svg>'],
                    ['href' => 'admin/extras', 'label' => 'Extras', 'icon' => '<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>'],
                    ['href' => 'admin/vehiculos', 'label' => 'Vehículos', 'icon' => '<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/></svg>'],
                    ['href' => 'admin/pasarelas', 'label' => 'Pagos / MP', 'icon' => '<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>'],
                    ['href' => 'admin/paginas', 'label' => 'Páginas', 'icon' => '<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>'],
                    ['href' => 'admin/sliders', 'label' => 'Carrusel Hero', 'icon' => '<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>'],
                    ['href' => 'admin/seguridad', 'label' => 'Seguridad', 'icon' => '<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>'],
                    ['href' => 'admin/configuracion', 'label' => 'Configuración', 'icon' => '<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><circle cx="12" cy="12" r="3"/></svg>'],
                    ['href' => 'admin/documentacion', 'label' => 'Manual', 'icon' => '<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.168.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>'],
                ];
            @endphp

            <nav class="flex-1 p-4 space-y-1 overflow-y-auto">
                @foreach($navItems as $item)
                    @php
                        $isActive = ($currentRoute === $item['href']) || ($item['href'] === 'admin' && $currentRoute === 'admin');
                    @endphp
                    <a href="/{{ $item['href'] }}"
                       class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium {{ $isActive ? 'active' : '' }}">
                        {!! $item['icon'] !!}
                        {{ $item['label'] }}
                    </a>
                @endforeach
            </nav>

            <div class="mt-auto p-4 border-t border-black/5 dark:border-white/5 space-y-3 bg-white/95 dark:bg-[#111111]/95 backdrop-blur-sm">
                <a href="/"
                   class="w-full flex items-center justify-center gap-2 rounded-xl border border-brand/25 bg-brand/10 px-4 py-3 text-sm font-semibold text-brand hover:bg-brand/20 transition-all shadow-lg shadow-brand/10">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                    Volver al sitio
                </a>
                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <button type="submit"
                            class="w-full flex items-center justify-center gap-2 rounded-xl border border-red-500/25 bg-red-500/12 px-4 py-3 text-sm font-semibold text-red-600 dark:text-red-400 hover:bg-red-500/20 transition-all shadow-lg shadow-red-950/20">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        Cerrar sesión
                    </button>
                </form>
            </div>
        </aside>

        <!-- Mobile Sidebar Panel -->
        <div x-show="sidebarOpen" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="fixed inset-0 bg-black/60 z-40 lg:hidden" style="display: none;" @click="sidebarOpen = false"></div>
        <aside x-show="sidebarOpen" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full" class="fixed top-0 left-0 bottom-0 w-64 bg-white dark:bg-[#111111] border-r border-black/5 dark:border-white/5 z-50 flex flex-col lg:hidden" style="display: none;">
            <div class="p-6 flex items-center justify-between border-b border-black/5 dark:border-white/5">
                <span class="font-display font-bold text-black dark:text-white text-sm">Administración</span>
                <button @click="sidebarOpen = false" class="text-black/50 dark:text-white/50">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            <nav class="p-4 space-y-1 overflow-y-auto flex-1">
                @foreach($navItems as $item)
                    @php
                        $isActive = ($currentRoute === $item['href']) || ($item['href'] === 'admin' && $currentRoute === 'admin');
                    @endphp
                    <a href="/{{ $item['href'] }}"
                       @click="sidebarOpen = false"
                       class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium {{ $isActive ? 'active' : '' }}">
                        {!! $item['icon'] !!}
                        {{ $item['label'] }}
                    </a>
                @endforeach
            </nav>
            <div class="p-4 border-t border-black/5 dark:border-white/5 bg-white/95 dark:bg-[#111111]/95 backdrop-blur-sm space-y-3">
                <a href="/"
                   class="w-full flex items-center justify-center gap-2 rounded-xl border border-brand/25 bg-brand/10 px-4 py-3 text-sm font-semibold text-brand hover:bg-brand/20 transition-all shadow-lg shadow-brand/10">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                    Volver al sitio
                </a>
                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <button type="submit"
                            class="w-full flex items-center justify-center gap-2 rounded-xl border border-red-500/25 bg-red-500/12 px-4 py-3 text-sm font-semibold text-red-600 dark:text-red-400 hover:bg-red-500/20 transition-all shadow-lg shadow-red-950/20">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        Cerrar sesión
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Workspace Shell -->
        <div class="flex-1 min-w-0 flex flex-col relative z-20">
            <!-- Header bar -->
            <header class="sticky top-0 z-10 bg-white/95 dark:bg-[#0A0A0A]/95 backdrop-blur-lg border-b border-black/5 dark:border-white/5 px-6 py-4 transition-colors duration-300">
                <div class="flex items-center justify-between gap-4">
                    <div class="flex items-center gap-4">
                        <button @click="sidebarOpen = true" class="lg:hidden text-black/60 dark:text-white/60" aria-label="Menu">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/></svg>
                        </button>
                        <h1 class="font-display font-bold text-black dark:text-white text-lg md:text-xl transition-colors">
                            @yield('title_section', 'Dashboard')
                        </h1>
                    </div>
                    
                    <div class="flex items-center gap-4">
                        <!-- Dark mode toggler -->
                        <button @click="
                            theme = theme === 'dark' ? 'light' : 'dark';
                            localStorage.setItem('admin_theme', theme);
                            if (theme === 'dark') {
                                document.documentElement.classList.add('dark');
                            } else {
                                document.documentElement.classList.remove('dark');
                            }
                        " class="p-2 rounded-full hover:bg-black/5 dark:hover:bg-white/5 transition-all text-black/60 dark:text-white/60">
                            <svg x-show="theme === 'dark'" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-yellow-400"><circle cx="12" cy="12" r="4"/><path d="M12 2v2"/><path d="M12 20v2"/><path d="m4.93 4.93 1.41 1.41"/><path d="m17.66 17.66 1.41 1.41"/><path d="M2 12h2"/><path d="M20 12h2"/><path d="m6.34 17.66-1.41 1.41"/><path d="m19.07 4.93-1.41 1.41"/></svg>
                            <svg x-show="theme === 'light'" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-slate-700" style="display: none;"><path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z"/></svg>
                        </button>

                        <div class="hidden sm:block text-right border-l border-black/5 dark:border-white/5 pl-4">
                            <p class="text-black dark:text-white text-sm font-semibold transition-colors">{{ Auth::user()->name ?? 'Administrador' }}</p>
                            <p class="text-black/40 dark:text-white/30 text-[9px] font-bold uppercase tracking-[0.2em]">Sesión Activa</p>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 p-6 lg:p-8 bg-gray-50 dark:bg-surface-900/10 min-h-0 overflow-y-auto animate-fade-in relative z-20">
                @yield('content')
            </main>
        </div>
    </div>

    @yield('scripts')
    @stack('scripts')
</body>
</html>
