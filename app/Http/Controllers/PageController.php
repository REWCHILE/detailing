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
        $services = \App\Models\Service::with('vehicleTypes')->where('is_active', true)->get()->keyBy('slug');
        $vehicleTypes = \App\Models\VehicleType::where('is_active', true)->orderBy('display_order')->get();
        $profile = \App\Models\BusinessProfile::first();
        $onlinePaymentsActive = $profile ? ($profile->payment_gateway_enabled || $profile->show_prices) : false;
        return view('detailing-interior', compact('services', 'vehicleTypes', 'onlinePaymentsActive', 'profile'));
    }

    public function tratamientoCeramico()
    {
        $services = \App\Models\Service::with('vehicleTypes')->where('is_active', true)->get()->keyBy('slug');
        $vehicleTypes = \App\Models\VehicleType::where('is_active', true)->orderBy('display_order')->get();
        $profile = \App\Models\BusinessProfile::first();
        $onlinePaymentsActive = $profile ? ($profile->payment_gateway_enabled || $profile->show_prices) : false;
        return view('tratamiento-ceramico', compact('services', 'vehicleTypes', 'onlinePaymentsActive', 'profile'));
    }

    public function restauracionDeFocos()
    {
        $services = \App\Models\Service::with('vehicleTypes')->where('is_active', true)->get()->keyBy('slug');
        $vehicleTypes = \App\Models\VehicleType::where('is_active', true)->orderBy('display_order')->get();
        $profile = \App\Models\BusinessProfile::first();
        $onlinePaymentsActive = $profile ? ($profile->payment_gateway_enabled || $profile->show_prices) : false;
        return view('restauracion-de-focos', compact('services', 'vehicleTypes', 'onlinePaymentsActive', 'profile'));
    }

    /**
     * Generate dynamic XML Sitemap for Google Search Console & SEO.
     */
    public function sitemap()
    {
        $baseUrl = config('app.url', 'https://highcontrastdetailingcenter.cl');
        if (str_ends_with($baseUrl, '/')) {
            $baseUrl = rtrim($baseUrl, '/');
        }

        $pages = [
            ['loc' => $baseUrl . '/', 'priority' => '1.0', 'changefreq' => 'daily', 'lastmod' => date('Y-m-d')],
            ['loc' => $baseUrl . '/sellado-ceramico', 'priority' => '0.9', 'changefreq' => 'weekly', 'lastmod' => date('Y-m-d')],
            ['loc' => $baseUrl . '/pulido-de-autos-santiago', 'priority' => '0.9', 'changefreq' => 'weekly', 'lastmod' => date('Y-m-d')],
            ['loc' => $baseUrl . '/proteccion-parabrisas-santiago', 'priority' => '0.9', 'changefreq' => 'weekly', 'lastmod' => date('Y-m-d')],
            ['loc' => $baseUrl . '/limpieza-y-detallado', 'priority' => '0.9', 'changefreq' => 'weekly', 'lastmod' => date('Y-m-d')],
            ['loc' => $baseUrl . '/detailing-interior', 'priority' => '0.8', 'changefreq' => 'weekly', 'lastmod' => date('Y-m-d')],
            ['loc' => $baseUrl . '/tratamiento-ceramico', 'priority' => '0.8', 'changefreq' => 'weekly', 'lastmod' => date('Y-m-d')],
            ['loc' => $baseUrl . '/restauracion-de-focos', 'priority' => '0.8', 'changefreq' => 'weekly', 'lastmod' => date('Y-m-d')],
            ['loc' => $baseUrl . '/nosotros', 'priority' => '0.7', 'changefreq' => 'monthly', 'lastmod' => date('Y-m-d')],
            ['loc' => $baseUrl . '/reserva', 'priority' => '0.9', 'changefreq' => 'daily', 'lastmod' => date('Y-m-d')],
        ];

        // Include active dynamic services from database
        try {
            $services = \App\Models\Service::where('is_active', true)->get();
            foreach ($services as $srv) {
                if ($srv->slug) {
                    $pages[] = [
                        'loc' => $baseUrl . '/reserva?service=' . $srv->slug,
                        'priority' => '0.8',
                        'changefreq' => 'weekly',
                        'lastmod' => $srv->updated_at ? $srv->updated_at->format('Y-m-d') : date('Y-m-d')
                    ];
                }
            }
        } catch (\Exception $e) {}

        return response()->view('sitemap', compact('pages'))
            ->header('Content-Type', 'application/xml; charset=utf-8');
    }
}
