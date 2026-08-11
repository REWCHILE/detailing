<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('waf_settings', function (Blueprint $table) {
            $table->id();
            $table->boolean('waf_enabled')->default(true);
            $table->boolean('block_mode')->default(false); // Default to detection mode so developer is safe
            $table->boolean('bot_protection')->default(true);
            $table->integer('max_requests_per_minute')->default(100);
            $table->timestamps();
        });

        Schema::create('waf_blocked_ips', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('ip', 45)->unique();
            $table->string('reason', 255)->nullable();
            $table->timestamp('blocked_at');
            $table->timestamp('expires_at')->nullable(); // null means permanent
            $table->timestamps();
        });

        Schema::create('waf_logs', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('ip', 45);
            $table->string('url', 1000);
            $table->string('method', 10);
            $table->text('user_agent')->nullable();
            $table->text('payload')->nullable(); // JSON or serialized POST/GET payload
            $table->string('threat_type', 50)->default('None');
            $table->integer('threat_score')->default(0);
            $table->boolean('is_bot')->default(false);
            $table->string('country', 100)->nullable();
            $table->string('region', 100)->nullable();
            $table->string('city', 100)->nullable();
            $table->string('status', 20)->default('allowed'); // allowed, blocked, flagged
            $table->timestamp('created_at')->useCurrent();

            // Indexes for fast administrative views
            $table->index('ip');
            $table->index('threat_type');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('waf_logs');
        Schema::dropIfExists('waf_blocked_ips');
        Schema::dropIfExists('waf_settings');
    }
};
