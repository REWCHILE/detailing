@php
    $schemaProfile = \App\Models\BusinessProfile::first();
    
    // Dynamically build the sameAs array to associate GMB & social profiles
    $sameAs = [];
    if ($schemaProfile) {
        if ($schemaProfile->instagram) {
            $sameAs[] = 'https://instagram.com/' . ltrim($schemaProfile->instagram, '@');
        } else {
            $sameAs[] = 'https://instagram.com/highcontrastdc';
        }
        if (!empty($schemaProfile->google_maps_url)) {
            $sameAs[] = $schemaProfile->google_maps_url;
        }
    } else {
        $sameAs[] = 'https://instagram.com/highcontrastdc';
    }

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
                'sameAs' => $sameAs,
                'address' => [
                    '@type' => 'PostalAddress',
                    'streetAddress' => trim(($schemaProfile->address_line1 ?? 'Chicureo') . ' ' . ($schemaProfile->address_line2 ?? '')),
                    'addressLocality' => $schemaProfile->city ?? 'Colina',
                    'addressRegion' => $schemaProfile->region ?? 'Región Metropolitana',
                    'addressCountry' => $schemaProfile->country_code ?? 'CL',
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
                    ['@type' => 'Offer', 'name' => 'Pulido y Corrección de Pintura Automotriz'],
                    ['@type' => 'Offer', 'name' => 'Detailing y Limpieza Interior Profunda'],
                ],
            ],
            [
                '@type' => 'Organization',
                '@id' => url('/') . '#organization',
                'name' => $schemaProfile->business_name ?? 'High Contrast Detailing Center',
                'url' => url('/'),
                'logo' => $schemaProfile->logo ? asset($schemaProfile->logo) : asset('assets/logos/main-logo.png'),
                'sameAs' => $sameAs,
            ],
        ],
    ];
@endphp
<script type="application/ld+json">
{!! json_encode($jsonLd, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
</script>
