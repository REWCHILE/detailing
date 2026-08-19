@extends('layouts.public')

@section('title', 'Cotizador Online & Reservas | High Contrast Detailing Center')
@section('meta_description', 'Cotiza y agenda el detallado automotriz de tu vehículo online. Chicureo, Colina.')
@section('meta_keywords', 'cotizar detailing online, agendar detailing chicureo, reserva detailing santiago, precios detailing colina, cotizador detailing')

@section('content')
<main class="min-h-screen bg-[#070707] text-white transition-colors duration-300 pt-28 pb-20">
    <div class="container-custom max-w-7xl px-4" x-data="bookingWizard()">
        
        <!-- Header -->
        <div class="text-center mb-10" x-show="currentStep <= 2">
            <p class="text-brand text-xs font-bold tracking-[0.25em] uppercase mb-3 px-4 py-1.5 rounded-full bg-brand/10 border border-brand/20 inline-block">
                Cotizador Inteligente
            </p>
            <h2 class="font-display text-4xl md:text-5xl font-extrabold text-white uppercase tracking-tight">
                Cotiza en <span class="text-gradient">2 Simples Pasos</span>
            </h2>
        </div>

        <!-- 2-Step Stepper Indicator -->
        <div class="max-w-md mx-auto mb-10" x-show="currentStep <= 2" id="cotizador-wizard">
            <div class="flex items-center justify-center">
                
                <!-- Step 1 Circle & Label -->
                <div class="flex flex-col items-center">
                    <button 
                        type="button"
                        @click="goToStep(1)"
                        class="w-11 h-11 rounded-full border-2 flex items-center justify-center text-sm font-extrabold transition-all duration-300 cursor-pointer shrink-0"
                        :class="currentStep >= 1 
                            ? 'bg-brand border-brand text-white shadow-lg shadow-brand/40 scale-105' 
                            : 'bg-zinc-900 border-white/15 text-white/40'"
                    >
                        <template x-if="currentStep > 1">
                            <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                        </template>
                        <template x-if="currentStep <= 1">
                            <span>1</span>
                        </template>
                    </button>
                    <span class="text-xs mt-2 font-bold uppercase tracking-wider text-center" 
                          :class="currentStep >= 1 ? 'text-brand' : 'text-white/40'">
                        Servicios
                    </span>
                </div>

                <!-- Connecting Line strictly between Step 1 and Step 2 (Starts at Circle 1 and ends at Circle 2, zero overflow) -->
                <div class="w-24 sm:w-36 h-[3px] bg-white/15 mx-3 -mt-6 rounded-full overflow-hidden shrink-0">
                    <div class="h-full bg-brand transition-all duration-500 rounded-full" 
                         :style="'width: ' + (currentStep >= 2 ? '100%' : '0%')"></div>
                </div>

                <!-- Step 2 Circle & Label (Final Step) -->
                <div class="flex flex-col items-center">
                    <button 
                        type="button"
                        @click="goToStep(2)"
                        :disabled="2 > maxStepReached"
                        class="w-11 h-11 rounded-full border-2 flex items-center justify-center text-sm font-extrabold transition-all duration-300 disabled:cursor-not-allowed cursor-pointer shrink-0"
                        :class="currentStep >= 2 
                            ? 'bg-brand border-brand text-white shadow-lg shadow-brand/40 scale-105' 
                            : 'bg-zinc-900 border-white/15 text-white/40'"
                    >
                        <span>2</span>
                    </button>
                    <span class="text-xs mt-2 font-bold uppercase tracking-wider text-center" 
                          :class="currentStep >= 2 ? 'text-brand' : 'text-white/40'">
                        Tus Datos & Vehículo
                    </span>
                </div>

            </div>
        </div>

        <!-- Wizard Main Container -->
        <div class="flex flex-col lg:flex-row gap-8 items-start">
            
            <!-- Main Content Area -->
            <div class="flex-1 w-full min-w-0 bg-zinc-950/90 border border-white/15 rounded-[2.5rem] p-6 sm:p-10 md:p-12 shadow-2xl backdrop-blur-2xl text-white">
                
                <!-- PASO 1: SELECCIÓN DE SERVICIOS (4 CATEGORÍAS + EXPLORADOR DE SERVICIOS) -->
                <div x-show="currentStep === 1" x-transition>
                    
                    <!-- VISTA A: 4 CARDS PRINCIPALES DE CATEGORÍAS -->
                    <template x-if="!selectedCategory">
                        <div>
                            <div class="mb-8">
                                <h3 class="font-display font-extrabold text-white text-2xl md:text-3xl uppercase tracking-tight">
                                    1. Selecciona un Servicio
                                </h3>
                                <p class="text-white/60 text-sm mt-1">
                                    Elige la especialidad de detallado automotriz que deseas cotizar:
                                </p>
                            </div>

                            <div class="grid grid-cols-1 gap-5 mb-8">
                                <template x-for="cat in categories" :key="cat.key">
                                    <div 
                                        @click="selectCategory(cat.key)"
                                        class="relative group rounded-[2.5rem] sm:rounded-[3.2rem] overflow-hidden min-h-[220px] sm:min-h-[260px] md:min-h-[290px] border-2 border-white/20 bg-zinc-950 hover:border-brand hover:shadow-2xl hover:scale-[1.005] cursor-pointer shadow-2xl flex flex-col justify-between p-6 sm:p-8 md:p-10 transition-all duration-300"
                                    >
                                        <!-- Video Background with Autoplay & High Visual Clarity -->
                                        <template x-if="cat.video">
                                            <video 
                                                autoplay 
                                                loop 
                                                muted 
                                                playsinline 
                                                :poster="cat.image || '/assets/images/cotizador_banner.png'"
                                                class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out z-0 opacity-80 group-hover:opacity-95 pointer-events-none"
                                            >
                                                <source :src="cat.video" type="video/mp4">
                                            </video>
                                        </template>
                                        <template x-if="!cat.video">
                                            <img :src="cat.image || '/assets/images/cotizador_banner.png'" :alt="cat.name" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out z-0 opacity-80 group-hover:opacity-95">
                                        </template>
                                        
                                        <!-- Cinematic Vignette: Protected text on left, vivid video on center/right -->
                                        <div class="absolute inset-0 bg-gradient-to-r from-black/95 via-black/65 to-black/15 z-10 pointer-events-none"></div>
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-black/30 z-10 pointer-events-none"></div>

                                        <!-- Top Row: Badge & Service Count -->
                                        <div class="relative z-20 flex items-center justify-between gap-2">
                                            <span class="px-4 py-1.5 rounded-full bg-black/80 border border-white/20 text-white text-[11px] sm:text-xs font-extrabold uppercase tracking-widest backdrop-blur-md shadow-lg flex items-center gap-2">
                                                <span x-text="cat.icon"></span>
                                                <span x-text="cat.badge"></span>
                                            </span>
                                            <span class="px-4 py-1.5 rounded-full bg-brand/20 border border-brand/50 text-brand text-xs sm:text-sm font-black uppercase tracking-wider backdrop-blur-md shadow-lg"
                                                  x-text="getCategoryServicesCount(cat.key) + ' Servicios'">
                                            </span>
                                        </div>

                                        <!-- Bottom Row: Title in Pink, Description & CTA Button -->
                                        <div class="relative z-20 mt-auto pt-4">
                                            <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4">
                                                <div class="max-w-2xl">
                                                    <h4 class="font-display font-black text-2xl sm:text-3xl md:text-4xl text-brand uppercase tracking-tight drop-shadow-[0_4px_12px_rgba(0,0,0,1)] leading-tight mb-2 group-hover:text-brand transition-colors"
                                                        x-text="cat.name"></h4>
                                                    <p class="text-sm sm:text-base text-white/95 line-clamp-2 drop-shadow-[0_2px_6px_rgba(0,0,0,0.95)] leading-relaxed font-medium"
                                                       x-text="cat.description"></p>
                                                </div>

                                                <div class="flex items-center gap-3 text-xs sm:text-sm font-black uppercase tracking-wider text-brand shrink-0">
                                                    <span>Explorar Servicios</span>
                                                    <div class="w-9 h-9 sm:w-11 sm:h-11 rounded-full bg-brand text-white flex items-center justify-center transition-all duration-300 shadow-xl shadow-brand/40 group-hover:scale-110">
                                                        <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </template>

                    <!-- VISTA B: SERVICIOS DENTRO DE LA CATEGORÍA SELECCIONADA -->
                    <template x-if="selectedCategory">
                        <div>
                            <!-- Header de Navegación y Botón Volver -->
                            <div class="mb-6 pb-6 border-b border-white/10 flex items-center justify-between flex-wrap gap-4">
                                <button 
                                    type="button" 
                                    @click="backToCategories()"
                                    class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-zinc-900 border border-white/20 text-white hover:bg-brand hover:border-brand text-xs sm:text-sm font-bold uppercase tracking-wider transition-all duration-300 shadow-lg group"
                                >
                                    <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                                    <span>Volver a Categorías</span>
                                </button>

                                <span class="px-5 py-2 rounded-full bg-brand/20 border border-brand/40 text-brand text-xs sm:text-sm font-black uppercase tracking-wider"
                                      x-text="filteredServices.length + ' Servicios Disponibles'"></span>
                            </div>

                            <div class="mb-8">
                                <h3 class="font-display font-extrabold text-white text-2xl md:text-3xl uppercase tracking-tight flex items-center gap-2">
                                    <span>Servicios de</span>
                                    <span class="text-brand" x-text="getCategoryTitle(selectedCategory)"></span>
                                </h3>
                                <p class="text-white/60 text-sm mt-1">
                                    Selecciona el tratamiento específico que deseas cotizar para tu vehículo:
                                </p>
                            </div>

                            <!-- PILL-SHAPED HORIZONTAL CARDS STACKED VERTICALLY -->
                            <div class="grid grid-cols-1 gap-6 mb-8 w-full">
                                <template x-for="(srv, index) in filteredServices" :key="srv.id">
                                    <div 
                                        @click="selectService(srv)"
                                        class="relative group rounded-[2.5rem] sm:rounded-[3.2rem] overflow-hidden min-h-[220px] sm:min-h-[260px] md:min-h-[290px] border-2 transition-all duration-300 bg-zinc-950 shadow-2xl cursor-pointer flex flex-col justify-between p-6 sm:p-8 md:p-10"
                                        :class="selectedService && selectedService.id === srv.id
                                            ? 'border-brand ring-4 ring-brand/40 shadow-2xl shadow-brand/40 scale-[1.005] bg-brand/5'
                                            : 'border-white/20 hover:border-brand/70 hover:shadow-2xl hover:scale-[1.005]'"
                                    >
                                        <!-- Panoramic Studio Background / Dynamic Video with Enhanced Clarity -->
                                        <div class="absolute inset-0 z-0 overflow-hidden pointer-events-none">
                                            <template x-if="getServiceVideo(srv)">
                                                <video 
                                                    autoplay 
                                                    loop 
                                                    muted 
                                                    playsinline 
                                                    :poster="getServiceImage(srv) || '/assets/images/cotizador_banner.png'"
                                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out z-0 opacity-80 group-hover:opacity-95 pointer-events-none"
                                                >
                                                    <source :src="getServiceVideo(srv)" type="video/mp4">
                                                </video>
                                            </template>
                                            <template x-if="!getServiceVideo(srv)">
                                                <img 
                                                    :src="getServiceImage(srv) || '/assets/images/cotizador_banner.png'" 
                                                    :alt="srv.name" 
                                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out z-0 opacity-80 group-hover:opacity-95"
                                                >
                                            </template>
                                            
                                            <!-- Cinematic Vignette for High Text Contrast and Rich Video Exposure -->
                                            <div class="absolute inset-0 bg-gradient-to-r from-black/95 via-black/65 to-black/15 z-10 pointer-events-none"></div>
                                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-black/30 z-10 pointer-events-none"></div>
                                        </div>

                                        <!-- Top Row: Badge & Protection/Benefit Pill -->
                                        <div class="relative z-20 flex items-center justify-between gap-2">
                                            <span class="px-4 py-1.5 rounded-full bg-black/80 border border-white/20 text-white text-[11px] sm:text-xs font-extrabold uppercase tracking-widest backdrop-blur-md shadow-lg flex items-center gap-2">
                                                <span x-text="getServiceLevelBadgeIcon(srv)"></span>
                                                <span x-text="getServiceLevelBadge(srv, index)"></span>
                                            </span>

                                            <div class="flex items-center gap-2">
                                                <template x-if="selectedService && selectedService.id === srv.id">
                                                    <span class="px-3.5 py-1.5 rounded-full bg-brand border border-brand/50 text-white text-[11px] sm:text-xs font-black uppercase tracking-wider backdrop-blur-md shadow-lg flex items-center gap-1.5">
                                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                                        <span>Seleccionado</span>
                                                    </span>
                                                </template>
                                                <span 
                                                    class="px-4 py-1.5 rounded-full border text-xs sm:text-sm font-semibold backdrop-blur-md shadow-lg hidden sm:inline-flex items-center"
                                                    :class="selectedService && selectedService.id === srv.id
                                                        ? 'bg-brand/20 border-brand/50 text-brand'
                                                        : 'bg-black/80 border-white/20 text-white/90'"
                                                    x-text="getServiceProtectionSubtitle(srv)"
                                                ></span>
                                            </div>
                                        </div>

                                        <!-- Bottom Row: Title, Price & Action Buttons -->
                                        <div class="relative z-20 mt-auto pt-4">
                                            <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4">
                                                <div class="max-w-2xl">
                                                    <h4 class="font-display font-black text-2xl sm:text-3xl md:text-4xl text-brand uppercase tracking-tight drop-shadow-[0_4px_12px_rgba(0,0,0,1)] leading-tight mb-2 group-hover:text-brand transition-colors"
                                                        x-text="getServiceLevelTitle(srv, index)"></h4>
                                                    
                                                    <!-- Price Display Matching Parent Aesthetics -->
                                                    <div class="flex items-baseline gap-2 mb-2 sm:mb-0">
                                                        <span class="text-white/60 text-xs sm:text-sm font-bold uppercase tracking-wider">Desde</span>
                                                        <span class="font-display font-black text-2xl sm:text-3xl text-white drop-shadow-[0_2px_8px_rgba(0,0,0,0.9)]"
                                                              x-text="onlinePaymentsActive ? formatCLP(getAdjustedPrice(srv)) : 'A Cotizar'"></span>
                                                    </div>
                                                </div>

                                                <!-- Action Buttons: Details + Selection CTA -->
                                                <div class="flex items-center gap-3 shrink-0">
                                                    <button 
                                                        type="button" 
                                                        @click.stop="openDetailsModal(srv)"
                                                        class="px-4 py-2 sm:px-5 sm:py-2.5 rounded-full bg-black/80 hover:bg-zinc-900 border border-white/20 hover:border-brand/60 text-white hover:text-brand text-xs sm:text-sm font-bold uppercase tracking-wider transition-all duration-200 backdrop-blur-md shadow-lg flex items-center gap-2 group/btn"
                                                    >
                                                        <span>Detalles</span>
                                                        <svg class="w-4 h-4 text-brand group-hover/btn:translate-x-0.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                                                    </button>

                                                    <div class="flex items-center gap-2 text-xs sm:text-sm font-black uppercase tracking-wider text-brand">
                                                        <span class="hidden md:inline" x-text="selectedService && selectedService.id === srv.id ? 'Seleccionado' : 'Elegir'"></span>
                                                        <div 
                                                            class="w-9 h-9 sm:w-11 sm:h-11 rounded-full flex items-center justify-center transition-all duration-300 shadow-xl"
                                                            :class="selectedService && selectedService.id === srv.id 
                                                                ? 'bg-brand text-white shadow-brand/50 scale-110' 
                                                                : 'bg-brand text-white group-hover:scale-110 shadow-brand/40'"
                                                        >
                                                            <template x-if="selectedService && selectedService.id === srv.id">
                                                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                                            </template>
                                                            <template x-if="!selectedService || selectedService.id !== srv.id">
                                                                <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                                            </template>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </template>
                            </div>

                            <!-- Step 1 Bottom Bar: Back Button -->
                            <div class="mt-8 pt-6 border-t border-white/15 flex items-center justify-between gap-4">
                                <button 
                                    type="button" 
                                    @click="backToCategories()"
                                    class="inline-flex items-center gap-2 px-6 py-3.5 rounded-full bg-zinc-900 border border-white/20 text-white/80 hover:text-white hover:bg-zinc-800 text-xs sm:text-sm font-bold uppercase tracking-wider transition-all duration-300 shadow-md group"
                                >
                                    <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                                    <span>Volver a Categorías</span>
                                </button>
                            </div>
                        </div>
                    </template>

                </div>

                <!-- MODAL DE DETALLES DEL SERVICIO (TELEPORTED TO BODY FOR PERFECT VIEWPORT CENTERING) -->
                <template x-teleport="body">
                    <div 
                        x-show="modalServiceDetails" 
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0"
                        x-transition:enter-end="opacity-100"
                        x-transition:leave="transition ease-in duration-200"
                        x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0"
                        class="fixed inset-0 z-[99999] bg-black/85 backdrop-blur-md flex items-center justify-center p-4 sm:p-6"
                        style="display: none;"
                    >
                        <div 
                            @click.away="closeDetailsModal()"
                            x-show="modalServiceDetails"
                            x-transition:enter="transition ease-out duration-300 transform"
                            x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-200 transform"
                            x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                            x-transition:leave-end="opacity-0 scale-95 translate-y-4"
                            class="bg-zinc-900 border-2 border-white/20 rounded-[2.5rem] max-w-2xl w-full shadow-2xl relative text-white max-h-[85vh] flex flex-col my-auto overflow-hidden"
                        >
                            <!-- Header (Fixed at top with rounded container respected) -->
                            <div class="p-6 sm:p-8 pb-4 border-b border-white/10 shrink-0 relative text-center">
                                <button 
                                    type="button" 
                                    @click="closeDetailsModal()"
                                    class="absolute top-6 right-6 w-10 h-10 rounded-full bg-white/10 hover:bg-brand text-white flex items-center justify-center transition-all shadow-md cursor-pointer"
                                >
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                                </button>

                                <h3 class="text-brand font-display font-black text-2xl sm:text-3xl mb-1 uppercase tracking-tight">
                                    Detalles del servicio
                                </h3>
                                <h4 class="text-white/90 font-display font-bold text-base sm:text-lg" x-text="modalServiceDetails ? modalServiceDetails.name : ''"></h4>
                            </div>

                            <!-- Styled Bullet Points List with Inner Scrollbar (Never overflows outer boundaries) -->
                            <div class="p-6 sm:p-8 overflow-y-auto flex-1 custom-scrollbar">
                                <ul class="space-y-3.5 text-left">
                                    <template x-for="(point, pIdx) in getServiceDetailPoints(modalServiceDetails)" :key="pIdx">
                                        <li class="flex items-start gap-3.5 p-3.5 rounded-2xl bg-black/50 border border-white/10 hover:border-brand/40 transition-colors">
                                            <div class="w-5 h-5 rounded-full bg-brand/20 border border-brand/60 text-brand flex items-center justify-center shrink-0 mt-0.5 text-xs font-black shadow-[0_0_8px_rgba(251,44,107,0.4)]">
                                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3.5">
                                                    <polyline points="20 6 9 17 4 12"/>
                                                </svg>
                                            </div>
                                            <span class="font-sans text-sm sm:text-base text-white/95 leading-relaxed font-medium html-content" x-html="point"></span>
                                        </li>
                                    </template>
                                </ul>
                            </div>

                            <!-- Modal Footer (Fixed at bottom) -->
                            <div class="p-6 sm:p-8 pt-4 border-t border-white/15 shrink-0 bg-zinc-900 flex flex-col sm:flex-row items-center justify-between gap-4">
                                <div class="text-center sm:text-left">
                                    <span class="text-xs uppercase tracking-wider text-white/50 block font-bold">Valor Estimado</span>
                                    <span class="text-white font-display font-black text-2xl sm:text-3xl md:text-4xl" x-text="modalServiceDetails ? formatCLP(getAdjustedPrice(modalServiceDetails)) : '$0'"></span>
                                </div>

                                <div class="flex items-center gap-3 w-full sm:w-auto">
                                    <button 
                                        type="button" 
                                        @click="closeDetailsModal()"
                                        class="px-6 py-3.5 rounded-full font-bold text-sm uppercase tracking-wider bg-zinc-800 hover:bg-zinc-700 text-white/80 hover:text-white border border-white/20 transition-all duration-300 w-1/2 sm:w-auto text-center cursor-pointer"
                                    >
                                        Cerrar
                                    </button>

                                    <button 
                                        type="button" 
                                        @click="selectAndProceed(modalServiceDetails)"
                                        class="px-8 py-3.5 rounded-full font-display font-black text-sm uppercase tracking-wider bg-brand hover:bg-brand-dark text-white shadow-xl shadow-brand/40 transition-all duration-300 w-1/2 sm:w-auto text-center cursor-pointer flex items-center justify-center gap-2"
                                    >
                                        <span>SELECCIONAR</span>
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>

                <!-- PASO 2: TAMAÑO DEL VEHÍCULO + ¿SE TE OLVIDÓ ALGO? + DATOS DE CONTACTO (FINAL STEP) -->
                <div x-show="currentStep === 2" x-transition>
                    
                    <!-- Top Live Price Indicator (Dynamically updates when selecting vehicle or extras) -->
                    <div class="mb-8 p-6 rounded-3xl bg-zinc-900 border-2 border-brand/40 shadow-xl flex flex-col sm:flex-row items-center justify-between gap-4">
                        <div>
                            <span class="text-xs font-bold text-brand uppercase tracking-wider block mb-0.5">Cotización en Tiempo Real</span>
                            <h3 class="font-display font-black text-xl sm:text-2xl text-white uppercase" x-text="selectedService ? selectedService.name : 'Servicio'"></h3>
                            <p class="text-white/60 text-xs mt-0.5" x-text="selectedVehicle ? ('Vehículo: ' + selectedVehicle.name) : 'Selecciona el tamaño de tu vehículo para calcular el precio exacto'"></p>
                        </div>

                        <div class="text-center sm:text-right">
                            <span class="text-xs text-white/60 uppercase font-bold block">Total Estimado Actual</span>
                            <span class="text-brand font-display font-black text-3xl sm:text-4xl drop-shadow-[0_2px_12px_rgba(251,44,107,0.5)]" x-text="formatCLP(getTotalPrice())"></span>
                        </div>
                    </div>

                    <!-- Bloque B: Selección de Categoría / Tamaño de Vehículo -->
                    <div class="mb-10">
                        <h4 class="font-display font-bold text-white text-base mb-4 flex items-center gap-2">
                            <span class="w-6 h-6 rounded-full bg-brand text-white text-xs flex items-center justify-center font-black">B</span>
                            <span>Selecciona la Categoría / Tamaño de tu Vehículo *</span>
                        </h4>

                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                            <template x-for="vt in vehicleTypes" :key="vt.id">
                                <button 
                                    type="button"
                                    @click="selectVehicle(vt)"
                                    class="relative rounded-2xl border-2 transition-all duration-300 text-left p-5 flex flex-col justify-between cursor-pointer group"
                                    :class="selectedVehicle && selectedVehicle.id === vt.id
                                        ? 'border-brand bg-brand/15 shadow-xl shadow-brand/30 ring-2 ring-brand/40 scale-[1.02]'
                                        : 'border-white/15 bg-zinc-900 hover:border-brand/50'"
                                >
                                    <div class="text-3xl mb-2" x-text="getVehicleIcon(vt.slug)"></div>
                                    <div>
                                        <h5 class="font-display font-extrabold text-white text-base leading-tight mb-1" x-text="vt.name"></h5>
                                        <p class="text-white/50 text-xs line-clamp-2" x-text="vt.description"></p>
                                    </div>
                                    
                                    <div class="mt-4 pt-2 border-t border-white/10 flex items-center justify-between text-xs font-bold">
                                        <span class="text-brand uppercase font-black" x-text="selectedVehicle && selectedVehicle.id === vt.id ? '✓ SELECCIONADO' : 'ELEGIR'"></span>
                                        <span class="text-white/60 text-xs font-mono" x-text="selectedService ? formatCLP(getAdjustedPriceForVehicle(selectedService, vt)) : ''"></span>
                                    </div>
                                </button>
                            </template>
                        </div>
                    </div>

                    <!-- SECCIÓN ¿SE TE OLVIDÓ ALGO? (PREMIUM LUXURY INTERACTIVE CARDS) -->
                    <div class="my-10 p-7 sm:p-9 rounded-[2.5rem] bg-zinc-900 border-2 border-white/15 shadow-2xl">
                        <div class="text-center mb-7">
                            <span class="text-[11px] font-bold text-brand uppercase tracking-[0.2em] px-3 py-1 rounded-full bg-brand/10 border border-brand/25 inline-block mb-2">
                                Extras Opcionales
                            </span>
                            <h4 class="font-display italic font-black text-2xl sm:text-3xl text-white uppercase tracking-wider drop-shadow-md">
                                ¿SE TE OLVIDÓ ALGO?
                            </h4>
                            <p class="text-xs text-white/50 mt-1 max-w-md mx-auto">
                                Potencia tu resultado con tratamientos específicos. Agrégalos con un solo click:
                            </p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 max-w-5xl mx-auto">
                            <template x-for="extra in availableExtras" :key="extra.id || extra.name">
                                <div 
                                    @click="toggleExtra(extra)"
                                    class="relative flex flex-col justify-between p-6 rounded-[2rem] border-2 cursor-pointer transition-all duration-300 group select-none shadow-xl overflow-hidden"
                                    :class="isExtraSelected(extra) 
                                        ? 'bg-zinc-950 border-brand ring-2 ring-brand/40 shadow-[0_0_30px_rgba(251,44,107,0.3)] scale-[1.015]' 
                                        : 'bg-zinc-950/70 border-white/10 hover:border-brand/50 hover:bg-zinc-900/90 hover:scale-[1.01]'"
                                >
                                    <!-- Background ambient glow when selected -->
                                    <div x-show="isExtraSelected(extra)" class="absolute -top-16 -right-16 w-44 h-44 bg-brand/25 rounded-full blur-3xl pointer-events-none"></div>

                                    <div class="flex items-start gap-4 sm:gap-5">
                                        <!-- Large 3D Artwork Emblem (Crisp 100px-112px display for stunning detailing visuals) -->
                                        <div class="relative w-24 h-24 sm:w-28 sm:h-28 rounded-full p-1 shrink-0 transition-all duration-500 group-hover:scale-105 shadow-xl"
                                             :class="isExtraSelected(extra) 
                                                ? 'bg-gradient-to-tr from-brand via-pink-500 to-rose-400 shadow-[0_0_25px_rgba(251,44,107,0.7)]' 
                                                : 'bg-gradient-to-b from-white/20 to-white/5 group-hover:from-brand/70 group-hover:to-brand/30'">
                                            <div class="w-full h-full rounded-full overflow-hidden bg-black flex items-center justify-center relative shadow-inner">
                                                <template x-if="extra.image">
                                                    <img :src="extra.image" :alt="extra.name" class="w-full h-full object-cover rounded-full transition-transform duration-700 group-hover:scale-115">
                                                </template>
                                                <template x-if="!extra.image">
                                                    <span class="text-4xl" x-text="extra.icon || '✨'"></span>
                                                </template>
                                            </div>
                                        </div>

                                        <!-- Info: Title, Description & Badge -->
                                        <div class="min-w-0 flex-1">
                                            <div class="flex items-start justify-between gap-2">
                                                <span class="font-display italic font-black text-lg sm:text-xl transition-colors leading-tight" 
                                                      :class="isExtraSelected(extra) ? 'text-brand' : 'text-white group-hover:text-brand'" 
                                                      x-text="extra.name"></span>
                                            </div>
                                            <p class="text-xs sm:text-sm text-white/65 font-normal leading-relaxed mt-2" x-text="extra.description || ''"></p>
                                        </div>
                                    </div>

                                    <!-- Bottom Row: Status Indicator & Price -->
                                    <div class="mt-5 pt-3.5 border-t border-white/10 flex items-center justify-between">
                                        <div class="flex items-center gap-2">
                                            <div class="w-5 h-5 rounded-md border flex items-center justify-center transition-all duration-300 shrink-0"
                                                 :class="isExtraSelected(extra) 
                                                    ? 'bg-brand border-brand text-white shadow-[0_0_8px_rgba(251,44,107,0.8)]' 
                                                    : 'border-white/30 bg-black/40 text-transparent group-hover:border-brand/70'">
                                                <template x-if="isExtraSelected(extra)">
                                                    <svg class="w-3.5 h-3.5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3.5">
                                                        <polyline points="20 6 9 17 4 12"/>
                                                    </svg>
                                                </template>
                                            </div>
                                            <span class="text-xs uppercase font-extrabold tracking-wider transition-colors"
                                                  :class="isExtraSelected(extra) ? 'text-brand' : 'text-white/50 group-hover:text-white'"
                                                  x-text="isExtraSelected(extra) ? '✓ Agregado al tratamiento' : 'Agregar tratamiento'">
                                            </span>
                                        </div>

                                        <span class="px-4 py-1.5 rounded-full font-display font-black text-sm sm:text-base tracking-wide border transition-all"
                                              :class="isExtraSelected(extra) 
                                                ? 'bg-brand text-white border-brand shadow-[0_0_15px_rgba(251,44,107,0.5)]' 
                                                : 'bg-brand/15 text-brand border-brand/30 group-hover:bg-brand/25 group-hover:border-brand/60'"
                                              x-text="parseInt(extra.price) === 0 ? (isCourtesy(extra) ? '🎁 CORTESÍA' : '✓ INCLUIDO') : ('+ ' + formatCLP(extra.price))">
                                        </span>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>

                    <!-- Bloque A: Formulario de Contacto -->
                    <div class="mb-10 p-6 sm:p-8 rounded-3xl bg-zinc-900 border border-white/15">
                        <h4 class="font-display font-bold text-white text-base mb-4 flex items-center gap-2">
                            <span class="w-6 h-6 rounded-full bg-brand text-white text-xs flex items-center justify-center font-black">C</span>
                            <span>Información de Contacto</span>
                        </h4>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-white/70 uppercase tracking-wider mb-2">Nombre Completo *</label>
                                <input type="text" x-model="name" @input="submitError = null; saveDraftLead(2)" required placeholder="Ej: Juan Pérez" class="w-full px-4 py-3.5 rounded-2xl bg-black border border-white/20 focus:border-brand text-white text-sm outline-none">
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-white/70 uppercase tracking-wider mb-2">WhatsApp / Teléfono *</label>
                                <input type="text" x-model="phone" @input="submitError = null; saveDraftLead(2)" required placeholder="Ej: +56 9 1234 5678" class="w-full px-4 py-3.5 rounded-2xl bg-black border border-white/20 focus:border-brand text-white text-sm outline-none">
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-white/70 uppercase tracking-wider mb-2">Correo Electrónico (Opcional)</label>
                                <input type="email" x-model="email" @input="submitError = null; saveDraftLead(2)" placeholder="Ej: juan@email.com" class="w-full px-4 py-3.5 rounded-2xl bg-black border border-white/20 focus:border-brand text-white text-sm outline-none">
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-white/70 uppercase tracking-wider mb-2">Comuna</label>
                                <select x-model="commune" @change="saveDraftLead(2)" class="w-full px-4 py-3.5 rounded-2xl bg-black border border-white/20 focus:border-brand text-white text-sm outline-none appearance-none">
                                    <option value="" class="bg-black text-white">Selecciona tu comuna...</option>
                                    <option value="Colina / Chicureo" class="bg-black text-white">Colina / Chicureo</option>
                                    <option value="Lo Barnechea" class="bg-black text-white">Lo Barnechea</option>
                                    <option value="Vitacura" class="bg-black text-white">Vitacura</option>
                                    <option value="Las Condes" class="bg-black text-white">Las Condes</option>
                                    <option value="Providencia" class="bg-black text-white">Providencia</option>
                                    <option value="La Reina" class="bg-black text-white">La Reina</option>
                                    <option value="Ñuñoa" class="bg-black text-white">Ñuñoa</option>
                                    <option value="Santiago Centro" class="bg-black text-white">Santiago Centro</option>
                                    <option value="Huechuraba" class="bg-black text-white">Huechuraba</option>
                                    <option value="Otra comuna / Región" class="bg-black text-white">Otra comuna / Región</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- RESUMEN DETALLADO DE COTIZACIÓN -->
                    <div class="mb-10 p-6 sm:p-8 md:p-10 rounded-[2.5rem] bg-zinc-950/90 border-2 border-brand/40 shadow-2xl shadow-brand/10 backdrop-blur-xl">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-6 border-b border-white/10">
                            <div>
                                <div class="flex items-center gap-2">
                                    <span class="px-3 py-1 rounded-full bg-brand/15 border border-brand/30 text-brand text-[10px] sm:text-xs font-black uppercase tracking-wider">
                                        Paso Final
                                    </span>
                                    <span class="text-white/40 text-xs font-bold uppercase tracking-wider">Revisión de Pedido</span>
                                </div>
                                <h4 class="font-display italic font-black text-2xl sm:text-3xl text-white uppercase tracking-wide mt-1">
                                    Resumen de tu Cotización
                                </h4>
                            </div>
                            <div class="text-left sm:text-right">
                                <span class="text-xs text-white/50 uppercase font-bold block">Total Estimado</span>
                                <span class="text-brand font-display font-black text-3xl sm:text-4xl drop-shadow-[0_2px_15px_rgba(251,44,107,0.6)]" x-text="formatCLP(getTotalPrice())"></span>
                            </div>
                        </div>

                        <!-- Detalle de Ítems Seleccionados -->
                        <div class="py-6 space-y-5 border-b border-white/10">
                            <!-- Servicio Principal -->
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 p-4 rounded-2xl bg-zinc-900/90 border border-white/10">
                                <div class="flex items-center gap-3.5">
                                    <div class="w-10 h-10 rounded-xl bg-brand/20 border border-brand/50 text-brand flex items-center justify-center text-lg font-black shrink-0">
                                        <span x-text="getServiceLevelBadgeIcon(selectedService)"></span>
                                    </div>
                                    <div>
                                        <div class="flex items-center gap-2">
                                            <span class="text-xs font-extrabold uppercase tracking-wider text-brand" x-text="getCategoryBadgeLabel(selectedService)"></span>
                                            <span class="text-white/30 text-xs">•</span>
                                            <span class="text-xs font-semibold text-white/70 flex items-center gap-1">
                                                <span x-text="selectedVehicle ? getVehicleIcon(selectedVehicle.slug) : '🚗'"></span>
                                                <span x-text="selectedVehicle ? selectedVehicle.name : 'Vehículo no seleccionado'"></span>
                                            </span>
                                        </div>
                                        <h5 class="font-display font-black text-base sm:text-lg text-white" x-text="selectedService ? selectedService.name : 'Servicio'"></h5>
                                    </div>
                                </div>
                                <div class="text-left sm:text-right pl-14 sm:pl-0">
                                    <span class="text-white font-mono font-bold text-base sm:text-lg" x-text="selectedService ? formatCLP(getAdjustedPrice(selectedService)) : '$0'"></span>
                                </div>
                            </div>

                            <!-- 1. Servicios y Tratamientos que incluye tu compra -->
                            <template x-if="includedTreatments.length > 0">
                                <div class="space-y-2.5 pt-2">
                                    <div class="flex items-center justify-between pl-1">
                                        <span class="text-xs font-extrabold uppercase tracking-wider text-emerald-400 flex items-center gap-1.5">
                                            <span>✓</span>
                                            <span>Servicios que incluye tu compra (<span x-text="includedTreatments.length"></span>):</span>
                                        </span>
                                        <span class="text-[10px] uppercase font-bold text-white/40 tracking-wider">Incluidos en el valor base</span>
                                    </div>
                                    <template x-for="item in includedTreatments" :key="item.id || item.name || item">
                                        <div class="flex items-center justify-between gap-3 p-3 rounded-2xl bg-zinc-900/50 border border-white/10">
                                            <div class="flex items-center gap-2.5">
                                                <div class="w-6 h-6 rounded-lg bg-emerald-500/15 border border-emerald-500/30 text-emerald-400 flex items-center justify-center text-xs font-black shrink-0">
                                                    ✓
                                                </div>
                                                <span class="text-xs sm:text-sm font-semibold text-white/90" x-text="item.name || item"></span>
                                            </div>
                                            <span class="px-2.5 py-1 rounded-full text-[11px] font-black uppercase tracking-wider font-mono shrink-0"
                                                  :class="isCourtesy(item) ? 'bg-pink-500/15 text-pink-400 border border-pink-500/30' : 'bg-emerald-500/15 text-emerald-400 border border-emerald-500/30'"
                                                  x-text="isCourtesy(item) ? '🎁 CORTESÍA' : '✓ INCLUIDO'">
                                            </span>
                                        </div>
                                    </template>
                                </div>
                            </template>

                            <!-- 2. Adicionales & Extras Seleccionados (De pago) -->
                            <template x-if="paidExtras.length > 0">
                                <div class="space-y-2.5 pt-2">
                                    <span class="text-xs font-extrabold uppercase tracking-wider text-brand block pl-1">
                                        + Adicionales Seleccionados (<span x-text="paidExtras.length"></span>):
                                    </span>
                                    <template x-for="extra in paidExtras" :key="extra.id || extra.name">
                                        <div class="flex items-center justify-between gap-3 p-3.5 rounded-2xl bg-zinc-900/80 border border-brand/30 hover:border-brand transition-colors">
                                            <div class="flex items-center gap-3">
                                                <div class="w-7 h-7 rounded-lg bg-brand/15 border border-brand/40 text-brand flex items-center justify-center text-xs font-black shrink-0">
                                                    +
                                                </div>
                                                <span class="text-sm font-bold text-white/95" x-text="extra.name"></span>
                                            </div>
                                            <span class="text-brand font-mono font-black text-sm shrink-0" x-text="'+ ' + formatCLP(extra.price)"></span>
                                        </div>
                                    </template>
                                </div>
                            </template>

                            <template x-if="paidExtras.length === 0">
                                <div class="p-3 rounded-2xl bg-zinc-900/30 border border-white/5 text-xs text-white/40 italic flex items-center gap-2">
                                    <span>✨ Sin adicionales de pago agregados (puedes agregar extras opcionales en el paso superior).</span>
                                </div>
                            </template>
                        </div>

                        <!-- Desglose de Totales -->
                        <div class="pt-6 space-y-2.5 text-sm">
                            <div class="flex items-center justify-between text-white/70">
                                <span>Subtotal Servicio (<span x-text="selectedVehicle ? selectedVehicle.name : 'Estándar'"></span>)</span>
                                <span class="font-mono font-semibold" x-text="selectedService ? formatCLP(getAdjustedPrice(selectedService)) : '$0'"></span>
                            </div>

                            <template x-if="getExtrasTotal() > 0">
                                <div class="flex items-center justify-between text-white/70">
                                    <span>Subtotal Tratamientos Extras</span>
                                    <span class="font-mono font-semibold text-brand" x-text="'+ ' + formatCLP(getExtrasTotal())"></span>
                                </div>
                            </template>

                            <div class="flex items-center justify-between pt-3 border-t border-white/10 text-base sm:text-lg font-black text-white">
                                <span class="font-display uppercase tracking-wider">Total Estimado Final:</span>
                                <span class="font-display text-2xl sm:text-3xl text-brand drop-shadow-[0_2px_10px_rgba(251,44,107,0.5)]" x-text="formatCLP(getTotalPrice())"></span>
                            </div>
                        </div>

                        <!-- Nota de confianza y contacto -->
                        <div class="mt-6 p-4 rounded-2xl bg-brand/10 border border-brand/25 flex items-start gap-3 text-xs text-white/80">
                            <span class="text-base shrink-0">💬</span>
                            <span><strong>Sin pago por adelantado:</strong> Al solicitar la cotización, nuestro equipo revisará los requerimientos de tu vehículo y te contactará de inmediato por WhatsApp para coordinar fecha y hora a tu conveniencia.</span>
                        </div>
                    </div>

                    <!-- Mensaje de Error Reactivo -->
                    <div class="rounded-2xl border border-red-500/30 bg-red-500/10 px-5 py-4 text-sm font-semibold text-red-400 mb-6 flex items-center gap-3 animate-pulse" x-show="submitError">
                        <svg class="w-5 h-5 text-red-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10"/>
                            <line x1="12" y1="8" x2="12" y2="12"/>
                            <line x1="12" y1="16" x2="12.01" y2="16"/>
                        </svg>
                        <span x-text="submitError"></span>
                    </div>

                    <!-- Step 2 Actions (Direct Submit & Final Step) -->
                    <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-4 border-t border-white/15">
                        <button type="button" @click="prevStep()" class="w-full sm:w-auto px-8 py-3.5 rounded-full font-bold text-xs uppercase tracking-wider border border-white/20 text-white/70 hover:text-white transition-all cursor-pointer">
                            ← Volver a Servicios
                        </button>

                        <button 
                            type="button" 
                            @click="submitQuote()"
                            :disabled="isSubmitting || !selectedVehicle || !name.trim() || !phone.trim()"
                            class="w-full sm:w-auto px-10 py-4 rounded-full font-display italic font-black text-base uppercase tracking-wider bg-brand hover:bg-brand-dark text-white shadow-xl shadow-brand/40 transition-all duration-300 flex items-center justify-center gap-2 disabled:opacity-40 disabled:cursor-not-allowed cursor-pointer"
                        >
                            <span x-show="isSubmitting" class="animate-spin h-5 w-5 border-2 border-white border-t-transparent rounded-full"></span>
                            <span x-text="isSubmitting ? 'Enviando Cotización...' : 'SOLICITAR COTIZACIÓN'"></span>
                            <svg x-show="!isSubmitting" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </button>
                    </div>
                </div>

            </div>

        </div>

        <!-- EXIT INTENT RETENTION MODAL (OPCIÓN C) -->
        <div 
            x-show="showExitModal" 
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/85 backdrop-blur-xl select-none"
            style="display: none;"
            @keydown.escape.window="showExitModal = false"
        >
            <!-- Modal Box -->
            <div 
                @click.away="showExitModal = false"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-90 translate-y-4"
                x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                class="relative w-full max-w-lg rounded-[2.5rem] bg-zinc-950 border-2 border-brand/50 p-6 sm:p-8 md:p-10 shadow-[0_0_50px_rgba(251,44,107,0.35)] overflow-hidden text-center"
            >
                <!-- Glow Effect -->
                <div class="absolute -top-24 -left-24 w-48 h-48 bg-brand/30 rounded-full blur-3xl pointer-events-none"></div>
                <div class="absolute -bottom-24 -right-24 w-48 h-48 bg-brand/20 rounded-full blur-3xl pointer-events-none"></div>

                <!-- Close Button -->
                <button 
                    type="button" 
                    @click="showExitModal = false" 
                    class="absolute top-5 right-5 w-9 h-9 rounded-full bg-white/10 hover:bg-white/20 text-white/70 hover:text-white flex items-center justify-center transition-colors cursor-pointer"
                >
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

                <!-- Badge -->
                <span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full bg-brand/15 border border-brand/40 text-brand text-[11px] font-black uppercase tracking-widest mb-3">
                    <span>⚡</span>
                    <span x-text="selectedService ? 'Asesoría Técnica en 1 Clic' : '¿Buscas Asesoría Personalizada?'"></span>
                </span>

                <!-- Title -->
                <h3 class="font-display italic font-black text-2xl sm:text-3xl text-white uppercase tracking-tight leading-tight">
                    <template x-if="selectedService">
                        <span>¿Tienes dudas con tu <span class="text-brand" x-text="selectedService.name"></span>?</span>
                    </template>
                    <template x-if="!selectedService">
                        <span>¿Tienes dudas para elegir tu <span class="text-brand">Servicio de Detailing</span>?</span>
                    </template>
                </h3>

                <p class="text-xs sm:text-sm text-white/70 mt-2.5 leading-relaxed font-medium">
                    <template x-if="selectedService">
                        <span>No te preocupes por los tecnicismos. Nuestro equipo especializado en Chicureo te asesora al instante por WhatsApp para resolver dudas sobre tiempos, durabilidad y disponibilidad.</span>
                    </template>
                    <template x-if="!selectedService">
                        <span>No te preocupes por los tecnicismos. Cuéntanos qué necesita tu vehículo y nuestro equipo técnico en Chicureo te recomendará el tratamiento ideal al instante por WhatsApp.</span>
                    </template>
                </p>

                <!-- Summary Snapshot Card (When service is selected) -->
                <template x-if="selectedService">
                    <div class="my-5 p-4 rounded-2xl bg-zinc-900/90 border border-white/10 flex items-center justify-between text-left">
                        <div class="min-w-0 flex-1 pr-2">
                            <span class="text-[10px] font-extrabold uppercase tracking-wider text-brand block" x-text="selectedVehicle ? selectedVehicle.name : 'Vehículo'"></span>
                            <p class="text-sm font-bold text-white truncate" x-text="selectedService.name"></p>
                        </div>
                        <div class="text-right shrink-0">
                            <span class="text-[10px] text-white/40 uppercase block">Total</span>
                            <span class="text-brand font-display font-black text-lg" x-text="formatCLP(getTotalPrice())"></span>
                        </div>
                    </div>
                </template>

                <!-- Action Buttons -->
                <div class="space-y-3 pt-4">
                    <a 
                        :href="getExitWhatsAppUrl()" 
                        target="_blank"
                        @click="showExitModal = false"
                        class="w-full py-4 px-6 rounded-full bg-emerald-600 hover:bg-emerald-500 text-white font-display italic font-black text-sm uppercase tracking-wider shadow-lg shadow-emerald-600/40 flex items-center justify-center gap-2.5 transition-all hover:scale-[1.02]"
                    >
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                            <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.711 2.598 2.664-.698c.993.585 1.771.884 2.802.884l.006.001c3.18 0 5.767-2.586 5.768-5.766 0-3.18-2.587-5.772-5.78-5.772zm3.393 8.245c-.144.405-.837.774-1.17.824-.312.045-.694.073-1.905-.429-1.547-.643-2.534-2.213-2.61-2.316-.076-.103-.625-.833-.625-1.59 0-.756.397-1.127.538-1.282.14-.156.307-.195.41-.195.102 0 .205.001.294.005.093.004.218-.035.34.258.125.297.424 1.036.46 1.112.038.077.063.167.013.268-.052.102-.078.166-.155.257-.078.09-.163.2-.234.269-.078.077-.16.16-.068.318.092.158.408.672.875 1.088.6.536 1.106.702 1.264.78.158.077.25-.067.34-.171.092-.104.394-.462.499-.619.104-.157.208-.13.348-.078.14.052.888.419 1.04.496.152.078.254.116.29.181.037.065.037.377-.107.782z"/>
                        </svg>
                        <span>HABLAR CON UN ASESOR POR WHATSAPP</span>
                    </a>

                    <button 
                        type="button" 
                        @click="showExitModal = false; scrollToTop()" 
                        class="w-full py-3 px-6 rounded-full border border-white/20 text-white/70 hover:text-white hover:border-white/40 text-xs font-bold uppercase tracking-wider transition-all cursor-pointer"
                    >
                        Prefiero continuar cotizando online
                    </button>
                </div>

            </div>
        </div>

    </div>
</main>
@endsection

@section('styles')
<style>
    .scrollbar-none::-webkit-scrollbar { display: none; }
    .scrollbar-none { -ms-overflow-style: none; scrollbar-width: none; }
    .html-content { line-height: 1.5; }
</style>
@endsection

@push('scripts')
<script>
function bookingWizard() {
    return {
        sessionId: '',
        currentStep: 1,
        maxStepReached: 1,
        showExitModal: false,
        steps: [
            { number: 1, label: 'Servicios' },
            { number: 2, label: 'Tus Datos & Vehículo' }
        ],
        vehicleTypes: @json($vehicleTypes),
        services: @json($services),
        allExtrasList: @json($allExtras ?? []),
        modalServiceDetails: null,
        onlinePaymentsActive: true,
        
        categories: [
            {
                key: 'limpieza',
                name: 'Limpieza & Detallado',
                badge: 'Cuidado & Estética',
                icon: '🧼',
                description: 'Lavados premium de alta gama, descontaminado profundo y detailing completo interior y exterior.',
                image: '/assets/images/services/service_limpieza.png',
                video: '/assets/videos/lavado-premium.mp4'
            },
            {
                key: 'pulido',
                name: 'Corrección de Pintura',
                badge: 'Restauración & Brillo',
                icon: '🌀',
                description: 'Pulido profesional, eliminación de micro-rayas (swirls), corrección multi-etapa y restauración de focos.',
                image: '/assets/images/services/service_pulido.png',
                video: '/assets/videos/pulido-correccion.mp4'
            },
            {
                key: 'ceramico',
                name: 'Ceramic Coating',
                badge: 'Protección 9H & Gtechniq',
                icon: '💎',
                description: 'Sellados cerámicos 9H y Crystal Serum Ultra de ultra duración, hidrofobia extrema y brillo espejo.',
                image: '/assets/images/services/service_ceramico.png',
                video: '/assets/videos/sellado-ceramico-aplicacion.mp4'
            },
            {
                key: 'especiales',
                name: 'ExoShield',
                badge: 'Blindaje Parabrisas',
                icon: '🛡️',
                description: 'Película nanotecnológica TPU de protección contra impactos de piedras, gravilla y rayas en parabrisas.',
                image: '/assets/images/services/service_exoshield.png',
                video: '/assets/videos/exoshield-web.mp4'
            }
        ],

        selectedVehicle: null,
        selectedService: null,
        selectedExtras: [],
        selectedCategory: null,
        
        // Customer Details
        name: '',
        phone: '',
        email: '',
        commune: '',
        
        submitError: null,
        isSubmitting: false,

        scrollToTop() {
            this.$nextTick(() => {
                const el = document.getElementById('cotizador-wizard') || document.querySelector('main');
                if (el) {
                    el.scrollIntoView({ behavior: 'smooth', block: 'start' });
                } else {
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                }
            });
        },

        selectCategory(catKey) {
            this.selectedCategory = catKey;
            this.scrollToTop();
        },

        backToCategories() {
            this.selectedCategory = null;
            this.scrollToTop();
        },

        getCategoryServicesCount(catKey) {
            return this.services.filter(s => this.getServiceCatKey(s) === catKey).length;
        },

        getCategoryTitle(catKey) {
            const found = this.categories.find(c => c.key === catKey);
            return found ? found.name : 'Servicios';
        },

        init() {
            // Persistent quote session identifier
            try {
                let storedId = sessionStorage.getItem('hcd_quote_session');
                if (!storedId) {
                    storedId = 'lead_' + Math.random().toString(36).substring(2, 9) + '_' + Date.now();
                    sessionStorage.setItem('hcd_quote_session', storedId);
                }
                this.sessionId = storedId;
            } catch(e) {
                this.sessionId = 'lead_' + Date.now();
            }

            // Parse URL Query parameters for pre-selected service / category / vehicle
            const urlParams = new URLSearchParams(window.location.search);
            const serviceParam = urlParams.get('service') || urlParams.get('servicio');
            const categoryParam = urlParams.get('category') || urlParams.get('categoria');
            const vehicleParam = urlParams.get('vehicle') || urlParams.get('vt');

            if (categoryParam) {
                const catClean = categoryParam.toLowerCase();
                if (['limpieza', 'ceramico', 'pulido', 'especiales', 'correccion', 'exoshield'].includes(catClean)) {
                    this.selectedCategory = (catClean === 'correccion') ? 'pulido' : ((catClean === 'exoshield') ? 'especiales' : catClean);
                }
            }

            if (serviceParam) {
                const found = this.services.find(s => 
                    s.slug === serviceParam || 
                    String(s.id) === String(serviceParam) || 
                    (s.name && s.name.toLowerCase().includes(serviceParam.toLowerCase()))
                );
                if (found) {
                    this.selectService(found);
                    this.selectedCategory = this.getServiceCatKey(found);
                }
            }

            if (vehicleParam) {
                const foundVt = this.vehicleTypes.find(vt => 
                    vt.slug === vehicleParam || 
                    String(vt.id) === String(vehicleParam) ||
                    (vt.name && vt.name.toLowerCase().includes(vehicleParam.toLowerCase()))
                );
                if (foundVt) {
                    this.selectVehicle(foundVt);
                }
            }

            this.saveDraftLead(1);
            this.setupExitIntent();
        },

        setupExitIntent() {
            let lastTriggerTime = 0;
            const handleExitIntent = (e) => {
                // If cursor moves to the top of the window (attempting to close tab / switch tabs / URL bar)
                const isLeavingTop = (e.clientY <= 30) || (e.type === 'mouseleave' && e.clientY <= 50) || (!e.relatedTarget && e.clientY <= 30);
                
                if (isLeavingTop && !this.isSubmitting && !this.showExitModal) {
                    const now = Date.now();
                    // Cooldown of 20 seconds between dismissals
                    if (now - lastTriggerTime > 20000) {
                        lastTriggerTime = now;
                        this.showExitModal = true;
                    }
                }
            };

            document.addEventListener('mouseleave', handleExitIntent);
            document.addEventListener('mouseout', handleExitIntent);

            // Inactivity timer on step 2 (after 40s without submitting)
            setTimeout(() => {
                if (this.currentStep === 2 && !this.isSubmitting && !this.showExitModal && (Date.now() - lastTriggerTime > 20000)) {
                    lastTriggerTime = Date.now();
                    this.showExitModal = true;
                }
            }, 40000);
        },

        getExitWhatsAppUrl() {
            const rawPhone = '{{ preg_replace("/[^0-9]/", "", $businessProfile->phone ?? "+56912345678") }}';
            const phone = rawPhone.length >= 8 ? rawPhone : '56912345678';
            const srvName = this.selectedService ? this.selectedService.name : 'un servicio de detailing';
            const vtName = this.selectedVehicle ? ` (${this.selectedVehicle.name})` : '';
            const total = this.getTotalPrice() > 0 ? ` [Presupuesto estimado: ${this.formatCLP(this.getTotalPrice())}]` : '';
            const client = this.name ? ` Mi nombre es ${this.name}.` : '';
            const msg = `Hola High Contrast Detailing! Estoy en el cotizador web revisando ${srvName}${vtName}${total}.${client} ¿Me pueden asesorar por favor?`;
            return `https://wa.me/${phone}?text=${encodeURIComponent(msg)}`;
        },
        
        getServiceCatKey(srv) {
            if (!srv) return 'limpieza';
            const cat = (srv.category || '').toLowerCase();
            if (cat === 'correccion' || cat === 'pulido') return 'pulido';
            if (cat === 'ceramico') return 'ceramico';
            if (cat === 'limpieza') return 'limpieza';
            if (cat === 'especiales') return 'especiales';
            
            const text = ((srv.name || '') + ' ' + (srv.slug || '') + ' ' + (srv.short_description || '')).toLowerCase();
            if (text.includes('exoshield') || text.includes('parabrisas') || text.includes('vidrio')) {
                return 'especiales';
            }
            if (text.includes('nivel 1') || text.includes('nivel 2') || text.includes('nivel 3') || text.includes('ceramic') || text.includes('cerámico') || text.includes('glass') || text.includes('gtechniq') || text.includes('sellado') || text.includes('coating')) {
                return 'ceramico';
            }
            if (text.includes('pulido') || text.includes('corrección') || text.includes('correccion') || text.includes('paint') || text.includes('pintura') || text.includes('focos')) {
                return 'pulido';
            }
            return 'limpieza';
        },

        get filteredServices() {
            if (!this.selectedCategory) return [];
            return this.services.filter(s => this.getServiceCatKey(s) === this.selectedCategory);
        },

        getServiceImage(srv) {
            if (srv && srv.image && srv.image.length > 5) return srv.image;
            if (!srv) return '/assets/images/services/service_limpieza.png';
            
            const name = (srv.name || '').toLowerCase();
            
            // Unique mapping per specific service
            if (name.includes('nivel 1')) return '/assets/images/services/service_ceramico.png';
            if (name.includes('nivel 2')) return '/assets/images/gtechniq/csl-product.png';
            if (name.includes('nivel 3')) return '/assets/images/gtechniq/csu-product.png';
            if (name.includes('servicio de pulido') || name.includes('pulido profesional')) return '/assets/images/galeria/Polishing.jpg';
            if (name.includes('multi')) return '/assets/images/galeria/HCD-70.jpg';
            if (name.includes('un paso') || name.includes('1 etapa')) return '/assets/images/galeria/MVW00751.jpg';
            if (name.includes('focos')) return '/assets/images/galeria/White Rcf-7.jpg';
            if (name.includes('lavado premium')) return '/assets/images/galeria/Wash.jpg';
            if (name.includes('lavado avanzado')) return '/assets/images/galeria/Red ZO6-20.jpg';
            if (name.includes('detailing interior')) return '/assets/images/galeria/HCD-17.jpg';
            if (name.includes('detailing completo')) return '/assets/images/galeria/1-22-25-39.jpg';
            if (name.includes('exoshield')) return '/assets/images/exoshield/gt3-box.png';
            
            const key = this.getServiceCatKey(srv);
            const fallbackImages = {
                limpieza: '/assets/images/services/service_limpieza.png',
                ceramico: '/assets/images/services/service_ceramico.png',
                pulido: '/assets/images/services/service_pulido.png',
                especiales: '/assets/images/services/service_exoshield.png'
            };
            return fallbackImages[key] || '/assets/images/services/service_limpieza.png';
        },

        getServiceVideo(srv) {
            if (!srv) return null;
            if (srv.video && srv.video.length > 5) return srv.video;
            
            const name = (srv.name || '').toLowerCase();
            const slug = (srv.slug || '').toLowerCase();
            const cat = this.getServiceCatKey(srv);

            // 1. Ceramic Coating Category (Cerámico)
            if (cat === 'ceramico') {
                if (name.includes('nivel 1') || slug.includes('nivel-1') || slug.includes('dos-anos') || slug.includes('2-anos')) {
                    return '/assets/videos/sellado-ceramico-aplicacion.mp4';
                }
                if (name.includes('nivel 2') || slug.includes('nivel-2') || slug.includes('cinco-anos') || slug.includes('5-anos')) {
                    return '/assets/videos/crosslink.mp4';
                }
                if (name.includes('nivel 3') || slug.includes('nivel-3') || slug.includes('nueve-anos') || slug.includes('9-anos') || slug.includes('crystal-serum-ultra')) {
                    return '/assets/videos/hero-gtechniq.mp4';
                }
                return '/assets/videos/sellado-ceramico-aplicacion.mp4';
            }

            // 2. Limpieza & Detallado Category
            if (cat === 'limpieza') {
                if (name.includes('avanzado') || slug.includes('avanzado')) {
                    return '/assets/videos/lavado-avanzado.mp4';
                }
                if (name.includes('interior') || slug.includes('interior')) {
                    return '/assets/videos/detailing-terminacion.mp4';
                }
                if (name.includes('completo') || slug.includes('completo')) {
                    return '/assets/videos/pulido-correccion-2.mp4';
                }
                // Lavado Premium / Paquete Lavado
                return '/assets/videos/lavado-premium.mp4';
            }

            // 3. Corrección de Pintura Category (Pulido)
            if (cat === 'pulido') {
                if (name.includes('un paso') || name.includes('1 etapa') || name.includes('1 paso') || slug.includes('una-etapa') || slug.includes('un-paso')) {
                    return '/assets/videos/pulido-rupes.mp4';
                }
                if (name.includes('multi') || slug.includes('multi')) {
                    return '/assets/videos/pulido-correccion-2.mp4';
                }
                if (name.includes('focos') || slug.includes('focos')) {
                    return '/assets/videos/detailing-terminacion.mp4';
                }
                // Servicio de pulido base
                return '/assets/videos/pulido-correccion.mp4';
            }

            // 4. Especiales / ExoShield
            if (cat === 'especiales' || slug.includes('exoshield') || name.includes('exoshield') || name.includes('parabrisas')) {
                return '/assets/videos/exoshield-web.mp4';
            }

            const fallbackVideos = {
                limpieza: '/assets/videos/lavado-premium.mp4',
                pulido: '/assets/videos/pulido-correccion.mp4',
                ceramico: '/assets/videos/sellado-ceramico-aplicacion.mp4',
                especiales: '/assets/videos/exoshield-web.mp4'
            };
            return fallbackVideos[cat] || '/assets/videos/lavado-premium.mp4';
        },

        getCategoryBadgeLabel(srv) {
            const key = (typeof srv === 'object' && srv !== null) ? this.getServiceCatKey(srv) : (srv || 'limpieza');
            const labels = {
                limpieza: 'Limpieza & Detallado',
                ceramico: 'Ceramic Coating',
                pulido: 'Corrección de Pintura',
                especiales: 'Protección ExoShield'
            };
            return labels[key] || 'Servicio Élite';
        },

        getFeatures(description) {
            if (!description) return [];
            if (description.includes('<')) {
                const div = document.createElement('div');
                div.innerHTML = description;
                const elements = div.querySelectorAll('p, li');
                if (elements.length > 0) {
                    return Array.from(elements).map(el => el.innerHTML.trim()).filter(t => t.length > 0);
                }
                return [description];
            }
            return description.split(/[•\-]/).map(i => i.trim()).filter(i => i.length > 2);
        },

        getVehicleIcon(slug) {
            const icons = {
                autos: '🚘',
                sedan: '🚘',
                medianos: '🚙',
                suv: '🚙',
                grandes: '🛻',
                camioneta: '🛻',
                hatchback: '🚗',
                deportivo: '🏎️',
                moto: '🏍️'
            };
            return icons[slug] || '🚗';
        },

        openDetailsModal(srv) {
            this.modalServiceDetails = srv;
        },

        closeDetailsModal() {
            this.modalServiceDetails = null;
        },

        selectAndProceed(srv) {
            if (srv) {
                this.selectService(srv);
            }
            this.closeDetailsModal();
            this.nextStep();
        },

        getDefaultExtraIcon(name) {
            const n = (name || '').toLowerCase();
            if (n.includes('cuero') || n.includes('asiento')) return '💺';
            if (n.includes('llanta') || n.includes('rueda')) return '🛞';
            if (n.includes('cristal') || n.includes('vidrio') || n.includes('parabrisa')) return '🪟';
            if (n.includes('ozono') || n.includes('olor') || n.includes('desinfecc')) return '💨';
            if (n.includes('motor')) return '⚙️';
            if (n.includes('foco') || n.includes('óptico')) return '💡';
            if (n.includes('plástico')) return '🛡️';
            return '✨';
        },

        getDefaultExtraDescription(name) {
            const n = (name || '').toLowerCase();
            if (n.includes('cuero')) return 'Nutrición profunda e hidrofobia para tapicería en cuero';
            if (n.includes('llanta')) return 'Sellado cerámico en caras de llantas contra polvo de freno';
            if (n.includes('cristal') || n.includes('vidrio')) return 'Efecto lluvia extrema y anti-manchas de agua en vidrios';
            if (n.includes('ozono') || n.includes('olor')) return 'Eliminación 99.9% de bacterias, ácaros y malos olores';
            if (n.includes('motor')) return 'Desengrase técnico a vapor y sellado protector de gomas';
            if (n.includes('foco')) return 'Eliminación de opacidad y sellador UV cerámico en ópticos';
            if (n.includes('plástico')) return 'Acondicionamiento y protección UV para molduras';
            return 'Tratamiento adicional de protección y embellecimiento';
        },

        get availableExtras() {
            if (!this.selectedService) return [];
            const srv = this.selectedService;
            const srvName = (srv.name || '').toLowerCase();
            const srvCat = this.getServiceCatKey(srv);

            // High-value optional upsell extras catalog with icons & descriptions
            const defaultCatalog = [
                { id: '01M06WPBK06DYS7N06FFNRVHH7', name: 'Sellado Cerámico de Cristales', image: '/assets/images/extras/sellado-cristales.jpg', icon: '🪟', description: 'Efecto lluvia extrema y anti-manchas de agua en parabrisas y vidrios', price: 30000, slug: 'sellado-cristales' },
                { id: '01M06WPBK4E25PP45ZQEFTGJM9', name: 'Sellado Cerámico de Llantas', image: '/assets/images/extras/sellado-llantas.jpg', icon: '🛞', description: 'Protección cerámica en caras de llantas contra polvo de freno', price: 25000, slug: 'sellado-llantas' },
                { id: '01kwfafhqvgbvc2xpxwaa99jh1', name: 'Limpieza de Motor', image: '/assets/images/extras/limpieza-motor.jpg', icon: '⚙️', description: 'Desengrase técnico a vapor y sellado protector de gomas y plásticos', price: 20000, slug: 'limpieza-motor' },
                { id: '01kwfafhqwvbrtm1wd9mvykkna', name: 'Tratamiento de Cuero', image: '/assets/images/extras/tratamiento-cuero.jpg', icon: '💺', description: 'Nutrición profunda e hidrofobia protectora para tapicería en cuero', price: 18000, slug: 'tratamiento-cuero' },
                { id: '01kwfafhqxg2b3dnrrgjtw8fxa', name: 'Desinfección con Ozono', image: '/assets/images/extras/eliminacion-olores.jpg', icon: '💨', description: 'Eliminación 99.9% de bacterias, ácaros y malos olores en el habitáculo', price: 15000, slug: 'eliminacion-olores' },
                { id: '01kwfafhqt2q2pthjs450m95re', name: 'Pulido de Focos', image: '/assets/images/extras/pulido-focos.jpg', icon: '💡', description: 'Eliminación de opacidad, amarillamiento y sellador UV en ópticos', price: 20000, slug: 'pulido-focos' },
                { id: '01kwfafhqyt3y2y4b075cdbf68', name: 'Protección Plástica', image: '/assets/images/extras/proteccion-plastica.jpg', icon: '🛡️', description: 'Restauración de tono original y protección UV para molduras exteriores', price: 12000, slug: 'proteccion-plastica' }
            ];

            // Match real database extras from allExtrasList
            let list = defaultCatalog.map(ex => {
                if (this.allExtrasList && this.allExtrasList.length > 0) {
                    const dbMatch = this.allExtrasList.find(e => e.slug === ex.slug);
                    if (dbMatch) {
                        return { 
                            ...ex, 
                            id: dbMatch.id, 
                            name: dbMatch.name || ex.name,
                            price: parseInt(dbMatch.price) || ex.price,
                            description: dbMatch.description || ex.description,
                            image: ex.image
                        };
                    }
                }
                return ex;
            });

            // Extract all included extras from service configuration
            const includedInService = (srv.extras || [])
                .filter(ex => ex.pivot && (ex.pivot.is_included == 1 || ex.pivot.is_courtesy == 1 || ex.pivot.is_required == 1))
                .map(ex => ((ex.slug || '') + ' ' + (ex.name || '')).toLowerCase());

            // Prevent offering an extra if it is already part of the chosen service package
            const isMotorIncluded = srvName.includes('detailing completo') || srvName.includes('completo') || includedInService.some(s => s.includes('motor'));
            const isCueroIncluded = srvName.includes('detailing interior') || srvName.includes('interior') || srvName.includes('completo') || includedInService.some(s => s.includes('cuero'));
            const isOzonoIncluded = srvName.includes('detailing interior') || srvName.includes('interior') || srvName.includes('completo') || includedInService.some(s => s.includes('olor') || s.includes('ozono'));
            const isFocosIncluded = srvName.includes('focos') || srvName.includes('restauración') || includedInService.some(s => s.includes('foco'));
            const isCristalesIncluded = srvName.includes('nivel 1') || srvName.includes('nivel 2') || srvName.includes('nivel 3') || srvName.includes('crystal serum ultra') || srvName.includes('exoshield') || srvCat === 'especiales' || includedInService.some(s => s.includes('cristal') || s.includes('parabrisas') || s.includes('vidrio'));
            const isLlantasIncluded = srvName.includes('nivel 2') || srvName.includes('nivel 3') || srvName.includes('crystal serum ultra') || includedInService.some(s => s.includes('llanta'));
            const isPlasticaIncluded = srvName.includes('nivel 1') || srvName.includes('nivel 2') || srvName.includes('nivel 3') || srvName.includes('completo') || srvName.includes('avanzado') || includedInService.some(s => s.includes('plástico') || s.includes('plastico'));

            return list.filter(e => {
                if (e.slug === 'limpieza-motor' && isMotorIncluded) return false;
                if (e.slug === 'tratamiento-cuero' && isCueroIncluded) return false;
                if (e.slug === 'eliminacion-olores' && isOzonoIncluded) return false;
                if (e.slug === 'pulido-focos' && isFocosIncluded) return false;
                if (e.slug === 'sellado-cristales' && isCristalesIncluded) return false;
                if (e.slug === 'sellado-llantas' && isLlantasIncluded) return false;
                if (e.slug === 'proteccion-plastica' && isPlasticaIncluded) return false;
                return true;
            });
        },

        getServiceLevelTitle(srv, index) {
            if (!srv) return 'Servicio';
            return srv.name;
        },

        getServiceLevelBadgeIcon(srv) {
            if (!srv) return '✨';
            const cat = this.getServiceCatKey(srv);
            if (cat === 'ceramico') return '💎';
            if (cat === 'pulido') return '🌀';
            if (cat === 'limpieza') return '🧼';
            if (cat === 'especiales') return '🛡️';
            return '✨';
        },

        getServiceLevelBadge(srv, index) {
            if (!srv) return 'Servicio';
            const name = (srv.name || '').toLowerCase();
            const slug = (srv.slug || '').toLowerCase();
            const cat = this.getServiceCatKey(srv);

            if (cat === 'ceramico') {
                if (name.includes('nivel 1') || slug.includes('nivel-1') || slug.includes('dos-anos')) return 'Nivel 1 • Protección 2 Años';
                if (name.includes('nivel 2') || slug.includes('nivel-2') || slug.includes('cinco-anos')) return 'Nivel 2 • Protección 5 Años';
                if (name.includes('nivel 3') || slug.includes('nivel-3') || slug.includes('nueve-anos') || slug.includes('crystal-serum-ultra')) return 'Nivel 3 • 9 Años 10H Ultra';
                return 'Ceramic Coating 9H';
            }
            if (cat === 'pulido') {
                if (name.includes('un paso') || name.includes('1 etapa') || name.includes('1 paso') || slug.includes('una-etapa') || slug.includes('un-paso')) return 'Corrección 1 Paso • Swirls';
                if (name.includes('multi') || slug.includes('multi')) return 'Corrección Multi-Etapa • 95% Acabado';
                if (name.includes('focos') || slug.includes('focos')) return 'Restauración Óptica + Sellado UV';
                return 'Pulido Profesional';
            }
            if (cat === 'limpieza') {
                if (name.includes('lavado premium') || slug.includes('paquete-lavado')) return 'Lavado Artesanal pH Neutro';
                if (name.includes('avanzado') || slug.includes('avanzado')) return 'Descontaminado + Sellante';
                if (name.includes('interior') || slug.includes('interior')) return 'Detailing Interior a Vapor';
                if (name.includes('completo') || slug.includes('completo')) return 'Detailing Integral Completo';
                return 'Cuidado & Estética';
            }
            if (cat === 'especiales') {
                return 'Blindaje Nanotecnológico TPU';
            }
            return 'Tratamiento Premium';
        },

        getServiceProtectionSubtitle(srv) {
            if (!srv) return '';
            const name = (srv.name || '').toLowerCase();
            const slug = (srv.slug || '').toLowerCase();
            const cat = this.getServiceCatKey(srv);

            if (cat === 'ceramico') {
                if (name.includes('nivel 3') || slug.includes('nivel-3') || slug.includes('crystal-serum-ultra')) return 'Hasta 9 años con Crystal Serum Ultra 10H';
                if (name.includes('nivel 2') || slug.includes('nivel-2') || slug.includes('platinum-v2')) return 'Cinco años de protección 9H';
                if (name.includes('nivel 1') || slug.includes('nivel-1') || slug.includes('platinum-v1')) return 'Dos años de protección cerámica';
                return 'Protección cerámica de alta gama';
            }
            if (cat === 'pulido') {
                if (name.includes('multi') || slug.includes('multi')) return 'Elimina hasta 95% de micro-rayas profundas';
                if (name.includes('un paso') || name.includes('1 etapa') || name.includes('1 paso') || slug.includes('1-etapa')) return 'Elimina hasta 70% de defectos de pintura';
                if (name.includes('focos') || slug.includes('focos')) return 'Ópticos 100% transparentes + Sellador UV';
                return 'Eliminación de micro-rayas y brillo espejo';
            }
            if (cat === 'limpieza') {
                if (name.includes('completo') || slug.includes('completo')) return 'Lavado exterior + Detailing interior integral';
                if (name.includes('interior') || slug.includes('interior')) return 'Limpieza y desinfección integral a vapor';
                if (name.includes('avanzado') || slug.includes('avanzado')) return 'Descontaminado férrico + Sellante sintético';
                return 'Lavado técnico artesanal con pH neutro';
            }
            if (cat === 'especiales') {
                return 'Blindaje nanotecnológico TPU para parabrisas';
            }
            return 'Detallado profesional de alta gama';
        },

        getServiceDetailPoints(srv) {
            if (!srv) return [];
            
            // 1. If service has linked included extras in DB, display them!
            if (srv.extras && Array.isArray(srv.extras)) {
                const included = srv.extras.filter(e => e.pivot && (e.pivot.is_included == 1 || e.pivot.is_courtesy == 1));
                if (included.length > 0) {
                    return included.map(e => e.name);
                }
            }

            // 2. Check if service already has bullet list in description
            const rawDesc = srv.short_description || srv.description || '';
            const parsedFeatures = this.getFeatures(rawDesc);
            if (parsedFeatures && parsedFeatures.length >= 2) {
                return parsedFeatures;
            }

            const name = (srv.name || '').toLowerCase();
            const slug = (srv.slug || '').toLowerCase();
            const cat = this.getServiceCatKey(srv);

            // Specific Service points
            if (name.includes('focos') || slug.includes('focos')) {
                return [
                    'Lijado técnico progresivo al agua para eliminar capa quemada y opaca',
                    'Pulido rotativo y orbital con compuestos especiales para policarbonato',
                    'Refinado óptico de alta claridad y restauración de transparencia 100%',
                    'Aplicación de sellador UV cerámico para prevenir futuro desgaste y amarilleamiento'
                ];
            }

            if (name.includes('detailing interior') || name.includes('detallado interior')) {
                return [
                    'Limpieza y desinfección a vapor profunda de todas las superficies interiores',
                    'Lavado y extracción en húmedo de asientos, alfombras y techo',
                    'Nutrición e hidratación de tapicería en cuero con productos de alta gama',
                    'Descontaminado y eliminación de bacterias y malos olores',
                    'Protección hidrofóbica y antiestática para plásticos y molduras'
                ];
            }

            if (name.includes('detailing completo')) {
                return [
                    'Tratamiento integral interior y exterior de máxima exigencia',
                    'Lavado artesanal con espuma activa y descontaminado químico y mecánico',
                    'Limpieza y detallado minucioso de motor a vapor',
                    'Limpieza y desinfección total de habitáculo, cueros y tapicería',
                    'Encerado premium de alta duración o sellado cerámico de cortesía'
                ];
            }

            if (name.includes('crystal serum ultra') || slug.includes('crystal-serum-ultra')) {
                return [
                    'Cerámico insignia más potente del mundo con dureza 10H certificada',
                    'Hasta 9 años de durabilidad y máxima resistencia a rayas y químicos',
                    'Estructura molecular con nanopartículas duras (10H) y flexibles (7H)',
                    'Capa superior EXO Ultra Top Coat para brillo espejo inigualable',
                    'Incluye pulido ligero y limpieza interior profunda',
                    'Garantía oficial y acreditación de instalador certificado Gtechniq'
                ];
            }

            if (name.includes('platinum v2') || slug.includes('platinum-v2')) {
                return [
                    'Cerámico más potente con hasta 5 años de durabilidad garantizada',
                    'Una capa de recubrimiento cerámico de alta dureza',
                    'Una capa de Top Coat (máximo brillo e hidrofobia extrema)',
                    'Una capa de recubrimiento cerámico específico en caras de llantas',
                    'Una capa de recubrimiento cerámico específico para plásticos',
                    'Una capa de recubrimiento cerámico específico para el parabrisas',
                    'Todos los servicios de cerámico incluyen un pulido ligero y limpieza interior'
                ];
            }

            if (cat === 'ceramico') {
                return [
                    'Cerámico de alta protección con 2 a 5 años de durabilidad',
                    'Una capa de recubrimiento cerámico de alta dureza',
                    'Una capa de Top Coat (máximo brillo)',
                    'Una capa de recubrimiento cerámico específico en caras de llantas',
                    'Una capa de recubrimiento cerámico específico para plásticos',
                    'Una capa de recubrimiento cerámico específico para el parabrisas',
                    'Todos los servicios de cerámico incluyen un pulido ligero y limpieza interior (el pulido o corrección de pintura puede variar según el estado de la pintura y cobrarse un extra)'
                ];
            }
            if (cat === 'pulido') {
                return [
                    'Eliminación de microrayas, marcas de remolino (swirls) y hologramas',
                    'Descontaminado técnico profundo con claybar y descontaminante férrico',
                    'Corrección y nivelación del barniz según el nivel seleccionado',
                    'Refinado óptico para máxima claridad, reflejo y profundidad de color',
                    'Sellado sintético o cera de carnauba premium de alta protección'
                ];
            }
            if (cat === 'especiales') {
                return [
                    'Blindaje nanotecnológico TPU de alto impacto contra piedras y gravilla',
                    'Protección UV total contra amarilleamiento y trizaduras en parabrisas',
                    'Capa hidrofóbica integrada para óptima visibilidad bajo lluvia',
                    'Instalación técnica certificada de precisión sin distorsión visual',
                    'Garantía oficial y durabilidad extrema en ruta y ciudad'
                ];
            }
            return [
                'Lavado técnico artesanal con método de dos baldes y shampoo pH neutro',
                'Limpieza profunda y desinfección a vapor de tapicería, cueros y alfombras',
                'Descontaminado y limpieza intensiva de llantas y pasos de rueda',
                'Acondicionamiento y protección UV para molduras plásticas y gomas',
                'Aromatización premium y terminación libre de residuos grasos'
            ];
        },

        getAdjustedPriceForVehicle(srv, vt) {
            if (!srv || !vt) return 0;
            const vtPrice = srv.vehicle_types ? srv.vehicle_types.find(v => v.id === vt.id) : null;
            return vtPrice ? parseInt(vtPrice.pivot.price) : (srv.base_price || 0);
        },

        selectService(srv) {
            this.selectedService = srv;
            this.selectedExtras = [];
            if (srv && srv.extras) {
                srv.extras.forEach(extra => {
                    if (extra.pivot && (extra.pivot.is_required == 1 || extra.pivot.is_courtesy == 1 || extra.pivot.is_included == 1)) {
                        this.selectedExtras.push(extra);
                    }
                });
            }
            this.maxStepReached = Math.max(this.maxStepReached, 2);
            this.saveDraftLead(1);
            // Advance immediately to Step 2!
            this.nextStep();
        },

        toggleExtra(extra) {
            if (extra.pivot && (extra.pivot.is_required == 1 || extra.pivot.is_courtesy == 1 || extra.pivot.is_included == 1)) return;
            const idx = this.selectedExtras.findIndex(e => (e.id === extra.id || e.name === extra.name));
            if (idx > -1) {
                this.selectedExtras.splice(idx, 1);
            } else {
                this.selectedExtras.push(extra);
            }
            this.saveDraftLead();
        },

        isExtraSelected(extra) {
            return this.selectedExtras.some(e => (e.id === extra.id || e.name === extra.name));
        },

        isCourtesy(item) {
            if (!item) return false;
            if (item.pivot && (item.pivot.is_courtesy == 1 || item.pivot.is_courtesy === true)) return true;
            if (item.is_courtesy == 1 || item.is_courtesy === true) return true;
            const name = ((item.name || item || '') + '').toLowerCase();
            return name.includes('cortesía') || name.includes('cortesia');
        },

        get includedTreatments() {
            if (!this.selectedService) return [];
            const result = [];
            
            // 1. Add any items from selectedExtras that are included or marked courtesy or price 0
            this.selectedExtras.forEach(e => {
                const isInc = (e.pivot && (e.pivot.is_included == 1 || e.pivot.is_courtesy == 1)) || parseInt(e.price) === 0 || this.isCourtesy(e);
                if (isInc && !result.some(r => r.name === e.name)) {
                    result.push(e);
                }
            });

            // 2. Also pull included items from the selected service's linked extras
            if (this.selectedService.extras && Array.isArray(this.selectedService.extras)) {
                this.selectedService.extras.forEach(e => {
                    const isInc = (e.pivot && (e.pivot.is_included == 1 || e.pivot.is_courtesy == 1)) || parseInt(e.price) === 0 || this.isCourtesy(e);
                    if (isInc && !result.some(r => r.name === e.name)) {
                        result.push(e);
                    }
                });
            }

            // 3. If no extras found, extract from service bullet points
            if (result.length === 0) {
                const points = this.getServiceDetailPoints(this.selectedService);
                points.forEach(p => {
                    result.push({ 
                        name: p, 
                        price: 0, 
                        is_courtesy: (p.toLowerCase().includes('cortesía') || p.toLowerCase().includes('cortesia')) ? 1 : 0 
                    });
                });
            }

            return result;
        },

        get paidExtras() {
            return this.selectedExtras.filter(e => {
                const isInc = (e.pivot && (e.pivot.is_included == 1 || e.pivot.is_courtesy == 1)) || parseInt(e.price) === 0 || this.isCourtesy(e);
                return !isInc && parseInt(e.price) > 0;
            });
        },

        selectVehicle(vt) {
            this.selectedVehicle = vt;
            this.maxStepReached = Math.max(this.maxStepReached, 2);
            this.saveDraftLead(2);
        },

        getAdjustedPrice(srv) {
            if (!this.selectedVehicle) return srv.base_price || 0;
            const vtPrice = srv.vehicle_types ? srv.vehicle_types.find(vt => vt.id === this.selectedVehicle.id) : null;
            return vtPrice ? parseInt(vtPrice.pivot.price) : (srv.base_price || 0);
        },

        getExtrasTotal() {
            return this.selectedExtras.reduce((sum, extra) => {
                if (extra.pivot && (extra.pivot.is_courtesy == 1 || extra.pivot.is_included == 1)) return sum;
                return sum + parseInt(extra.price);
            }, 0);
        },

        getTotalPrice() {
            if (!this.selectedService) return 0;
            return this.getAdjustedPrice(this.selectedService) + this.getExtrasTotal();
        },

        formatCLP(amount) {
            return new Intl.NumberFormat('es-CL', {
                style: 'currency',
                currency: 'CLP',
                minimumFractionDigits: 0,
                maximumFractionDigits: 0
            }).format(amount);
        },

        formatDuration(minutes) {
            const hours = Math.floor(minutes / 60);
            const mins = minutes % 60;
            if (hours === 0) return `${mins} min`;
            if (mins === 0) return `${hours}h`;
            return `${hours}h ${mins}min`;
        },

        saveDraftLead(overrideStep) {
            if (!this.sessionId) return;
            
            const payload = {
                sessionId: this.sessionId,
                customer: {
                    name: this.name || '',
                    email: this.email || '',
                    phone: this.phone || '',
                    commune: this.commune || ''
                },
                vehicle: this.selectedVehicle ? { id: this.selectedVehicle.id, name: this.selectedVehicle.name } : null,
                service: this.selectedService ? { id: this.selectedService.id, name: this.selectedService.name } : null,
                extras: this.selectedExtras.map(e => e.name),
                totalPrice: this.getTotalPrice(),
                step: overrideStep || this.currentStep
            };

            fetch('/api/bookings/draft-lead', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                },
                body: JSON.stringify(payload)
            }).catch(err => {
                console.debug('[DraftLead] autosave info:', err);
            });
        },

        nextStep() {
            if (this.currentStep === 1) {
                if (!this.selectedService) {
                    this.submitError = 'Por favor selecciona un servicio para continuar.';
                    return;
                }
            }
            if (this.currentStep === 2) {
                if (!this.name.trim() || !this.phone.trim()) {
                    this.submitError = 'Por favor ingresa tu nombre y teléfono de contacto.';
                    return;
                }
                if (!this.selectedVehicle) {
                    this.submitError = 'Por favor selecciona la categoría de tu vehículo.';
                    return;
                }
            }

            this.submitError = null;
            this.currentStep++;
            this.maxStepReached = Math.max(this.maxStepReached, this.currentStep);
            this.saveDraftLead(this.currentStep);
            this.scrollToTop();
        },

        prevStep() {
            if (this.currentStep > 1) {
                this.currentStep--;
                this.saveDraftLead(this.currentStep);
                this.scrollToTop();
            }
        },

        goToStep(stepNum) {
            if (stepNum <= this.maxStepReached) {
                this.currentStep = stepNum;
                this.saveDraftLead(stepNum);
                this.scrollToTop();
            }
        },

        submitQuote() {
            this.isSubmitting = true;
            this.submitError = null;

            const payload = {
                sessionId: this.sessionId,
                customer: {
                    firstName: this.name.split(' ')[0] || '',
                    lastName: this.name.split(' ').slice(1).join(' ') || this.name.split(' ')[0] || '',
                    email: this.email || 'sin-email@cotizacion.cl',
                    phone: this.phone,
                    notes: this.commune
                },
                vehicle: {
                    vehicleTypeId: this.selectedVehicle.id,
                    licensePlate: 'COTIZACION'
                },
                serviceId: this.selectedService.id,
                extraIds: this.selectedExtras.map(e => e.id),
                date: new Date().toISOString().split('T')[0],
                startAt: new Date().toISOString(),
                notes: `Cotización Web 3 Pasos. Comuna: ${this.commune}`
            };

            fetch('/api/bookings', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                },
                body: JSON.stringify(payload)
            })
            .then(async (response) => {
                const data = await response.json();
                if (!response.ok) {
                    throw new Error(data.error?.message || 'No se pudo procesar la solicitud.');
                }
                window.location.href = `/reserva/${data.booking.publicId}`;
            })
            .catch(err => {
                this.submitError = err.message;
            })
            .finally(() => {
                this.isSubmitting = false;
            });
        }
    };
}
</script>
@endpush
