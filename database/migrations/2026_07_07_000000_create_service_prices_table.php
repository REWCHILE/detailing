<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('service_prices')) {
            Schema::create('service_prices', function (Blueprint $table) {
                $table->foreignUlid('service_id')->constrained('services')->onDelete('cascade');
                $table->foreignUlid('vehicle_type_id')->constrained('vehicle_types')->onDelete('cascade');
                $table->integer('price')->unsigned();
                $table->timestamps();

                $table->primary(['service_id', 'vehicle_type_id']);
            });
        }
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_prices');
    }
};
