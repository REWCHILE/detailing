@extends('layouts.public')

@section('title', 'Cotizador Online & Reservas | High Contrast Detailing Center')
@section('meta_description', 'Cotiza y agenda el detallado automotriz de tu vehículo online. Chicureo, Colina.')
@section('meta_keywords', 'cotizar detailing online, agendar detailing chicureo, reserva detailing santiago, precios detailing colina, cotizador detailing')

@section('content')
<main class="min-h-screen bg-[#070707] text-white transition-colors duration-300 pt-28 pb-20">
    <div class="container-custom max-w-7xl px-4" x-data="bookingWizard()">
        
        <!-- Header -->
        <div class="text-center mb-10" x-show="currentStep < 4">
            <p class="text-brand text-xs font-bold tracking-[0.25em] uppercase mb-3 px-4 py-1.5 rounded-full bg-brand/10 border border-brand/20 inline-block">
                Cotizador Inteligente
            </p>
            <h2 class="font-display text-4xl md:text-5xl font-extrabold text-white uppercase tracking-tight">
                Cotiza en <span class="text-gradient">3 Simples Pasos</span>
            </h2>
        </div>

        <!-- 3-Step Stepper Indicator -->
        <div class="max-w-xl mx-auto mb-10" x-show="currentStep < 4">
            <div class="flex items-center justify-between relative px-4">
                <!-- Progress Line Behind -->
                <div class="absolute top-5 left-8 right-8 h-[2.5px] bg-white/10">
                    <div class="h-full bg-brand transition-all duration-500" :style="'width: ' + ((currentStep - 1) / 2) * 100 + '%'"></div>
                </div>

                <!-- Steps -->
                <template x-for="step in steps" :key="step.number">
                    <div class="relative z-10 flex flex-col items-center">
                        <button 
                            type="button"
                            @click="goToStep(step.number)"
                            :disabled="step.number > maxStepReached"
                            class="w-11 h-11 rounded-full border-2 flex items-center justify-center text-sm font-extrabold transition-all duration-300 disabled:cursor-not-allowed"
                            :class="currentStep >= step.number 
                                ? 'bg-brand border-brand text-white shadow-lg shadow-brand/30 scale-105' 
                                : 'bg-zinc-900 border-white/15 text-white/40'"
                        >
                            <template x-if="currentStep > step.number">
                                <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                            </template>
                            <template x-if="currentStep <= step.number">
                                <span x-text="step.number"></span>
                            </template>
                        </button>
                        <span class="text-xs mt-2 font-bold uppercase tracking-wider" 
                              :class="currentStep >= step.number ? 'text-brand' : 'text-white/40'" 
                              x-text="step.label"></span>
                    </div>
                </template>
            </div>
        </div>

        <!-- Wizard Main Container -->
        <div class="flex flex-col lg:flex-row gap-8 items-start">
            
            <!-- Main Content Area -->
            <div class="flex-1 w-full min-w-0 bg-zinc-950/90 border border-white/15 rounded-[2.5rem] p-6 sm:p-10 md:p-12 shadow-2xl backdrop-blur-2xl text-white">
                
                <!-- PASO 1: SELECCIÓN INNOVADORA DE SERVICIOS (CHIPS DE CATEGORÍAS) -->
                <div x-show="currentStep === 1" x-transition>
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
                        <div>
                            <h3 class="font-display font-extrabold text-white text-2xl md:text-3xl uppercase tracking-tight">
                                1. Selecciona tu Servicio
                            </h3>
                            <p class="text-black/50 dark:text-white/50 text-sm mt-1">
                                Explora nuestras especialidades por categoría y elige el tratamiento ideal.
                            </p>
                        </div>
                    </div>

                    <!-- Category Chips Selector (High Visibility Dark Luxury Styling) -->
                    <div class="mb-8">
                        <div class="flex items-center gap-2.5 overflow-x-auto pb-3 scrollbar-none snap-x snap-mandatory">
                            <button 
                                type="button" 
                                @click="selectedCategory = 'todas'"
                                :class="selectedCategory === 'todas'
                                    ? 'bg-brand text-white border-brand shadow-lg shadow-brand/40 scale-[1.03]'
                                    : 'bg-zinc-900 border-white/20 text-white font-bold hover:border-brand/60 hover:bg-zinc-800'"
                                class="snap-start shrink-0 px-5 py-3 rounded-2xl border text-xs font-bold uppercase tracking-wider transition-all duration-300 flex items-center gap-2 shadow-md"
                            >
                                <span>✨ Todos</span>
                            </button>

                            <button 
                                type="button" 
                                @click="selectedCategory = 'limpieza'"
                                :class="selectedCategory === 'limpieza'
                                    ? 'bg-brand text-white border-brand shadow-lg shadow-brand/40 scale-[1.03]'
                                    : 'bg-zinc-900 border-white/20 text-white font-bold hover:border-brand/60 hover:bg-zinc-800'"
                                class="snap-start shrink-0 px-5 py-3 rounded-2xl border text-xs font-bold uppercase tracking-wider transition-all duration-300 flex items-center gap-2 shadow-md"
                            >
                                <span>🧼 Limpieza & Detallado</span>
                            </button>

                            <button 
                                type="button" 
                                @click="selectedCategory = 'ceramico'"
                                :class="selectedCategory === 'ceramico'
                                    ? 'bg-brand text-white border-brand shadow-lg shadow-brand/40 scale-[1.03]'
                                    : 'bg-zinc-900 border-white/20 text-white font-bold hover:border-brand/60 hover:bg-zinc-800'"
                                class="snap-start shrink-0 px-5 py-3 rounded-2xl border text-xs font-bold uppercase tracking-wider transition-all duration-300 flex items-center gap-2 shadow-md"
                            >
                                <span>💎 Ceramic Coating</span>
                            </button>

                            <button 
                                type="button" 
                                @click="selectedCategory = 'pulido'"
                                :class="selectedCategory === 'pulido'
                                    ? 'bg-brand text-white border-brand shadow-lg shadow-brand/40 scale-[1.03]'
                                    : 'bg-zinc-900 border-white/20 text-white font-bold hover:border-brand/60 hover:bg-zinc-800'"
                                class="snap-start shrink-0 px-5 py-3 rounded-2xl border text-xs font-bold uppercase tracking-wider transition-all duration-300 flex items-center gap-2 shadow-md"
                            >
                                <span>🌀 Corrección de Pintura</span>
                            </button>

                            <button 
                                type="button" 
                                @click="selectedCategory = 'especiales'"
                                :class="selectedCategory === 'especiales'
                                    ? 'bg-brand text-white border-brand shadow-lg shadow-brand/40 scale-[1.03]'
                                    : 'bg-zinc-900 border-white/20 text-white font-bold hover:border-brand/60 hover:bg-zinc-800'"
                                class="snap-start shrink-0 px-5 py-3 rounded-2xl border text-xs font-bold uppercase tracking-wider transition-all duration-300 flex items-center gap-2 shadow-md"
                            >
                                <span>🛡️ ExoShield & Especiales</span>
                            </button>
                        </div>
                    </div>

                    <!-- Photo Bento Grid Services Selection (Matching Reference Design) -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
                        <template x-for="srv in filteredServices" :key="srv.id">
                            <div 
                                @click="selectService(srv)"
                                class="relative group rounded-[2.2rem] overflow-hidden min-h-[320px] sm:min-h-[360px] border-2 cursor-pointer shadow-xl flex flex-col justify-between p-6 md:p-8 transition-all duration-500"
                                :class="selectedService && selectedService.id === srv.id
                                    ? 'border-brand ring-4 ring-brand/30 scale-[1.02] shadow-2xl shadow-brand/30'
                                    : 'border-white/15 bg-zinc-900 hover:border-brand/60 hover:shadow-2xl hover:scale-[1.01]'"
                            >
                                <!-- Photo Background with Zoom Effect -->
                                <img :src="getServiceImage(srv)" :alt="srv.name" class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 ease-out z-0">
                                
                                <!-- Dark Vignette Overlay for High Legibility -->
                                <div class="absolute inset-0 bg-gradient-to-t from-black via-black/60 to-black/30 z-10 transition-opacity"></div>
                                <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-transparent to-transparent z-10"></div>

                                <!-- Card Top Row: Category & Status Badge -->
                                <div class="relative z-20 flex items-center justify-between gap-2">
                                    <span class="px-3.5 py-1.5 rounded-full bg-black/60 border border-white/20 text-white text-[10px] font-extrabold uppercase tracking-widest backdrop-blur-md shadow-lg" x-text="getCategoryBadgeLabel(srv)"></span>
                                    
                                    <template x-if="selectedService && selectedService.id === srv.id">
                                        <span class="px-3.5 py-1.5 rounded-full bg-brand text-white text-xs font-black uppercase tracking-wider flex items-center gap-1 shadow-lg shadow-brand/50">
                                            ✓ Seleccionado
                                        </span>
                                    </template>
                                    <template x-if="!selectedService || selectedService.id !== srv.id">
                                        <span class="px-3 py-1 rounded-full bg-black/40 border border-white/15 text-white/80 text-[11px] font-medium backdrop-blur-sm flex items-center gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 text-brand" fill="none" viewBox="0 0 24 24" stroke="currentColor"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                                            <span x-text="formatDuration(srv.duration_minutes)"></span>
                                        </span>
                                    </template>
                                </div>

                                <!-- Card Bottom Row: Title, Price & CTA -->
                                <div class="relative z-20 mt-auto pt-8">
                                    <div class="flex flex-col gap-1 mb-3">
                                        <span class="text-brand font-black text-2xl md:text-3xl drop-shadow-md" x-text="onlinePaymentsActive ? formatCLP(getAdjustedPrice(srv)) : 'Cotizar'"></span>
                                        <h4 class="font-display font-extrabold text-2xl md:text-3xl text-white uppercase tracking-tight drop-shadow-lg leading-tight"
                                            x-text="srv.name"></h4>
                                    </div>

                                    <!-- Features Bullet Summary -->
                                    <ul class="space-y-1.5 mb-4">
                                        <template x-for="item in getFeatures(srv.short_description).slice(0, 2)">
                                            <li class="flex items-start gap-2 text-xs text-white/80 drop-shadow">
                                                <svg class="w-4 h-4 text-brand mt-0.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                                                <span class="leading-snug html-content" x-html="item"></span>
                                            </li>
                                        </template>
                                    </ul>

                                    <div class="pt-2 border-t border-white/15 flex items-center justify-between text-xs text-white/90">
                                        <span class="font-semibold uppercase tracking-wider text-[11px] text-white/70">Haz clic para seleccionar</span>
                                        <div class="w-8 h-8 rounded-full bg-white/10 group-hover:bg-brand flex items-center justify-center text-white transition-all duration-300">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>

                    <!-- Extras Option (Inline for Selected Service) -->
                    <div x-show="selectedService && selectedService.extras && selectedService.extras.length > 0" class="mt-8 pt-6 border-t border-black/10 dark:border-white/10">
                        <h4 class="font-display font-extrabold text-black dark:text-white text-lg mb-2">
                            Tratamientos Adicionales Opcionales
                        </h4>
                        <p class="text-xs text-black/50 dark:text-white/40 mb-4">Complementa tu servicio con tratamientos específicos para potenciar el acabado:</p>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            <template x-for="extra in selectedService.extras" :key="extra.id">
                                <div 
                                    @click="toggleExtra(extra)"
                                    class="p-4 rounded-2xl border transition-all duration-300 flex items-center justify-between cursor-pointer"
                                    :class="isExtraSelected(extra) 
                                        ? 'border-brand bg-brand/10 text-white' 
                                        : 'border-black/10 dark:border-white/10 bg-black/5 dark:bg-surface-800 hover:border-brand/30'"
                                >
                                    <div class="flex items-center gap-3">
                                        <div class="w-5 h-5 rounded-md border flex items-center justify-center shrink-0"
                                             :class="isExtraSelected(extra) ? 'bg-brand border-brand' : 'border-black/30 dark:border-white/30'">
                                            <svg x-show="isExtraSelected(extra)" class="w-3.5 h-3.5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                                        </div>
                                        <span class="text-xs font-bold text-black dark:text-white" x-text="extra.name"></span>
                                    </div>
                                    <span class="text-xs font-bold text-brand" x-text="'+' + formatCLP(extra.price)"></span>
                                </div>
                            </template>
                        </div>
                    </div>

                    <div class="mt-8 flex justify-end">
                        <button 
                            type="button" 
                            @click="nextStep()"
                            :disabled="!selectedService"
                            class="w-full sm:w-auto px-10 py-4 rounded-full font-bold text-sm uppercase tracking-wider bg-brand hover:bg-brand-dark text-white shadow-xl shadow-brand/30 transition-all duration-300 flex items-center justify-center gap-2 disabled:opacity-40 disabled:cursor-not-allowed"
                        >
                            <span>Paso 2: Tus Datos & Vehículo</span>
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </button>
                    </div>
                </div>

                <!-- PASO 2: DATOS DEL CLIENTE + TAMAÑO DEL VEHÍCULO (FUSIONADOS) -->
                <div x-show="currentStep === 2" x-transition>
                    <h3 class="font-display font-extrabold text-white text-2xl md:text-3xl uppercase tracking-tight mb-2">
                        2. Datos del Cliente & Tipo de Vehículo
                    </h3>
                    <p class="text-white/60 text-sm mb-8">
                        Completa tus datos de contacto y selecciona el tamaño de tu vehículo para calcular la cotización exacta.
                    </p>

                    <!-- Bloque A: Formulario de Contacto -->
                    <div class="mb-10 p-6 rounded-3xl bg-zinc-900 border border-white/15">
                        <h4 class="font-display font-bold text-white text-base mb-4 flex items-center gap-2">
                            <span class="w-6 h-6 rounded-full bg-brand text-white text-xs flex items-center justify-center font-black">A</span>
                            <span>Información Personal de Contacto</span>
                        </h4>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-white/70 uppercase tracking-wider mb-2">Nombre Completo *</label>
                                <input type="text" x-model="name" required placeholder="Ej: Juan Pérez" class="w-full px-4 py-3.5 rounded-2xl bg-black border border-white/20 focus:border-brand text-white text-sm outline-none">
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-white/70 uppercase tracking-wider mb-2">WhatsApp / Teléfono *</label>
                                <input type="text" x-model="phone" required placeholder="Ej: +56 9 1234 5678" class="w-full px-4 py-3.5 rounded-2xl bg-black border border-white/20 focus:border-brand text-white text-sm outline-none">
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-white/70 uppercase tracking-wider mb-2">Correo Electrónico (Opcional)</label>
                                <input type="email" x-model="email" placeholder="Ej: juan@email.com" class="w-full px-4 py-3.5 rounded-2xl bg-black border border-white/20 focus:border-brand text-white text-sm outline-none">
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-white/70 uppercase tracking-wider mb-2">Comuna</label>
                                <select x-model="commune" class="w-full px-4 py-3.5 rounded-2xl bg-black border border-white/20 focus:border-brand text-white text-sm outline-none appearance-none">
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

                    <!-- Bloque B: Tamaño del Vehículo -->
                    <div class="mb-8">
                        <h4 class="font-display font-bold text-white text-base mb-4 flex items-center gap-2">
                            <span class="w-6 h-6 rounded-full bg-brand text-white text-xs flex items-center justify-center font-black">B</span>
                            <span>Selecciona la Categoría / Tamaño de tu Vehículo *</span>
                        </h4>

                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                            <template x-for="vt in vehicleTypes" :key="vt.id">
                                <button 
                                    type="button"
                                    @click="selectVehicle(vt)"
                                    class="relative rounded-2xl border-2 transition-all duration-300 text-left p-5 flex flex-col justify-between"
                                    :class="selectedVehicle && selectedVehicle.id === vt.id
                                        ? 'border-brand bg-brand/20 shadow-lg shadow-brand/25 scale-[1.02]'
                                        : 'border-white/15 bg-zinc-900 hover:border-brand/50'"
                                >
                                    <div class="text-3xl mb-3" x-text="getVehicleIcon(vt.slug)"></div>
                                    <div>
                                        <h5 class="font-display font-extrabold text-white text-base leading-tight mb-1" x-text="vt.name"></h5>
                                        <p class="text-white/50 text-xs line-clamp-2" x-text="vt.description"></p>
                                    </div>
                                    
                                    <div class="mt-4 pt-2 border-t border-white/10 flex items-center justify-between text-[11px] font-bold">
                                        <span class="text-brand uppercase" x-text="selectedVehicle && selectedVehicle.id === vt.id ? '✓ Seleccionado' : 'Elegir'"></span>
                                    </div>
                                </button>
                            </template>
                        </div>
                    </div>

                    <div class="rounded-xl border border-red-500/20 bg-red-500/5 px-4 py-3 text-sm text-red-400 mb-6" x-show="submitError" x-text="submitError"></div>

                    <div class="flex items-center justify-between pt-4 border-t border-white/15">
                        <button type="button" @click="prevStep()" class="px-8 py-3.5 rounded-full font-bold text-xs uppercase tracking-wider border border-white/20 text-white/70 hover:text-white transition-all">
                            Anterior
                        </button>

                        <button 
                            type="button" 
                            @click="nextStep()"
                            :disabled="!selectedVehicle || !name || !phone"
                            class="px-10 py-4 rounded-full font-bold text-xs uppercase tracking-wider bg-brand hover:bg-brand-dark text-white shadow-xl shadow-brand/30 transition-all duration-300 flex items-center gap-2 disabled:opacity-40 disabled:cursor-not-allowed"
                        >
                            <span>Paso 3: Ver Resumen & Cotización</span>
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </button>
                    </div>
                </div>

                <!-- PASO 3: RESUMEN DE COTIZACIÓN & CONFIRMACIÓN (ENVÍO DE EMAILS) -->
                <div x-show="currentStep === 3" x-transition>
                    <h3 class="font-display font-extrabold text-white text-2xl md:text-3xl uppercase tracking-tight mb-2">
                        3. Resumen & Confirmación de Cotización
                    </h3>
                    <p class="text-white/60 text-sm mb-8">
                        Revisa los detalles finales antes de enviar la solicitud. Te enviaremos una copia por correo.
                    </p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <!-- Left: Breakdown -->
                        <div class="space-y-4">
                            <div class="p-5 rounded-2xl bg-zinc-900 border border-white/15">
                                <span class="text-xs font-bold text-brand uppercase tracking-wider block mb-1">Cliente Solicitante</span>
                                <p class="text-white font-extrabold text-lg" x-text="name"></p>
                                <p class="text-xs text-white/60 font-mono mt-1" x-text="phone + (email ? ' • ' + email : '') + (commune ? ' • 📍 ' + commune : '')"></p>
                            </div>

                            <div class="p-5 rounded-2xl bg-zinc-900 border border-white/15">
                                <span class="text-xs font-bold text-brand uppercase tracking-wider block mb-1">Servicio Seleccionado</span>
                                <div class="flex items-center justify-between">
                                    <span class="text-white font-bold text-base" x-text="selectedService ? selectedService.name : ''"></span>
                                    <span class="text-brand font-black text-lg" x-text="formatCLP(selectedService ? getAdjustedPrice(selectedService) : 0)"></span>
                                </div>
                            </div>

                            <div class="p-5 rounded-2xl bg-zinc-900 border border-white/15">
                                <span class="text-xs font-bold text-brand uppercase tracking-wider block mb-1">Tipo de Vehículo</span>
                                <div class="flex items-center justify-between">
                                    <span class="text-white font-bold text-base" x-text="selectedVehicle ? (getVehicleIcon(selectedVehicle.slug) + ' ' + selectedVehicle.name) : ''"></span>
                                </div>
                            </div>

                            <div class="p-5 rounded-2xl bg-zinc-900 border border-white/15" x-show="selectedExtras.length > 0">
                                <span class="text-xs font-bold text-brand uppercase tracking-wider block mb-2">Tratamientos Adicionales</span>
                                <template x-for="ex in selectedExtras" :key="ex.id">
                                    <div class="flex items-center justify-between text-xs py-1 border-b border-white/10 last:border-none">
                                        <span class="text-white/80" x-text="ex.name"></span>
                                        <span class="text-brand font-bold" x-text="'+' + formatCLP(ex.price)"></span>
                                    </div>
                                </template>
                            </div>
                        </div>

                        <!-- Right: Total & Action Card (Fixed Dark Luxury Contrast) -->
                        <div class="flex flex-col justify-between p-8 rounded-3xl bg-zinc-950 text-white border-2 border-brand/50 shadow-2xl">
                            <div>
                                <span class="text-xs font-extrabold uppercase tracking-widest text-brand block mb-2">Total Estimado de Servicio</span>
                                <div class="text-4xl md:text-5xl font-black text-white font-display mb-4 drop-shadow-md" x-text="formatCLP(getTotalPrice())"></div>

                                <div class="p-4 rounded-2xl bg-zinc-900 border border-white/15 text-xs text-white/90 space-y-2">
                                    <p class="font-bold text-brand flex items-center gap-1.5">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        Atención Directa & Personalizada
                                    </p>
                                    <p class="leading-relaxed">Al enviar tu cotización, recibirás una confirmación por email y un especialista de High Contrast se pondrá en contacto contigo para coordinar el horario ideal.</p>
                                </div>
                            </div>

                            <div class="mt-8 space-y-4">
                                <div class="rounded-xl border border-red-500/20 bg-red-500/5 px-4 py-3 text-xs text-red-400" x-show="submitError" x-text="submitError"></div>

                                <button 
                                    type="button" 
                                    @click="submitQuote()"
                                    :disabled="isSubmitting"
                                    class="w-full py-4 rounded-full font-extrabold text-sm uppercase tracking-wider bg-brand hover:bg-brand-dark text-white shadow-xl shadow-brand/40 transition-all duration-300 flex items-center justify-center gap-2 disabled:opacity-60"
                                >
                                    <span x-show="isSubmitting" class="animate-spin h-4 w-4 border-2 border-white border-t-transparent rounded-full"></span>
                                    <span x-text="isSubmitting ? 'Enviando cotización...' : '🚀 Solicitar Cotización Ahora'"></span>
                                </button>

                                <button type="button" @click="prevStep()" class="w-full py-3 text-xs font-bold uppercase tracking-wider text-brand hover:text-white transition-colors">
                                    ← Volver al Paso 2
                                </button>
                            </div>
                        </div>
                    </div>
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
        currentStep: 1,
        maxStepReached: 1,
        steps: [
            { number: 1, label: 'Servicios' },
            { number: 2, label: 'Tus Datos & Vehículo' },
            { number: 3, label: 'Cotización' }
        ],
        vehicleTypes: @json($vehicleTypes),
        services: @json($services),
        onlinePaymentsActive: true,
        
        selectedVehicle: null,
        selectedService: null,
        selectedExtras: [],
        selectedCategory: 'todas',
        
        // Customer Details
        name: '',
        phone: '',
        email: '',
        commune: '',
        
        submitError: null,
        isSubmitting: false,
        
        getServiceCatKey(srv) {
            if (!srv) return 'limpieza';
            const text = ((srv.name || '') + ' ' + (srv.slug || '') + ' ' + (srv.short_description || '')).toLowerCase();
            if (text.includes('exoshield') || text.includes('parabrisas') || text.includes('vidrio')) {
                return 'especiales';
            }
            if (text.includes('ceramic') || text.includes('cerámico') || text.includes('glass') || text.includes('gtechniq') || text.includes('sellado') || text.includes('coating')) {
                return 'ceramico';
            }
            if (text.includes('pulido') || text.includes('corrección') || text.includes('correccion') || text.includes('paint') || text.includes('pintura') || text.includes('focos')) {
                return 'pulido';
            }
            if (srv.category && ['limpieza', 'ceramico', 'pulido', 'especiales'].includes(srv.category.toLowerCase())) {
                return srv.category.toLowerCase();
            }
            return 'limpieza';
        },

        get filteredServices() {
            if (this.selectedCategory === 'todas') return this.services;
            return this.services.filter(s => this.getServiceCatKey(s) === this.selectedCategory);
        },

        getServiceImage(srv) {
            if (srv && srv.image && srv.image.length > 5) return srv.image;
            if (!srv) return '/assets/images/services/service_limpieza.png';
            
            const name = (srv.name || '').toLowerCase();
            
            // Unique mapping per specific service
            if (name.includes('lavado premium')) return '/assets/images/galeria/Wash.jpg';
            if (name.includes('detailing interior') || name.includes('detallado interior')) return '/assets/images/galeria/HCD-17.jpg';
            if (name.includes('detailing completo')) return '/assets/images/galeria/1-22-25-39.jpg';
            if (name.includes('pulido profesional') || name.includes('pulido básico')) return '/assets/images/galeria/Polishing.jpg';
            if (name.includes('corrección de pintura') || name.includes('corrección multi-etapa')) return '/assets/images/galeria/HCD-70.jpg';
            if (name.includes('corrección 1 etapa')) return '/assets/images/galeria/MVW00751.jpg';
            if (name.includes('tratamiento cerámico') || name.includes('coating hidrofóbico')) return '/assets/images/services/service_ceramico.png';
            if (name.includes('focos')) return '/assets/images/galeria/White Rcf-7.jpg';
            if (name.includes('gtechniq crystal serum ultra')) return '/assets/images/gtechniq/csu-product.png';
            if (name.includes('gtechniq platinum')) return '/assets/images/gtechniq/csl-product.png';
            if (name.includes('exoshield')) return '/assets/images/exoshield/gt3-box.png';
            if (name.includes('combo glass')) return '/assets/images/exoshield/q5-roller.jpg';
            if (name.includes('paquete lavado') || name.includes('lavado avanzado')) return '/assets/images/galeria/Red ZO6-20.jpg';
            
            const key = this.getServiceCatKey(srv);
            const fallbackImages = {
                limpieza: '/assets/images/services/service_limpieza.png',
                ceramico: '/assets/images/services/service_ceramico.png',
                pulido: '/assets/images/services/service_pulido.png',
                especiales: '/assets/images/services/service_exoshield.png'
            };
            return fallbackImages[key] || '/assets/images/services/service_limpieza.png';
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
                sedan: '🚘',
                hatchback: '🚗',
                suv: '🚙',
                camioneta: '🛻',
                deportivo: '🏎️',
                moto: '🏍️'
            };
            return icons[slug] || '🚗';
        },

        selectService(srv) {
            this.selectedService = srv;
            this.selectedExtras = [];
            if (srv.extras) {
                srv.extras.forEach(extra => {
                    if (extra.pivot && (extra.pivot.is_required == 1 || extra.pivot.is_courtesy == 1 || extra.pivot.is_included == 1)) {
                        this.selectedExtras.push(extra);
                    }
                });
            }
            this.maxStepReached = Math.max(this.maxStepReached, 2);
        },

        toggleExtra(extra) {
            if (extra.pivot && (extra.pivot.is_required == 1 || extra.pivot.is_courtesy == 1 || extra.pivot.is_included == 1)) return;
            const idx = this.selectedExtras.findIndex(e => e.id === extra.id);
            if (idx > -1) {
                this.selectedExtras.splice(idx, 1);
            } else {
                this.selectedExtras.push(extra);
            }
        },

        isExtraSelected(extra) {
            return this.selectedExtras.some(e => e.id === extra.id);
        },

        selectVehicle(vt) {
            this.selectedVehicle = vt;
            this.maxStepReached = Math.max(this.maxStepReached, 3);
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
        },

        prevStep() {
            if (this.currentStep > 1) {
                this.currentStep--;
            }
        },

        goToStep(stepNum) {
            if (stepNum <= this.maxStepReached) {
                this.currentStep = stepNum;
            }
        },

        submitQuote() {
            this.isSubmitting = true;
            this.submitError = null;

            const payload = {
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
