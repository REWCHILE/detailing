<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Add emoji column if it doesn't exist
        if (!Schema::hasColumn('vehicle_types', 'emoji')) {
            Schema::table('vehicle_types', function (Blueprint $table) {
                $table->string('emoji')->nullable()->default('🚗')->after('description');
            });
        }

        // 2. Define the 3 vehicle types
        $vehicles = [
            ['slug' => 'autos', 'name' => 'Autos', 'description' => 'Vehículo estándar de 4 puertas', 'emoji' => '🚗', 'display_order' => 1],
            ['slug' => 'medianos', 'name' => 'Medianos', 'description' => 'Compacto y versátil', 'emoji' => '🚗', 'display_order' => 2],
            ['slug' => 'grandes', 'name' => 'Grandes', 'description' => 'Mayor superficie, más detalle', 'emoji' => '🚙', 'display_order' => 3],
        ];

        $allowedSlugs = array_column($vehicles, 'slug');

        // Safely deactivate or delete other vehicle types to keep only these 3
        try {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            DB::table('vehicle_types')->whereNotIn('slug', $allowedSlugs)->delete();
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        } catch (\Throwable $e) {
            DB::table('vehicle_types')->whereNotIn('slug', $allowedSlugs)->update(['is_active' => false]);
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }



        // 3. Upsert the 3 allowed vehicles
        foreach ($vehicles as $v) {
            $exists = DB::table('vehicle_types')->where('slug', $v['slug'])->first();
            if ($exists) {
                DB::table('vehicle_types')->where('slug', $v['slug'])->update([
                    'name' => $v['name'],
                    'description' => $v['description'],
                    'emoji' => $v['emoji'],
                    'display_order' => $v['display_order'],
                ]);
            } else {
                DB::table('vehicle_types')->insert([
                    'id' => (string) Str::ulid(),
                    'slug' => $v['slug'],
                    'name' => $v['name'],
                    'description' => $v['description'],
                    'emoji' => $v['emoji'],
                    'price_multiplier' => 1.0,
                    'display_order' => $v['display_order'],
                    'is_active' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vehicle_types', function (Blueprint $table) {
            $table->dropColumn('emoji');
        });
    }
};
