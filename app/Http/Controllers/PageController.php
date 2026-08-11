<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function nosotros()
    {
        return view('nosotros');
    }

    public function limpiezaYDetallado()
    {
        $services = \App\Models\Service::with('vehicleTypes')->where('is_active', true)->get()->keyBy('slug');
        $vehicleTypes = \App\Models\VehicleType::where('is_active', true)->orderBy('display_order')->get();
        $profile = \App\Models\BusinessProfile::first();
        $onlinePaymentsActive = $profile ? ($profile->payment_gateway_enabled || $profile->show_prices) : false;
        return view('limpieza-y-detallado', compact('services', 'vehicleTypes', 'onlinePaymentsActive'));
    }

    public function selladoCeramico()
    {
        $services = \App\Models\Service::with('vehicleTypes')->where('is_active', true)->get()->keyBy('slug');
        $vehicleTypes = \App\Models\VehicleType::where('is_active', true)->orderBy('display_order')->get();
        $profile = \App\Models\BusinessProfile::first();
        $onlinePaymentsActive = $profile ? ($profile->payment_gateway_enabled || $profile->show_prices) : false;
        return view('sellado-ceramico', compact('services', 'vehicleTypes', 'onlinePaymentsActive'));
    }

    public function pulidoDeAutos()
    {
        $services = \App\Models\Service::with('vehicleTypes')->where('is_active', true)->get()->keyBy('slug');
        $vehicleTypes = \App\Models\VehicleType::where('is_active', true)->orderBy('display_order')->get();
        $profile = \App\Models\BusinessProfile::first();
        $onlinePaymentsActive = $profile ? ($profile->payment_gateway_enabled || $profile->show_prices) : false;
        return view('pulido-de-autos-santiago', compact('services', 'vehicleTypes', 'onlinePaymentsActive'));
    }

    public function proteccionParabrisas()
    {
        $services = \App\Models\Service::with('vehicleTypes')->where('is_active', true)->get()->keyBy('slug');
        $vehicleTypes = \App\Models\VehicleType::where('is_active', true)->orderBy('display_order')->get();
        $profile = \App\Models\BusinessProfile::first();
        $onlinePaymentsActive = $profile ? ($profile->payment_gateway_enabled || $profile->show_prices) : false;
        return view('proteccion-parabrisas-santiago', compact('services', 'vehicleTypes', 'onlinePaymentsActive'));
    }

    public function detailingInterior()
    {
        return view('seo-service', [
            'title' => 'Detailing Interior Profesional',
            'subtitle' => 'Tu habitáculo, impecable',
            'description' => 'El detailing interior va más allá de una limpieza común. Es un proceso meticuloso que restaura cada superficie del habitáculo a su estado original o superior. Desde la tapicería hasta el cielo, cada detalle importa.',
            'features' => [
                'Aspirado profundo de asientos, alfombras y maletero',
                'Limpieza de tapicería con extracción por inyección',
                'Tratamiento y acondicionamiento de cueros',
                'Limpieza y restauración de plásticos interiores',
                'Limpieza profunda del cielo del vehículo',
                'Tratamiento con ozono para eliminación de olores',
                'Limpieza y desinfección de sistemas de ventilación',
            ],
            'benefits' => [
                ['title' => 'Interior como nuevo', 'description' => 'Cada superficie restaurada a su máximo esplendor'],
                ['title' => 'Ambiente saludable', 'description' => 'Eliminamos bacterias, ácaros y olores del habitáculo'],
                ['title' => 'Experiencia premium', 'description' => 'Sentirás la diferencia cada vez que subas a tu auto'],
            ],
            'priceFrom' => 65000,
            'estimatedTime' => '3 a 4 horas',
            'ctaText' => 'Cotiza tu detailing',
            'serviceId' => 'detailing-interior',
        ]);
    }

    public function tratamientoCeramico()
    {
        return view('seo-service', [
            'title' => 'Tratamiento Cerámico Profesional',
            'subtitle' => 'Protección de nivel superior',
            'description' => 'El tratamiento cerámico es la máxima expresión en protección de pintura automotriz. Nuestro coating cerámico 9H crea una barrera permanente contra los elementos, manteniendo el brillo y la protección por años.',
            'features' => [
                'Preparación completa de la superficie (lavado, clay bar, pulido)',
                'Aplicación de coating cerámico 9H profesional',
                'Capa hidrofóbica de extrema repelencia al agua',
                'Protección UV contra decoloración de pintura',
                'Resistencia a contaminantes químicos y ambientales',
                'Durabilidad de 2 a 5 años según el producto',
                'Certificado de aplicación con garantía',
            ],
            'benefits' => [
                ['title' => 'Protección permanente', 'description' => 'Tu pintura protegida contra los elementos por años'],
                ['title' => 'Fácil mantenimiento', 'description' => 'La suciedad se desliza, lavados más rápidos y fáciles'],
                ['title' => 'Brillo constante', 'description' => 'Un nivel de brillo que se mantiene con el tiempo'],
            ],
            'priceFrom' => 150000,
            'estimatedTime' => '6 a 8 horas',
            'ctaText' => 'Cotiza tu cerámico',
            'serviceId' => 'ceramico',
        ]);
    }

    public function restauracionDeFocos()
    {
        return view('seo-service', [
            'title' => 'Restauración de Focos',
            'subtitle' => 'Visibilidad y estética recuperada',
            'description' => 'Los focos opacos no solo afectan la estética de tu vehículo, sino también tu seguridad al reducir la potencia lumínica. Nuestro proceso de restauración devuelve la transparencia original y protege contra el amarillamiento futuro.',
            'features' => [
                'Lijado progresivo multi-grano para eliminar oxidación',
                'Pulido con compound especial para ópticas',
                'Restauración de transparencia completa',
                'Aplicación de sellante UV protector',
                'Protección contra amarillamiento futuro',
                'Resultados visibles inmediatos',
                'Tratamiento de focos delanteros y traseros',
            ],
            'benefits' => [
                ['title' => 'Mayor seguridad', 'description' => 'Focos claros significan mejor iluminación nocturna'],
                ['title' => 'Estética renovada', 'description' => 'Tu auto se ve años más joven con focos cristalinos'],
                ['title' => 'Ahorro vs reemplazo', 'description' => 'Una fracción del costo de reemplazar los focos'],
            ],
            'priceFrom' => 35000,
            'estimatedTime' => '30 a 45 minutos',
            'ctaText' => 'Cotiza restauración',
            'serviceId' => 'restauracion-focos',
        ]);
    }
}
