@extends('layouts.public')

@section('title', 'High Contrast Detailing Center | Car Detailing Premium en Chicureo')
@section('meta_description', 'Centro de detailing automotriz premium en Chicureo, Colina. Pulido profesional, recubrimiento cerámico Gtechniq, detallado de interior y protección de parabrisas.')
@section('meta_keywords', 'detailing chicureo, car detailing santiago, pulido de autos colina, sellado ceramico chicureo, coating 9h santiago, limpieza de tapiz chicureo, High Contrast Detailing')

@section('content')
@php
    $activeSlides = $slides ?? collect();
    // Filter out incomplete slides if any exist in DB
    $activeSlides = $activeSlides->filter(function($s) {
        return !empty($s->media_path) || !empty($s->title);
    });
    if ($activeSlides->isEmpty()) {
        $activeSlides = collect([
            (object)[
                'title' => 'HIGH CONTRAST',
                'title_gradient' => 'DETAILING CENTER',
                'subtitle' => 'El estándar más alto en detallado automotriz. Protección, brillo y perfección absoluta.',
                'media_type' => 'video',
                'media_path' => '/assets/videos/primervideo.home.mp4',
                'button_primary_text' => 'Cotiza tu servicio',
                'button_primary_url' => '/reserva',
                'button_secondary_text' => 'Explorar servicios',
                'button_secondary_url' => '#servicios',
            ],
            (object)[
                'title' => 'SELLADO',
                'title_gradient' => 'CERÁMICO',
                'subtitle' => 'Protección molecular extrema con tecnología Gtechniq Platinum. Hasta 9 años de brillo permanente.',
                'media_type' => 'video',
                'media_path' => '/assets/videos/bmw-horizontal.mp4',
                'button_primary_text' => 'Cotizar Sellado',
                'button_primary_url' => '/reserva?category=ceramico',
                'button_secondary_text' => 'Saber más',
                'button_secondary_url' => '/sellado-ceramico',
            ],
            (object)[
                'title' => 'BLINDAJE',
                'title_gradient' => 'EXOSHIELD',
                'subtitle' => 'Película nanotecnológica TPU para parabrisas. 6x más resistente contra impactos de piedras, gravilla y rayas.',
                'media_type' => 'video',
                'media_path' => '/assets/videos/exoshield-web.mp4',
                'button_primary_text' => 'Cotizar ExoShield',
                'button_primary_url' => '/reserva?category=especiales',
                'button_secondary_text' => 'Ver Blindaje',
                'button_secondary_url' => '/proteccion-parabrisas-santiago',
            ],
            (object)[
                'title' => 'CORRECCIÓN DE',
                'title_gradient' => 'PINTURA',
                'subtitle' => 'Restauración artesanal mediante pulido técnico multi-etapa, eliminando micro-rayas y hologramas.',
                'media_type' => 'video',
                'media_path' => '/assets/videos/bmwblanco-horizontal.mp4',
                'button_primary_text' => 'Cotizar Pulido',
                'button_primary_url' => '/reserva?category=pulido',
                'button_secondary_text' => 'Ver Detalles',
                'button_secondary_url' => '/pulido-de-autos-santiago',
            ],
            (object)[
                'title' => 'LIMPIEZA &',
                'title_gradient' => 'DETALLADO',
                'subtitle' => 'Limpieza a vapor, descontaminado profundo, sanitización y tratamiento premium para habitáculos.',
                'media_type' => 'video',
                'media_path' => '/assets/videos/lavado-premium.mp4',
                'button_primary_text' => 'Cotizar Detallado',
                'button_primary_url' => '/reserva?category=limpieza',
                'button_secondary_text' => 'Ver Servicios',
                'button_secondary_url' => '/limpieza-y-detallado',
            ]
        ]);
    }
@endphp

<!-- Hero Section with Alpine Carousel -->
<section x-data="{ 
    activeSlide: 0,
    slidesCount: {{ $activeSlides->count() }},
    autoplayInterval: null,
    startAutoplay() {
        this.autoplayInterval = setInterval(() => {
            this.nextSlide();
        }, 8000);
    },
    stopAutoplay() {
        if (this.autoplayInterval) {
            clearInterval(this.autoplayInterval);
        }
    },
    nextSlide() {
        this.activeSlide = (this.activeSlide + 1) % this.slidesCount;
    },
    prevSlide() {
        this.activeSlide = (this.activeSlide - 1 + this.slidesCount) % this.slidesCount;
    }
}" 
x-init="startAutoplay()"
@mouseenter="stopAutoplay()"
@mouseleave="startAutoplay()"
class="hero-fullscreen relative w-full overflow-hidden bg-[#0A0A0A]"
style="min-height: 100vh; min-height: 100dvh;">


    @foreach($activeSlides as $index => $slide)
        @php
            $isRight = ($index % 2 === 1);
        @endphp
        <div x-show="activeSlide === {{ $index }}"
             x-transition:enter="transition ease-out duration-1000"
             x-transition:enter-start="opacity-0 scale-105"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-800"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95"
             class="absolute inset-0 w-full h-full"
             style="display: {{ $index === 0 ? 'block' : 'none' }};">
             
             <!-- Video/Image background (High Video Emphasis) -->
             <div class="absolute inset-0 bg-[#0A0A0A] overflow-hidden">
                 @if($slide->media_type === 'video')
                     <video autoplay muted loop playsinline preload="auto" 
                            class="w-full h-full object-cover opacity-85 md:opacity-90 animate-slow-zoom">
                         <source src="{{ asset($slide->media_path) }}" type="video/mp4">
                     </video>
                 @else
                     <img src="{{ asset($slide->media_path) }}" class="w-full h-full object-cover opacity-85 md:opacity-90 animate-slow-zoom" alt="slide bg">
                 @endif

                 <!-- Dynamic directional gradient vignette based on Left vs Right slide -->
                 @if($isRight)
                     <div class="absolute inset-y-0 right-0 bg-gradient-to-l from-[#0A0A0A]/95 via-[#0A0A0A]/60 to-transparent z-10 w-full md:w-7/12 lg:w-1/2"></div>
                 @else
                     <div class="absolute inset-y-0 left-0 bg-gradient-to-r from-[#0A0A0A]/95 via-[#0A0A0A]/60 to-transparent z-10 w-full md:w-7/12 lg:w-1/2"></div>
                 @endif
                 <div class="absolute inset-0 bg-gradient-to-b from-[#0A0A0A]/70 via-transparent to-[#0A0A0A]/90 z-10"></div>
             </div>

             <!-- Floating orb effect alternating left and right -->
             @if($isRight)
                 <div class="absolute top-1/3 right-10 w-80 h-80 bg-brand/20 rounded-full blur-[130px] opacity-60 pointer-events-none z-10"></div>
             @else
                 <div class="absolute top-1/3 left-10 w-80 h-80 bg-brand/20 rounded-full blur-[130px] opacity-60 pointer-events-none z-10"></div>
             @endif

             <!-- Content Container (Alternating Left / Right) -->
             <div class="absolute inset-0 z-20 flex items-center {{ $isRight ? 'justify-end' : 'justify-start' }} pointer-events-none">
                 <div class="w-full max-w-7xl mx-auto px-6 md:px-12 lg:px-16 pointer-events-auto flex {{ $isRight ? 'justify-end' : 'justify-start' }}">
                     <div class="max-w-sm sm:max-w-md md:max-w-xl text-left pt-12 md:pt-0">
                          @if($index === 0)
                              <h1 class="font-display text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold text-white leading-[0.95] tracking-tight uppercase mb-3 text-left drop-shadow-[0_4px_16px_rgba(0,0,0,0.9)]">
                                  {{ $slide->title }}
                                  @if(!empty($slide->title_gradient))
                                      <span class="block text-gradient mt-0.5">{{ $slide->title_gradient }}</span>
                                  @endif
                              </h1>
                          @else
                              <h2 class="font-display text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold text-white leading-[0.95] tracking-tight uppercase mb-3 text-left drop-shadow-[0_4px_16px_rgba(0,0,0,0.9)]">
                                  {{ $slide->title }}
                                  @if(!empty($slide->title_gradient))
                                      <span class="block text-gradient mt-0.5">{{ $slide->title_gradient }}</span>
                                  @endif
                              </h2>
                          @endif
                     </div>
                 </div>
             </div>
        </div>
    @endforeach

    <!-- Slide Navigation & Indicators (Bottom-Left Aligned) -->
    <template x-if="slidesCount > 1">
        <div class="absolute bottom-8 left-6 md:left-12 lg:left-16 z-30 flex items-center gap-4 sm:gap-6">
            <!-- Slide Counter -->
            <div class="text-white/70 font-mono text-xs sm:text-sm tracking-wider drop-shadow-sm flex items-center">
                <span class="text-brand font-black text-sm sm:text-base" x-text="String(activeSlide + 1).padStart(2, '0')"></span>
                <span class="mx-1 text-white/40">/</span>
                <span class="text-white/80 font-bold" x-text="String(slidesCount).padStart(2, '0')"></span>
            </div>

            <!-- Slide Dots -->
            <div class="flex gap-2 items-center">
                <template x-for="(s, index) in slidesCount" :key="index">
                    <button @click="activeSlide = index" 
                            :class="activeSlide === index ? 'w-7 bg-brand border-brand' : 'w-2 bg-white/40 border-transparent hover:bg-white/70'"
                            class="h-2 rounded-full border transition-all duration-300 focus:outline-none"
                            :aria-label="'Ir a slide ' + (index + 1)"></button>
                </template>
            </div>

            <!-- Navigation Arrows -->
            <div class="flex items-center gap-2 ml-2">
                <button @click="prevSlide()" class="w-9 h-9 rounded-full border border-white/20 bg-black/40 hover:bg-brand text-white flex items-center justify-center transition-all focus:outline-none hover:scale-105 active:scale-95 duration-200" aria-label="Slide anterior">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                </button>
                <button @click="nextSlide()" class="w-9 h-9 rounded-full border border-white/20 bg-black/40 hover:bg-brand text-white flex items-center justify-center transition-all focus:outline-none hover:scale-105 active:scale-95 duration-200" aria-label="Slide siguiente">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                </button>
            </div>
        </div>
    </template>
</section>




<!-- Full-Screen Video Showcase: White BMW Multi-Etapa Correction (Right-Aligned Column) -->
<section id="maestria-detailing" class="hero-fullscreen relative w-full overflow-hidden bg-[#0A0A0A]" style="min-height: 100vh; min-height: 100dvh;">
    <!-- Background Video (White BMW Studio Correction in Full Screen) -->
    <div class="absolute inset-0 bg-[#0A0A0A] overflow-hidden">
        <video autoplay muted loop playsinline preload="auto" class="w-full h-full object-cover opacity-85 md:opacity-90 animate-slow-zoom">
            <source src="/assets/videos/bmwblanco-horizontal.mp4" type="video/mp4">
        </video>
        <!-- Dark Gradient Overlay Focused on the Right Side for Maximum Legibility -->
        <div class="absolute inset-y-0 right-0 bg-gradient-to-l from-[#0A0A0A] via-[#0A0A0A]/90 to-transparent z-10 w-full md:w-3/4 lg:w-3/5"></div>
        <div class="absolute inset-0 bg-gradient-to-b from-[#0A0A0A]/70 via-transparent to-[#0A0A0A]/90 z-10"></div>
    </div>

    <!-- Floating orb on right side -->
    <div class="absolute top-1/3 right-10 w-80 h-80 bg-brand/20 rounded-full blur-[130px] opacity-60 pointer-events-none z-10"></div>

    <!-- Content Container (Right-Aligned) -->
    <div class="absolute inset-0 z-20 flex items-center justify-end pointer-events-none">
        <div class="w-full max-w-7xl mx-auto px-6 md:px-12 lg:px-16 pointer-events-auto flex justify-end">
            <div class="text-right">
                <!-- Headline -->
                <h2 class="font-display text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-extrabold text-white leading-[0.95] tracking-tight uppercase mb-6 drop-shadow-[0_4px_16px_rgba(0,0,0,0.9)]">
                    CORRECCIÓN DE
                    <span class="block text-gradient mt-0.5">PINTURA</span>
                </h2>

                <!-- Explorar Link -->
                <a href="/pulido-de-autos-santiago#correccion-pintura" class="inline-flex items-center gap-2 text-white/80 hover:text-brand text-sm sm:text-base font-semibold uppercase tracking-widest transition-all duration-300 group">
                    <span>Explorar</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transform group-hover:translate-x-1 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="m9 18 6-6-6-6"/></svg>
                </a>
            </div>
        </div>
    </div>
</section>


<!-- Full-Screen Image Showcase: Lavado Detallado (Left-Aligned Column) -->
<section id="lavado-detallado" class="hero-fullscreen relative w-full overflow-hidden bg-[#0A0A0A]" style="min-height: 100vh; min-height: 100dvh;">
    <!-- Background Image (Lavado Detallado in Full Screen) -->
    <div class="absolute inset-0 bg-[#0A0A0A] overflow-hidden">
        <picture>
            <source srcset="{{ asset('assets/images/home/lavado.webp') }}" type="image/webp">
            <img src="{{ asset('assets/images/home/lavado.jpg') }}" 
                 alt="High Contrast Detailing - Lavado y Detallado" 
                 class="w-full h-full object-cover object-[75%_center] md:object-[70%_center] opacity-85 md:opacity-90 animate-slow-zoom">
        </picture>
        <!-- Dark Gradient Overlay Focused on the Left Side for Maximum Legibility -->
        <div class="absolute inset-y-0 left-0 bg-gradient-to-r from-[#0A0A0A] via-[#0A0A0A]/90 to-transparent z-10 w-full md:w-3/4 lg:w-3/5"></div>
        <div class="absolute inset-0 bg-gradient-to-b from-[#0A0A0A]/70 via-transparent to-[#0A0A0A]/90 z-10"></div>
    </div>

    <!-- Floating orb on left side -->
    <div class="absolute top-1/3 left-10 w-80 h-80 bg-brand/20 rounded-full blur-[130px] opacity-60 pointer-events-none z-10"></div>

    <!-- Content Container (Left-Aligned) -->
    <div class="absolute inset-0 z-20 flex items-center justify-start pointer-events-none">
        <div class="w-full max-w-7xl mx-auto px-6 md:px-12 lg:px-16 pointer-events-auto flex justify-start">
            <div class="text-left">
                <!-- Headline -->
                <h2 class="font-display text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-extrabold text-white leading-[0.95] tracking-tight uppercase mb-6 drop-shadow-[0_4px_16px_rgba(0,0,0,0.9)]">
                    LAVADO &
                    <span class="block text-gradient mt-0.5">DETALLADO</span>
                </h2>

                <!-- Explorar Link -->
                <a href="/limpieza-y-detallado" class="inline-flex items-center gap-2 text-white/80 hover:text-brand text-sm sm:text-base font-semibold uppercase tracking-widest transition-all duration-300 group">
                    <span>Explorar</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transform group-hover:translate-x-1 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="m9 18 6-6-6-6"/></svg>
                </a>
            </div>
        </div>
    </div>
</section>


<!-- Full-Screen Image Showcase: Sellado Cerámico (Right-Aligned Column) -->
<section id="sellado-ceramico-home" class="hero-fullscreen relative w-full overflow-hidden bg-[#0A0A0A]" style="min-height: 100vh; min-height: 100dvh;">
    <!-- Background Image (Sellado Cerámico 3 BMWs in Full Screen) -->
    <div class="absolute inset-0 bg-[#0A0A0A] overflow-hidden">
        <picture>
            <source srcset="{{ asset('assets/images/home/ceramico.webp') }}" type="image/webp">
            <img src="{{ asset('assets/images/home/ceramico.jpg') }}" 
                 alt="High Contrast Detailing - Sellado Cerámico" 
                 class="w-full h-full object-cover object-[25%_center] md:object-[30%_center] opacity-85 md:opacity-90 animate-slow-zoom">
        </picture>
        <!-- Dark Gradient Overlay Focused on the Right Side for Maximum Legibility -->
        <div class="absolute inset-y-0 right-0 bg-gradient-to-l from-[#0A0A0A] via-[#0A0A0A]/90 to-transparent z-10 w-full md:w-3/4 lg:w-3/5"></div>
        <div class="absolute inset-0 bg-gradient-to-b from-[#0A0A0A]/70 via-transparent to-[#0A0A0A]/90 z-10"></div>
    </div>

    <!-- Floating orb on right side -->
    <div class="absolute top-1/3 right-10 w-80 h-80 bg-brand/20 rounded-full blur-[130px] opacity-60 pointer-events-none z-10"></div>

    <!-- Content Container (Right-Aligned) -->
    <div class="absolute inset-0 z-20 flex items-center justify-end pointer-events-none">
        <div class="w-full max-w-7xl mx-auto px-6 md:px-12 lg:px-16 pointer-events-auto flex justify-end">
            <div class="text-right">
                <!-- Headline -->
                <h2 class="font-display text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-extrabold text-white leading-[0.95] tracking-tight uppercase mb-6 drop-shadow-[0_4px_16px_rgba(0,0,0,0.9)]">
                    SELLADO &
                    <span class="block text-gradient mt-0.5">CERÁMICO</span>
                </h2>

                <!-- Explorar Link -->
                <a href="/sellado-ceramico" class="inline-flex items-center gap-2 text-white/80 hover:text-brand text-sm sm:text-base font-semibold uppercase tracking-widest transition-all duration-300 group">
                    <span>Explorar</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transform group-hover:translate-x-1 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="m9 18 6-6-6-6"/></svg>
                </a>
            </div>
        </div>
    </div>
</section>


<!-- Full-Screen Image Section: Nuestra Historia (Left-Aligned) -->
<section class="hero-fullscreen relative w-full overflow-hidden bg-[#0A0A0A]" style="min-height: 100vh; min-height: 100dvh;">
    <!-- Background Image -->
    <div class="absolute inset-0 bg-[#0A0A0A] overflow-hidden">
        <picture>
            <source srcset="{{ asset('assets/images/home/nuestra-historia.webp') }}" type="image/webp">
            <img src="{{ asset('assets/images/home/nuestra-historia.jpg') }}" 
                 alt="High Contrast Detailing - Nuestra Historia" 
                 class="w-full h-full object-cover object-[65%_center] md:object-[60%_center] opacity-90 animate-slow-zoom">
        </picture>
        <!-- Subtle ambient vignette to preserve José and the workshop brightness -->
        <div class="absolute inset-0 bg-gradient-to-r from-black/30 via-transparent to-transparent z-10 w-full md:w-1/2"></div>
        <div class="absolute inset-0 bg-gradient-to-b from-[#0A0A0A]/40 via-transparent to-[#0A0A0A]/70 z-10"></div>
    </div>

    <!-- Floating orb left (very soft) -->
    <div class="absolute top-1/3 left-6 w-72 h-72 bg-brand/10 rounded-full blur-[120px] opacity-40 pointer-events-none z-10"></div>

    <!-- Content Container (Anchored to the Left at the Red X position) -->
    <div class="absolute inset-0 z-20 flex items-center justify-start pointer-events-none">
        <div class="w-full px-6 md:px-10 lg:px-12 pointer-events-auto flex justify-start">
            <div class="relative w-full max-w-md lg:max-w-lg p-6 sm:p-8 md:p-9 rounded-3xl bg-black/40 backdrop-blur-xl border border-white/20 shadow-[0_25px_60px_rgba(0,0,0,0.6)] text-left" style="transform: translateY(40px);">
                <!-- Subtle internal glass highlight -->
                <div class="absolute inset-x-0 top-0 h-px bg-gradient-to-r from-transparent via-white/40 to-transparent rounded-t-3xl pointer-events-none"></div>

                <!-- Headline (Refined size, solid vibrant pink, no stroke artifacts) -->
                <h2 class="font-display text-xl sm:text-2xl md:text-3xl lg:text-4xl font-extrabold leading-[1.08] tracking-tight uppercase mb-6">
                    <span class="block text-white" style="text-shadow: 0 3px 14px rgba(0,0,0,0.95);">SOMOS MÁS QUE UN TALLER DE DETAILING,</span>
                    <span class="block mt-2" style="color: #FB2C6B; text-shadow: 0 3px 14px rgba(0,0,0,0.95);">
                        SOMOS APASIONADOS POR LOS AUTOMÓVILES
                    </span>
                </h2>

                <!-- Action Button -->
                <a href="/nosotros" class="inline-flex items-center gap-3 px-6 py-3 sm:px-7 sm:py-3.5 rounded-2xl bg-black/50 hover:bg-brand text-white text-xs sm:text-sm font-bold uppercase tracking-wider border border-white/30 hover:border-brand transition-all duration-300 group shadow-xl hover:shadow-brand/25 backdrop-blur-md">
                    <span>Nuestra Historia</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 sm:w-5 sm:h-5 transform group-hover:translate-x-1.5 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="m9 18 6-6-6-6"/></svg>
                </a>
            </div>
        </div>
    </div>
</section>


@php
    $showcaseCards = [
        [
            'number' => '01',
            'badge' => 'Limpieza & Detallado',
            'title' => '160°C Desinfección',
            'video' => '/assets/videos/lavado-premium.mp4',
            'url' => '/limpieza-y-detallado'
        ],
        [
            'number' => '02',
            'badge' => 'Ceramic Coating',
            'title' => '9H Platinum',
            'video' => '/assets/videos/bmw-horizontal.mp4',
            'url' => '/sellado-ceramico'
        ],
        [
            'number' => '03',
            'badge' => 'Corrección de Pintura',
            'title' => '95% Rayas Elim.',
            'video' => '/assets/videos/bmwblanco-horizontal.mp4',
            'url' => '/pulido-de-autos-santiago'
        ],
        [
            'number' => '04',
            'badge' => 'Protección ExoShield',
            'title' => '6x Más Resistente',
            'video' => '/assets/videos/2.mp4',
            'url' => '/proteccion-parabrisas-santiago'
        ]
    ];
@endphp

<!-- Interactive EVOKN-Style Horizontal Scroll Showcase Section -->
<section id="experiencia-evokn" 
         x-data="{
             singleSetWidth: 0,
             isResetting: false,
             initCarousel() {
                 this.$nextTick(() => {
                     const el = this.$refs.slider;
                     if (!el || el.children.length < 5) return;
                     const firstCard = el.children[0];
                     const fifthCard = el.children[4];
                     if (firstCard && fifthCard) {
                         this.singleSetWidth = fifthCard.offsetLeft - firstCard.offsetLeft;
                     } else {
                         this.singleSetWidth = el.scrollWidth / 3;
                     }
                     el.scrollLeft = this.singleSetWidth;
                 });
             },
             checkBounds() {
                 if (this.isResetting) return;
                 const el = this.$refs.slider;
                 if (!el || !this.singleSetWidth) return;
                 if (el.scrollLeft >= this.singleSetWidth * 2) {
                     this.isResetting = true;
                     el.scrollLeft -= this.singleSetWidth;
                     setTimeout(() => { this.isResetting = false; }, 50);
                 } else if (el.scrollLeft < this.singleSetWidth * 0.4) {
                     this.isResetting = true;
                     el.scrollLeft += this.singleSetWidth;
                     setTimeout(() => { this.isResetting = false; }, 50);
                 }
             },
             scrollLeft() {
                 const el = this.$refs.slider;
                 if (!el) return;
                 this.checkBounds();
                 const cardWidth = el.children[0]?.offsetWidth || 380;
                 const step = cardWidth + 24;
                 el.scrollBy({ left: -step, behavior: 'smooth' });
             },
             scrollRight() {
                 const el = this.$refs.slider;
                 if (!el) return;
                 this.checkBounds();
                 const cardWidth = el.children[0]?.offsetWidth || 380;
                 const step = cardWidth + 24;
                 el.scrollBy({ left: step, behavior: 'smooth' });
             },
             handleWheel(e) {
                 if (Math.abs(e.deltaY) > Math.abs(e.deltaX)) {
                     this.$refs.slider.scrollLeft += e.deltaY * 1.2;
                     this.checkBounds();
                 }
             }
         }"
         x-init="initCarousel()"
         @resize.window.debounce.200ms="initCarousel()"
         class="py-24 md:py-32 relative overflow-hidden bg-white dark:bg-[#0A0A0A] transition-colors duration-300">
    <!-- Glow accent -->
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[800px] bg-brand/10 dark:bg-brand/15 rounded-full blur-[160px] pointer-events-none"></div>

    <div class="container-custom relative z-10">
        <!-- Section Header with Left Title and Right Scroll Arrows -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12">
            <div>
                <span class="inline-flex items-center gap-2 text-brand text-xs font-bold tracking-[0.25em] uppercase mb-3">
                    <span class="w-2 h-2 rounded-full bg-brand animate-pulse"></span>
                    AUTORIDAD & EXCELENCIA ACREDITADA
                </span>
                <h2 class="font-display text-3xl sm:text-5xl md:text-6xl font-extrabold text-black dark:text-white uppercase leading-none tracking-tight">
                    EL ESTÁNDAR QUE LOS <span class="text-gradient">EXPERTOS</span> ELIGEN
                </h2>
                <p class="text-black/60 dark:text-white/60 text-sm md:text-base max-w-xl mt-3 font-light">
                    Resultados respaldados por acreditación oficial Gtechniq, precisión técnica y la confianza comprobada de más de 500 conductores en Santiago.
                </p>

            </div>

            <!-- Interactive Scroll Navigation Arrows -->
            <div class="flex items-center gap-3 shrink-0">
                <button @click="scrollLeft()" 
                        class="w-12 h-12 rounded-full border border-black/10 dark:border-white/20 bg-black/5 dark:bg-white/5 hover:bg-brand dark:hover:bg-brand hover:border-brand hover:text-white text-black dark:text-white flex items-center justify-center transition-all duration-300 shadow-md hover:scale-105 active:scale-95" 
                        aria-label="Anterior card">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                </button>
                <button @click="scrollRight()" 
                        class="w-12 h-12 rounded-full border border-black/10 dark:border-white/20 bg-black/5 dark:bg-white/5 hover:bg-brand dark:hover:bg-brand hover:border-brand hover:text-white text-black dark:text-white flex items-center justify-center transition-all duration-300 shadow-md hover:scale-105 active:scale-95" 
                        aria-label="Siguiente card">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                </button>
            </div>
        </div>

        <!-- EVOKN Horizontal Scroll Track (Infinite Cloned Loop) -->
        <div x-ref="slider" 
             @scroll.debounce.150ms="checkBounds()"
             @wheel.passive="handleWheel($event)"
             class="flex gap-6 overflow-x-auto scrollbar-none py-4 snap-x snap-mandatory cursor-grab active:cursor-grabbing select-none -mx-4 px-4 sm:mx-0 sm:px-0">
            
            @for($set = 0; $set < 3; $set++)
                @foreach($showcaseCards as $card)
                    <a href="{{ $card['url'] }}" 
                       class="w-[300px] sm:w-[380px] h-[480px] shrink-0 snap-start rounded-[2.5rem] overflow-hidden relative group shadow-2xl border border-black/10 dark:border-white/10 transition-all duration-500 hover:scale-[1.02] hover:border-brand/50 block">
                        <video autoplay muted loop playsinline class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            <source src="{{ $card['video'] }}" type="video/mp4">
                        </video>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/30 to-transparent"></div>
                        
                        <div class="absolute inset-0 p-8 flex flex-col justify-between z-10">
                            <div class="flex items-center justify-between">
                                <span class="px-4 py-1.5 rounded-full bg-brand text-white text-[10px] font-bold uppercase tracking-widest shadow-lg">{{ $card['badge'] }}</span>
                                <span class="w-8 h-8 rounded-full bg-black/60 border border-white/20 backdrop-blur-md flex items-center justify-center text-white text-xs font-bold shadow-md">{{ $card['number'] }}</span>
                            </div>

                            <div>
                                <h3 class="font-display text-3xl sm:text-4xl font-extrabold text-white uppercase leading-tight drop-shadow-[0_4px_16px_rgba(0,0,0,0.8)]">{{ $card['title'] }}</h3>
                            </div>
                        </div>
                    </a>
                @endforeach
            @endfor

        </div>
    </div>
</section>

<!-- Gallery Section -->
<script>
    window.instagramFeedData = {!! json_encode($instagramFeed ?? [], JSON_INVALID_UTF8_SUBSTITUTE) ?: '[]' !!};
</script>
<section id="galeria" x-data="{ 
    selectedIndex: null, 
    isZoomed: false, 
    isMuted: true,
    images: window.instagramFeedData,
    next() {
        if (this.selectedIndex !== null) {
            this.selectedIndex = (this.selectedIndex + 1) % this.images.length;
            this.resetVideo();
        }
    },
    prev() {
        if (this.selectedIndex !== null) {
            this.selectedIndex = (this.selectedIndex - 1 + this.images.length) % this.images.length;
            this.resetVideo();
        }
    },
    resetVideo() {
        this.isMuted = true;
        this.$nextTick(() => {
            const vid = document.getElementById('lightbox-video');
            if (vid) {
                vid.load();
                vid.play().catch(e => {});
            }
        });
    }
}" 
@keydown.window.escape="selectedIndex = null; const vid = document.getElementById('lightbox-video'); if (vid) { vid.pause(); }"
@keydown.window.arrow-right="next()"
@keydown.window.arrow-left="prev()"
class="section-padding relative overflow-hidden">
    <div class="pointer-events-none absolute inset-x-0 top-0 h-24 bg-gradient-to-b from-white/[0.04] via-brand/[0.05] to-transparent"></div>
    <div class="pointer-events-none absolute left-1/2 top-32 h-[420px] w-[620px] -translate-x-1/2 rounded-full bg-brand/5 blur-[140px]"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="mb-16 text-center">
            <p class="mb-4 text-xs md:text-sm font-bold uppercase tracking-[0.25em] text-brand">Síguenos en Instagram</p>
            <h2 class="font-display text-4xl font-extrabold text-black dark:text-white md:text-6xl uppercase tracking-tight">
                Nuestro día a <span class="text-gradient">día</span>
            </h2>
        </div>

        <div class="relative rounded-[40px] border border-black/5 dark:border-white/10 bg-white/50 dark:bg-[#111111]/40 p-4 shadow-2xl md:p-8 backdrop-blur-sm">
            <div class="pointer-events-none absolute inset-x-10 top-0 h-px bg-gradient-to-r from-transparent via-white/20 to-transparent"></div>
            <!-- Expanded 2-Column Grid for Massive Images -->
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-2 md:gap-10">
                <template x-for="(img, index) in images" :key="img.src">
                    <div @click="selectedIndex = index"
                         @mouseenter="if (img.is_video && img.video_url) { $el.querySelector('video').play().catch(e => {}) }"
                         @mouseleave="if (img.is_video && img.video_url) { $el.querySelector('video').pause(); $el.querySelector('video').currentTime = 0 }"
                         class="group relative aspect-[4/3] sm:aspect-[16/11] lg:aspect-[16/10] cursor-pointer overflow-hidden rounded-[32px] border border-black/10 dark:border-white/15 bg-zinc-100 dark:bg-black/50 shadow-2xl transition-all duration-500 hover:-translate-y-2 hover:shadow-brand/20">
                        
                        <!-- Cover Image -->
                        <img :src="img.src" :alt="img.title" loading="lazy" decoding="async" class="absolute inset-0 h-full w-full object-cover transition-transform duration-700 group-hover:scale-105 z-0">
                        
                        <!-- Hover Video Playback -->
                        <template x-if="img.is_video && img.video_url">
                            <video :src="img.video_url" loop muted playsinline preload="none"
                                   class="absolute inset-0 h-full w-full object-cover opacity-0 transition-opacity duration-500 group-hover:opacity-100 pointer-events-none z-0">
                            </video>
                        </template>

                        <!-- Gradient Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/95 via-black/40 to-black/10 opacity-75 transition-opacity duration-500 group-hover:opacity-90 z-10"></div>
                        
                        <!-- Video Play Badge (Top Left) -->
                        <template x-if="img.is_video">
                            <div class="absolute top-6 left-6 z-20 flex h-10 w-10 items-center justify-center rounded-full bg-black/70 text-white backdrop-blur-md border border-white/20 shadow-xl transition-transform duration-300 group-hover:scale-110">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor" class="text-white"><path d="M8 5v14l11-7z"/></svg>
                            </div>
                        </template>

                        <!-- Instagram icon always visible (Top Right) -->
                        <div class="absolute top-6 right-6 text-white/80 transition-colors group-hover:text-brand drop-shadow-lg z-20">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
                        </div>
                        
                        <!-- Large Title & Label (Bottom) -->
                        <div class="absolute bottom-0 left-0 right-0 p-8 md:p-10 transition-all duration-500 z-20">
                            <span class="mb-2 block text-xs font-bold uppercase tracking-[0.25em] text-brand" x-text="img.label"></span>
                            <h3 class="font-display text-2xl md:text-3xl font-extrabold text-white group-hover:text-white line-clamp-2 leading-tight" x-text="img.title"></h3>
                        </div>

                        <!-- Hover Icon overlay (Center) -->
                        <div class="absolute inset-0 flex items-center justify-center opacity-0 transition-opacity duration-300 group-hover:opacity-100 z-30">
                            <div class="glass rounded-full p-5 text-white border border-white/30 shadow-2xl bg-brand/80 backdrop-blur-md transform group-hover:scale-110 transition-transform">
                                <template x-if="img.is_video">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polygon points="10 8 16 12 10 16 10 8"/></svg>
                                </template>
                                <template x-if="!img.is_video">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 3 6 6-9 9-4 1 1-4Z"/><path d="M18 17h2a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2H9a2 2 0 0 0-2 2v2"/></svg>
                                </template>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>

        <div class="mt-14 text-center">
            <a href="https://instagram.com/highcontrastdc" target="_blank" rel="noopener noreferrer" class="group inline-flex items-center gap-3 rounded-full border border-black/10 dark:border-white/10 px-10 py-5 font-bold text-black/70 dark:text-white/80 transition-all duration-300 hover:border-brand/50 hover:bg-brand hover:text-white shadow-xl bg-white dark:bg-transparent text-sm uppercase tracking-wider">
                <span>Ver más en Instagram</span>
                <span class="flex h-8 w-8 items-center justify-center rounded-full bg-brand/10 transition-colors group-hover:bg-white">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="text-brand group-hover:text-brand"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </span>
            </a>
        </div>
    </div>

    <!-- Lightbox Modal -->
    <div x-show="selectedIndex !== null" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         @click="selectedIndex = null; const vid = document.getElementById('lightbox-video'); if (vid) { vid.pause(); }"
         class="fixed inset-0 z-[140] flex items-center justify-center bg-black/95 p-4 backdrop-blur-xl md:p-10" 
         style="display: none;">
        
        <!-- Toolbar Top -->
        <div @click.stop class="absolute left-0 right-0 top-6 z-[150] flex items-center justify-between px-6 md:px-12">
            <span class="rounded-full bg-white/10 px-4 py-2 text-xs font-bold tracking-widest text-white border border-white/10" x-text="`${selectedIndex + 1} / ${images.length}`"></span>
            <div class="flex items-center gap-3">
                <template x-if="!images[selectedIndex]?.is_video">
                    <button @click="isZoomed = !isZoomed" class="group flex h-12 w-12 items-center justify-center rounded-full bg-white/10 text-white transition-all hover:bg-white/20 hover:text-brand border border-white/10">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" x2="16.65" y1="21" y2="16.65"/><line x1="11" x2="11" y1="8" y2="14"/><line x1="8" x2="14" y1="11" y2="11"/></svg>
                    </button>
                </template>
                <button @click="selectedIndex = null; const vid = document.getElementById('lightbox-video'); if (vid) { vid.pause(); }" class="group flex h-12 w-12 items-center justify-center rounded-full bg-white/10 text-white transition-all hover:bg-white/20 hover:text-red-500 border border-white/10">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" x2="6" y1="6" y2="18"/><line x1="6" x2="18" y1="6" y2="18"/></svg>
                </button>
            </div>
        </div>

        <div @click.stop class="relative flex h-full w-full max-w-7xl items-center justify-center overflow-hidden">
            <!-- Left Button -->
            <button @click="prev()" class="group absolute left-4 z-[150] flex h-14 w-14 items-center justify-center rounded-full bg-black/50 text-white/70 backdrop-blur-md transition-all hover:bg-black/80 hover:text-brand border border-white/10">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
            </button>
            
            <!-- Right Button -->
            <button @click="next()" class="group absolute right-4 z-[150] flex h-14 w-14 items-center justify-center rounded-full bg-black/50 text-white/70 backdrop-blur-md transition-all hover:bg-black/80 hover:text-brand border border-white/10">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
            </button>

            <!-- Media display -->
            <div class="relative flex h-full w-full flex-col items-center justify-center p-4 md:p-12">
                <div class="relative w-full h-[65vh] md:h-[75vh] flex items-center justify-center overflow-hidden">
                    <template x-if="!images[selectedIndex]?.is_video">
                        <img :src="images[selectedIndex]?.src" :alt="images[selectedIndex]?.title" 
                             :class="isZoomed ? 'scale-[2] cursor-zoom-out' : 'scale-100 cursor-zoom-in'"
                             class="mx-auto max-h-full max-w-full rounded-2xl object-contain shadow-2xl transition-transform duration-300"
                             @click="isZoomed = !isZoomed">
                    </template>
                    
                    <template x-if="images[selectedIndex]?.is_video">
                        <div class="relative w-full h-full flex items-center justify-center">
                            <video id="lightbox-video" :src="images[selectedIndex]?.video_url" 
                                   autoplay loop playsinline :muted="isMuted"
                                   class="mx-auto max-h-full max-w-full rounded-2xl object-contain shadow-2xl transition-transform duration-300">
                            </video>
                            
                            <!-- Custom volume control -->
                            <div class="absolute bottom-4 right-4 z-[160]">
                                <button @click.stop="isMuted = !isMuted" 
                                        class="flex h-12 w-12 items-center justify-center rounded-full bg-black/60 text-white backdrop-blur-md border border-white/10 hover:bg-black/80 hover:text-brand transition-all shadow-xl">
                                    <template x-if="isMuted">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M11 5L6 9H2v6h4l5 4V5z"/><line x1="23" y1="9" x2="17" y2="15"/><line x1="17" y1="9" x2="23" y2="15"/></svg>
                                    </template>
                                    <template x-if="!isMuted">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M11 5L6 9H2v6h4l5 4V5z"/><path d="M15.54 8.46a5 5 0 0 1 0 7.07"/><path d="M19.07 4.93a10 10 0 0 1 0 14.14"/></svg>
                                    </template>
                                </button>
                            </div>
                        </div>
                    </template>
                </div>

                <div class="absolute bottom-8 left-1/2 -translate-x-1/2 text-center w-full px-4 flex flex-col items-center gap-4">
                    <div class="inline-block rounded-3xl bg-black/60 px-8 py-4 border border-white/10 shadow-2xl">
                        <span class="mb-1 block text-[10px] font-bold uppercase tracking-[0.3em] text-brand" x-text="images[selectedIndex]?.label"></span>
                        <h3 class="font-display text-xl font-bold text-white md:text-3xl" x-text="images[selectedIndex]?.title"></h3>
                    </div>
                    
                    <!-- Instagram Link Button -->
                    <template x-if="images[selectedIndex]?.link">
                        <a :href="images[selectedIndex].link" target="_blank" rel="noopener noreferrer" 
                           class="inline-flex items-center gap-2 rounded-full bg-gradient-to-r from-[#833ab4] via-[#fd1d1d] to-[#fcb045] px-6 py-2.5 text-sm font-bold text-white shadow-lg transition-transform hover:scale-105">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
                            Ver en Instagram
                        </a>
                    </template>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section id="testimonios" 
         x-data="{ 
            current: 0,
            autoplayTimer: null,
            autoplayDuration: 10000,
            testimonials: [
                { name: 'Rodrigo Fernández', vehicle: 'BMW M4 Competition', rating: 5, text: 'Increíble trabajo. Mi M4 quedó como recién salido del concesionario. El tratamiento cerámico superó todas mis expectativas. Profesionalismo de otro nivel.', service: 'Tratamiento Cerámico', image: '/assets/images/testimonials/bmw_m4.png' },
                { name: 'Carolina Muñoz', vehicle: 'Mercedes-Benz GLC 300', rating: 5, text: 'Llevé mi GLC con rayones que me tenían preocupada. Después de la corrección de pintura, desaparecieron por completo. Muy recomendados.', service: 'Corrección de Pintura', image: '/assets/images/testimonials/mercedes_glc.png' },
                { name: 'Sebastián Torres', vehicle: 'Porsche 911 Carrera', rating: 5, text: 'Como dueño de un 911, soy muy exigente con quién toca mi auto. High Contrast es el único lugar donde lo llevo. Perfeccionistas.', service: 'Pulido Profesional', image: '/assets/images/testimonials/porsche_911.png' },
                { name: 'María José Contreras', vehicle: 'Audi Q5', rating: 5, text: 'El detailing interior dejó mi Q5 impecable. Los cueros quedaron como nuevos y el olor es increíble. Volveré cada mes.', service: 'Detailing Interior', image: '/assets/images/testimonials/audi_q5.png' },
                { name: 'Andrés Villalobos', vehicle: 'Tesla Model 3', rating: 5, text: 'Profesionales, puntuales y el resultado habla por sí solo. El cerámico protege mi Tesla de todo. 100% recomendado.', service: 'Tratamiento Cerámico', image: '/assets/images/testimonials/tesla_model3.png' }
            ],
            startAutoplay() {
                this.stopAutoplay();
                this.autoplayTimer = setInterval(() => {
                    this.next();
                }, this.autoplayDuration);
            },
            stopAutoplay() {
                if (this.autoplayTimer) {
                    clearInterval(this.autoplayTimer);
                    this.autoplayTimer = null;
                }
            },
            next() {
                this.current = (this.current + 1) % this.testimonials.length;
                this.startAutoplay();
            },
            prev() {
                this.current = (this.current - 1 + this.testimonials.length) % this.testimonials.length;
                this.startAutoplay();
            },
            goTo(index) {
                this.current = index;
                this.startAutoplay();
            }
         }" 
         x-init="startAutoplay()"
         @mouseenter="stopAutoplay()"
         @mouseleave="startAutoplay()"
         class="py-24 md:py-36 relative overflow-hidden bg-black text-white min-h-[720px] flex items-center">

    <!-- FULL HERO VEHICLE BACKGROUND LAYER (BRIGHT, VIBRANT & 100% PROTAGONIST) -->
    <template x-for="(t, index) in testimonials" :key="t.image">
        <div class="absolute inset-0 transition-opacity duration-1000 ease-in-out pointer-events-none z-0 overflow-hidden"
             :class="index === current ? 'opacity-100' : 'opacity-0'">
            <!-- Vehicle Image with enhanced brightness and contrast -->
            <img :src="t.image" :alt="t.vehicle" 
                 class="w-full h-full object-cover object-left md:object-center brightness-105 contrast-105 saturate-[1.1] transition-transform duration-1000 ease-out"
                 :class="index === current ? 'scale-100' : 'scale-105'">
            
            <!-- Focused right-side gradient vignette so vehicle remains 100% bright on the left/center while text is perfectly legible on the right -->
            <div class="absolute inset-y-0 right-0 w-full md:w-3/5 lg:w-1/2 bg-gradient-to-l from-black/95 via-black/80 to-transparent"></div>
            
            <!-- Soft top and bottom blends for seamless page transitions -->
            <div class="absolute inset-x-0 top-0 h-24 bg-gradient-to-b from-black via-black/40 to-transparent"></div>
            <div class="absolute inset-x-0 bottom-0 h-24 bg-gradient-to-t from-black via-black/40 to-transparent"></div>
        </div>
    </template>

    <!-- Subtle Ambient Glow on Vehicle Side -->
    <div class="absolute top-1/2 left-1/4 -translate-x-1/2 -translate-y-1/2 w-[700px] h-[700px] bg-brand/15 rounded-full blur-[180px] pointer-events-none z-0"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 w-full">
        <!-- Section Header -->
        <div class="mb-10 text-left">
            <span class="text-brand text-xs font-bold tracking-[0.25em] uppercase mb-3 px-4 py-1.5 rounded-full bg-brand/20 border border-brand/40 inline-block backdrop-blur-md">Testimonios Reales</span>
            <h2 class="font-display text-4xl md:text-6xl font-extrabold text-white uppercase tracking-tight drop-shadow-lg">
                Lo que dicen nuestros <span class="text-gradient">clientes</span>
            </h2>
        </div>

        <!-- Hero Split Grid: Right Side Card Placement -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
            
            <!-- Left Side: Empty space letting vehicle image be 100% visible & protagonist -->
            <div class="hidden lg:block lg:col-span-6"></div>

            <!-- Right Side: Testimonial Card (Highly Legible & Glassmorphic) -->
            <div class="lg:col-span-6">
                <div class="relative rounded-[2.5rem] overflow-hidden border border-white/20 bg-black/75 backdrop-blur-2xl shadow-2xl min-h-[380px] flex flex-col justify-between p-8 sm:p-10 md:p-12">
                    <!-- Card Content -->
                    <div>
                        <!-- Quote Icon & Service Badge -->
                        <div class="flex items-center justify-between mb-6">
                            <svg class="w-12 h-12 text-brand" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/></svg>

                            <span class="px-4 py-1.5 rounded-full bg-brand/20 border border-brand/40 text-brand text-xs font-bold uppercase tracking-wider backdrop-blur-md"
                                  x-text="testimonials[current].service"></span>
                        </div>
                        
                        <p class="text-white text-lg sm:text-xl md:text-2xl leading-relaxed mb-8 font-light italic" x-text="`“${testimonials[current].text}”`"></p>
                    </div>

                    <!-- Client Info Footer -->
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pt-6 border-t border-white/15">
                        <div class="flex items-center gap-4">
                            <!-- Vehicle Thumbnail Circle -->
                            <div class="w-14 h-14 rounded-full overflow-hidden border-2 border-brand shadow-lg shadow-brand/40 shrink-0 bg-black">
                                <img :src="testimonials[current].image" :alt="testimonials[current].vehicle" class="w-full h-full object-cover">
                            </div>
                            <div>
                                <p class="font-display font-extrabold text-white text-xl leading-tight" x-text="testimonials[current].name"></p>
                                <p class="text-brand font-bold text-sm" x-text="testimonials[current].vehicle"></p>
                            </div>
                        </div>
                        
                        <!-- Rating Stars -->
                        <div class="flex gap-1.5 text-yellow-400 bg-white/5 px-4 py-2 rounded-full border border-white/10 shrink-0 w-fit">
                            <template x-for="i in testimonials[current].rating">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor" stroke="none"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                            </template>
                        </div>
                    </div>
                </div>

                <!-- Navigation Controls & Dots with Autoplay indicator -->
                <div class="flex items-center justify-between gap-5 mt-6 px-2">
                    <!-- Slide Indicator Dots -->
                    <div class="flex gap-2.5 items-center">
                        <template x-for="(testimonial, i) in testimonials" :key="i">
                            <button @click="goTo(i)"
                                    :class="i === current ? 'bg-brand w-8' : 'bg-white/30 hover:bg-white/60 w-2.5'"
                                    class="h-2.5 rounded-full transition-all duration-300 focus:outline-none"
                                    :aria-label="'Ir a testimonio ' + (i + 1)"></button>
                        </template>
                    </div>

                    <!-- Prev/Next Controls -->
                    <div class="flex items-center gap-3">
                        <button @click="prev()" class="w-12 h-12 rounded-full border border-white/20 bg-black/70 hover:bg-brand hover:border-brand flex items-center justify-center text-white transition-all duration-300 shadow-lg backdrop-blur-md focus:outline-none hover:scale-105 active:scale-95" aria-label="Anterior">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                        </button>

                        <button @click="next()" class="w-12 h-12 rounded-full border border-white/20 bg-black/70 hover:bg-brand hover:border-brand flex items-center justify-center text-white transition-all duration-300 shadow-lg backdrop-blur-md focus:outline-none hover:scale-105 active:scale-95" aria-label="Siguiente">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- FAQ Section -->
<section id="faq" x-data="{ openItems: { 0: true, 1: true } }" class="section-padding relative bg-gray-50 dark:bg-[#111111] transition-colors duration-300">
    <div class="container-custom">
        <div class="text-center mb-16">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-brand/10 border border-brand/20 text-brand text-xs font-bold uppercase tracking-widest mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><line x1="12" x2="12.01" y1="17" y2="17"/></svg>
                Preguntas Frecuentes
            </div>
            <h2 class="font-display text-3xl md:text-5xl font-bold text-black dark:text-white">
                Resolvemos tus <span class="text-gradient">dudas</span>
            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 max-w-5xl mx-auto">
            <!-- FAQ 1 -->
            <div class="h-fit">
                <button @click="openItems[0] = !openItems[0]"
                        :class="openItems[0] ? 'bg-white dark:bg-[#1A1A1A] border-brand/30 shadow-md' : 'bg-white dark:bg-[#1A1A1A]/50 border-black/5 dark:border-white/5 hover:border-black/10 dark:hover:border-white/10'"
                        class="w-full flex items-center justify-between p-6 rounded-2xl transition-all duration-300 border">
                    <span :class="openItems[0] ? 'text-black dark:text-white' : 'text-black/60 dark:text-white/70'" class="text-left font-bold">
                        ¿Por qué debería detallar mi auto?
                    </span>
                    <div class="shrink-0 ml-4 transition-transform duration-300" :class="openItems[0] ? 'rotate-180' : ''">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" :class="openItems[0] ? 'text-brand' : 'text-black/40 dark:text-white/40'"><line x1="12" x2="12" y1="5" y2="19"/><line x1="5" x2="19" y1="12" y2="12"/></svg>
                    </div>
                </button>
                <div x-show="openItems[0]" x-transition class="overflow-hidden">
                    <div class="p-6 text-black/60 dark:text-white/50 leading-relaxed text-sm bg-gray-50 dark:bg-[#1A1A1A]/30 rounded-b-2xl -mt-2">
                        El detallado automotriz es mucho más que un lavado: es el arte de restaurar y proteger cada superficie. Es una limpieza profunda y minuciosa que busca la perfección, eliminando impurezas y protegiendo la inversión que representa tu vehículo.
                    </div>
                </div>
            </div>

            <!-- FAQ 2 -->
            <div class="h-fit">
                <button @click="openItems[1] = !openItems[1]"
                        :class="openItems[1] ? 'bg-white dark:bg-[#1A1A1A] border-brand/30 shadow-md' : 'bg-white dark:bg-[#1A1A1A]/50 border-black/5 dark:border-white/5 hover:border-black/10 dark:hover:border-white/10'"
                        class="w-full flex items-center justify-between p-6 rounded-2xl transition-all duration-300 border">
                    <span :class="openItems[1] ? 'text-black dark:text-white' : 'text-black/60 dark:text-white/70'" class="text-left font-bold">
                        ¿Por qué aplicar un recubrimiento cerámico?
                    </span>
                    <div class="shrink-0 ml-4 transition-transform duration-300" :class="openItems[1] ? 'rotate-180' : ''">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" :class="openItems[1] ? 'text-brand' : 'text-black/40 dark:text-white/40'"><line x1="12" x2="12" y1="5" y2="19"/><line x1="5" x2="19" y1="12" y2="12"/></svg>
                    </div>
                </button>
                <div x-show="openItems[1]" x-transition class="overflow-hidden">
                    <div class="p-6 text-black/60 dark:text-white/50 leading-relaxed text-sm bg-gray-50 dark:bg-[#1A1A1A]/30 rounded-b-2xl -mt-2">
                        Los recubrimientos cerámicos basados en nanotecnología (SiO₂) sellan los poros de la pintura, creando una superficie ultra-fuerte e hidrofóbica. Esto ofrece resistencia superior contra rayos UV, químicos corrosivos, micro-rayas e incluso marcas de agua, manteniendo un brillo extremo por años.
                    </div>
                </div>
            </div>

            <!-- FAQ 3 -->
            <div class="h-fit">
                <button @click="openItems[2] = !openItems[2]"
                        :class="openItems[2] ? 'bg-white dark:bg-[#1A1A1A] border-brand/30 shadow-md' : 'bg-white dark:bg-[#1A1A1A]/50 border-black/5 dark:border-white/5 hover:border-black/10 dark:hover:border-white/10'"
                        class="w-full flex items-center justify-between p-6 rounded-2xl transition-all duration-300 border">
                    <span :class="openItems[2] ? 'text-black dark:text-white' : 'text-black/60 dark:text-white/70'" class="text-left font-bold">
                        ¿Cómo sé si mi auto necesita corrección?
                    </span>
                    <div class="shrink-0 ml-4 transition-transform duration-300" :class="openItems[2] ? 'rotate-180' : ''">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" :class="openItems[2] ? 'text-brand' : 'text-black/40 dark:text-white/40'"><line x1="12" x2="12" y1="5" y2="19"/><line x1="5" x2="19" y1="12" y2="12"/></svg>
                    </div>
                </button>
                <div x-show="openItems[2]" x-transition class="overflow-hidden">
                    <div class="p-6 text-black/60 dark:text-white/50 leading-relaxed text-sm bg-gray-50 dark:bg-[#1A1A1A]/30 rounded-b-2xl -mt-2">
                        Si bajo la luz del sol notas rayas circulares (swirls) o la pintura se ve opaca y sin brillo, es probable que necesites una corrección. Dependiendo de la gravedad de los defectos, nuestros pulidos pueden eliminar entre el 80% y 95% de los arañazos.
                    </div>
                </div>
            </div>

            <!-- FAQ 4 -->
            <div class="h-fit">
                <button @click="openItems[3] = !openItems[3]"
                        :class="openItems[3] ? 'bg-white dark:bg-[#1A1A1A] border-brand/30 shadow-md' : 'bg-white dark:bg-[#1A1A1A]/50 border-black/5 dark:border-white/5 hover:border-black/10 dark:hover:border-white/10'"
                        class="w-full flex items-center justify-between p-6 rounded-2xl transition-all duration-300 border">
                    <span :class="openItems[3] ? 'text-black dark:text-white' : 'text-black/60 dark:text-white/70'" class="text-left font-bold">
                        ¿Diferencia entre pulido ligero y corrección?
                    </span>
                    <div class="shrink-0 ml-4 transition-transform duration-300" :class="openItems[3] ? 'rotate-180' : ''">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" :class="openItems[3] ? 'text-brand' : 'text-black/40 dark:text-white/40'"><line x1="12" x2="12" y1="5" y2="19"/><line x1="5" x2="19" y1="12" y2="12"/></svg>
                    </div>
                </button>
                <div x-show="openItems[3]" x-transition class="overflow-hidden">
                    <div class="p-6 text-black/60 dark:text-white/50 leading-relaxed text-sm bg-gray-50 dark:bg-[#1A1A1A]/30 rounded-b-2xl -mt-2">
                        El pulido ligero busca devolver brillo eliminando microdefectos muy superficiales. La corrección de pintura multi-etapa es un proceso intensivo de corte y refinado diseñado para eliminar imperfecciones profundas del barniz, devolviendo un brillo como recién pintado.
                    </div>
                </div>
            </div>

            <!-- FAQ 5 -->
            <div class="h-fit">
                <button @click="openItems[4] = !openItems[4]"
                        :class="openItems[4] ? 'bg-white dark:bg-[#1A1A1A] border-brand/30 shadow-md' : 'bg-white dark:bg-[#1A1A1A]/50 border-black/5 dark:border-white/5 hover:border-black/10 dark:hover:border-white/10'"
                        class="w-full flex items-center justify-between p-6 rounded-2xl transition-all duration-300 border">
                    <span :class="openItems[4] ? 'text-black dark:text-white' : 'text-black/60 dark:text-white/70'" class="text-left font-bold">
                        ¿ExoShield es realmente invisible?
                    </span>
                    <div class="shrink-0 ml-4 transition-transform duration-300" :class="openItems[4] ? 'rotate-180' : ''">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" :class="openItems[4] ? 'text-brand' : 'text-black/40 dark:text-white/40'"><line x1="12" x2="12" y1="5" y2="19"/><line x1="5" x2="19" y1="12" y2="12"/></svg>
                    </div>
                </button>
                <div x-show="openItems[4]" x-transition class="overflow-hidden">
                    <div class="p-6 text-black/60 dark:text-white/50 leading-relaxed text-sm bg-gray-50 dark:bg-[#1A1A1A]/30 rounded-b-2xl -mt-2">
                        Sí, totalmente. ExoShield es una película protectora flexible con la mayor claridad óptica del mercado. No genera distorsión ni reflejos incómodos, protegiendo activamente tu costoso parabrisas de quebraduras sin notarse que está instalado.
                    </div>
                </div>
            </div>

            <!-- FAQ 6 -->
            <div class="h-fit">
                <button @click="openItems[5] = !openItems[5]"
                        :class="openItems[5] ? 'bg-white dark:bg-[#1A1A1A] border-brand/30 shadow-md' : 'bg-white dark:bg-[#1A1A1A]/50 border-black/5 dark:border-white/5 hover:border-black/10 dark:hover:border-white/10'"
                        class="w-full flex items-center justify-between p-6 rounded-2xl transition-all duration-300 border">
                    <span :class="openItems[5] ? 'text-black dark:text-white' : 'text-black/60 dark:text-white/70'" class="text-left font-bold">
                        ¿Cuánto demora realizar el servicio?
                    </span>
                    <div class="shrink-0 ml-4 transition-transform duration-300" :class="openItems[5] ? 'rotate-180' : ''">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" :class="openItems[5] ? 'text-brand' : 'text-black/40 dark:text-white/40'"><line x1="12" x2="12" y1="5" y2="19"/><line x1="5" x2="19" y1="12" y2="12"/></svg>
                    </div>
                </button>
                <div x-show="openItems[5]" x-transition class="overflow-hidden">
                    <div class="p-6 text-black/60 dark:text-white/50 leading-relaxed text-sm bg-gray-50 dark:bg-[#1A1A1A]/30 rounded-b-2xl -mt-2">
                        El tiempo varía según el paquete elegido. Un lavado premium toma entre 1.5 y 3 horas. Un detallado interior profundo toma 1 día completo, mientras que una corrección de pintura multi-etapa con Ceramic Coating Gtechniq requiere típicamente entre 2 y 4 días de minucioso trabajo.
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Final Section (Full-Bleed Video Background with Left Glass Card) -->
<section class="py-28 md:py-36 relative overflow-hidden bg-black text-white min-h-[650px] flex items-center">
    
    <!-- FULL SECTION BACKGROUND VIDEO (100% PROTAGONISM) -->
    <div class="absolute inset-0 z-0 overflow-hidden pointer-events-none">
        <video autoplay muted loop playsinline class="w-full h-full object-cover scale-105">
            <source src="/assets/videos/1.mp4" type="video/mp4">
        </video>
        <!-- Gradient Overlay: Dark on left for high contrast text readability, subtle on right for full video visibility -->
        <div class="absolute inset-0 bg-gradient-to-r from-black/95 via-black/70 to-black/30"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-black/60"></div>
    </div>

    <!-- Glow Accent -->
    <div class="absolute top-1/2 left-1/4 -translate-x-1/2 -translate-y-1/2 w-[700px] h-[700px] bg-brand/15 rounded-full blur-[180px] pointer-events-none z-0"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 w-full">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
            
            <!-- Left Side: Compact High-Contrast Glassmorphic CTA Card -->
            <div class="lg:col-span-6">
                <div class="relative rounded-[2.5rem] overflow-hidden border border-white/20 bg-black/85 backdrop-blur-2xl shadow-2xl p-8 sm:p-12 md:p-14 text-left">
                    <span class="text-brand text-xs font-bold tracking-[0.25em] uppercase mb-4 px-4 py-1.5 rounded-full bg-brand/20 border border-brand/40 inline-block backdrop-blur-md">¿Listo para la diferencia?</span>
                    
                    <h2 class="font-display text-4xl sm:text-5xl font-extrabold text-white uppercase tracking-tight mb-6 leading-tight">
                        Transforma tu vehículo <span class="text-gradient">hoy</span>
                    </h2>
                    
                    <p class="text-white/80 text-base sm:text-lg mb-8 font-light leading-relaxed">
                        Agenda tu cita y experimenta el nivel de excelencia profesional que tu vehículo merece.
                    </p>

                    <div class="flex flex-col sm:flex-row items-center gap-4">
                        <a href="/reserva" class="w-full sm:w-auto px-8 py-4 bg-brand hover:bg-brand-dark text-white font-bold rounded-2xl text-sm uppercase tracking-wider transition-all duration-300 shadow-xl shadow-brand/40 hover:scale-105 flex items-center justify-center gap-2">
                            <span>Cotizar ahora</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="shrink-0"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                        </a>
                        <a href="https://instagram.com/highcontrastdc" target="_blank" rel="noopener noreferrer" class="w-full sm:w-auto px-8 py-4 border border-white/25 hover:bg-white/10 text-white font-bold rounded-2xl text-sm uppercase tracking-wider transition-all duration-300 flex items-center justify-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="shrink-0"><rect width="20" height="20" x="2" y="2" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" x2="17.51" y1="6.5" y2="6.5"/></svg>
                            <span>Ver Instagram</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Right Side: Open Space highlighting full background video protagonism -->
            <div class="hidden lg:block lg:col-span-6"></div>

        </div>
    </div>
</section>

@endsection

@section('scripts')
@php
    $schemaProfile = \App\Models\BusinessProfile::first();
    $jsonLd = [
        '@context' => 'https://schema.org',
        '@graph' => [
            [
                '@type' => 'LocalBusiness',
                '@id' => url('/') . '#localbusiness',
                'name' => $schemaProfile->business_name ?? 'High Contrast Detailing Center',
                'image' => $schemaProfile->logo ? asset($schemaProfile->logo) : asset('assets/logos/main-logo.png'),
                'url' => url('/'),
                'telephone' => $schemaProfile->phone ?? '+56 9 5102 4782',
                'email' => $schemaProfile->email ?? 'info@highcontrastdetailing.cl',
                'address' => [
                    '@type' => 'PostalAddress',
                    'streetAddress' => trim(($schemaProfile->address_line1 ?? 'Chicureo') . ' ' . ($schemaProfile->address_line2 ?? '')),
                    'addressLocality' => $schemaProfile->city ?? 'Colina',
                    'addressRegion' => 'Región Metropolitana',
                    'addressCountry' => 'CL',
                ],
                'geo' => [
                    '@type' => 'GeoCoordinates',
                    'latitude' => '-33.2798',
                    'longitude' => '-70.6433',
                ],
                'areaServed' => ['Santiago', 'Chicureo', 'Colina', 'Lo Barnechea', 'Vitacura', 'Las Condes'],
                'priceRange' => '$$$',
                'makesOffer' => [
                    ['@type' => 'Offer', 'name' => 'Sellado Cerámico Gtechniq Platinum'],
                    ['@type' => 'Offer', 'name' => 'Protección de Parabrisas ExoShield ULTRA'],
                ],
            ],
            [
                '@type' => 'Organization',
                '@id' => url('/') . '#organization',
                'name' => $schemaProfile->business_name ?? 'High Contrast Detailing Center',
                'url' => url('/'),
                'logo' => $schemaProfile->logo ? asset($schemaProfile->logo) : asset('assets/logos/main-logo.png'),
                'sameAs' => [
                    'https://instagram.com/' . ltrim($schemaProfile->instagram ?? 'highcontrastdc', '@'),
                ],
            ],
        ],
    ];
@endphp
<script type="application/ld+json">
{!! json_encode($jsonLd, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
</script>
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

@include('partials.schema-local-business')

@php
    $faqData = [
        [
            'q' => '¿Por qué debería detallar mi auto?',
            'a' => 'El detallado automotriz es mucho más que un lavado: es el arte de restaurar y proteger cada superficie. Es una limpieza profunda y minuciosa que busca la perfección, eliminando impurezas y protegiendo la inversión que representa tu vehículo.'
        ],
        [
            'q' => '¿Por qué aplicar un recubrimiento cerámico?',
            'a' => 'Los recubrimientos cerámicos basados en nanotecnología (SiO₂) sellan los poros de la pintura, creando una superficie ultra-fuerte e hidrofóbica. Esto ofrece resistencia superior contra rayos UV, químicos corrosivos, micro-rayas e incluso marcas de agua, manteniendo un brillo extremo por años.'
        ],
        [
            'q' => '¿Cómo sé si mi auto necesita corrección?',
            'a' => 'Si bajo la luz del sol notas rayas circulares (swirls) o la pintura se ve opaca y sin brillo, es probable que necesites una corrección. Dependiendo de la gravedad de los defectos, nuestros pulidos pueden eliminar entre el 80% y 95% de los arañazos.'
        ],
        [
            'q' => '¿Diferencia entre pulido ligero y corrección?',
            'a' => 'El pulido ligero busca devolver brillo eliminando microdefectos muy superficiales. La corrección de pintura multi-etapa es un proceso intensivo de corte y refinado diseñado para eliminar imperfecciones profundas del barniz, devolviendo un brillo como recién pintado.'
        ],
        [
            'q' => '¿ExoShield es realmente invisible?',
            'a' => 'Sí, totalmente. ExoShield es una película protectora flexible con la mayor claridad óptica del mercado. No genera distorsión ni reflejos incómodos, protegiendo activamente tu costoso parabrisas de quebraduras sin notarse que está instalado.'
        ],
        [
            'q' => '¿Cuánto demora realizar el servicio?',
            'a' => 'El tiempo varía según el paquete elegido. Un lavado premium toma entre 1.5 y 3 horas. Un detallado interior profundo toma 1 día completo, mientras que una corrección de pintura multi-etapa con Ceramic Coating Gtechniq requiere típicamente entre 2 y 4 días de minucioso trabajo.'
        ]
    ];
    $faqEntities = array_map(fn($f) => [
        '@type' => 'Question',
        'name' => $f['q'],
        'acceptedAnswer' => [
            '@type' => 'Answer',
            'text' => $f['a']
        ]
    ], $faqData);
    $faqJsonLd = [
        '@context' => 'https://schema.org',
        '@type' => 'FAQPage',
        'mainEntity' => $faqEntities
    ];
@endphp
<script type="application/ld+json">
{!! json_encode($faqJsonLd, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
</script>
@endsection


