<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('services')) {
            $service = DB::table('services')->where('slug', 'tratamiento-ceramico')->first();
            if ($service) {
                // Remove pivot relations if any
                if (Schema::hasTable('service_vehicle_type')) {
                    DB::table('service_vehicle_type')->where('service_id', $service->id)->delete();
                }
                if (Schema::hasTable('service_prices')) {
                    DB::table('service_prices')->where('service_id', $service->id)->delete();
                }
                if (Schema::hasTable('extra_service')) {
                    DB::table('extra_service')->where('service_id', $service->id)->delete();
                }
                // Delete service
                DB::table('services')->where('id', $service->id)->delete();
            }
        }
    }

    public function down(): void
    {
    }
};
