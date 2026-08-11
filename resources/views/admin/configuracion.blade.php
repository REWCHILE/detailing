@extends('layouts.admin')

@section('title', 'Configuración General | High Contrast Detailing')
@section('title_section', 'Configuración')

@section('content')
<div x-data="shopSettings()" class="space-y-6 max-w-4xl">
    @if(session('success'))
        <div class="rounded-xl border border-green-500/20 bg-green-500/10 p-4 text-sm text-green-600 dark:text-green-400">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('admin.configuracion') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        
        <!-- Tab navigation -->
        <div class="flex border-b border-black/5 dark:border-white/5 gap-2 overflow-x-auto pb-px">
            <button type="button" @click="activeTab = 'perfil'" :class="activeTab === 'perfil' ? 'border-brand text-brand font-bold' : 'border-transparent text-black/50 dark:text-white/50 hover:text-black dark:hover:text-white hover:border-black/10 dark:hover:border-white/10'" class="px-4 py-2 border-b-2 text-sm transition-all whitespace-nowrap">
                Perfil de Tienda
            </button>
            <button type="button" @click="activeTab = 'horarios'" :class="activeTab === 'horarios' ? 'border-brand text-brand font-bold' : 'border-transparent text-black/50 dark:text-white/50 hover:text-black dark:hover:text-white hover:border-black/10 dark:hover:border-white/10'" class="px-4 py-2 border-b-2 text-sm transition-all whitespace-nowrap">
                Horarios de Atención
            </button>
            <button type="button" @click="activeTab = 'smtp'" :class="activeTab === 'smtp' ? 'border-brand text-brand font-bold' : 'border-transparent text-black/50 dark:text-white/50 hover:text-black dark:hover:text-white hover:border-black/10 dark:hover:border-white/10'" class="px-4 py-2 border-b-2 text-sm transition-all whitespace-nowrap">
                Configuración SMTP (Correos)
            </button>
            <button type="button" @click="activeTab = 'seo'" :class="activeTab === 'seo' ? 'border-brand text-brand font-bold' : 'border-transparent text-black/50 dark:text-white/50 hover:text-black dark:hover:text-white hover:border-black/10 dark:hover:border-white/10'" class="px-4 py-2 border-b-2 text-sm transition-all whitespace-nowrap">
                SEO & Analítica
            </button>
        </div>

        <!-- TAB 1: PERFIL DE TIENDA -->
        <div x-show="activeTab === 'perfil'" class="rounded-2xl border border-black/5 dark:border-white/5 bg-white dark:bg-surface/30 p-6 md:p-8 shadow-sm backdrop-blur-xl space-y-6">
            <h3 class="font-display font-bold text-lg text-black dark:text-white border-b border-black/5 dark:border-white/5 pb-3">Información del Negocio</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
                <div class="md:col-span-2">
                    <label class="block text-xs uppercase text-black/55 dark:text-white/50 font-bold mb-1.5">Nombre Comercial</label>
                    <input type="text" name="business_name" value="{{ $profile->business_name }}" required class="w-full rounded-xl border border-black/10 dark:border-white/10 bg-black/[0.02] dark:bg-surface/50 px-4 py-2.5 text-sm text-black dark:text-white outline-none focus:border-brand">
                </div>
                <div>
                    <label class="block text-xs uppercase text-black/55 dark:text-white/50 font-bold mb-1.5">Logo del Centro</label>
                    <div class="flex items-center gap-2">
                        @if($profile->logo)
                            <img src="{{ asset($profile->logo) }}" alt="Logo" class="h-10 w-10 object-contain rounded bg-black/10 dark:bg-white/10 p-1 border border-black/10 dark:border-white/10">
                        @else
                            <div class="h-10 w-10 flex items-center justify-center rounded bg-black/10 dark:bg-white/10 text-[9px] font-bold text-black/55 dark:text-white/50 border border-black/10 dark:border-white/10 uppercase">No Logo</div>
                        @endif
                        <input type="file" name="logo" accept="image/*" class="w-full text-xs text-black/50 dark:text-white/50 file:mr-2 file:py-1 file:px-2 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-brand file:text-white hover:file:bg-brand/90 cursor-pointer">
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-xs uppercase text-black/55 dark:text-white/50 font-bold mb-1.5">Correo de Contacto</label>
                    <input type="email" name="email" value="{{ $profile->email }}" required class="w-full rounded-xl border border-black/10 dark:border-white/10 bg-black/[0.02] dark:bg-surface/50 px-4 py-2.5 text-sm text-black dark:text-white outline-none focus:border-brand">
                </div>
                <div>
                    <label class="block text-xs uppercase text-black/55 dark:text-white/50 font-bold mb-1.5">Página Web</label>
                    <input type="text" name="website" value="{{ $profile->website }}" placeholder="https://..." class="w-full rounded-xl border border-black/10 dark:border-white/10 bg-black/[0.02] dark:bg-surface/50 px-4 py-2.5 text-sm text-black dark:text-white outline-none focus:border-brand">
                </div>
                <div>
                    <label class="block text-xs uppercase text-black/55 dark:text-white/50 font-bold mb-1.5">Enlace Google Maps (GMB)</label>
                    <input type="text" name="google_maps_url" value="{{ $profile->google_maps_url }}" placeholder="https://maps.app.goo.gl/..." class="w-full rounded-xl border border-black/10 dark:border-white/10 bg-black/[0.02] dark:bg-surface/50 px-4 py-2.5 text-sm text-black dark:text-white outline-none focus:border-brand">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-xs uppercase text-black/55 dark:text-white/50 font-bold mb-1.5">Teléfono Fijo / Celular</label>
                    <input type="text" name="phone" value="{{ $profile->phone }}" required class="w-full rounded-xl border border-black/10 dark:border-white/10 bg-black/[0.02] dark:bg-surface/50 px-4 py-2.5 text-sm text-black dark:text-white outline-none focus:border-brand">
                </div>
                <div>
                    <label class="block text-xs uppercase text-black/55 dark:text-white/50 font-bold mb-1.5">WhatsApp (Internacional)</label>
                    <input type="text" name="whatsapp" value="{{ $profile->whatsapp }}" placeholder="e.g. 56912345678" class="w-full rounded-xl border border-black/10 dark:border-white/10 bg-black/[0.02] dark:bg-surface/50 px-4 py-2.5 text-sm text-black dark:text-white outline-none focus:border-brand">
                </div>
                <div>
                    <label class="block text-xs uppercase text-black/55 dark:text-white/50 font-bold mb-1.5">Instagram (Nombre de usuario)</label>
                    <input type="text" name="instagram" value="{{ $profile->instagram }}" placeholder="e.g. @highcontrastdc" class="w-full rounded-xl border border-black/10 dark:border-white/10 bg-black/[0.02] dark:bg-surface/50 px-4 py-2.5 text-sm text-black dark:text-white outline-none focus:border-brand">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-xs uppercase text-black/55 dark:text-white/50 font-bold mb-1.5">Dirección Línea 1</label>
                    <input type="text" name="address_line1" value="{{ $profile->address_line1 }}" required class="w-full rounded-xl border border-black/10 dark:border-white/10 bg-black/[0.02] dark:bg-surface/50 px-4 py-2.5 text-sm text-black dark:text-white outline-none focus:border-brand">
                </div>
                <div>
                    <label class="block text-xs uppercase text-black/55 dark:text-white/50 font-bold mb-1.5">Ciudad</label>
                    <input type="text" name="city" value="{{ $profile->city }}" required class="w-full rounded-xl border border-black/10 dark:border-white/10 bg-black/[0.02] dark:bg-surface/50 px-4 py-2.5 text-sm text-black dark:text-white outline-none focus:border-brand">
                </div>
                <div>
                    <label class="block text-xs uppercase text-black/55 dark:text-white/50 font-bold mb-1.5">Región</label>
                    <input type="text" name="region" value="{{ $profile->region }}" required class="w-full rounded-xl border border-black/10 dark:border-white/10 bg-black/[0.02] dark:bg-surface/50 px-4 py-2.5 text-sm text-black dark:text-white outline-none focus:border-brand">
                </div>
            </div>

            <h3 class="font-display font-bold text-lg text-black dark:text-white border-b border-black/5 dark:border-white/5 pt-4 pb-3">Políticas del Cotizador</h3>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-xs uppercase text-black/55 dark:text-white/50 font-bold mb-1.5" title="Hold time">Tiempo de Espera Pago (min)</label>
                    <input type="number" name="booking_hold_minutes" value="{{ $profile->booking_hold_minutes }}" required min="5" class="w-full rounded-xl border border-black/10 dark:border-white/10 bg-black/[0.02] dark:bg-surface/50 px-4 py-2.5 text-sm text-black dark:text-white outline-none focus:border-brand">
                    <p class="text-[10px] text-black/40 dark:text-white/30 mt-1">Tiempo que se congela la agenda mientras el cliente paga.</p>
                </div>
                <div>
                    <label class="block text-xs uppercase text-black/55 dark:text-white/50 font-bold mb-1.5">Anticipación Mínima (horas)</label>
                    <input type="number" name="lead_time_hours" value="{{ $profile->lead_time_hours }}" required min="0" class="w-full rounded-xl border border-black/10 dark:border-white/10 bg-black/[0.02] dark:bg-surface/50 px-4 py-2.5 text-sm text-black dark:text-white outline-none focus:border-brand">
                    <p class="text-[10px] text-black/40 dark:text-white/30 mt-1">Horas previas mínimas requeridas para agendar una cita.</p>
                </div>
                <div>
                    <label class="block text-xs uppercase text-black/55 dark:text-white/50 font-bold mb-1.5">Límite Agenda (días)</label>
                    <input type="number" name="max_advance_days" value="{{ $profile->max_advance_days }}" required min="1" class="w-full rounded-xl border border-black/10 dark:border-white/10 bg-black/[0.02] dark:bg-surface/50 px-4 py-2.5 text-sm text-black dark:text-white outline-none focus:border-brand">
                    <p class="text-[10px] text-black/40 dark:text-white/30 mt-1">Máximo de días hacia el futuro habilitados para agendar.</p>
                </div>
            </div>
        </div>

        <!-- TAB 2: HORARIOS DE ATENCION -->
        <div x-show="activeTab === 'horarios'" class="rounded-2xl border border-black/5 dark:border-white/5 bg-white dark:bg-surface/30 p-6 md:p-8 shadow-sm backdrop-blur-xl space-y-6" style="display: none;">
            <h3 class="font-display font-bold text-lg text-black dark:text-white border-b border-black/5 dark:border-white/5 pb-3">Horarios de Funcionamiento Semanal</h3>
            
            <div class="space-y-4">
                @php
                    $weekdaysSp = [
                        'MONDAY' => 'Lunes',
                        'TUESDAY' => 'Martes',
                        'WEDNESDAY' => 'Miércoles',
                        'THURSDAY' => 'Jueves',
                        'FRIDAY' => 'Viernes',
                        'SATURDAY' => 'Sábado',
                        'SUNDAY' => 'Domingo',
                    ];
                @endphp

                @foreach($businessHours as $hour)
                    @php
                        $openTime = $hour->open_minute_of_day !== null 
                            ? sprintf('%02d:%02d', floor($hour->open_minute_of_day / 60), $hour->open_minute_of_day % 60) 
                            : '09:00';
                        $closeTime = $hour->close_minute_of_day !== null 
                            ? sprintf('%02d:%02d', floor($hour->close_minute_of_day / 60), $hour->close_minute_of_day % 60) 
                            : '19:00';
                    @endphp

                    <div x-data="{ isClosed: {{ $hour->is_closed ? 'true' : 'false' }} }" 
                         class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 p-4 rounded-xl border border-black/5 dark:border-white/5 bg-black/[0.01] dark:bg-surface/10 select-none">
                        <div class="flex items-center gap-3 sm:w-1/4">
                            <input type="checkbox" name="hours[{{ $hour->weekday }}][is_closed]" value="1" x-model="isClosed" class="rounded border-black/10 dark:border-white/10 text-brand focus:ring-brand">
                            <span class="text-sm font-bold text-black dark:text-white">{{ $weekdaysSp[$hour->weekday] }}</span>
                        </div>
                        
                        <div class="flex items-center gap-3 flex-1 justify-end" x-show="!isClosed">
                            <span class="text-xs text-black/50 dark:text-white/40">Abre:</span>
                            <input type="time" name="hours[{{ $hour->weekday }}][open_time]" value="{{ $openTime }}" class="rounded-lg border border-black/10 dark:border-white/10 bg-white dark:bg-[#111111] px-3 py-1.5 text-xs text-black dark:text-white focus:border-brand outline-none">
                            
                            <span class="text-xs text-black/50 dark:text-white/40 ml-2">Cierra:</span>
                            <input type="time" name="hours[{{ $hour->weekday }}][close_time]" value="{{ $closeTime }}" class="rounded-lg border border-black/10 dark:border-white/10 bg-white dark:bg-[#111111] px-3 py-1.5 text-xs text-black dark:text-white focus:border-brand outline-none">
                        </div>
                        
                        <div class="flex items-center justify-end flex-1" x-show="isClosed">
                            <span class="text-xs font-semibold text-red-500 uppercase tracking-wider bg-red-500/10 px-3 py-1 rounded-full border border-red-500/10">Cerrado</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- TAB 3: CONFIGURACION SMTP -->
        <div x-show="activeTab === 'smtp'" class="space-y-6" style="display: none;">
            <div class="rounded-2xl border border-black/5 dark:border-white/5 bg-white dark:bg-surface/30 p-6 md:p-8 shadow-sm backdrop-blur-xl space-y-6">
                <div class="flex items-center justify-between border-b border-black/5 dark:border-white/5 pb-3">
                    <h3 class="font-display font-bold text-lg text-black dark:text-white">Servidor de Correos (SMTP)</h3>
                    
                    <label class="flex items-center gap-2 cursor-pointer select-none">
                        <input type="checkbox" name="smtp_enabled" value="1" {{ $profile->smtp_enabled ? 'checked' : '' }} class="rounded border-black/10 dark:border-white/10 text-brand focus:ring-brand">
                        <span class="text-xs font-bold uppercase tracking-wider text-black/75 dark:text-white/75">Activar Envíos</span>
                    </label>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="md:col-span-2">
                        <label class="block text-xs uppercase text-black/55 dark:text-white/50 font-bold mb-1.5">Host SMTP</label>
                        <input type="text" name="smtp_host" x-model="smtpForm.host" class="w-full rounded-xl border border-black/10 dark:border-white/10 bg-black/[0.02] dark:bg-surface/50 px-4 py-2.5 text-sm text-black dark:text-white outline-none focus:border-brand">
                    </div>
                    <div>
                        <label class="block text-xs uppercase text-black/55 dark:text-white/50 font-bold mb-1.5">Puerto SMTP</label>
                        <input type="number" name="smtp_port" x-model="smtpForm.port" class="w-full rounded-xl border border-black/10 dark:border-white/10 bg-black/[0.02] dark:bg-surface/50 px-4 py-2.5 text-sm text-black dark:text-white outline-none focus:border-brand">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs uppercase text-black/55 dark:text-white/50 font-bold mb-1.5">Usuario SMTP</label>
                        <input type="text" name="smtp_user" x-model="smtpForm.user" class="w-full rounded-xl border border-black/10 dark:border-white/10 bg-black/[0.02] dark:bg-surface/50 px-4 py-2.5 text-sm text-black dark:text-white outline-none focus:border-brand">
                    </div>
                    <div>
                        <label class="block text-xs uppercase text-black/55 dark:text-white/50 font-bold mb-1.5">Contraseña SMTP</label>
                        <input type="password" name="smtp_password" x-model="smtpForm.password" placeholder="{{ $profile->smtp_password ? '••••••••' : '' }}" class="w-full rounded-xl border border-black/10 dark:border-white/10 bg-black/[0.02] dark:bg-surface/50 px-4 py-2.5 text-sm text-black dark:text-white outline-none focus:border-brand">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs uppercase text-black/55 dark:text-white/50 font-bold mb-1.5">Nombre de Remitente</label>
                        <input type="text" name="smtp_from_name" x-model="smtpForm.fromName" class="w-full rounded-xl border border-black/10 dark:border-white/10 bg-black/[0.02] dark:bg-surface/50 px-4 py-2.5 text-sm text-black dark:text-white outline-none focus:border-brand">
                    </div>
                    <div>
                        <label class="block text-xs uppercase text-black/55 dark:text-white/50 font-bold mb-1.5">Correo de Remitente</label>
                        <input type="email" name="smtp_from_email" x-model="smtpForm.fromEmail" class="w-full rounded-xl border border-black/10 dark:border-white/10 bg-black/[0.02] dark:bg-surface/50 px-4 py-2.5 text-sm text-black dark:text-white outline-none focus:border-brand">
                    </div>
                </div>

                <label class="flex items-center gap-2 rounded-xl border border-black/5 dark:border-white/5 bg-black/[0.01] dark:bg-surface/20 p-3 select-none">
                    <input type="checkbox" name="smtp_secure" value="1" x-model="smtpForm.secure" class="rounded border-black/10 dark:border-white/10 text-brand focus:ring-brand">
                    <span class="text-sm font-medium text-black/80 dark:text-white/80">Conexión Segura SSL/TLS</span>
                </label>
            </div>

            <!-- TAB 3.2: GESTION DE PLANTILLAS -->
            <div class="rounded-2xl border border-black/5 dark:border-white/5 bg-white dark:bg-surface/30 p-6 md:p-8 shadow-sm backdrop-blur-xl space-y-6">
                <div class="border-b border-black/5 dark:border-white/5 pb-3">
                    <h3 class="font-display font-bold text-lg text-black dark:text-white">Plantillas de Notificaciones por Correo</h3>
                    <p class="text-xs text-black/50 dark:text-white/40 mt-1">Configura el diseño y textos de los correos electrónicos automáticos que reciben los clientes.</p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                    <!-- Sidebar: list of templates -->
                    <div class="lg:col-span-4 space-y-2">
                        <label class="block text-xs uppercase text-black/55 dark:text-white/50 font-bold mb-3">Selecciona una plantilla</label>
                        @foreach($templates as $tpl)
                            <button type="button" 
                                    @click="selectedTemplateKey = '{{ $tpl->key }}'" 
                                    :class="selectedTemplateKey === '{{ $tpl->key }}' ? 'border-brand bg-brand/5 text-brand dark:bg-brand/10' : 'border-black/5 dark:border-white/5 hover:bg-black/[0.02] dark:hover:bg-white/[0.02] text-black/75 dark:text-white/75'" 
                                    class="w-full text-left p-4 rounded-xl border flex items-center justify-between transition-all select-none">
                                <div class="flex flex-col">
                                    <span class="text-sm font-semibold">{{ $tpl->name }}</span>
                                    <span class="text-[10px] text-black/40 dark:text-white/40 mt-0.5">Clave: {{ $tpl->key }}</span>
                                </div>
                                <span class="h-2.5 w-2.5 rounded-full shadow-sm" :style="{ backgroundColor: templates['{{ $tpl->key }}'].badge_color }"></span>
                            </button>
                        @endforeach
                    </div>

                    <!-- Editor Panel -->
                    <div class="lg:col-span-8 space-y-6">
                        @foreach($templates as $tpl)
                            <div x-show="selectedTemplateKey === '{{ $tpl->key }}'" class="space-y-4" style="display: none;">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-xs uppercase text-black/55 dark:text-white/50 font-bold mb-1.5">Asunto del Correo</label>
                                        <input type="text" name="templates[{{ $tpl->key }}][subject]" x-model="templates['{{ $tpl->key }}'].subject" class="w-full rounded-xl border border-black/10 dark:border-white/10 bg-black/[0.02] dark:bg-surface/50 px-4 py-2.5 text-sm text-black dark:text-white outline-none focus:border-brand">
                                    </div>
                                    <div>
                                        <label class="block text-xs uppercase text-black/55 dark:text-white/50 font-bold mb-1.5">Título Interno</label>
                                        <input type="text" name="templates[{{ $tpl->key }}][title]" x-model="templates['{{ $tpl->key }}'].title" class="w-full rounded-xl border border-black/10 dark:border-white/10 bg-black/[0.02] dark:bg-surface/50 px-4 py-2.5 text-sm text-black dark:text-white outline-none focus:border-brand">
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-xs uppercase text-black/55 dark:text-white/50 font-bold mb-1.5">Texto del Estado (Badge)</label>
                                        <input type="text" name="templates[{{ $tpl->key }}][badge_text]" x-model="templates['{{ $tpl->key }}'].badge_text" class="w-full rounded-xl border border-black/10 dark:border-white/10 bg-black/[0.02] dark:bg-surface/50 px-4 py-2.5 text-sm text-black dark:text-white outline-none focus:border-brand">
                                    </div>
                                    <div>
                                        <label class="block text-xs uppercase text-black/55 dark:text-white/50 font-bold mb-1.5">Color del Estado</label>
                                        <div class="flex gap-2 items-center">
                                            <input type="color" x-model="templates['{{ $tpl->key }}'].badge_color" class="h-10 w-10 p-0.5 rounded-xl border border-black/10 dark:border-white/10 bg-transparent cursor-pointer">
                                            <input type="text" name="templates[{{ $tpl->key }}][badge_color]" x-model="templates['{{ $tpl->key }}'].badge_color" class="flex-1 rounded-xl border border-black/10 dark:border-white/10 bg-black/[0.02] dark:bg-surface/50 px-4 py-2.5 text-sm text-black dark:text-white outline-none focus:border-brand" placeholder="#22C55E">
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <div class="flex items-center justify-between mb-1.5">
                                        <label class="block text-xs uppercase text-black/55 dark:text-white/50 font-bold">Mensaje de Introducción (Cuerpo)</label>
                                        <span class="text-[10px] text-black/40 dark:text-white/40">Soporta saltos de línea</span>
                                    </div>
                                    <textarea name="templates[{{ $tpl->key }}][body_text]" x-model="templates['{{ $tpl->key }}'].body_text" rows="5" class="w-full rounded-xl border border-black/10 dark:border-white/10 bg-black/[0.02] dark:bg-surface/50 px-4 py-2.5 text-sm text-black dark:text-white outline-none focus:border-brand select-text"></textarea>
                                </div>
                            </div>
                        @endforeach

                        <!-- Placeholders quick tips -->
                        <div class="rounded-xl border border-black/5 dark:border-white/5 bg-black/[0.01] dark:bg-surface/10 p-4">
                            <h4 class="font-display font-semibold text-xs text-black/70 dark:text-white/70 uppercase tracking-wider mb-2">Variables Dinámicas Soportadas</h4>
                            <p class="text-xs text-black/50 dark:text-white/40 mb-3 leading-relaxed">Puedes hacer clic en cualquier variable para insertarla en la posición actual del cursor dentro del cuerpo del correo:</p>
                            <div class="flex flex-wrap gap-1.5">
                                <button type="button" @click="insertPlaceholder('{cliente_nombre}')" class="px-2.5 py-1 bg-white dark:bg-[#111] hover:bg-brand/5 hover:border-brand/30 border border-black/10 dark:border-white/10 rounded-lg text-[10px] font-mono text-brand transition-all font-semibold" title="Nombre completo del cliente">{cliente_nombre}</button>
                                <button type="button" @click="insertPlaceholder('{servicio_nombre}')" class="px-2.5 py-1 bg-white dark:bg-[#111] hover:bg-brand/5 hover:border-brand/30 border border-black/10 dark:border-white/10 rounded-lg text-[10px] font-mono text-brand transition-all font-semibold" title="Nombre del servicio cotizado">{servicio_nombre}</button>
                                <button type="button" @click="insertPlaceholder('{fecha_hora}')" class="px-2.5 py-1 bg-white dark:bg-[#111] hover:bg-brand/5 hover:border-brand/30 border border-black/10 dark:border-white/10 rounded-lg text-[10px] font-mono text-brand transition-all font-semibold" title="Fecha y hora formateadas">{fecha_hora}</button>
                                <button type="button" @click="insertPlaceholder('{vehiculo_detalle}')" class="px-2.5 py-1 bg-white dark:bg-[#111] hover:bg-brand/5 hover:border-brand/30 border border-black/10 dark:border-white/10 rounded-lg text-[10px] font-mono text-brand transition-all font-semibold" title="Detalles del vehículo">{vehiculo_detalle}</button>
                                <button type="button" @click="insertPlaceholder('{patente}')" class="px-2.5 py-1 bg-white dark:bg-[#111] hover:bg-brand/5 hover:border-brand/30 border border-black/10 dark:border-white/10 rounded-lg text-[10px] font-mono text-brand transition-all font-semibold" title="Patente">{patente}</button>
                                <button type="button" @click="insertPlaceholder('{monto_total}')" class="px-2.5 py-1 bg-white dark:bg-[#111] hover:bg-brand/5 hover:border-brand/30 border border-black/10 dark:border-white/10 rounded-lg text-[10px] font-mono text-brand transition-all font-semibold" title="Monto total del servicio">{monto_total}</button>
                                <button type="button" @click="insertPlaceholder('{link_reserva}')" class="px-2.5 py-1 bg-white dark:bg-[#111] hover:bg-brand/5 hover:border-brand/30 border border-black/10 dark:border-white/10 rounded-lg text-[10px] font-mono text-brand transition-all font-semibold" title="Enlace de seguimiento">{link_reserva}</button>
                                <button type="button" @click="insertPlaceholder('{notas}')" class="px-2.5 py-1 bg-white dark:bg-[#111] hover:bg-brand/5 hover:border-brand/30 border border-black/10 dark:border-white/10 rounded-lg text-[10px] font-mono text-brand transition-all font-semibold" title="Notas del cliente">{notas}</button>
                                <button type="button" @click="insertPlaceholder('{motivo_cancelacion}')" class="px-2.5 py-1 bg-white dark:bg-[#111] hover:bg-brand/5 hover:border-brand/30 border border-black/10 dark:border-white/10 rounded-lg text-[10px] font-mono text-brand transition-all font-semibold" title="Motivo de cancelación (solo cancelados)">{motivo_cancelacion}</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Live Premium Email Preview Panel -->
                <div class="border-t border-black/5 dark:border-white/5 pt-6 space-y-4">
                    <div class="flex items-center gap-2">
                        <span class="flex h-2.5 w-2.5 relative">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-brand opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-brand"></span>
                        </span>
                        <h4 class="font-display font-bold text-sm text-black dark:text-white">Vista Previa de Correo en Tiempo Real</h4>
                    </div>
                    
                    <div class="w-full max-w-2xl mx-auto rounded-2xl border border-black/5 dark:border-white/10 bg-[#080808] overflow-hidden shadow-2xl">
                        <!-- Top Bar Mockup -->
                        <div class="flex items-center gap-2 px-4 py-3 border-b border-white/5 bg-black/60 text-xs text-white/40 font-mono">
                            <div class="flex gap-1.5">
                                <span class="h-2.5 w-2.5 rounded-full bg-red-500/60"></span>
                                <span class="h-2.5 w-2.5 rounded-full bg-yellow-500/60"></span>
                                <span class="h-2.5 w-2.5 rounded-full bg-green-500/60"></span>
                            </div>
                            <span class="flex-1 text-center truncate">Asunto: <span class="text-white/80 font-sans font-semibold" x-text="getPreviewText(templates[selectedTemplateKey].subject)"></span></span>
                        </div>
                        
                        <!-- Email Container -->
                        <div class="m-3 md:m-5 rounded-xl border border-white/[0.06] bg-[#111111] overflow-hidden">
                            <!-- Header with gradient -->
                            <div class="bg-gradient-to-br from-brand to-brand-dark p-7 text-center">
                                @if($profile->logo)
                                    <div class="mb-3.5 inline-block bg-white/[0.15] rounded-xl p-2.5 border border-white/20">
                                        <img src="{{ asset($profile->logo) }}" alt="Logo" class="h-10 w-auto block rounded-lg">
                                    </div>
                                    <p class="text-white/90 text-base font-semibold tracking-tight m-0" x-text="smtpForm.fromName || '{{ $profile->business_name }}'"></p>
                                @else
                                    <p class="text-white text-xl font-bold tracking-tight m-0" x-text="smtpForm.fromName || '{{ $profile->business_name }}'"></p>
                                @endif
                            </div>

                            <!-- Accent Line -->
                            <div class="h-[3px] bg-gradient-to-r from-brand via-yellow-400 via-green-400 to-blue-400"></div>

                            <!-- Body -->
                            <div class="p-6 md:p-8 space-y-5 text-neutral-200">
                                <!-- Badge -->
                                <div class="text-center">
                                    <span class="inline-block text-[10px] uppercase tracking-widest font-bold px-4 py-1.5 rounded-full border transition-all" 
                                          :style="{ borderColor: templates[selectedTemplateKey].badge_color, color: templates[selectedTemplateKey].badge_color, backgroundColor: templates[selectedTemplateKey].badge_color + '08' }"
                                          x-text="templates[selectedTemplateKey].badge_text">
                                    </span>
                                </div>

                                <!-- Title -->
                                <h2 class="text-center text-lg font-bold text-white tracking-tight" x-text="getPreviewText(templates[selectedTemplateKey].title)"></h2>

                                <!-- Body text -->
                                <div class="text-sm leading-relaxed text-neutral-400 font-sans">
                                    <p>Hola <strong class="text-neutral-200">Juan Pérez</strong>,</p>
                                    <p class="mt-2 whitespace-pre-line" x-html="getPreviewText(templates[selectedTemplateKey].body_text)"></p>
                                </div>

                                <!-- Summary Card -->
                                <div class="rounded-xl border border-white/[0.06] bg-[#0D0D0D] overflow-hidden">
                                    <h3 class="text-[10px] uppercase tracking-widest font-bold text-neutral-500 px-5 py-3 border-b border-white/[0.04] m-0">Resumen de la Cita</h3>
                                    
                                    <!-- Service -->
                                    <div class="flex items-start gap-3 px-5 py-3 border-b border-white/[0.03]">
                                        <svg class="w-4 h-4 text-brand flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                                        <div>
                                            <span class="block text-[9px] uppercase font-bold text-neutral-600 tracking-wider">Servicio</span>
                                            <span class="text-xs text-neutral-200 font-semibold">Lavado Avanzado</span>
                                        </div>
                                    </div>

                                    <!-- Vehicle -->
                                    <div class="flex items-start gap-3 px-5 py-3 border-b border-white/[0.03]">
                                        <svg class="w-4 h-4 text-brand flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 17h2m10 0h2M3 11l2-6h14l2 6M3 11v6h18v-6M3 11h18"/><circle cx="7" cy="17" r="2"/><circle cx="17" cy="17" r="2"/></svg>
                                        <div>
                                            <span class="block text-[9px] uppercase font-bold text-neutral-600 tracking-wider">Vehículo</span>
                                            <span class="text-xs text-neutral-200 font-semibold">Tesla Model 3 (SUV) — <strong class="text-white">ABCD-12</strong></span>
                                        </div>
                                    </div>

                                    <!-- Date -->
                                    <div class="flex items-start gap-3 px-5 py-3 border-b border-white/[0.03]">
                                        <svg class="w-4 h-4 text-brand flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                                        <div>
                                            <span class="block text-[9px] uppercase font-bold text-neutral-600 tracking-wider">Fecha y Hora</span>
                                            <span class="text-xs text-brand font-semibold">Viernes, 26 de Junio de 2026, 10:00 hrs</span>
                                        </div>
                                    </div>

                                    <!-- Total -->
                                    <div class="flex items-start gap-3 px-5 py-3.5 bg-brand/[0.03]">
                                        <svg class="w-4 h-4 text-brand flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                                        <div>
                                            <span class="block text-[9px] uppercase font-bold text-neutral-600 tracking-wider">Total</span>
                                            <span class="text-base text-white font-extrabold">$45.000</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- CTA -->
                                <div class="text-center py-1">
                                    <a href="#" onclick="return false;" class="inline-block px-7 py-2.5 bg-gradient-to-r from-brand to-brand-dark text-white text-xs font-bold rounded-xl shadow-lg shadow-brand/20 transition-all select-none">
                                        Ver Detalles de tu Reserva &rarr;
                                    </a>
                                </div>
                            </div>

                            <!-- Footer -->
                            <div class="px-6 py-5 bg-[#080808] border-t border-white/[0.04] text-[10px] text-white/30 text-center leading-relaxed">
                                <p class="font-bold text-white/50 text-[11px]" x-text="smtpForm.fromName || '{{ $profile->business_name }}'"></p>
                                <p class="mt-1">{{ $profile->address_line1 }}, {{ $profile->city }}</p>
                                <p>Tel: {{ $profile->phone }} @if($profile->whatsapp) | <span class="text-green-400/70 font-semibold">WhatsApp</span> @endif</p>
                                <div class="w-8 h-px bg-white/10 mx-auto my-3"></div>
                                <p class="text-white/15">&copy; {{ date('Y') }} Todos los derechos reservados.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SMTP Tester block -->
            <div class="rounded-2xl border border-black/5 dark:border-white/5 bg-white dark:bg-surface/30 p-6 md:p-8 shadow-sm backdrop-blur-xl space-y-4">
                <h4 class="font-display font-bold text-sm text-black dark:text-white">Probar Configuración SMTP</h4>
                <p class="text-xs text-black/50 dark:text-white/40">Ingresa un correo electrónico para verificar que el servidor SMTP funcione correctamente antes de guardar.</p>
                
                <div class="flex flex-col sm:flex-row gap-3">
                    <input type="email" x-model="testEmail" placeholder="correo-destinatario@example.com" class="flex-1 rounded-xl border border-black/10 dark:border-white/10 bg-black/[0.02] dark:bg-surface/50 px-4 py-2.5 text-sm text-black dark:text-white outline-none focus:border-brand">
                    <button type="button" @click="runSmtpTest()" :disabled="isTestingSmtp" class="rounded-xl border border-brand/20 bg-brand/10 hover:bg-brand/20 text-brand px-6 py-2.5 text-sm font-semibold shadow-sm transition-all disabled:opacity-50">
                        <span x-show="!isTestingSmtp">Enviar Correo Prueba</span>
                        <span x-show="isTestingSmtp">Probando...</span>
                    </button>
                </div>

                <div x-show="testResult" 
                     :class="testResult && testResult.status === 'success' ? 'border-green-500/20 bg-green-500/5 text-green-600 dark:text-green-400' : 'border-red-500/20 bg-red-500/5 text-red-500'" 
                     class="rounded-xl border p-4 text-xs font-semibold leading-relaxed" 
                     style="display: none;" 
                     x-text="testResult ? testResult.message : ''">
                </div>
            </div>
        </div>

        <!-- TAB 4: SEO & ANALITICA -->
        <div x-show="activeTab === 'seo'" class="rounded-2xl border border-black/5 dark:border-white/5 bg-white dark:bg-surface/30 p-6 md:p-8 shadow-sm backdrop-blur-xl space-y-6" style="display: none;">
            <h3 class="font-display font-bold text-lg text-black dark:text-white border-b border-black/5 dark:border-white/5 pb-3">SEO y Códigos de Seguimiento</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs uppercase text-black/55 dark:text-white/50 font-bold mb-1.5">ID de Google Analytics (GA4)</label>
                    <input type="text" name="google_analytics_id" value="{{ $profile->google_analytics_id }}" placeholder="e.g. G-XXXXXXXXXX" class="w-full rounded-xl border border-black/10 dark:border-white/10 bg-black/[0.02] dark:bg-surface/50 px-4 py-2.5 text-sm text-black dark:text-white outline-none focus:border-brand">
                </div>
                <div>
                    <label class="block text-xs uppercase text-black/55 dark:text-white/50 font-bold mb-1.5">ID de Google Tag Manager (GTM)</label>
                    <input type="text" name="google_tag_manager_id" value="{{ $profile->google_tag_manager_id }}" placeholder="e.g. GTM-XXXXXXX" class="w-full rounded-xl border border-black/10 dark:border-white/10 bg-black/[0.02] dark:bg-surface/50 px-4 py-2.5 text-sm text-black dark:text-white outline-none focus:border-brand">
                </div>
            </div>

            <div class="space-y-4">
                <div>
                    <label class="block text-xs uppercase text-black/55 dark:text-white/50 font-bold mb-1.5">Scripts Personalizados en Cabecera (&lt;head&gt;)</label>
                    <textarea name="header_scripts" rows="5" placeholder="<!-- Introduce tus scripts aquí (Analytics, Meta Verification, Facebook Pixel, etc.) -->" class="w-full rounded-xl border border-black/10 dark:border-white/10 bg-black/[0.02] dark:bg-surface/50 px-4 py-2.5 text-sm text-black dark:text-white outline-none focus:border-brand font-mono">{{ $profile->header_scripts }}</textarea>
                    <p class="text-[10px] text-black/40 dark:text-white/30 mt-1">Estos scripts se inyectarán directamente antes del cierre de la etiqueta &lt;/head&gt;.</p>
                </div>
                <div>
                    <label class="block text-xs uppercase text-black/55 dark:text-white/50 font-bold mb-1.5">Scripts Personalizados en Pie de Página (&lt;body&gt;)</label>
                    <textarea name="footer_scripts" rows="5" placeholder="<!-- Introduce tus scripts aquí (Chat widgets, GTM noscript, etc.) -->" class="w-full rounded-xl border border-black/10 dark:border-white/10 bg-black/[0.02] dark:bg-surface/50 px-4 py-2.5 text-sm text-black dark:text-white outline-none focus:border-brand font-mono">{{ $profile->footer_scripts }}</textarea>
                    <p class="text-[10px] text-black/40 dark:text-white/30 mt-1">Estos scripts se inyectarán antes del cierre de la etiqueta &lt;/body&gt;.</p>
                </div>
            </div>
        </div>

        <!-- Sticky submit button bar -->
        <div class="pt-4 border-t border-black/5 dark:border-white/5 text-right">
            <button type="submit" class="rounded-xl bg-brand hover:bg-brand-dark text-white px-8 py-3 text-sm font-semibold shadow-md transition-all">
                Guardar Cambios
            </button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
function shopSettings() {
    return {
        activeTab: 'perfil',
        testEmail: '',
        isTestingSmtp: false,
        testResult: null,

        // SMTP Form values for local test ajax
        smtpForm: {
            host: '{{ $profile->smtp_host }}',
            port: '{{ $profile->smtp_port }}',
            user: '{{ $profile->smtp_user }}',
            password: '{{ $profile->smtp_password ? "____STORED_SECRET____" : "" }}',
            fromName: '{{ $profile->smtp_from_name }}',
            fromEmail: '{{ $profile->smtp_from_email }}',
            secure: {{ $profile->smtp_secure ? 'true' : 'false' }},
        },

        selectedTemplateKey: 'CONFIRMED',
        templates: {
            @foreach($templates as $tpl)
            '{{ $tpl->key }}': {
                id: {{ $tpl->id }},
                name: '{{ addslashes($tpl->name) }}',
                subject: '{{ addslashes($tpl->subject) }}',
                title: '{{ addslashes($tpl->title) }}',
                body_text: `{!! str_replace('`','\\`',$tpl->body_text) !!}`,
                badge_text: '{{ addslashes($tpl->badge_text) }}',
                badge_color: '{{ addslashes($tpl->badge_color) }}',
            },
            @endforeach
        },

        insertPlaceholder(placeholder) {
            const textareaEl = document.querySelector(`textarea[name="templates[${this.selectedTemplateKey}][body_text]"]`);
            if (textareaEl) {
                const start = textareaEl.selectionStart;
                const end = textareaEl.selectionEnd;
                const text = this.templates[this.selectedTemplateKey].body_text;
                this.templates[this.selectedTemplateKey].body_text = text.substring(0, start) + placeholder + text.substring(end);
                setTimeout(() => {
                    textareaEl.focus();
                    textareaEl.selectionStart = textareaEl.selectionEnd = start + placeholder.length;
                }, 10);
            } else {
                this.templates[this.selectedTemplateKey].body_text += placeholder;
            }
        },

        getPreviewText(text) {
            if (!text) return '';
            let preview = text;
            const replacements = {
                '{cliente_nombre}': 'Juan Pérez',
                '{servicio_nombre}': 'Lavado Avanzado',
                '{fecha_hora}': 'Viernes, 26 de Junio de 2026, 10:00 hrs',
                '{vehiculo_detalle}': 'Tesla Model 3 (SUV / Sedán)',
                '{patente}': 'ABCD-12',
                '{monto_total}': '$45.000',
                '{link_reserva}': '#',
                '{notas}': 'Por favor, tener especial cuidado con las llantas.',
                '{motivo_cancelacion}': 'Superposición horaria con mantención de bahía.'
            };
            for (const [placeholder, val] of Object.entries(replacements)) {
                preview = preview.split(placeholder).join(val);
            }
            return preview.replace(/[\u00A0-\u9999<>&]/gim, function(i) {
                if (i === '<' || i === '>') return i;
                return '&#'+i.charCodeAt(0)+';';
            }).replace(/\n/g, '<br>');
        },

        runSmtpTest() {
            if (!this.testEmail) {
                this.testResult = { status: 'error', message: 'Ingresa un correo electrónico para realizar la prueba.' };
                return;
            }

            this.isTestingSmtp = true;
            this.testResult = null;

            const payload = {
                test_email: this.testEmail,
                host: this.smtpForm.host,
                port: this.smtpForm.port,
                user: this.smtpForm.user,
                password: this.smtpForm.password,
                fromName: this.smtpForm.fromName,
                fromEmail: this.smtpForm.fromEmail,
                secure: this.smtpForm.secure ? 1 : 0,
            };

            fetch('/api/admin/configuracion/test-smtp', {
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
                    throw new Error(data.message || 'Error desconocido del servidor SMTP.');
                }
                this.testResult = { status: 'success', message: data.message };
            })
            .catch(err => {
                this.testResult = { status: 'error', message: err.message };
            })
            .finally(() => {
                this.isTestingSmtp = false;
            });
        }
    };
}
</script>
@endsection
