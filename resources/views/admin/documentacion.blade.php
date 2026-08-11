@extends('layouts.admin')

@section('title', 'Wiki de Operación | High Contrast Detailing')
@section('title_section', 'Wiki del Sistema')

@section('content')
<!-- Top Banner -->
<div class="mb-6 p-6 rounded-3xl border border-black/5 dark:border-white/5 bg-gradient-to-r from-brand/10 via-transparent to-transparent">
    <h2 class="font-display font-black text-xl md:text-2xl text-black dark:text-white mb-1">Manual & Centro de Ayuda</h2>
    <p class="text-black/60 dark:text-white/40 text-xs max-w-2xl leading-relaxed">
        Busca guías detalladas sobre el funcionamiento de las reservas, catálogo de servicios, vehículos, pasarelas de pago y seguridad.
    </p>
</div>

<!-- Main Split Container (Responsive) -->
<div class="flex flex-col gap-6 w-full animate-fade-in"
     x-data="{ 
         activeArticle: 'reservas',
         articles: [
             { id: 'reservas', title: '1. Gestión de Agenda y Citas', category: 'Agenda', readTime: '3 min' },
             { id: 'servicios', title: '2. Catálogo de Servicios', category: 'Servicios', readTime: '3 min' },
             { id: 'vehiculos', title: '3. Categorías de Vehículos', category: 'Vehículos', readTime: '2 min' },
             { id: 'extras', title: '4. Extras y Adicionales', category: 'Extras', readTime: '2 min' },
             { id: 'pasarelas', title: '5. Mercado Pago y Precios', category: 'Pagos', readTime: '5 min' },
             { id: 'smtp', title: '6. SMTP y Notificaciones', category: 'Emails', readTime: '3 min' },
             { id: 'waf', title: '7. Seguridad WAF y Bloqueos', category: 'Seguridad', readTime: '4 min' },
             { id: 'contenido', title: '8. Carrusel Hero y Logo', category: 'Contenido', readTime: '2 min' }
         ]
     }">
     
    <!-- Top Horizontal Tabs -->
    <div class="w-full overflow-x-auto hide-scrollbar pb-2">
        <nav class="flex gap-2 w-max min-w-full px-1">
            <template x-for="art in articles" :key="art.id">
                <button @click="activeArticle = art.id"
                        :class="activeArticle === art.id ? 'bg-brand text-white shadow-md shadow-brand/20' : 'bg-white dark:bg-surface/30 text-black/60 dark:text-white/60 hover:bg-black/5 dark:hover:bg-white/5 border border-black/5 dark:border-white/5'"
                        class="px-5 py-2.5 rounded-full text-xs font-bold transition-all whitespace-nowrap flex items-center gap-2">
                    <span x-text="art.title"></span>
                </button>
            </template>
        </nav>
    </div>

    <!-- Main Content Area -->
    <main class="w-full rounded-3xl border border-black/5 dark:border-white/5 bg-white dark:bg-surface/30 p-6 md:p-8 shadow-lg backdrop-blur-xl">
        
        <!-- ARTICLE: RESERVAS -->
        <div x-show="activeArticle === 'reservas'" class="space-y-4">
            <!-- Breadcrumbs -->
            <div class="flex items-center gap-1 text-[9px] uppercase font-bold text-black/40 dark:text-white/30 tracking-wider">
                <span>Wiki</span>
                <span>/</span>
                <span>Agenda</span>
                <span>/</span>
                <span class="text-brand">Reservas</span>
            </div>

            <div class="border-b border-black/5 dark:border-white/5 pb-3">
                <h1 class="font-display font-black text-xl md:text-2xl text-black dark:text-white mb-1">1. Gestión de Agenda y Citas</h1>
                <div class="flex items-center gap-2 text-[10px] text-black/40 dark:text-white/40">
                    <span>Categoría: Agenda</span>
                    <span>•</span>
                    <span class="text-green-500 font-semibold">ACTIVO</span>
                </div>
            </div>

            <div class="text-xs text-black/80 dark:text-white/80 space-y-4 leading-relaxed">
                <p>
                    La sección <strong>Calendario</strong> es la herramienta central para controlar el flujo diario de trabajo. Muestra las citas confirmadas o pendientes en sus respectivos bloques horarios.
                </p>
                <h3 class="font-display font-bold text-xs text-brand uppercase tracking-wider">1.1 Detalles de Reservas</h3>
                <p>
                    Al hacer clic en cualquier cita dentro del calendario se despliega información completa:
                </p>
                <ul class="list-disc pl-4 space-y-1.5">
                    <li><strong>Cliente:</strong> Nombre, email y un enlace rápido para chatear directamente por WhatsApp.</li>
                    <li><strong>Vehículo:</strong> Patente, marca y modelo seleccionados.</li>
                    <li><strong>Monto y Pago:</strong> Detalle financiero del servicio contratado.</li>
                </ul>

                <h3 class="font-display font-bold text-xs text-brand uppercase tracking-wider">1.2 Bloqueo de Horarios (Mantención o Feriados)</h3>
                <p>
                    Usa el botón <strong>"Bloquear Horario"</strong> para cerrar preventivamente una bahía de trabajo en fechas específicas (por ejemplo, feriados o mantenimiento). Esto impide automáticamente que clientes hagan agendamientos online en esas horas sin alterar el catálogo de servicios.
                </p>
            </div>

            <div class="text-xs text-black/80 dark:text-white/80 space-y-4 leading-relaxed mt-6">
                <h3 class="font-display font-bold text-xs text-brand uppercase tracking-wider">1.3 Autoadministración de Citas</h3>
                <p>
                    Desde la pestaña <strong>Citas</strong>, puedes hacer clic en <strong>"Administrar"</strong> en cada reserva para cambiar sus estados rápidamente:
                </p>
                <ul class="list-disc pl-4 space-y-2">
                    <li><strong>Estado de la Cita:</strong> 
                        <span class="text-black/60 dark:text-white/60">Permite marcar la reserva como Confirmada, En Progreso, Completada o Cancelada.</span>
                    </li>
                    <li><strong>Estado del Pago:</strong> 
                        <span class="text-black/60 dark:text-white/60">Controla si el servicio está Pendiente o Pagado (útil para transferencias o efectivo).</span>
                    </li>
                    <li><strong>Notificar al Cliente:</strong> 
                        <span class="text-black/60 dark:text-white/60">Si marcas la casilla, al cambiar el estado a Confirmada o Cancelada, el sistema disparará un correo automático formal al cliente. Si la dejas desmarcada, el cambio es silencioso (solo para tu control interno).</span>
                    </li>
                    <li><strong>Eliminar Cita:</strong> 
                        <span class="text-black/60 dark:text-white/60">Borra la reserva permanentemente y libera ese bloque horario.</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- ARTICLE: SERVICIOS -->
        <div x-show="activeArticle === 'servicios'" class="space-y-4" x-cloak>
            <!-- Breadcrumbs -->
            <div class="flex items-center gap-1 text-[9px] uppercase font-bold text-black/40 dark:text-white/30 tracking-wider">
                <span>Wiki</span>
                <span>/</span>
                <span>Catálogo</span>
                <span>/</span>
                <span class="text-brand">Servicios</span>
            </div>

            <div class="border-b border-black/5 dark:border-white/5 pb-3">
                <h1 class="font-display font-black text-xl md:text-2xl text-black dark:text-white mb-1">2. Catálogo de Servicios</h1>
                <div class="flex items-center gap-2 text-[10px] text-black/40 dark:text-white/40">
                    <span>Categoría: Servicios</span>
                    <span>•</span>
                    <span class="text-brand font-semibold">PRECIO BASE</span>
                </div>
            </div>

            <div class="text-xs text-black/80 dark:text-white/80 space-y-4 leading-relaxed">
                <p>
                    El catálogo contiene tus programas de detallado (Lavado Premium, Detailing Interior, Sellado Cerámico, etc.).
                </p>
                <h3 class="font-display font-bold text-xs text-brand uppercase tracking-wider">2.1 Campos Requeridos al Crear/Editar</h3>
                <ul class="list-disc pl-4 space-y-1">
                    <li><strong>Nombre del Servicio:</strong> Nombre descriptivo público.</li>
                    <li><strong>Precio Base:</strong> Tarifa mínima establecida para el servicio.</li>
                    <li><strong>Duración en minutos:</strong> Define el bloque horario que ocupará en el calendario.</li>
                    <li><strong>Estado Activo:</strong> Si se desmarca, se oculta inmediatamente del cotizador.</li>
                </ul>
            </div>
        </div>

        <!-- ARTICLE: VEHICULOS -->
        <div x-show="activeArticle === 'vehiculos'" class="space-y-4" x-cloak>
            <!-- Breadcrumbs -->
            <div class="flex items-center gap-1 text-[9px] uppercase font-bold text-black/40 dark:text-white/30 tracking-wider">
                <span>Wiki</span>
                <span>/</span>
                <span>Catálogo</span>
                <span>/</span>
                <span class="text-brand">Vehículos</span>
            </div>

            <div class="border-b border-black/5 dark:border-white/5 pb-3">
                <h1 class="font-display font-black text-xl md:text-2xl text-black dark:text-white mb-1">3. Categorías de Vehículos</h1>
                <div class="flex items-center gap-2 text-[10px] text-black/40 dark:text-white/40">
                    <span>Categoría: Vehículos</span>
                    <span>•</span>
                    <span class="text-brand font-semibold">CARROCERÍAS</span>
                </div>
            </div>

            <div class="text-xs text-black/80 dark:text-white/80 space-y-4 leading-relaxed">
                <p>
                    La sección de **Vehículos** sirve para configurar los diferentes tipos de carrocería disponibles en el cotizador (ej: Sedán, Hatchback, SUV, Camioneta, Deportivo, Moto).
                </p>
                
                <h3 class="font-display font-bold text-xs text-brand uppercase tracking-wider">3.1 Configuración</h3>
                <ul class="list-disc pl-4 space-y-1.5">
                    <li><strong>Nombre del Tipo:</strong> Identificación del grupo de vehículos.</li>
                    <li><strong>Estado:</strong> Define si la categoría se encuentra habilitada para ser seleccionada por el cliente durante el proceso de reserva.</li>
                    <li><strong>display_order:</strong> Determina el orden visual de aparición en la lista desplegable que ve el usuario.</li>
                </ul>
            </div>
        </div>

        <!-- ARTICLE: EXTRAS -->
        <div x-show="activeArticle === 'extras'" class="space-y-4" x-cloak>
            <!-- Breadcrumbs -->
            <div class="flex items-center gap-1 text-[9px] uppercase font-bold text-black/40 dark:text-white/30 tracking-wider">
                <span>Wiki</span>
                <span>/</span>
                <span>Catálogo</span>
                <span>/</span>
                <span class="text-brand">Extras</span>
            </div>

            <div class="border-b border-black/5 dark:border-white/5 pb-3">
                <h1 class="font-display font-black text-xl md:text-2xl text-black dark:text-white mb-1">4. Extras y Adicionales</h1>
                <div class="flex items-center gap-2 text-[10px] text-black/40 dark:text-white/40">
                    <span>Categoría: Extras</span>
                    <span>•</span>
                    <span class="text-brand font-semibold">ADITIVOS</span>
                </div>
            </div>

            <div class="text-xs text-black/80 dark:text-white/80 space-y-4 leading-relaxed">
                <p>
                    Los **Extras** son servicios opcionales complementarios (limpieza de motor, detallado de llantas, sanitizado premium de aire acondicionado).
                </p>
                <h3 class="font-display font-bold text-xs text-brand uppercase tracking-wider">4.1 Costo y Tiempo fijo</h3>
                <p>
                    Los extras tienen un costo y tiempo fijo especificados que se suman al total de la reserva cuando el cliente los selecciona.
                </p>
            </div>
        </div>

        <!-- ARTICLE: PAGOS -->
        <div x-show="activeArticle === 'pasarelas'" class="space-y-4" x-cloak>
            <!-- Breadcrumbs -->
            <div class="flex items-center gap-1 text-[9px] uppercase font-bold text-black/40 dark:text-white/30 tracking-wider">
                <span>Wiki</span>
                <span>/</span>
                <span>Configuración</span>
                <span>/</span>
                <span class="text-brand">Mercado Pago</span>
            </div>

            <div class="border-b border-black/5 dark:border-white/5 pb-3">
                <h1 class="font-display font-black text-xl md:text-2xl text-black dark:text-white mb-1">5. Mercado Pago y Precios</h1>
                <div class="flex items-center gap-2 text-[10px] text-black/40 dark:text-white/40">
                    <span>Categoría: Pagos</span>
                    <span>•</span>
                    <span class="text-red-500 font-semibold">CONFIGURACIÓN</span>
                </div>
            </div>

            <div class="text-xs text-black/80 dark:text-white/80 space-y-4 leading-relaxed">
                <p>
                    Configura la pasarela oficial para recibir pagos automatizados mediante Mercado Pago (Webpay/Redcompra en Chile).
                </p>

                <h3 class="font-display font-bold text-xs text-brand uppercase tracking-wider">5.1 Obtener Credenciales API</h3>
                <p>
                    Crea tu aplicación en el portal de <a href="https://developers.mercadopago.com" target="_blank" class="text-brand font-bold hover:underline">Mercado Pago Developers</a> para conseguir los tokens necesarios:
                </p>
                <ul class="list-disc pl-4 space-y-1">
                    <li><strong>Public Key:</strong> Llave pública utilizada en el checkout de la página web.</li>
                    <li><strong>Access Token:</strong> Llave privada de seguridad para procesar transacciones.</li>
                </ul>

                <h3 class="font-display font-bold text-xs text-brand uppercase tracking-wider">5.2 Toggle "Mostrar Precios"</h3>
                <p>
                    Si desactivas los cobros online (porque prefieres agendar y recibir transferencias manualmente), puedes activar el toggle **Mostrar Precios (Precios ON)**. Esto mantendrá los precios visibles en el home y catálogo en vez de mostrar el texto "Solicitar Cotización".
                </p>
            </div>
        </div>

        <!-- ARTICLE: SMTP -->
        <div x-show="activeArticle === 'smtp'" class="space-y-4" x-cloak>
            <!-- Breadcrumbs -->
            <div class="flex items-center gap-1 text-[9px] uppercase font-bold text-black/40 dark:text-white/30 tracking-wider">
                <span>Wiki</span>
                <span>/</span>
                <span>Notificaciones</span>
                <span>/</span>
                <span class="text-brand">SMTP</span>
            </div>

            <div class="border-b border-black/5 dark:border-white/5 pb-3">
                <h1 class="font-display font-black text-xl md:text-2xl text-black dark:text-white mb-1">6. SMTP y Notificaciones</h1>
                <div class="flex items-center gap-2 text-[10px] text-black/40 dark:text-white/40">
                    <span>Categoría: Emails</span>
                    <span>•</span>
                    <span class="text-brand font-semibold">NOTIFICACIONES</span>
                </div>
            </div>

            <div class="text-xs text-black/80 dark:text-white/80 space-y-4 leading-relaxed">
                <p>
                    El sistema despacha correos automáticos (confirmación de reserva, reprogramaciones, recordatorios) mediante SMTP.
                </p>
                <h3 class="font-display font-bold text-xs text-brand uppercase tracking-wider">6.1 Servidor de Salida (cPanel)</h3>
                <p>
                    Usa los datos de tu hosting web para configurar:
                </p>
                <ul class="list-disc pl-4 space-y-1">
                    <li><strong>Host:</strong> `mail.tudominio.cl` o `smtp.tudominio.cl`.</li>
                    <li><strong>Puerto:</strong> `465` (con encriptación segura SSL activa).</li>
                    <li><strong>Usuario/Clave:</strong> Tu casilla de correo corporativa (ej. `agenda@tudominio.cl`).</li>
                </ul>
            </div>
        </div>

        <!-- ARTICLE: WAF -->
        <div x-show="activeArticle === 'waf'" class="space-y-4" x-cloak>
            <!-- Breadcrumbs -->
            <div class="flex items-center gap-1 text-[9px] uppercase font-bold text-black/40 dark:text-white/30 tracking-wider">
                <span>Wiki</span>
                <span>/</span>
                <span>Seguridad</span>
                <span>/</span>
                <span class="text-brand">Firewall</span>
            </div>

            <div class="border-b border-black/5 dark:border-white/5 pb-3">
                <h1 class="font-display font-black text-xl md:text-2xl text-black dark:text-white mb-1">7. Seguridad WAF y Bloqueos</h1>
                <div class="flex items-center gap-2 text-[10px] text-black/40 dark:text-white/40">
                    <span>Categoría: Seguridad</span>
                    <span>•</span>
                    <span class="text-red-500 font-semibold">WAF ACTIVO</span>
                </div>
            </div>

            <div class="text-xs text-black/80 dark:text-white/80 space-y-4 leading-relaxed">
                <p>
                    El firewall WAF protege el sistema contra bots automatizados de spam que intenten colapsar el cotizador.
                </p>
                <h3 class="font-display font-bold text-xs text-brand uppercase tracking-wider">7.1 Lista Blanca (Whitelist)</h3>
                <p>
                    Para evitar bloqueos por error al trabajar frecuentemente en la administración, añade tu dirección IP a la **Lista Blanca** en el módulo de Seguridad. El firewall omitirá tus peticiones inmediatamente.
                </p>
            </div>
        </div>

        <!-- ARTICLE: CONTENIDO -->
        <div x-show="activeArticle === 'contenido'" class="space-y-4" x-cloak>
            <!-- Breadcrumbs -->
            <div class="flex items-center gap-1 text-[9px] uppercase font-bold text-black/40 dark:text-white/30 tracking-wider">
                <span>Wiki</span>
                <span>/</span>
                <span>Personalización</span>
                <span>/</span>
                <span class="text-brand">Banners</span>
            </div>

            <div class="border-b border-black/5 dark:border-white/5 pb-3">
                <h1 class="font-display font-black text-xl md:text-2xl text-black dark:text-white mb-1">8. Carrusel Hero y Logo</h1>
                <div class="flex items-center gap-2 text-[10px] text-black/40 dark:text-white/40">
                    <span>Categoría: Contenido</span>
                    <span>•</span>
                    <span class="text-brand font-semibold">DISEÑO</span>
                </div>
            </div>

            <div class="text-xs text-black/80 dark:text-white/80 space-y-4 leading-relaxed">
                <p>
                    Personaliza la identidad visual de tu portal público.
                </p>
                <h3 class="font-display font-bold text-xs text-brand uppercase tracking-wider">8.1 Carrusel del Home</h3>
                <p>
                    Puedes añadir sliders de imagen o videos en formato MP4 (ej. `/assets/videos/hero-banner.mp4`) con textos promocionales que redirijan al cotizador.
                </p>
                <h3 class="font-display font-bold text-xs text-brand uppercase tracking-wider">8.2 Logo Corporativo</h3>
                <p>
                    Al subir tu logo en **Configuración**, este se propagará automáticamente en los correos transaccionales SMTP, la cabecera de la web y el favicon.
                </p>
            </div>
        </div>

    </main>
</div>
@endsection
