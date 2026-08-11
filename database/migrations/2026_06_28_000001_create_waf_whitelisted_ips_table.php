<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('waf_whitelisted_ips', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('ip', 45)->unique();
            $table->string('reason', 255)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('waf_whitelisted_ips');
    }
};
