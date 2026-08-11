@php
    $schemaProfile = \App\Models\BusinessProfile::first();
    $faqs = [
        ['q' => '¿El pulido automotriz elimina todas las rayas de la pintura?', 'a' => 'Elimina la gran mayoría de marcas de lavado, hologramas y micro-rayas en la capa transparente. Rayas que cruzan la pintura base requieren retoque de color.'],
        ['q' => '¿Qué diferencia hay entre corrección en un paso y multi-etapa?', 'a' => 'Un paso mejora el brillo y defectos leves. Multi-etapa usa combinaciones de pads agresivos y de acabado para corrección profunda (nivel exhibición).'],
        ['q' => '¿Cuántas veces puedo pulir mi auto antes de dañar la pintura?', 'a' => 'Depende del espesor de la capa transparente (clear coat). Nuestros medidores de espesor aseguran que pulimos de manera conservadora y segura.'],
        ['q' => '¿El pulido elimina la piel de naranja (orange peel)?', 'a' => 'Reducir la piel de naranja requiere lijado en húmedo (wet sanding) previo al pulido, un servicio especializado que también ofrecemos tras una evaluación.'],
        ['q' => '¿Pueden pulir autos con cerámico previamente aplicado?', 'a' => 'Sí, el pulido removerá el recubrimiento cerámico antiguo, dejando la pintura virgen lista para aplicar una nueva protección.'],
        ['q' => '¿Cuánto tiempo toma un servicio de pulido profesional?', 'a' => 'Entre 1 a 3 días, dependiendo del tamaño del vehículo, la dureza de la pintura y el nivel de corrección (multi-etapa) requerido.'],
        ['q' => '¿El pulido devuelve el brillo a una pintura quemada por el sol?', 'a' => 'Si el barniz está opaco por oxidación superficial, el pulido lo restaurará. Si el barniz se está pelando o descascarando (clear coat failure), requiere repintado.'],
        ['q' => '¿Qué es un holograma en la pintura?', 'a' => 'Son rastros circulares dejados por malas técnicas de pulido rotatorio previo. Nuestro proceso elimina estos hologramas para un acabado perfecto a la luz del sol.'],
        ['q' => '¿Necesito proteger la pintura tras pulir?', 'a' => 'Es obligatorio. El pulido deja el poro de la pintura abierto. Siempre aplicamos cerámico, sellante o PPF inmediatamente después.'],
        ['q' => '¿Pueden pulir plásticos exteriores piano black?', 'a' => 'Sí, los pilares de puertas y molduras negro piano se pulen delicadamente para restaurar su acabado espejo original sin marcas.'],
    ];
    $faqEntities = array_map(fn($f) => ['@type' => 'Question', 'name' => $f['q'], 'acceptedAnswer' => ['@type' => 'Answer', 'text' => $f['a']]], $faqs);
    $jsonLd = [
        '@context' => 'https://schema.org',
        '@graph' => [
            [
                '@type' => 'Service',
                'name' => 'Pulido y Corrección de Pintura Automotriz',
                'provider' => ['@type' => 'LocalBusiness', '@id' => url('/') . '#localbusiness', 'name' => $schemaProfile->business_name ?? 'High Contrast Detailing Center'],
                'areaServed' => ['@type' => 'City', 'name' => 'Santiago'],
                'description' => 'Corrección de pintura multi-etapa y pulido automotriz profesional en Santiago. Eliminación de rayas, hologramas y restauración de brillo nivel 8K.',
                'offers' => ['@type' => 'Offer', 'priceCurrency' => 'CLP', 'price' => '80000'],
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
