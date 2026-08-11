<?php $__env->startSection('title', 'High Contrast Detailing Center | Car Detailing Premium en Chicureo'); ?>
<?php $__env->startSection('meta_description', 'Centro de detailing automotriz premium en Chicureo, Colina. Pulido profesional, recubrimiento cerámico Gtechniq, detallado de interior y protección de parabrisas.'); ?>
<?php $__env->startSection('meta_keywords', 'detailing chicureo, car detailing santiago, pulido de autos colina, sellado ceramico chicureo, coating 9h santiago, limpieza de tapiz chicureo, High Contrast Detailing'); ?>

<?php $__env->startSection('content'); ?>
<?php
    $activeSlides = $slides ?? collect();
    // Filter out incomplete slides if any exist in DB
    $activeSlides = $activeSlides->filter(function($s) {
        return !empty($s->media_path) || !empty($s->title);
    });
    if ($activeSlides->isEmpty()) {
        $activeSlides = collect([
            (object)[
                'title' => 'HIGH',
                'title_gradient' => 'CONTRAST',
                'subtitle' => 'El estándar más alto en detallado automotriz. Protección, brillo y perfección absoluta.',
                'media_type' => 'video',
                'media_path' => '/assets/videos/hero-banner.mp4',
                'button_primary_text' => 'Cotiza tu servicio',
                'button_primary_url' => '/reserva',
                'button_secondary_text' => 'Explorar servicios',
                'button_secondary_url' => '#servicios',
            ],
            (object)[
                'title' => 'SELLADO',
                'title_gradient' => 'CERÁMICO',
                'subtitle' => 'Protección extrema con tecnología Gtechniq Platinum. Hasta 9 años de brillo permanente.',
                'media_type' => 'video',
                'media_path' => '/assets/videos/hero-gtechniq.mp4',
                'button_primary_text' => 'Cotizar Sellado',
                'button_primary_url' => '/reserva?category=ceramic',
                'button_secondary_text' => 'Saber más',
                'button_secondary_url' => '/sellado-ceramico',
            ],
            (object)[
                'title' => 'CORRECCIÓN DE',
                'title_gradient' => 'PINTURA',
                'subtitle' => 'Restauración artesanal mediante pulido técnico multi-etapa, eliminando micro-rayas.',
                'media_type' => 'video',
                'media_path' => '/assets/videos/pulido-correccion.mp4',
                'button_primary_text' => 'Cotizar Pulido',
                'button_primary_url' => '/reserva?category=correccion',
                'button_secondary_text' => 'Ver Detalles',
                'button_secondary_url' => '/pulido-de-autos-santiago',
            ],
            (object)[
                'title' => 'DETALLADO DE',
                'title_gradient' => 'INTERIOR',
                'subtitle' => 'Limpieza a vapor, sanitización profunda y acondicionamiento protector de cuero.',
                'media_type' => 'video',
                'media_path' => '/assets/videos/lavado-premium.mp4',
                'button_primary_text' => 'Cotizar Detallado',
                'button_primary_url' => '/reserva?category=limpieza',
                'button_secondary_text' => 'Ver Más',
                'button_secondary_url' => '/detailing-interior',
            ]
        ]);
    }
?>

<!-- Hero Section with Alpine Carousel -->
<section x-data="{ 
    activeSlide: 0,
    slidesCount: <?php echo e($activeSlides->count()); ?>,
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


    <?php $__currentLoopData = $activeSlides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div x-show="activeSlide === <?php echo e($index); ?>"
             x-transition:enter="transition ease-out duration-1000"
             x-transition:enter-start="opacity-0 scale-105"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-800"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95"
             class="absolute inset-0 w-full h-full"
             style="display: <?php echo e($index === 0 ? 'block' : 'none'); ?>;">
             
             <!-- Video/Image background (High Video Emphasis) -->
             <div class="absolute inset-0 bg-[#0A0A0A] overflow-hidden">
                 <?php if($slide->media_type === 'video'): ?>
                     <video autoplay muted loop playsinline class="w-full h-full object-cover opacity-85 md:opacity-90 animate-slow-zoom">
                         <source src="<?php echo e(asset($slide->media_path)); ?>" type="video/mp4">
                     </video>
                 <?php else: ?>
                     <img src="<?php echo e(asset($slide->media_path)); ?>" class="w-full h-full object-cover opacity-85 md:opacity-90 animate-slow-zoom" alt="slide bg">
                 <?php endif; ?>
                 <!-- Soft subtle gradient overlay so Video dominates visually -->
                 <div class="absolute inset-0 bg-gradient-to-r from-[#0A0A0A]/90 via-[#0A0A0A]/40 to-transparent z-10 w-full md:w-1/2 lg:w-5/12"></div>
                 <div class="absolute inset-0 bg-gradient-to-b from-[#0A0A0A]/70 via-transparent to-[#0A0A0A]/90 z-10"></div>
             </div>

             <!-- Floating orb only on first slide -->
             <?php if($index === 0): ?>
                 <div class="absolute top-1/3 left-10 w-80 h-80 bg-brand/20 rounded-full blur-[130px] opacity-60 pointer-events-none z-10"></div>
             <?php endif; ?>

             <!-- Content Container (Compact Middle-Left Area) -->
             <div class="absolute inset-0 z-20 flex items-center justify-start pointer-events-none">
                 <div class="w-full max-w-7xl mx-auto px-6 md:px-12 lg:px-16 pointer-events-auto">
                     <div class="max-w-sm sm:max-w-md md:max-w-lg text-left pt-12 md:pt-0">
                          <?php if($index === 0): ?>
                              <h1 class="font-display text-2xl sm:text-4xl md:text-5xl font-extrabold text-white leading-[0.95] tracking-tight uppercase mb-3 text-left drop-shadow-md">
                                  <?php echo e($slide->title); ?>

                                  <?php if(!empty($slide->title_gradient)): ?>
                                      <span class="block text-gradient mt-0.5"><?php echo e($slide->title_gradient); ?></span>
                                  <?php endif; ?>
                              </h1>
                          <?php else: ?>
                              <h2 class="font-display text-2xl sm:text-4xl md:text-5xl font-extrabold text-white leading-[0.95] tracking-tight uppercase mb-3 text-left drop-shadow-md">
                                  <?php echo e($slide->title); ?>

                                  <?php if(!empty($slide->title_gradient)): ?>
                                      <span class="block text-gradient mt-0.5"><?php echo e($slide->title_gradient); ?></span>
                                  <?php endif; ?>
                              </h2>
                          <?php endif; ?>


                         <p class="text-xs sm:text-sm md:text-base text-white/90 max-w-sm mb-6 leading-relaxed font-normal text-left drop-shadow-sm">
                             <?php echo e($slide->subtitle); ?>

                         </p>

                         <div class="flex flex-row items-center justify-start gap-3">
                             <?php if($slide->button_primary_text): ?>
                                 <a href="<?php echo e($slide->button_primary_url); ?>" class="flex items-center justify-center gap-2 px-5 sm:px-6 py-2.5 bg-brand hover:bg-brand-dark text-white font-semibold rounded-full text-xs sm:text-sm transition-all duration-300 shadow-md shadow-brand/30 hover:scale-105">
                                     <!-- Calendar Icon -->
                                     <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white animate-pulse" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                     <span><?php echo e($slide->button_primary_text); ?></span>
                                 </a>
                             <?php endif; ?>
                             <?php if($slide->button_secondary_text): ?>
                                 <a href="<?php echo e($slide->button_secondary_url); ?>" class="flex items-center justify-center gap-2 px-5 sm:px-6 py-2.5 border border-white/30 hover:border-brand/60 hover:bg-white/10 text-white font-semibold rounded-full text-xs sm:text-sm transition-all duration-300 backdrop-blur-xs">
                                     <!-- Explore Grid Icon -->
                                     <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white/80 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                                     <span><?php echo e($slide->button_secondary_text); ?></span>
                                 </a>
                             <?php endif; ?>
                         </div>
                     </div>
                 </div>
             </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <!-- Slide Navigation & Indicators (Bottom-Left Aligned) -->
    <template x-if="slidesCount > 1">
        <div class="absolute bottom-8 left-6 md:left-12 lg:left-16 z-30 flex items-center gap-4 sm:gap-6">
            <!-- Slide Counter -->
            <div class="text-white/70 font-mono text-xs sm:text-sm tracking-wider drop-shadow-sm">
                <span class="text-white font-bold" x-text="String(activeSlide + 1).padStart(2, '0')"></span>
                <span class="mx-1 text-white/40">/</span>
                <span x-text="String(slidesCount).padStart(2, '0')"></span>
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




<!-- Ceramic Coating Full-Screen Video Section (Middle-Right Aligned) -->
<section id="ceramic-showcase" class="hero-fullscreen relative w-full overflow-hidden bg-[#0A0A0A]" style="min-height: 100vh; min-height: 100dvh;">
    <!-- Background Video (High Quality Gtechniq Showcase) -->
    <div class="absolute inset-0 bg-[#0A0A0A] overflow-hidden">
        <video autoplay muted loop playsinline class="w-full h-full object-cover opacity-85 md:opacity-90 animate-slow-zoom">
            <source src="/assets/videos/hero-gtechniq.mp4" type="video/mp4">
        </video>
        <!-- Dark Gradient Overlay Focused on the Right Side -->
        <div class="absolute inset-0 bg-gradient-to-l from-[#0A0A0A] via-[#0A0A0A]/90 to-transparent z-10 w-full md:w-3/4 lg:w-3/5 right-0 left-auto"></div>
        <div class="absolute inset-0 bg-gradient-to-b from-[#0A0A0A]/70 via-transparent to-[#0A0A0A]/90 z-10"></div>
    </div>

    <!-- Floating orb on right side -->
    <div class="absolute top-1/3 right-10 w-80 h-80 bg-brand/20 rounded-full blur-[130px] opacity-60 pointer-events-none z-10"></div>

    <!-- Content Container (Compact Middle-Right Column Area) -->
    <div class="absolute inset-0 z-20 flex items-center justify-end pointer-events-none">
        <div class="w-full max-w-7xl mx-auto px-6 md:px-12 lg:px-16 pointer-events-auto">
            <div class="max-w-sm sm:max-w-md md:max-w-lg text-right ml-auto pt-12 md:pt-0">
                <!-- Gtechniq Badge (Right aligned) -->
                <div class="inline-flex items-center gap-2.5 px-4 py-1.5 rounded-full bg-brand/20 border border-brand/40 text-white text-[10px] sm:text-xs font-bold uppercase tracking-widest mb-4 backdrop-blur-md">
                    <img src="/assets/logos/Gtechniq-Logo.png" alt="Gtechniq" class="h-3.5 object-contain">
                    <span class="w-1.5 h-1.5 rounded-full bg-brand animate-pulse"></span>
                    <span>Ceramic Coating 9H</span>
                </div>

                <!-- Headline (Right aligned) -->
                <h2 class="font-display text-2xl sm:text-4xl md:text-5xl font-extrabold text-white leading-[0.95] tracking-tight uppercase mb-3 text-right drop-shadow-md">
                    SELLADO CERÁMICO
                    <span class="block text-gradient mt-0.5">TECNOLOGÍA 9H</span>
                </h2>

                <!-- Subtitle (Right aligned) -->
                <p class="text-xs sm:text-sm md:text-base text-white/90 max-w-sm mb-6 leading-relaxed font-normal text-right ml-auto drop-shadow-sm">
                    Protección extrema de nivel profesional con Gtechniq Platinum. Hasta 9 años de brillo espejo permanente y repelencia hidrofóbica.
                </p>

                <!-- CTA Action Buttons (Right aligned) -->
                <div class="flex flex-row items-center justify-end gap-3">
                    <a href="/reserva?category=ceramic" class="flex items-center justify-center gap-2 px-5 sm:px-6 py-2.5 bg-brand hover:bg-brand-dark text-white font-semibold rounded-full text-xs sm:text-sm transition-all duration-300 shadow-md shadow-brand/30 hover:scale-105">
                        <!-- Calendar Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white animate-pulse" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <span>Cotizar Sellado</span>
                    </a>
                    <a href="/sellado-ceramico" class="flex items-center justify-center gap-2 px-5 sm:px-6 py-2.5 border border-white/30 hover:border-brand/60 hover:bg-white/10 text-white font-semibold rounded-full text-xs sm:text-sm transition-all duration-300 backdrop-blur-xs">
                        <span>Saber más</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white/80 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="m9 18 6-6-6-6"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>



<!-- Paint Correction Full-Screen Video Section (Middle-Left Aligned) -->
<section id="pulido-showcase" class="hero-fullscreen relative w-full overflow-hidden bg-[#0A0A0A]" style="min-height: 100vh; min-height: 100dvh;">
    <!-- Background Video (Polishing & Paint Correction HD Video) -->
    <div class="absolute inset-0 bg-[#0A0A0A] overflow-hidden">
        <video autoplay muted loop playsinline class="w-full h-full object-cover opacity-85 md:opacity-90 animate-slow-zoom">
            <source src="/assets/videos/pulido-correccion.mp4" type="video/mp4">
        </video>
        <!-- Dark Gradient Overlay Focused on the Left Side -->
        <div class="absolute inset-0 bg-gradient-to-r from-[#0A0A0A] via-[#0A0A0A]/90 to-transparent z-10 w-full md:w-3/4 lg:w-3/5 left-0 right-auto"></div>
        <div class="absolute inset-0 bg-gradient-to-b from-[#0A0A0A]/70 via-transparent to-[#0A0A0A]/90 z-10"></div>
    </div>

    <!-- Floating orb on left side -->
    <div class="absolute top-1/3 left-10 w-80 h-80 bg-brand/20 rounded-full blur-[130px] opacity-60 pointer-events-none z-10"></div>

    <!-- Content Container (Compact Middle-Left Column Area) -->
    <div class="absolute inset-0 z-20 flex items-center justify-start pointer-events-none">
        <div class="w-full max-w-7xl mx-auto px-6 md:px-12 lg:px-16 pointer-events-auto">
            <div class="max-w-sm sm:max-w-md md:max-w-lg text-left pt-12 md:pt-0">
                <!-- Badge (Left aligned) -->
                <div class="inline-flex items-center gap-2.5 px-4 py-1.5 rounded-full bg-brand/20 border border-brand/40 text-white text-[10px] sm:text-xs font-bold uppercase tracking-widest mb-4 backdrop-blur-md">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 text-brand" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="m12 3-1.912 5.886L4 9l4.912.863L12 15l1.912-5.137L20 9l-4.912-.114z"/></svg>
                    <span>Pulido Técnico Multi-Etapa</span>
                </div>

                <!-- Headline (Left aligned) -->
                <h2 class="font-display text-2xl sm:text-4xl md:text-5xl font-extrabold text-white leading-[0.95] tracking-tight uppercase mb-3 text-left drop-shadow-md">
                    CORRECCIÓN DE PINTURA
                    <span class="block text-gradient mt-0.5">ACABADO ESPEJO 8K</span>
                </h2>

                <!-- Subtitle (Left aligned) -->
                <p class="text-xs sm:text-sm md:text-base text-white/90 max-w-sm mb-6 leading-relaxed font-normal text-left drop-shadow-sm">
                    Restauración artesanal de pintura. Eliminamos hasta un 95% de micro-rayas, swirles y marcas de lavado, devolviendo la claridad óptica pura a la laca.
                </p>

                <!-- CTA Action Buttons (Left aligned) -->
                <div class="flex flex-row items-center justify-start gap-3">
                    <a href="/reserva?category=correccion" class="flex items-center justify-center gap-2 px-5 sm:px-6 py-2.5 bg-brand hover:bg-brand-dark text-white font-semibold rounded-full text-xs sm:text-sm transition-all duration-300 shadow-md shadow-brand/30 hover:scale-105">
                        <!-- Calendar Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white animate-pulse" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <span>Cotizar Pulido</span>
                    </a>
                    <a href="/pulido-de-autos-santiago" class="flex items-center justify-center gap-2 px-5 sm:px-6 py-2.5 border border-white/30 hover:border-brand/60 hover:bg-white/10 text-white font-semibold rounded-full text-xs sm:text-sm transition-all duration-300 backdrop-blur-xs">
                        <span>Ver Detalles</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white/80 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="m9 18 6-6-6-6"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Interactive EVOKN-Style Horizontal Scroll Showcase Section -->
<section id="experiencia-evokn" 
         x-data="{
             scrollLeft() { $refs.slider.scrollBy({ left: -400, behavior: 'smooth' }) },
             scrollRight() { $refs.slider.scrollBy({ left: 400, behavior: 'smooth' }) },
             handleWheel(e) {
                 if (Math.abs(e.deltaY) > Math.abs(e.deltaX)) {
                     $refs.slider.scrollLeft += e.deltaY * 1.5;
                 }
             }
         }"
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

        <!-- EVOKN Horizontal Scroll Track -->
        <div x-ref="slider" 
             @wheel.passive="handleWheel($event)"
             class="flex gap-6 overflow-x-auto scrollbar-none py-4 snap-x snap-mandatory cursor-grab active:cursor-grabbing select-none -mx-4 px-4 sm:mx-0 sm:px-0">
            
            <!-- Card 1: Gtechniq Ceramic Coating -->
            <div class="w-[300px] sm:w-[380px] h-[480px] shrink-0 snap-start rounded-[2.5rem] overflow-hidden relative group shadow-2xl border border-black/10 dark:border-white/10 transition-all duration-500 hover:scale-[1.02] hover:border-brand/50">
                <video autoplay muted loop playsinline class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    <source src="/assets/videos/hero-gtechniq.mp4" type="video/mp4">
                </video>
                <div class="absolute inset-0 bg-gradient-to-t from-black/95 via-black/40 to-transparent"></div>
                
                <!-- Badge & Stats overlay -->
                <div class="absolute inset-0 p-8 flex flex-col justify-between z-10">
                    <div class="flex items-center justify-between">
                        <span class="px-4 py-1.5 rounded-full bg-brand text-white text-[10px] font-bold uppercase tracking-widest shadow-lg">Gtechniq Certified</span>
                        <span class="w-8 h-8 rounded-full bg-white/20 backdrop-blur-md flex items-center justify-center text-white text-xs font-bold">01</span>
                    </div>

                    <div>
                        <p class="font-display text-4xl font-extrabold text-white uppercase leading-none mb-2">9H Platinum</p>
                        <p class="text-white/80 text-xs font-light leading-relaxed mb-4">Acreditados oficiales para aplicación de sellado cerámico permanente con garantía hasta 9 años.</p>
                        <div class="flex items-center justify-between pt-4 border-t border-white/20">
                            <span class="text-brand font-bold text-xs uppercase tracking-wider">99% Satisfacción</span>
                            <a href="/sellado-ceramico" class="w-10 h-10 rounded-full bg-white/10 hover:bg-brand backdrop-blur-md flex items-center justify-center text-white transition-all group-hover:scale-110">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="m9 18 6-6-6-6"/></svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 2: Paint Correction 8K -->
            <div class="w-[300px] sm:w-[380px] h-[480px] shrink-0 snap-start rounded-[2.5rem] overflow-hidden relative group shadow-2xl border border-black/10 dark:border-white/10 transition-all duration-500 hover:scale-[1.02] hover:border-brand/50">
                <video autoplay muted loop playsinline class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    <source src="/assets/videos/pulido-correccion.mp4" type="video/mp4">
                </video>
                <div class="absolute inset-0 bg-gradient-to-t from-black/95 via-black/40 to-transparent"></div>
                
                <div class="absolute inset-0 p-8 flex flex-col justify-between z-10">
                    <div class="flex items-center justify-between">
                        <span class="px-4 py-1.5 rounded-full bg-brand text-white text-[10px] font-bold uppercase tracking-widest shadow-lg">Multi-Etapa</span>
                        <span class="w-8 h-8 rounded-full bg-white/20 backdrop-blur-md flex items-center justify-center text-white text-xs font-bold">02</span>
                    </div>

                    <div>
                        <p class="font-display text-4xl font-extrabold text-white uppercase leading-none mb-2">95% Rayas Elim.</p>
                        <p class="text-white/80 text-xs font-light leading-relaxed mb-4">Pulido técnico artesanal bajo luces de inspección de espectro solar para restaurar la laca original.</p>
                        <div class="flex items-center justify-between pt-4 border-t border-white/20">
                            <span class="text-brand font-bold text-xs uppercase tracking-wider">Acabado Espejo 8K</span>
                            <a href="/pulido-de-autos-santiago" class="w-10 h-10 rounded-full bg-white/10 hover:bg-brand backdrop-blur-md flex items-center justify-center text-white transition-all group-hover:scale-110">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="m9 18 6-6-6-6"/></svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 3: ExoShield Windshield Protection -->
            <div class="w-[300px] sm:w-[380px] h-[480px] shrink-0 snap-start rounded-[2.5rem] overflow-hidden relative group shadow-2xl border border-black/10 dark:border-white/10 transition-all duration-500 hover:scale-[1.02] hover:border-brand/50">
                <video autoplay muted loop playsinline class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    <source src="/assets/videos/4K animated Windshield - Jeep .mp4" type="video/mp4">
                </video>
                <div class="absolute inset-0 bg-gradient-to-t from-black/95 via-black/40 to-transparent"></div>
                
                <div class="absolute inset-0 p-8 flex flex-col justify-between z-10">
                    <div class="flex items-center justify-between">
                        <span class="px-4 py-1.5 rounded-full bg-brand text-white text-[10px] font-bold uppercase tracking-widest shadow-lg">ExoShield SPRINT</span>
                        <span class="w-8 h-8 rounded-full bg-white/20 backdrop-blur-md flex items-center justify-center text-white text-xs font-bold">03</span>
                    </div>

                    <div>
                        <p class="font-display text-4xl font-extrabold text-white uppercase leading-none mb-2">6x Más Resistente</p>
                        <p class="text-white/80 text-xs font-light leading-relaxed mb-4">Película protectora nanotecnológica de TPU que previene trizaduras y roturas por impactos de piedras.</p>
                        <div class="flex items-center justify-between pt-4 border-t border-white/20">
                            <span class="text-brand font-bold text-xs uppercase tracking-wider">Instalador Autorizado</span>
                            <a href="/proteccion-parabrisas-santiago" class="w-10 h-10 rounded-full bg-white/10 hover:bg-brand backdrop-blur-md flex items-center justify-center text-white transition-all group-hover:scale-110">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="m9 18 6-6-6-6"/></svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 4: Interior Vapor Detailing -->
            <div class="w-[300px] sm:w-[380px] h-[480px] shrink-0 snap-start rounded-[2.5rem] overflow-hidden relative group shadow-2xl border border-black/10 dark:border-white/10 transition-all duration-500 hover:scale-[1.02] hover:border-brand/50">
                <video autoplay muted loop playsinline class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    <source src="/assets/videos/lavado-premium.mp4" type="video/mp4">
                </video>
                <div class="absolute inset-0 bg-gradient-to-t from-black/95 via-black/40 to-transparent"></div>
                
                <div class="absolute inset-0 p-8 flex flex-col justify-between z-10">
                    <div class="flex items-center justify-between">
                        <span class="px-4 py-1.5 rounded-full bg-brand text-white text-[10px] font-bold uppercase tracking-widest shadow-lg">Sanitización Vapor</span>
                        <span class="w-8 h-8 rounded-full bg-white/20 backdrop-blur-md flex items-center justify-center text-white text-xs font-bold">04</span>
                    </div>

                    <div>
                        <p class="font-display text-4xl font-extrabold text-white uppercase leading-none mb-2">160°C Desinfección</p>
                        <p class="text-white/80 text-xs font-light leading-relaxed mb-4">Limpieza profunda a alta presión y vapor seco. Acondicionamiento protector de cuero y eliminación de olores.</p>
                        <div class="flex items-center justify-between pt-4 border-t border-white/20">
                            <span class="text-brand font-bold text-xs uppercase tracking-wider">Detallado Interior</span>
                            <a href="/detailing-interior" class="w-10 h-10 rounded-full bg-white/10 hover:bg-brand backdrop-blur-md flex items-center justify-center text-white transition-all group-hover:scale-110">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="m9 18 6-6-6-6"/></svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 5: 500+ Satisfied Clients -->
            <div class="w-[300px] sm:w-[380px] h-[480px] shrink-0 snap-start rounded-[2.5rem] overflow-hidden relative group shadow-2xl border border-black/10 dark:border-white/10 transition-all duration-500 hover:scale-[1.02] hover:border-brand/50">
                <video autoplay muted loop playsinline class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    <source src="/assets/videos/hero-banner.mp4" type="video/mp4">
                </video>
                <div class="absolute inset-0 bg-gradient-to-t from-black/95 via-black/40 to-transparent"></div>
                
                <div class="absolute inset-0 p-8 flex flex-col justify-between z-10">
                    <div class="flex items-center justify-between">
                        <span class="px-4 py-1.5 rounded-full bg-brand text-white text-[10px] font-bold uppercase tracking-widest shadow-lg">Confianza Total</span>
                        <span class="w-8 h-8 rounded-full bg-white/20 backdrop-blur-md flex items-center justify-center text-white text-xs font-bold">05</span>
                    </div>

                    <div>
                        <p class="font-display text-4xl font-extrabold text-white uppercase leading-none mb-2">500+ Clientes</p>
                        <p class="text-white/80 text-xs font-light leading-relaxed mb-4">Los vehículos de más alto estándar en Santiago confían en nuestra precisión y metódico estándar de entrega.</p>
                        <div class="flex items-center justify-between pt-4 border-t border-white/20">
                            <span class="text-brand font-bold text-xs uppercase tracking-wider">Chicureo, Colina</span>
                            <a href="/reserva" class="w-10 h-10 rounded-full bg-white/10 hover:bg-brand backdrop-blur-md flex items-center justify-center text-white transition-all group-hover:scale-110">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="m9 18 6-6-6-6"/></svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Interactive Car Wash Game Section -->
<section id="car-wash-game" 
         class="py-24 md:py-32 relative overflow-hidden bg-[#0A0A0A] text-white select-none">
    <!-- Glow Background Accents -->
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[900px] h-[900px] bg-brand/15 rounded-full blur-[180px] pointer-events-none"></div>

    <div class="container-custom relative z-20">
        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto mb-10">
            <span class="inline-flex items-center gap-2 text-brand text-xs font-bold tracking-[0.25em] uppercase mb-3 px-4 py-1.5 rounded-full bg-brand/15 border border-brand/30">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-brand animate-spin" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v3m0 12v3m9-9h-3M6 12H3m15.364-6.364l-2.121 2.121M7.757 16.243l-2.121 2.121m12.728 0l-2.121-2.121M7.757 7.757L5.636 5.636"/></svg>
                EXPERIENCIA INTERACTIVA MULTI-HERRAMIENTA
            </span>
            <h2 class="font-display text-3xl sm:text-5xl md:text-6xl font-extrabold text-white uppercase tracking-tight leading-none mb-4">
                Lava & Detalla el <span class="text-gradient">BMW M3</span>
            </h2>
            <p class="text-white/70 text-sm sm:text-base font-light max-w-xl mx-auto">
                Selecciona tus herramientas (hidrolavadora, espuma de jabón, esponja o sellado cerámico) para dejar el vehículo 100% perfecto.
            </p>
        </div>

        <!-- Game Main Container -->
        <div id="game-stage-wrapper" class="relative max-w-5xl mx-auto rounded-[2.5rem] overflow-hidden border border-white/15 bg-black/60 backdrop-blur-xl shadow-2xl p-4 sm:p-8">
            
            <!-- TOOL SELECTOR BAR & PROGRESS -->
            <div class="flex flex-col gap-6 mb-6">
                <!-- Top Toolbar: Interactive Tool Buttons -->
                <div class="flex flex-wrap items-center justify-center gap-2 sm:gap-3 p-2 bg-white/5 rounded-2xl border border-white/10">
                    <button data-tool="hydro" class="game-tool-btn active px-4 py-2.5 rounded-xl border border-brand bg-brand text-white font-bold text-xs uppercase tracking-wider transition-all flex items-center gap-2 shadow-lg shadow-brand/20">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-cyan-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v3m0 12v3m9-9h-3M6 12H3m15.364-6.364l-2.121 2.121M7.757 16.243l-2.121 2.121m12.728 0l-2.121-2.121M7.757 7.757L5.636 5.636"/></svg>
                        <span>1. Hidrolavadora</span>
                    </button>
                    
                    <button data-tool="soap" class="game-tool-btn px-4 py-2.5 rounded-xl border border-white/15 bg-white/5 hover:bg-white/15 text-white/80 hover:text-white font-bold text-xs uppercase tracking-wider transition-all flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="4"/></svg>
                        <span>2. Aplicar Jabón</span>
                    </button>

                    <button data-tool="sponge" class="game-tool-btn px-4 py-2.5 rounded-xl border border-white/15 bg-white/5 hover:bg-white/15 text-white/80 hover:text-white font-bold text-xs uppercase tracking-wider transition-all flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-amber-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="3" y="5" width="18" height="14" rx="4"/></svg>
                        <span>3. Pasar Esponja</span>
                    </button>

                    <button data-tool="ceramic" class="game-tool-btn px-4 py-2.5 rounded-xl border border-white/15 bg-white/5 hover:bg-white/15 text-white/80 hover:text-white font-bold text-xs uppercase tracking-wider transition-all flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-brand animate-pulse" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="m12 3-1.912 5.886L4 9l4.912.863L12 15l1.912-5.137L20 9l-4.912-.114z"/></svg>
                        <span>4. Ceramic Coating 9H</span>
                    </button>
                </div>

                <!-- HUD Stats Header -->
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4 px-2">
                    <!-- Clean Progress Bar -->
                    <div class="w-full sm:w-1/2 flex items-center gap-4">
                        <span class="text-xs font-bold uppercase tracking-widest text-white/80 shrink-0">Progreso:</span>
                        <div class="w-full h-4 bg-white/10 rounded-full overflow-hidden border border-white/20 relative">
                            <div id="clean-progress-bar" class="h-full bg-gradient-to-r from-brand to-rose-400 transition-all duration-300 w-0"></div>
                        </div>
                        <span id="clean-percentage-text" class="text-brand font-display font-extrabold text-lg shrink-0 w-14 text-right">0%</span>
                    </div>

                    <!-- Action Controls -->
                    <div class="flex items-center gap-2 w-full sm:w-auto justify-end">
                        <button id="reset-mud-btn" class="px-3.5 py-2 rounded-full border border-white/20 bg-white/5 hover:bg-white/15 text-white text-[11px] font-bold uppercase tracking-wider transition-all duration-200 flex items-center gap-1.5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 text-brand" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                            Ensuciar
                        </button>
                        <button id="auto-clean-btn" class="px-3.5 py-2 rounded-full bg-brand hover:bg-brand-dark text-white text-[11px] font-bold uppercase tracking-wider transition-all duration-200 shadow-md shadow-brand/30">
                            Lavado 100%
                        </button>
                    </div>
                </div>
            </div>

            <!-- Canvas & Image Stage -->
            <div id="car-canvas-container" class="relative w-full aspect-[16/9] rounded-2xl overflow-hidden cursor-none bg-zinc-950 border border-white/10">
                <!-- Base Image: Clean BMW M3 -->
                <img id="clean-car-img" 
                     src="/assets/images/game/bmw_clean.png" 
                     alt="BMW M3 Limpio" 
                     class="absolute inset-0 w-full h-full object-contain pointer-events-none select-none">

                <!-- Canvas Layer 1: Mud & Dirt Layer -->
                <canvas id="mud-canvas" class="absolute inset-0 w-full h-full z-10"></canvas>

                <!-- Canvas Layer 2: Soap & Foam Layer -->
                <canvas id="soap-canvas" class="absolute inset-0 w-full h-full z-15 pointer-events-none opacity-90"></canvas>

                <!-- Canvas Layer 3: Ceramic Sparkles & Gloss Particle Canvas -->
                <canvas id="sparkle-canvas" class="absolute inset-0 w-full h-full z-20 pointer-events-none"></canvas>

                <!-- Floating Tool Nozzle (Follows Cursor) -->
                <div id="washer-nozzle" class="pointer-events-none absolute z-30 opacity-0 transition-opacity duration-200 -translate-x-3 -translate-y-3">
                    <div class="relative">
                        <!-- Water Pressure Jet Cone -->
                        <div id="water-spray-cone" class="absolute left-full top-1/2 -translate-y-1/2 w-32 h-16 bg-gradient-to-r from-cyan-400/80 via-white/40 to-transparent blur-[2px] opacity-0 transition-opacity pointer-events-none origin-left"></div>
                        
                        <!-- Tool Icon Badge -->
                        <div id="nozzle-badge" class="w-12 h-12 bg-brand/90 backdrop-blur-md rounded-full border-2 border-white flex items-center justify-center shadow-lg shadow-brand/50 text-white font-bold text-lg">
                            🚿
                        </div>
                    </div>
                </div>

                <!-- 100% Celebration Banner Overlay -->
                <div id="celebration-overlay" class="absolute inset-0 z-40 bg-black/80 backdrop-blur-md flex flex-col items-center justify-center p-6 text-center opacity-0 pointer-events-none transition-opacity duration-500">
                    <div class="w-16 h-16 rounded-full bg-brand text-white flex items-center justify-center mb-3 shadow-xl shadow-brand/40 animate-bounce">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                    </div>
                    <h3 class="font-display text-3xl sm:text-5xl font-extrabold text-white uppercase mb-2">¡BMW M3 100% RECTIFICADO!</h3>
                    <p class="text-white/80 text-xs sm:text-base max-w-lg mb-6 font-light">
                        Tu vehículo merece el mismo nivel de brillo espejo impecable y protección extrema. Reserva tu servicio de detallado profesional hoy.
                    </p>
                    <div class="flex flex-col sm:flex-row items-center gap-3">
                        <a href="/reserva" class="px-8 py-3.5 bg-brand hover:bg-brand-dark text-white font-bold rounded-full text-xs sm:text-sm uppercase tracking-wider transition-all duration-300 shadow-xl shadow-brand/40 hover:scale-105">
                            Agendar Detallado Premium
                        </a>
                        <button id="replay-game-btn" class="px-6 py-3.5 border border-white/30 hover:bg-white/10 text-white font-bold rounded-full text-xs sm:text-sm uppercase tracking-wider transition-all">
                            Lavar de nuevo
                        </button>
                    </div>
                </div>
            </div>

            <!-- FOOTER BAR: Social Sharing & Signature -->
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4 mt-6 px-4 pt-4 border-t border-white/10">
                <!-- Action Buttons: Download Photo & Share -->
                <div class="flex flex-wrap items-center gap-2">
                    <button id="download-photo-btn" class="px-4 py-2 rounded-xl bg-white/10 hover:bg-brand text-white font-bold text-xs uppercase tracking-wider transition-all duration-300 flex items-center gap-2 border border-white/15">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-brand group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                        <span>Descargar Foto</span>
                    </button>

                    <a id="share-wa-btn" href="https://api.whatsapp.com/send?text=%C2%A1Acabo%20de%20dejar%20un%20BMW%20M3%20100%25%20pulido%20y%20detallado%20en%20High%20Contrast%20Detailing!%20Prueba%20la%20experiencia%203D%20interactiva%3A%20https%3A%2F%2Fhighcontrastdetailingcenter.cl" target="_blank" rel="noopener" class="px-4 py-2 rounded-xl bg-emerald-600/80 hover:bg-emerald-600 text-white font-bold text-xs uppercase tracking-wider transition-all duration-300 flex items-center gap-2 border border-emerald-500/30">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-1.14 4.162 4.226-1.109z"/></svg>
                        <span>Compartir en WhatsApp</span>
                    </a>

                    <button id="copy-link-btn" class="px-4 py-2 rounded-xl bg-white/10 hover:bg-white/20 text-white font-bold text-xs uppercase tracking-wider transition-all duration-300 flex items-center gap-2 border border-white/15">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                        <span id="copy-btn-text">Copiar Enlace</span>
                    </button>
                </div>

                <!-- Signature REW.CL -->
                <div class="text-[11px] text-white/50 flex items-center gap-1.5 font-mono shrink-0">
                    <span>Developed by</span>
                    <a href="https://rew.cl" target="_blank" rel="noopener" class="text-brand font-extrabold hover:underline tracking-widest uppercase transition-colors">REW.CL</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Car Wash Game Engine Script -->
<script>
document.addEventListener('DOMContentLoaded', () => {
    const container = document.getElementById('car-canvas-container');
    const mudCanvas = document.getElementById('mud-canvas');
    const soapCanvas = document.getElementById('soap-canvas');
    const sparkleCanvas = document.getElementById('sparkle-canvas');
    if (!container || !mudCanvas || !soapCanvas || !sparkleCanvas) return;

    const ctxMud = mudCanvas.getContext('2d');
    const ctxSoap = soapCanvas.getContext('2d');
    const ctxSparkle = sparkleCanvas.getContext('2d');

    const nozzle = document.getElementById('washer-nozzle');
    const nozzleBadge = document.getElementById('nozzle-badge');
    const sprayCone = document.getElementById('water-spray-cone');
    const progressBar = document.getElementById('clean-progress-bar');
    const progressText = document.getElementById('clean-percentage-text');
    const resetBtn = document.getElementById('reset-mud-btn');
    const autoCleanBtn = document.getElementById('auto-clean-btn');
    const celebrationOverlay = document.getElementById('celebration-overlay');
    const replayBtn = document.getElementById('replay-game-btn');
    const downloadBtn = document.getElementById('download-photo-btn');
    const copyLinkBtn = document.getElementById('copy-link-btn');
    const copyBtnText = document.getElementById('copy-btn-text');

    let currentTool = 'hydro'; // 'hydro', 'soap', 'sponge', 'ceramic'
    let dirtyImg = new Image();
    dirtyImg.src = '/assets/images/game/bmw_dirty.png';

    let cleanImg = document.getElementById('clean-car-img');
    let isDrawing = false;
    let isCompleted = false;
    let sparkles = [];

    // Tool Selector Click
    document.querySelectorAll('.game-tool-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            document.querySelectorAll('.game-tool-btn').forEach(b => {
                b.classList.remove('active', 'border-brand', 'bg-brand', 'shadow-lg');
                b.classList.add('border-white/15', 'bg-white/5', 'text-white/80');
            });
            btn.classList.add('active', 'border-brand', 'bg-brand', 'shadow-lg');
            btn.classList.remove('border-white/15', 'bg-white/5', 'text-white/80');
            
            currentTool = btn.dataset.tool;

            // Update nozzle badge icon & cone visibility
            if (currentTool === 'hydro') {
                nozzleBadge.innerHTML = '🚿';
                sprayCone.style.display = 'block';
            } else if (currentTool === 'soap') {
                nozzleBadge.innerHTML = '🧼';
                sprayCone.style.display = 'none';
            } else if (currentTool === 'sponge') {
                nozzleBadge.innerHTML = '🧽';
                sprayCone.style.display = 'none';
            } else if (currentTool === 'ceramic') {
                nozzleBadge.innerHTML = '💎';
                sprayCone.style.display = 'none';
            }
        });
    });

    function resizeCanvas() {
        const rect = container.getBoundingClientRect();
        [mudCanvas, soapCanvas, sparkleCanvas].forEach(c => {
            c.width = rect.width;
            c.height = rect.height;
        });
        drawMudLayer();
    }

    function drawMudLayer() {
        if (!dirtyImg.complete) return;
        ctxMud.globalCompositeOperation = 'source-over';
        ctxMud.clearRect(0, 0, mudCanvas.width, mudCanvas.height);
        ctxSoap.clearRect(0, 0, soapCanvas.width, soapCanvas.height);
        
        const hRatio = mudCanvas.width / dirtyImg.width;
        const vRatio = mudCanvas.height / dirtyImg.height;
        const ratio = Math.min(hRatio, vRatio);
        const centerShift_x = (mudCanvas.width - dirtyImg.width * ratio) / 2;
        const centerShift_y = (mudCanvas.height - dirtyImg.height * ratio) / 2;
        
        ctxMud.drawImage(dirtyImg, 0, 0, dirtyImg.width, dirtyImg.height,
                         centerShift_x, centerShift_y, dirtyImg.width * ratio, dirtyImg.height * ratio);
        
        updateProgress();
    }

    dirtyImg.onload = () => {
        resizeCanvas();
    };

    window.addEventListener('resize', resizeCanvas);

    function applyTool(x, y) {
        if (isCompleted && currentTool !== 'ceramic') return;
        
        const brushRadius = Math.max(32, mudCanvas.width * 0.045);

        if (currentTool === 'hydro') {
            // Hydro pressure erases mud & soap
            ctxMud.globalCompositeOperation = 'destination-out';
            const grad = ctxMud.createRadialGradient(x, y, 0, x, y, brushRadius);
            grad.addColorStop(0, 'rgba(0,0,0,1)');
            grad.addColorStop(0.7, 'rgba(0,0,0,0.8)');
            grad.addColorStop(1, 'rgba(0,0,0,0)');
            ctxMud.fillStyle = grad;
            ctxMud.beginPath();
            ctxMud.arc(x, y, brushRadius, 0, Math.PI * 2);
            ctxMud.fill();

            // Erase soap too
            ctxSoap.globalCompositeOperation = 'destination-out';
            ctxSoap.beginPath();
            ctxSoap.arc(x, y, brushRadius * 1.2, 0, Math.PI * 2);
            ctxSoap.fill();

        } else if (currentTool === 'soap') {
            // Apply thick white snow foam bubbles onto soap canvas
            ctxSoap.globalCompositeOperation = 'source-over';
            for (let i = 0; i < 6; i++) {
                const px = x + (Math.random() - 0.5) * brushRadius;
                const py = y + (Math.random() - 0.5) * brushRadius;
                const pr = Math.random() * 14 + 10;
                
                ctxSoap.fillStyle = 'rgba(255, 255, 255, 0.85)';
                ctxSoap.beginPath();
                ctxSoap.arc(px, py, pr, 0, Math.PI * 2);
                ctxSoap.fill();
            }
        } else if (currentTool === 'sponge') {
            // Sponge wipes off soap and erases mud smoothly
            ctxSoap.globalCompositeOperation = 'destination-out';
            ctxSoap.beginPath();
            ctxSoap.arc(x, y, brushRadius * 1.3, 0, Math.PI * 2);
            ctxSoap.fill();

            ctxMud.globalCompositeOperation = 'destination-out';
            ctxMud.beginPath();
            ctxMud.arc(x, y, brushRadius, 0, Math.PI * 2);
            ctxMud.fill();

        } else if (currentTool === 'ceramic') {
            // Ceramic Coating 9H adds glowing sparkles
            for (let i = 0; i < 3; i++) {
                sparkles.push({
                    x: x + (Math.random() - 0.5) * brushRadius * 1.5,
                    y: y + (Math.random() - 0.5) * brushRadius * 1.5,
                    size: Math.random() * 8 + 4,
                    alpha: 1,
                    decay: Math.random() * 0.03 + 0.01
                });
            }
        }

        updateProgress();
    }

    // Sparkle Animation Loop for Ceramic Coating
    function renderSparkles() {
        ctxSparkle.clearRect(0, 0, sparkleCanvas.width, sparkleCanvas.height);
        for (let i = sparkles.length - 1; i >= 0; i--) {
            const s = sparkles[i];
            s.alpha -= s.decay;
            if (s.alpha <= 0) {
                sparkles.splice(i, 1);
                continue;
            }
            ctxSparkle.fillStyle = `rgba(251, 44, 107, ${s.alpha})`;
            ctxSparkle.beginPath();
            // Draw 4-point star sparkle
            ctxSparkle.arc(s.x, s.y, s.size / 2, 0, Math.PI * 2);
            ctxSparkle.fill();
            
            ctxSparkle.fillStyle = `rgba(255, 255, 255, ${s.alpha * 0.9})`;
            ctxSparkle.beginPath();
            ctxSparkle.arc(s.x, s.y, s.size / 4, 0, Math.PI * 2);
            ctxSparkle.fill();
        }
        requestAnimationFrame(renderSparkles);
    }
    renderSparkles();

    function updateProgress() {
        try {
            const w = mudCanvas.width;
            const h = mudCanvas.height;
            const imgData = ctxMud.getImageData(0, 0, w, h);
            const data = imgData.data;
            let transparentPixels = 0;
            const step = 16;

            for (let i = 3; i < data.length; i += 4 * step) {
                if (data[i] === 0) transparentPixels++;
            }
            
            const totalSamples = data.length / (4 * step);
            const percentage = Math.min(100, Math.round((transparentPixels / totalSamples) * 100));
            
            progressBar.style.width = percentage + '%';
            progressText.textContent = percentage + '%';

            if (percentage >= 75 && !isCompleted) {
                isCompleted = true;
                celebrationOverlay.classList.remove('opacity-0', 'pointer-events-none');
            }
        } catch (e) {}
    }

    // Mouse & Touch Event Handlers
    function getPos(e) {
        const rect = mudCanvas.getBoundingClientRect();
        let clientX = e.clientX;
        let clientY = e.clientY;
        if (e.touches && e.touches[0]) {
            clientX = e.touches[0].clientX;
            clientY = e.touches[0].clientY;
        }
        return {
            x: clientX - rect.left,
            y: clientY - rect.top
        };
    }

    container.addEventListener('mouseenter', () => {
        nozzle.classList.remove('opacity-0');
    });

    container.addEventListener('mouseleave', () => {
        nozzle.classList.add('opacity-0');
        sprayCone.classList.add('opacity-0');
        isDrawing = false;
    });

    container.addEventListener('mousemove', (e) => {
        const pos = getPos(e);
        nozzle.style.left = pos.x + 'px';
        nozzle.style.top = pos.y + 'px';

        applyTool(pos.x, pos.y);
        if (currentTool === 'hydro') sprayCone.classList.remove('opacity-0');
    });

    container.addEventListener('mousedown', (e) => {
        isDrawing = true;
        const pos = getPos(e);
        applyTool(pos.x, pos.y);
        if (currentTool === 'hydro') sprayCone.classList.remove('opacity-0');
    });

    window.addEventListener('mouseup', () => {
        isDrawing = false;
    });

    // Touch events for mobile
    container.addEventListener('touchstart', (e) => {
        const pos = getPos(e);
        nozzle.style.left = pos.x + 'px';
        nozzle.style.top = pos.y + 'px';
        nozzle.classList.remove('opacity-0');
        applyTool(pos.x, pos.y);
    }, { passive: true });

    container.addEventListener('touchmove', (e) => {
        const pos = getPos(e);
        nozzle.style.left = pos.x + 'px';
        nozzle.style.top = pos.y + 'px';
        applyTool(pos.x, pos.y);
    }, { passive: true });

    container.addEventListener('touchend', () => {
        nozzle.classList.add('opacity-0');
        sprayCone.classList.add('opacity-0');
    });

    // Reset & Auto-clean
    resetBtn?.addEventListener('click', () => {
        isCompleted = false;
        celebrationOverlay.classList.add('opacity-0', 'pointer-events-none');
        drawMudLayer();
    });

    autoCleanBtn?.addEventListener('click', () => {
        ctxMud.clearRect(0, 0, mudCanvas.width, mudCanvas.height);
        ctxSoap.clearRect(0, 0, soapCanvas.width, soapCanvas.height);
        updateProgress();
    });

    replayBtn?.addEventListener('click', () => {
        isCompleted = false;
        celebrationOverlay.classList.add('opacity-0', 'pointer-events-none');
        drawMudLayer();
    });

    // Download Photo Feature
    downloadBtn?.addEventListener('click', () => {
        const tempCanvas = document.createElement('canvas');
        tempCanvas.width = mudCanvas.width;
        tempCanvas.height = mudCanvas.height;
        const tempCtx = tempCanvas.getContext('2d');

        // Draw clean car base + mud + soap layers
        tempCtx.drawImage(cleanImg, 0, 0, tempCanvas.width, tempCanvas.height);
        tempCtx.drawImage(mudCanvas, 0, 0);
        tempCtx.drawImage(soapCanvas, 0, 0);
        tempCtx.drawImage(sparkleCanvas, 0, 0);

        // Add Watermark
        tempCtx.font = 'bold 16px sans-serif';
        tempCtx.fillStyle = '#FB2C6B';
        tempCtx.fillText('HIGH CONTRAST DETAILING - Developed by REW.CL', 20, tempCanvas.height - 20);

        const dataUrl = tempCanvas.toDataURL('image/png');
        const link = document.createElement('a');
        link.download = 'BMW_M3_HighContrast_Detailing.png';
        link.href = dataUrl;
        link.click();
    });

    // Copy Link Action
    copyLinkBtn?.addEventListener('click', () => {
        navigator.clipboard.writeText(window.location.href).then(() => {
            copyBtnText.textContent = '¡Copiado!';
            setTimeout(() => {
                copyBtnText.textContent = 'Copiar Enlace';
            }, 2000);
        });
    });
});
</script>



<!-- Gallery Section -->
<script>
    window.instagramFeedData = <?php echo json_encode($instagramFeed ?? [], 15, 512) ?>;
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
<section id="testimonios" x-data="{ 
    current: 0,
    testimonials: [
        { name: 'Rodrigo Fernández', vehicle: 'BMW M4 Competition', rating: 5, text: 'Increíble trabajo. Mi M4 quedó como recién salido del concesionario. El tratamiento cerámico superó todas mis expectativas. Profesionalismo de otro nivel.', service: 'Tratamiento Cerámico', image: '/assets/images/testimonials/bmw_m4.png' },
        { name: 'Carolina Muñoz', vehicle: 'Mercedes-Benz GLC 300', rating: 5, text: 'Llevé mi GLC con rayones que me tenían preocupada. Después de la corrección de pintura, desaparecieron por completo. Muy recomendados.', service: 'Corrección de Pintura', image: '/assets/images/testimonials/mercedes_glc.png' },
        { name: 'Sebastián Torres', vehicle: 'Porsche 911 Carrera', rating: 5, text: 'Como dueño de un 911, soy muy exigente con quién toca mi auto. High Contrast es el único lugar donde lo llevo. Perfeccionistas.', service: 'Pulido Profesional', image: '/assets/images/testimonials/porsche_911.png' },
        { name: 'María José Contreras', vehicle: 'Audi Q5', rating: 5, text: 'El detailing interior dejó mi Q5 impecable. Los cueros quedaron como nuevos y el olor es increíble. Volveré cada mes.', service: 'Detailing Interior', image: '/assets/images/testimonials/audi_q5.png' },
        { name: 'Andrés Villalobos', vehicle: 'Tesla Model 3', rating: 5, text: 'Profesionales, puntuales y el resultado habla por sí solo. El cerámico protege mi Tesla de todo. 100% recomendado.', service: 'Tratamiento Cerámico', image: '/assets/images/testimonials/tesla_model3.png' }
    ],
    next() {
        this.current = (this.current + 1) % this.testimonials.length;
    },
    prev() {
        this.current = (this.current - 1 + this.testimonials.length) % this.testimonials.length;
    }
}" class="py-24 md:py-36 relative overflow-hidden bg-black text-white min-h-[720px] flex items-center">

    <!-- FULL HERO VEHICLE BACKGROUND LAYER (100% PROTAGONISM, BRIGHT & CLEAR) -->
    <template x-for="(t, index) in testimonials" :key="t.image">
        <div class="absolute inset-0 transition-all duration-700 ease-in-out pointer-events-none z-0"
             :class="index === current ? 'opacity-90 scale-100' : 'opacity-0 scale-105'">
            <img :src="t.image" :alt="t.vehicle" class="w-full h-full object-cover object-center">
            <!-- Subtle gradient to ensure right-hand card legibility while keeping the vehicle bright -->
            <div class="absolute inset-0 bg-gradient-to-r from-black/40 via-black/60 to-black/95"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-black/60"></div>
        </div>
    </template>

    <!-- Glow Accent -->
    <div class="absolute top-1/2 left-1/4 -translate-x-1/2 -translate-y-1/2 w-[700px] h-[700px] bg-brand/10 rounded-full blur-[180px] pointer-events-none z-0"></div>

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
                <div class="relative rounded-[2.5rem] overflow-hidden border border-white/20 bg-black/85 backdrop-blur-2xl shadow-2xl min-h-[380px] flex flex-col justify-between p-8 sm:p-10 md:p-12">
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

                <!-- Navigation Controls & Dots -->
                <div class="flex items-center justify-between gap-5 mt-6 px-2">
                    <div class="flex gap-2.5">
                        <template x-for="(testimonial, i) in testimonials">
                            <button @click="current = i"
                                    :class="i === current ? 'bg-brand w-8' : 'bg-white/30 hover:bg-white/60 w-2.5'"
                                    class="h-2.5 rounded-full transition-all duration-300"></button>
                        </template>
                    </div>

                    <div class="flex items-center gap-3">
                        <button @click="prev()" class="w-12 h-12 rounded-full border border-white/20 bg-black/70 hover:bg-brand hover:border-brand flex items-center justify-center text-white transition-all duration-300 shadow-lg backdrop-blur-md" aria-label="Anterior">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                        </button>

                        <button @click="next()" class="w-12 h-12 rounded-full border border-white/20 bg-black/70 hover:bg-brand hover:border-brand flex items-center justify-center text-white transition-all duration-300 shadow-lg backdrop-blur-md" aria-label="Siguiente">
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

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<?php
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
                'telephone' => $schemaProfile->phone ?? '+56912345678',
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
?>
<script type="application/ld+json">
<?php echo json_encode($jsonLd, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT); ?>

</script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('styles'); ?>
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

<?php echo $__env->make('partials.schema-local-business', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php
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
?>
<script type="application/ld+json">
<?php echo json_encode($faqJsonLd, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT); ?>

</script>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.public', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\detailing-laravel\resources\views/home.blade.php ENDPATH**/ ?>