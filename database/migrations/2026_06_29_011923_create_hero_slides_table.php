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
        Schema::create('hero_slides', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('title');
            $table->string('title_gradient')->nullable();
            $table->text('subtitle')->nullable();
            $table->string('media_type')->default('image'); // image or video
            $table->string('media_path')->nullable(); // path to file or url
            $table->string('button_primary_text')->nullable();
            $table->string('button_primary_url')->nullable();
            $table->string('button_secondary_text')->nullable();
            $table->string('button_secondary_url')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('display_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hero_slides');
    }
};
