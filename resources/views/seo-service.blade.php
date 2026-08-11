@extends('layouts.public')

@section('title', $title . ' | High Contrast Detailing Center')
@section('meta_description', $description)

@php
    $serviceKeywords = [
        'detailing-interior' => 'detailing interior santiago, limpieza de tapiz chicureo, lavado de alfombras autos, limpieza tapizado colina, desinfeccion ozono auto, detailing santiago',
        'ceramico' => 'tratamiento ceramico santiago, ceramic coating chile, sellado ceramico 9h colina, proteccion pintura autos santiago, detallado ceramico, coating 9H santiago',
        'restauracion-focos' => 'restauracion de focos santiago, pulido de focos colina, opticas opacas auto, pulido de opticas santiago, pulir focos chicureo, restaurar focos'
    ];
    $keywords = $serviceKeywords[$serviceId ?? ''] ?? 'car detailing, detailing premium, detailing santiago, detailing chicureo';
@endphp
@section('meta_keywords', $keywords)

@section('content')
<main class="overflow-hidden bg-white dark:bg-surface-900 text-black dark:text-white transition-colors duration-300">
    <!-- Hero Section -->
    <section class="pt-32 pb-20 relative overflow-hidden bg-gray-50 dark:bg-surface-900 transition-colors">
        <div class="absolute inset-0 bg-gradient-to-b from-brand/5 to-transparent"></div>
        <div class="container-custom relative z-10">
            <div class="max-w-3xl">
                <p class="text-brand text-sm font-semibold tracking-[0.2em] uppercase mb-4">
                    {{ $subtitle }}
                </p>
                <h1 class="font-display text-4xl md:text-6xl font-bold text-black dark:text-white mb-6 leading-tight transition-colors">
                    {{ $title }}
                </h1>
                <p class="text-black/70 dark:text-white/60 text-lg leading-relaxed mb-8 transition-colors">
                    {{ $description }}
                </p>
                
                <div class="flex flex-wrap items-center gap-6 mb-8">
                    @php
                        $profile = \App\Models\BusinessProfile::first();
                        $showPayments = $profile ? ($profile->payment_gateway_enabled || $profile->show_prices) : false;
                    @endphp
                    
                    @if($showPayments && isset($priceFrom))
                        <div class="flex items-center gap-2">
                            <span class="text-black/50 dark:text-white/40 text-sm">Desde</span>
                            <span class="text-brand font-display text-3xl font-bold">
                                ${{ number_format($priceFrom, 0, ',', '.') }} CLP
                            </span>
                        </div>
                    @else
                        <div class="flex items-center gap-2">
                            <span class="text-brand font-display text-2xl font-bold">
                                Cotización a convenir
                            </span>
                        </div>
                    @endif
                    
                    <div class="flex items-center gap-2 text-black/50 dark:text-white/40 text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-brand"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        {{ $estimatedTime }}
                    </div>
                </div>
                
                <a href="/reserva?servicio={{ $serviceId ?? '' }}" class="inline-flex items-center gap-2 px-8 py-4 bg-brand hover:bg-brand-dark text-white font-semibold rounded-full transition-all duration-300 shadow-lg shadow-brand/30 hover:shadow-brand/50">
                    {{ $ctaText }}
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" x2="19" y1="12" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="section-padding bg-gray-100/50 dark:bg-surface-800/30 transition-colors border-y border-black/5 dark:border-white/5">
        <div class="container-custom">
            <div>
                <h2 class="font-display text-2xl md:text-4xl font-bold text-black dark:text-white mb-12 transition-colors">
                    Qué incluye el <span class="text-gradient">servicio</span>
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($features as $i => $feature)
                        <div class="flex items-start gap-3 p-4 rounded-xl hover:bg-black/5 dark:hover:bg-white/[0.02] transition-colors">
                            <div class="w-6 h-6 rounded-full bg-brand/10 flex items-center justify-center shrink-0 mt-0.5">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-brand"><polyline points="20 6 9 17 4 12"/></svg>
                            </div>
                            <span class="text-black/80 dark:text-white/70 text-sm transition-colors">{{ $feature }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- Benefits Section -->
    <section class="section-padding bg-white dark:bg-surface-900 transition-colors">
        <div class="container-custom">
            <h2 class="font-display text-2xl md:text-4xl font-bold text-black dark:text-white mb-12 transition-colors">
                Beneficios <span class="text-gradient">para ti</span>
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($benefits as $i => $benefit)
                    @php
                        // Map icons matching Shield, Sparkles, Award
                        $iconPaths = [
                            // Shield
                            '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-brand"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>',
                            // Sparkles
                            '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-brand"><path d="m12 3-1.912 5.886L4 9l4.912.863L12 15l1.912-5.137L20 9l-4.912-.114z"/></svg>',
                            // Award
                            '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-brand"><circle cx="12" cy="8" r="7"/><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"/></svg>'
                        ];
                        $icon = $iconPaths[$i] ?? $iconPaths[0];
                    @endphp
                    <div class="p-6 rounded-2xl bg-gray-50 dark:bg-surface-800/50 border border-black/5 dark:border-white/5 hover:border-brand/20 dark:hover:border-brand/20 transition-all shadow-sm hover:shadow-md dark:shadow-none">
                        <div class="w-12 h-12 rounded-xl bg-brand/10 flex items-center justify-center mb-4">
                            {!! $icon !!}
                        </div>
                        <h3 class="font-display font-bold text-black dark:text-white text-lg mb-2 transition-colors">
                            {{ $benefit['title'] }}
                        </h3>
                        <p class="text-black/60 dark:text-white/50 text-sm leading-relaxed transition-colors">
                            {{ $benefit['description'] }}
                        </p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 relative bg-gray-50 dark:bg-surface-900 border-t border-black/5 dark:border-white/5 transition-colors">
        <div class="absolute inset-0 bg-gradient-to-b from-transparent via-brand/5 to-transparent"></div>
        <div class="container-custom relative z-10 text-center">
            <h2 class="font-display text-3xl md:text-5xl font-bold text-black dark:text-white mb-6 transition-colors">
                ¿Listo para comenzar?
            </h2>
            <p class="text-black/60 dark:text-white/50 text-lg max-w-xl mx-auto mb-8 transition-colors">
                Cotiza en minutos y agenda tu cita con nosotros.
            </p>
            <a href="/reserva?servicio={{ $serviceId ?? '' }}" class="inline-flex items-center gap-2 px-10 py-4 bg-brand hover:bg-brand-dark text-white font-semibold rounded-full text-lg transition-all shadow-lg shadow-brand/30 hover:scale-105">
                {{ $ctaText }}
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" x2="19" y1="12" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
            </a>
        </div>
    </section>
</main>

@php
    $schemaProfile = \App\Models\BusinessProfile::first();
    $jsonLd = [
        '@context' => 'https://schema.org',
        '@type' => 'Service',
        'name' => $title,
        'provider' => [
            '@type' => 'LocalBusiness',
            '@id' => url('/') . '#localbusiness',
            'name' => $schemaProfile->business_name ?? 'High Contrast Detailing Center'
        ],
        'areaServed' => ['Santiago', 'Chicureo', 'Colina', 'Lo Barnechea', 'Vitacura', 'Las Condes'],
        'description' => $description,
    ];
    if (isset($priceFrom) && $showPayments) {
        $jsonLd['offers'] = [
            '@type' => 'Offer',
            'priceCurrency' => 'CLP',
            'price' => (string)$priceFrom
        ];
    }
@endphp
<script type="application/ld+json">
{!! json_encode($jsonLd, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
</script>
@endsection
