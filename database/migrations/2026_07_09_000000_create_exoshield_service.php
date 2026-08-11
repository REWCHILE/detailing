<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Service;
use App\Models\VehicleType;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Create or update the Service
        $service = Service::updateOrCreate(
            ['slug' => 'proteccion-exoshield'],
            [
                'name' => 'Protección ExoShield SPRINT',
                'category' => 'especiales',
                'short_description' => 'Instalación profesional de lámina de TPU premium para parabrisas frontal. Protege contra impactos de piedras.',
                'long_description' => '<p>Material TPU de alta gama</p><p>1 año de Garantía Oficial</p><p>Claridad óptica inigualable</p><p>Aplicación libre de distorsión</p>',
                'base_price' => 180000,
                'duration_minutes' => 120,
                'is_active' => true,
                'is_featured' => true,
                'display_order' => 10,
            ]
        );

        // 2. Map prices to vehicle types
        $vehicleTypes = VehicleType::all();
        $prices = [];
        foreach ($vehicleTypes as $vt) {
            if ($vt->slug === 'sedan' || $vt->slug === 'hatchback' || $vt->slug === 'deportivo') {
                $prices[$vt->id] = ['price' => 180000];
            } elseif ($vt->slug === 'suv') {
                $prices[$vt->id] = ['price' => 210000];
            } elseif ($vt->slug === 'camioneta') {
                $prices[$vt->id] = ['price' => 250000];
            } else {
                $prices[$vt->id] = ['price' => 180000];
            }
        }

        $service->vehicleTypes()->sync($prices);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $service = Service::where('slug', 'proteccion-exoshield')->first();
        if ($service) {
            $service->vehicleTypes()->detach();
            $service->delete();
        }
    }
};
