<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('abandoned_quotes')) {
            Schema::create('abandoned_quotes', function (Blueprint $table) {
                $table->ulid('id')->primary();
                $table->string('session_id', 100)->index();
                $table->string('customer_name')->nullable();
                $table->string('customer_email')->nullable()->index();
                $table->string('customer_phone')->nullable()->index();
                $table->string('commune')->nullable();
                $table->string('vehicle_type_name')->nullable();
                $table->string('service_name')->nullable();
                $table->json('extras')->nullable();
                $table->integer('total_price')->default(0);
                $table->integer('last_step_reached')->default(1);
                $table->enum('status', ['DRAFT', 'RECOVERED', 'CANCELLED'])->default('DRAFT')->index();
                $table->timestamp('last_activity_at')->useCurrent()->index();
                $table->timestamps();
            });
        }
    }


    public function down(): void
    {
        Schema::dropIfExists('abandoned_quotes');
    }
};
