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
        Schema::table('business_profiles', function (Blueprint $table) {
            $table->string('google_maps_url', 1000)->nullable()->after('website');
            $table->string('google_analytics_id', 50)->nullable()->after('google_maps_url');
            $table->string('google_tag_manager_id', 50)->nullable()->after('google_analytics_id');
            $table->text('header_scripts')->nullable()->after('google_tag_manager_id');
            $table->text('footer_scripts')->nullable()->after('header_scripts');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('business_profiles', function (Blueprint $table) {
            $table->dropColumn([
                'google_maps_url',
                'google_analytics_id',
                'google_tag_manager_id',
                'header_scripts',
                'footer_scripts'
            ]);
        });
    }
};
