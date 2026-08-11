@php
    $schemaProfile = \App\Models\BusinessProfile::first();
    $faqs = [
        ['q' => '¿Qué diferencia hay entre lavado tradicional y Detailing?', 'a' => 'El detailing usa mitigación de daños (dos cubetas, snow foam), químicos pH neutro y pinceles para no causar marcas (swirls).'],
        ['q' => '¿El detailing interior elimina manchas de los asientos?', 'a' => 'Sí, usamos inyección/extracción profunda y vapor para extraer manchas y bacterias desde la raíz de los textiles.'],
        ['q' => '¿Qué es el lavado con Snow Foam?', 'a' => 'Es una espuma densa activa que encapsula la tierra y la arrastra fuera del auto sin fricción manual, evitando rayar la pintura.'],
        ['q' => '¿Limpian el motor de forma segura?', 'a' => 'Sí, aislamos componentes electrónicos y usamos vapor y desengrasantes dieléctricos seguros, finalizando con un acondicionador de plásticos que repele el polvo.'],
        ['q' => '¿Qué usan para no dañar los plásticos del tablero?', 'a' => 'Descartamos la silicona grasosa. Usamos limpiadores con bloqueadores UV que dejan un acabado mate original y seco al tacto.'],
        ['q' => '¿El detailing elimina los malos olores como cigarro o mascotas?', 'a' => 'Sí, nuestros tratamientos con cañón de ozono destruyen bacterias y esporas moleculares causantes del mal olor en ductos de AC y telas.'],
        ['q' => '¿Cuánto demora un servicio de detailing completo?', 'a' => 'Un paquete interior y exterior premium requiere entre 4 a 8 horas de trabajo minucioso por un técnico especializado.'],
        ['q' => '¿Qué es la descontaminación de pintura (Clay Bar)?', 'a' => 'Es el proceso de extraer metales férricos y alquitrán incrustado en el barniz para que la pintura quede suave como el cristal.'],
        ['q' => '¿Realizan limpieza y sellado de asientos de cuero?', 'a' => 'Sí, extraemos el brillo de la grasa acumulada, devolviendo el tono mate de fábrica, y aplicamos cremas hidratantes para evitar agrietamiento.'],
        ['q' => '¿Es seguro el detailing para autos con PPF o Wrap?', 'a' => 'Totalmente. Ajustamos nuestros químicos y herramientas para prolongar la vida útil del adhesivo y no dañar la lámina superficial.'],
    ];
    $faqEntities = array_map(fn($f) => ['@type' => 'Question', 'name' => $f['q'], 'acceptedAnswer' => ['@type' => 'Answer', 'text' => $f['a']]], $faqs);
    $jsonLd = [
        '@context' => 'https://schema.org',
        '@graph' => [
            [
                '@type' => 'Service',
                'name' => 'Limpieza y Detallado Automotriz Premium',
                'provider' => ['@type' => 'LocalBusiness', '@id' => url('/') . '#localbusiness', 'name' => $schemaProfile->business_name ?? 'High Contrast Detailing Center'],
                'areaServed' => ['@type' => 'City', 'name' => 'Chicureo'],
                'description' => 'Servicio profesional de detailing automotriz en Chicureo. Lavado premium con snow foam, limpieza profunda y detallado interior.',
                'offers' => ['@type' => 'Offer', 'priceCurrency' => 'CLP', 'price' => '45000'],
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
