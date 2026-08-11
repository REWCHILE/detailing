@php
    $schemaProfile = \App\Models\BusinessProfile::first();
    $faqs = [
        ['q' => '¿Cuánto tiempo dura el sellado cerámico en el auto?', 'a' => 'Nuestra protección Gtechniq Platinum ofrece una durabilidad certificada de 2 a 9 años (Crystal Serum Ultra), dependiendo del nivel elegido.'],
        ['q' => '¿El recubrimiento cerámico evita los rayones?', 'a' => 'Actúa como una capa de sacrificio (dureza 9H/10H) que previene micro-rayas (swirls) y daños por químicos, aunque no previene rayones profundos por vandalismo o colisiones.'],
        ['q' => '¿Dejo de lavar mi auto si aplico cerámico?', 'a' => 'No, pero el lavado se vuelve un proceso mucho más rápido y seguro gracias al efecto hidrofóbico que repele el agua y la suciedad adherida.'],
        ['q' => '¿Qué diferencia hay entre un cerámico Gtechniq y una cera tradicional?', 'a' => 'Las ceras se evaporan en semanas y no protegen contra químicos. Gtechniq se une molecularmente a la pintura, resiste pH2-pH12 y dura años.'],
        ['q' => '¿Puedo aplicar sellado cerámico si mi pintura ya está dañada?', 'a' => 'Sí, pero primero debemos realizar un proceso de corrección de pintura (pulido) para eliminar defectos antes de encapsular la pintura con el cerámico.'],
        ['q' => '¿El sellado cerámico protege contra los rayos UV?', 'a' => 'Absolutamente. Filtra los rayos UV previniendo la oxidación, pérdida de brillo y decoloración del barniz (clear coat).'],
        ['q' => '¿Se puede aplicar sellado en los vidrios y llantas?', 'a' => 'Sí, nuestros paquetes incluyen sellado hidrofóbico para vidrios (mejora visibilidad en lluvia) y revestimiento térmico para llantas (evita incrustación de polvo de frenos).'],
        ['q' => '¿Qué significa la dureza 9H o 10H?', 'a' => 'Es una escala de dureza en lápices. Significa que el recubrimiento es extremadamente resistente a la abrasión ligera, superando ampliamente la dureza del barniz automotriz de fábrica.'],
        ['q' => '¿El cerámico previene las manchas de agua (water spots)?', 'a' => 'Minimiza la probabilidad de formación gracias a su hidrofobicidad, pero el agua dura estancada bajo el sol aún puede dejar minerales.'],
        ['q' => '¿Cómo debo mantener mi vehículo tras aplicar Gtechniq?', 'a' => 'Sugerimos lavados con shampoo pH neutro, uso de microfibras premium y evitar lavados de rodillos automáticos para maximizar su vida útil.'],
    ];
    $faqEntities = array_map(fn($f) => ['@type' => 'Question', 'name' => $f['q'], 'acceptedAnswer' => ['@type' => 'Answer', 'text' => $f['a']]], $faqs);
    $jsonLd = [
        '@context' => 'https://schema.org',
        '@graph' => [
            [
                '@type' => 'Service',
                'name' => 'Sellado Cerámico Gtechniq Platinum',
                'provider' => ['@type' => 'LocalBusiness', '@id' => url('/') . '#localbusiness', 'name' => $schemaProfile->business_name ?? 'High Contrast Detailing Center'],
                'areaServed' => ['@type' => 'City', 'name' => 'Santiago'],
                'description' => 'Protección cerámica automotriz con tecnología Gtechniq. Durabilidad de 2 a 9 años, dureza 9H/10H, protección UV y brillo extremo.',
                'offers' => ['@type' => 'Offer', 'priceCurrency' => 'CLP', 'price' => '150000'],
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
