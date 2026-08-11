@extends('layouts.public')

@section('title', 'Protección de Parabrisas en Santiago | ExoShield SPRINT')
@section('meta_description', 'Especialistas en protección de parabrisas en Santiago. Tecnología ExoShield SPRINT TPU. Claridad excepcional para vehículos de uso ocasional. ¡Cotiza tu instalación!')
@section('meta_keywords', 'proteccion de parabrisas santiago, exoshield santiago, exoshield sprint chile, evitar trizaduras parabrisas, pelicula protectora parabrisas, exoshield chicureo')

@section('content')
<main class="bg-white dark:bg-surface-900 text-black dark:text-white transition-colors duration-300">
    
    <!-- Hero Section -->
    <section class="relative min-h-screen flex items-center justify-center overflow-hidden bg-black">
        <div class="absolute inset-0">
            <img src="/assets/images/exoshield/hero.jpg" alt="ExoShield Installation" class="w-full h-full object-cover opacity-60">
            <div class="absolute inset-0 bg-gradient-to-t from-black via-black/50 to-transparent"></div>
        </div>

        <div class="container-custom relative z-10 text-center px-4 fade-in-up mt-20">
            <div class="flex flex-col items-center justify-center max-w-4xl mx-auto">
                <span class="text-brand font-bold uppercase tracking-[0.25em] text-sm mb-6">THE HIGH-END WINDSHIELD PROTECTION FILM</span>
                <img src="/assets/images/exoshield/sprint-logo.png" alt="ExoShield SPRINT" class="h-12 md:h-20 object-contain mb-8">
                
                <h1 class="font-display text-4xl md:text-6xl font-black text-white mb-6 leading-tight">
                    The High-End Vehicle <br> Windshield Protection Film
                </h1>
                <p class="text-white/80 text-xl font-light mb-12 max-w-2xl mx-auto">
                    ExoShield SPRINT está diseñado con una claridad excepcional, estableciendo un nuevo estándar en protección de poliuretano (TPU) para parabrisas. Ideal para deportivos, conductores de fin de semana y vehículos de bajo kilometraje.
                </p>
                
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="/reserva?service=proteccion-exoshield" class="px-10 py-4 bg-brand text-white font-bold text-sm tracking-widest uppercase hover:bg-white hover:text-black transition-all rounded-full">
                        COTIZAR INSTALACIÓN
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Why SPRINT Section -->
    <section class="py-24 bg-white dark:bg-black transition-colors">
        <div class="container-custom">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div>
                    <img src="/assets/images/exoshield/sprint-logo.png" alt="SPRINT Logo" class="h-10 object-contain mb-6 invert dark:invert-0 opacity-80">
                    <h2 class="font-display text-3xl md:text-4xl font-bold mb-6">
                        <strong>Por qué SPRINT es el estándar High-End.</strong>
                    </h2>
                    <div class="space-y-4 text-black/70 dark:text-white/70 text-lg font-light leading-relaxed">
                        <p>
                            Diseñado para ofrecer una claridad excepcional y una calidad superior, SPRINT es la película de protección de parabrisas (TPU) definitiva. Es la solución perfecta para quienes disfrutan de los fines de semana al volante con total tranquilidad.
                        </p>
                        <p>
                            Con una década de innovación detrás, SPRINT incorpora lo mejor de la tecnología TPU, garantizando que tengas una visión cristalina mientras mantienes tu parabrisas a salvo de impactos e imperfecciones.
                        </p>
                    </div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div class="p-8 bg-gray-50 dark:bg-surface-800 rounded-xl border border-black/5 dark:border-white/5">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-brand mb-4"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                        <h4 class="font-bold mb-2">Garantía de 1 Año</h4>
                        <p class="text-sm text-black/60 dark:text-white/60">Cobertura oficial contra decoloración, grietas, ampollas y deslaminación.</p>
                    </div>
                    <div class="p-8 bg-gray-50 dark:bg-surface-800 rounded-xl border border-black/5 dark:border-white/5">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-brand mb-4"><circle cx="12" cy="12" r="10"/><path d="M12 2a14.5 14.5 0 0 0 0 20 14.5 14.5 0 0 0 0-20"/><path d="M2 12h20"/></svg>
                        <h4 class="font-bold mb-2">Óptica Cristalina</h4>
                        <p class="text-sm text-black/60 dark:text-white/60">Estándares de visibilidad de alta gama, manteniendo una visión clara y sin distorsión.</p>
                    </div>
                    <div class="p-8 bg-gray-50 dark:bg-surface-800 rounded-xl border border-black/5 dark:border-white/5">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-brand mb-4"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="4"/><line x1="21.17" x2="12" y1="8" y2="8"/><line x1="3.95" x2="8.54" y1="6.06" y2="14"/><line x1="10.88" x2="15.46" y1="21.94" y2="14"/></svg>
                        <h4 class="font-bold mb-2">Base TPU</h4>
                        <p class="text-sm text-black/60 dark:text-white/60">Poliuretano termoplástico de última generación que se adapta a las curvas.</p>
                    </div>
                    <div class="p-8 bg-gray-50 dark:bg-surface-800 rounded-xl border border-black/5 dark:border-white/5">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-brand mb-4"><path d="M12 2v20"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                        <h4 class="font-bold mb-2">Instalación Eficiente</h4>
                        <p class="text-sm text-black/60 dark:text-white/60">Aplicación segura que garantiza un acabado invisible sobre el cristal.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Comparison Table -->
    <section class="py-24 bg-gray-50 dark:bg-surface-900 transition-colors">
        <div class="container-custom max-w-5xl">
            <div class="text-center mb-16">
                <span class="text-brand text-xs font-bold tracking-[0.2em] uppercase mb-4 block">Comparativa</span>
                <h2 class="font-display text-3xl md:text-5xl font-bold mb-4">
                    Comparativa de <strong>Películas de Protección</strong>
                </h2>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr>
                            <th class="p-6 border-b border-black/10 dark:border-white/10"></th>
                            <th class="p-6 border-b border-black/10 dark:border-white/10 font-bold uppercase tracking-wider text-brand">ExoShield SPRINT</th>
                            <th class="p-6 border-b border-black/10 dark:border-white/10 font-bold uppercase tracking-wider text-black/50 dark:text-white/50 text-sm">Competidor TPU</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm md:text-base">
                        <!-- Performance -->
                        <tr class="bg-black/5 dark:bg-white/5"><td colspan="3" class="p-3 font-bold uppercase tracking-widest text-xs">Desempeño</td></tr>
                        <tr>
                            <td class="p-6 border-b border-black/5 dark:border-white/5 font-semibold">Material Base</td>
                            <td class="p-6 border-b border-black/5 dark:border-white/5 font-bold">TPU (Poliuretano) Premium</td>
                            <td class="p-6 border-b border-black/5 dark:border-white/5 text-black/60 dark:text-white/60">TPU Estándar</td>
                        </tr>
                        <tr>
                            <td class="p-6 border-b border-black/5 dark:border-white/5 font-semibold">Claridad Óptica</td>
                            <td class="p-6 border-b border-black/5 dark:border-white/5 font-bold">Excelente (Sin Distorsión)</td>
                            <td class="p-6 border-b border-black/5 dark:border-white/5 text-black/60 dark:text-white/60">Moderada</td>
                        </tr>
                        
                        <!-- Durability -->
                        <tr class="bg-black/5 dark:bg-white/5"><td colspan="3" class="p-3 font-bold uppercase tracking-widest text-xs">Durabilidad y Respaldo</td></tr>
                        <tr>
                            <td class="p-6 border-b border-black/5 dark:border-white/5 font-semibold">Garantía</td>
                            <td class="p-6 border-b border-black/5 dark:border-white/5 font-bold text-brand">1 año integral</td>
                            <td class="p-6 border-b border-black/5 dark:border-white/5 text-black/60 dark:text-white/60">Variable / Sin Garantía</td>
                        </tr>
                        <tr>
                            <td class="p-6 border-b border-black/5 dark:border-white/5 font-semibold">Instalación</td>
                            <td class="p-6 border-b border-black/5 dark:border-white/5 font-bold text-brand">Sin aplicación de calor térmico intensivo</td>
                            <td class="p-6 border-b border-black/5 dark:border-white/5 text-black/60 dark:text-white/60">Termoformado requerido</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- Supported Models (Renders) -->
    <section class="py-24 bg-white dark:bg-black transition-colors">
        <div class="container-custom">
            <div class="text-center mb-16">
                <h2 class="font-display text-3xl font-bold mb-4">Ideal para Vehículos de Alta Gama</h2>
                <p class="text-black/60 dark:text-white/60">Especialmente diseñado para deportivos y modelos de uso exclusivo o fin de semana.</p>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <div class="flex flex-col items-center group">
                    <img src="/assets/images/exoshield/tesla.png" alt="Tesla Model 3" class="h-40 object-contain mb-4 group-hover:scale-110 transition-transform">
                    <span class="font-bold text-sm text-black/50 dark:text-white/50">Vehículos Eléctricos</span>
                </div>
                <div class="flex flex-col items-center group">
                    <img src="/assets/images/exoshield/porsche.png" alt="Porsche 911" class="h-40 object-contain mb-4 group-hover:scale-110 transition-transform">
                    <span class="font-bold text-sm text-black/50 dark:text-white/50">Deportivos de Alta Gama</span>
                </div>
                <div class="flex flex-col items-center group">
                    <img src="/assets/images/exoshield/bronco.png" alt="Off-Road" class="h-40 object-contain mb-4 group-hover:scale-110 transition-transform">
                    <span class="font-bold text-sm text-black/50 dark:text-white/50">4x4 y Off-Road Moderado</span>
                </div>
                <div class="flex flex-col items-center group">
                    <img src="/assets/images/exoshield/f-series.png" alt="Pickup" class="h-40 object-contain mb-4 group-hover:scale-110 transition-transform">
                    <span class="font-bold text-sm text-black/50 dark:text-white/50">Pickups de Lujo</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section id="precios" class="py-24 bg-gray-50 dark:bg-surface-900 border-t border-black/5 dark:border-white/5 transition-colors">
        <div class="container-custom">
            <div class="text-center mb-16">
                <span class="text-brand text-xs font-bold tracking-[0.2em] uppercase mb-4 block">Cotiza tu Instalación</span>
                <h2 class="font-display text-4xl md:text-5xl font-bold mb-6">Inversión en Seguridad</h2>
            </div>

            @php
                $srv = $services->get('proteccion-exoshield');
            @endphp

            @if($srv)
                <div class="max-w-xl mx-auto">
                    <div class="bg-white dark:bg-black p-10 rounded-2xl border border-brand shadow-lg shadow-brand/10 flex flex-col relative transition-colors">
                        <span class="absolute -top-3 left-1/2 -translate-x-1/2 bg-brand text-white text-[10px] font-bold uppercase tracking-widest px-4 py-1 rounded-full">Recomendado</span>
                        <h3 class="text-2xl font-bold mb-3">{{ $srv->name }}</h3>
                        <p class="text-black/60 dark:text-white/60 text-sm mb-8 html-content">{!! $srv->short_description !!}</p>
                        
                        <div class="space-y-3 mb-8">
                            @foreach($vehicleTypes as $vt)
                                @php
                                    // Skip moto
                                    if ($vt->slug === 'moto') continue;
                                @endphp
                                <div class="flex justify-between items-center p-3 bg-gray-50 dark:bg-surface-800 rounded-lg">
                                    <span class="text-sm font-medium">{{ $vt->name }}</span>
                                    <span class="font-bold">
                                        {{ $onlinePaymentsActive ? '$'.number_format($srv->getPriceForVehicleType($vt->id), 0, ',', '.') : 'Cotizar' }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                        
                        @php
                            preg_match_all('/<(p|li)[^>]*>(.*?)<\/\1>/s', $srv->long_description, $matches);
                            $features = !empty($matches[2]) ? array_filter(array_map('trim', $matches[2])) : [];
                            if (empty($features)) {
                                $features = array_filter(array_map('trim', explode("\n", $srv->long_description)));
                            }
                        @endphp
                        <ul class="space-y-3 mb-8 flex-grow">
                            @foreach($features as $f)
                                <li class="flex items-center gap-3 text-sm text-black/70 dark:text-white/70">
                                    <svg class="text-brand w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                    <span class="html-content">{!! $f !!}</span>
                                </li>
                            @endforeach
                        </ul>
                        
                        <a href="/reserva?service={{ $srv->slug }}" class="text-center w-full py-4 font-bold text-sm uppercase tracking-widest transition-all bg-brand text-white hover:bg-brand-dark rounded-full">
                            Cotizar Instalación
                        </a>
                    </div>
                </div>
            @else
                @php
                    $packages = [
                        [
                            'id' => 'proteccion-exoshield',
                            'name' => 'Protección ExoShield SPRINT',
                            'desc' => 'Instalación profesional del film de TPU en el parabrisas frontal. Protege contra impactos de piedras.',
                            'features' => ['Material TPU de alta gama', '1 año de Garantía Oficial', 'Claridad óptica inigualable', 'Aplicación libre de distorsión'],
                            'prices' => ['autos' => 180000, 'medianos' => 210000, 'grandes' => 250000],
                            'popular' => true
                        ]
                    ];
                @endphp

                <div class="grid grid-cols-1 gap-8 max-w-xl mx-auto">
                    @foreach($packages as $pkg)
                        <div class="bg-white dark:bg-black p-10 rounded-2xl border border-brand shadow-lg shadow-brand/10 flex flex-col relative transition-colors">
                            <span class="absolute -top-3 left-1/2 -translate-x-1/2 bg-brand text-white text-[10px] font-bold uppercase tracking-widest px-4 py-1 rounded-full">Recomendado</span>
                            <h3 class="text-2xl font-bold mb-3">{{ $pkg['name'] }}</h3>
                            <p class="text-black/60 dark:text-white/60 text-sm mb-8">{{ $pkg['desc'] }}</p>
                            
                            <div class="space-y-3 mb-8">
                                @foreach([
                                    ['id' => 'autos', 'label' => 'Hatchback / Sedán'],
                                    ['id' => 'medianos', 'label' => 'SUV / Crossover'],
                                    ['id' => 'grandes', 'label' => 'Pickup / 4x4']
                                ] as $type)
                                    <div class="flex justify-between items-center p-3 bg-gray-50 dark:bg-surface-800 rounded-lg">
                                        <span class="text-sm font-medium">{{ $type['label'] }}</span>
                                        <span class="font-bold">
                                            {{ $onlinePaymentsActive ? '$'.number_format($pkg['prices'][$type['id']], 0, ',', '.') : 'Cotizar' }}
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                            
                            <ul class="space-y-3 mb-8 flex-grow">
                                @foreach($pkg['features'] as $f)
                                    <li class="flex items-center gap-3 text-sm text-black/70 dark:text-white/70">
                                        <svg class="text-brand w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                        {{ $f }}
                                    </li>
                                @endforeach
                            </ul>
                            
                            <a href="/reserva?service={{ $pkg['id'] }}" class="text-center w-full py-4 font-bold text-sm uppercase tracking-widest transition-all bg-brand text-white hover:bg-brand-dark rounded-full">
                                Cotizar Instalación
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    <!-- SEO Interlinking -->
    <section class="py-12 bg-black text-white/50 text-center text-xs">
        <div class="container-custom">
            <p>
                High Contrast Detailing es instalador autorizado. Conoce más sobre la tecnología SPRINT en la web oficial de <a href="https://www.getexoshield.com/products/windshield-protection-film-sprint" target="_blank" rel="dofollow" class="text-brand hover:underline">ExoShield</a>.
            </p>
        </div>
    </section>

</main>

@endsection

@section('scripts')
@include('partials.schema-proteccion')
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
