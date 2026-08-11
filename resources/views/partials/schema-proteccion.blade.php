@php
    $schemaProfile = \App\Models\BusinessProfile::first();
    $faqs = [
        ['q' => '¿Qué es ExoShield ULTRA?', 'a' => 'Es un film de grado nanotecnológico (8-mil de grosor, 6X más resistente) que se adhiere al exterior del parabrisas para evitar trizaduras por piedras.'],
        ['q' => '¿Afecta la visibilidad al conducir?', 'a' => 'No. Con 91.5% de claridad óptica, es el film más transparente del mercado y es virtualmente invisible.'],
        ['q' => '¿Soporta impactos de piedras grandes a alta velocidad?', 'a' => 'Está diseñado para disipar la energía de los impactos de gravilla de carretera. Salva el cristal original en el 99% de las situaciones comunes.'],
        ['q' => '¿ExoShield interfiere con sensores ADAS, cámaras o el HUD?', 'a' => 'Ninguno. ExoShield permite el funcionamiento perfecto de cámaras de mantenimiento de carril, radares y proyecciones Head-Up Display.'],
        ['q' => '¿Cuánto tiempo dura la instalación de ExoShield?', 'a' => 'El proceso toma aproximadamente 3 a 4 horas. Requiere limpieza microscópica y termoformado a la curvatura exacta del cristal.'],
        ['q' => '¿Se puede usar el limpiaparabrisas normalmente?', 'a' => 'Sí, cuenta con un recubrimiento endurecido resistente a la abrasión. Recomendamos mantener las plumillas en buen estado y usar líquidos lavaparabrisas sin químicos agresivos.'],
        ['q' => '¿ExoShield protege contra los rayos UV?', 'a' => 'Bloquea el 99.9% de la radiación UV dañina, protegiendo tanto tu piel como los interiores del tablero contra la degradación solar.'],
        ['q' => '¿Qué pasa si ExoShield se raya o pica con el tiempo?', 'a' => 'ExoShield hace el sacrificio que tu cristal no tendría. Si tras años recibe demasiados impactos, simplemente se retira y el parabrisas original debajo estará nuevo.'],
        ['q' => '¿ExoShield es legal para transitar y revisiones técnicas?', 'a' => 'Totalmente legal. Al ser incoloro y no afectar la transmisión de luz visible por debajo de las normativas, no genera problemas.'],
        ['q' => '¿Cuándo puedo lavar mi auto tras la instalación?', 'a' => 'Recomendamos esperar entre 3 a 5 días para permitir que el adhesivo cure perfectamente al sol y evitar el uso de hidrolavadoras a alta presión directamente en los bordes.'],
    ];
    $faqEntities = array_map(fn($f) => ['@type' => 'Question', 'name' => $f['q'], 'acceptedAnswer' => ['@type' => 'Answer', 'text' => $f['a']]], $faqs);
    $jsonLd = [
        '@context' => 'https://schema.org',
        '@graph' => [
            [
                '@type' => 'Service',
                'name' => 'Protección de Parabrisas ExoShield ULTRA',
                'provider' => ['@type' => 'LocalBusiness', '@id' => url('/') . '#localbusiness', 'name' => $schemaProfile->business_name ?? 'High Contrast Detailing Center'],
                'areaServed' => ['@type' => 'City', 'name' => 'Santiago'],
                'description' => 'Instalación de película nanotecnológica ExoShield ULTRA para parabrisas. Previene trizaduras, 6X más resistente, grosor de 8-mil, máxima claridad óptica.',
                'offers' => ['@type' => 'Offer', 'priceCurrency' => 'CLP', 'price' => '180000'],
            ],
            [
                '@type' => 'FAQPage',
                'mainEntity' => $faqEntities,
            ],
        ],
    ];
@endphp
<script type="application/ld+json">
{!! json_encode($jsonLd, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
</script>
