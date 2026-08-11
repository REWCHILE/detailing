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
        Schema::table('services', function (Blueprint $table) {
            $table->string('category', 50)->default('especiales')->after('slug');
        });

        Schema::table('service_extras', function (Blueprint $table) {
            $table->boolean('is_courtesy')->default(false)->after('is_required');
            $table->boolean('is_included')->default(false)->after('is_courtesy');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('service_extras', function (Blueprint $table) {
            $table->dropColumn('is_courtesy');
            $table->dropColumn('is_included');
        });

        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn('category');
        });
    }
};
