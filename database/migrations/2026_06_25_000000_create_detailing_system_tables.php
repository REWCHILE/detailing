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
        Schema::create('customers', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('user_id')->nullable()->unique()->constrained('users')->onDelete('set null');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->nullable();
            $table->string('phone');
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->index('phone');
            $table->index('email');
            $table->index(['last_name', 'first_name']);
        });

        Schema::create('vehicle_types', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('slug')->unique();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price_multiplier', 5, 2)->default(1.00);
            $table->integer('display_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index(['is_active', 'display_order']);
        });

        Schema::create('customer_vehicles', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('customer_id')->constrained('customers')->onDelete('cascade');
            $table->foreignUlid('vehicle_type_id')->constrained('vehicle_types')->onDelete('restrict');
            $table->string('license_plate');
            $table->string('license_plate_normalized')->unique();
            $table->string('make')->nullable();
            $table->string('model')->nullable();
            $table->integer('year')->nullable();
            $table->string('color')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->index('customer_id');
            $table->index('vehicle_type_id');
        });

        Schema::create('services', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('slug')->unique();
            $table->string('name');
            $table->text('short_description');
            $table->text('long_description')->nullable();
            $table->integer('base_price');
            $table->integer('duration_minutes');
            $table->boolean('is_active')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->integer('display_order')->default(0);
            $table->timestamps();

            $table->index(['is_active', 'display_order']);
        });

        Schema::create('extras', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('slug')->unique();
            $table->string('name');
            $table->text('description');
            $table->integer('price');
            $table->integer('duration_minutes');
            $table->boolean('is_active')->default(true);
            $table->integer('display_order')->default(0);
            $table->timestamps();

            $table->index(['is_active', 'display_order']);
        });

        Schema::create('service_extras', function (Blueprint $table) {
            $table->foreignUlid('service_id')->constrained('services')->onDelete('cascade');
            $table->foreignUlid('extra_id')->constrained('extras')->onDelete('cascade');
            $table->boolean('is_default')->default(false);
            $table->boolean('is_required')->default(false);

            $table->primary(['service_id', 'extra_id']);
            $table->index('extra_id');
        });

        Schema::create('work_bays', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('name');
            $table->boolean('is_active')->default(true);
            $table->integer('display_order')->default(0);
            $table->timestamps();

            $table->index(['is_active', 'display_order']);
        });

        Schema::create('business_profiles', function (Blueprint $table) {
            $table->string('id')->primary()->default('default');
            $table->string('business_name');
            $table->string('email');
            $table->string('phone');
            $table->string('whatsapp')->nullable();
            $table->string('instagram')->nullable();
            $table->string('website')->nullable();
            $table->string('address_line1');
            $table->string('address_line2')->nullable();
            $table->string('city');
            $table->string('region');
            $table->string('country_code')->default('CL');
            $table->string('timezone')->default('America/Santiago');
            $table->string('currency')->default('CLP');
            $table->integer('booking_hold_minutes')->default(15);
            $table->integer('slot_interval_minutes')->default(30);
            $table->integer('lead_time_hours')->default(12);
            $table->integer('max_advance_days')->default(60);

            // Payment settings
            $table->boolean('payment_gateway_enabled')->default(false);
            $table->string('payment_gateway_mode')->default('TEST'); // TEST, PRODUCTION
            $table->text('mercado_pago_public_key_test')->nullable();
            $table->text('mercado_pago_access_token_test')->nullable();
            $table->text('mercado_pago_public_key_production')->nullable();
            $table->text('mercado_pago_access_token_production')->nullable();
            
            $table->boolean('transbank_enabled')->default(false);
            $table->string('transbank_mode')->default('TEST');
            $table->text('transbank_commerce_code_test')->nullable();
            $table->text('transbank_api_key_test')->nullable();
            $table->text('transbank_commerce_code_production')->nullable();
            $table->text('transbank_api_key_production')->nullable();

            // SMTP settings
            $table->boolean('smtp_enabled')->default(false);
            $table->string('smtp_host')->nullable();
            $table->integer('smtp_port')->nullable();
            $table->string('smtp_user')->nullable();
            $table->string('smtp_password')->nullable();
            $table->boolean('smtp_secure')->default(false);
            $table->string('smtp_from_name')->nullable();
            $table->string('smtp_from_email')->nullable();

            $table->timestamps();
        });

        Schema::create('business_hours', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('weekday')->unique(); // MONDAY, TUESDAY, etc.
            $table->boolean('is_closed')->default(false);
            $table->integer('open_minute_of_day')->nullable();
            $table->integer('close_minute_of_day')->nullable();
            $table->timestamps();
        });

        Schema::create('schedule_blocks', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('title');
            $table->text('reason')->nullable();
            $table->string('block_type'); // HOLIDAY, MAINTENANCE, MANUAL
            $table->dateTime('starts_at');
            $table->dateTime('ends_at');
            $table->boolean('all_day')->default(false);
            $table->foreignUlid('created_by_id')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();

            $table->index(['starts_at', 'ends_at']);
        });

        Schema::create('bookings', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('public_id')->unique();
            $table->foreignUlid('customer_id')->constrained('customers')->onDelete('restrict');
            $table->foreignUlid('customer_vehicle_id')->constrained('customer_vehicles')->onDelete('restrict');
            $table->foreignUlid('service_id')->constrained('services')->onDelete('restrict');
            $table->foreignUlid('bay_id')->constrained('work_bays')->onDelete('restrict');
            $table->foreignUlid('created_by_id')->nullable()->constrained('users')->onDelete('set null');
            $table->dateTime('start_at');
            $table->dateTime('end_at');
            $table->dateTime('expires_at')->nullable();
            $table->string('status')->default('PENDING'); // PENDING, CONFIRMED, etc.
            $table->string('payment_status')->default('PENDING'); // PENDING, PAID, etc.
            $table->string('channel')->default('WEB'); // WEB, ADMIN, etc.
            $table->text('notes')->nullable();
            $table->text('admin_notes')->nullable();
            $table->text('cancellation_reason')->nullable();
            
            // Snapshots
            $table->string('service_name_snapshot');
            $table->integer('service_base_price_snapshot');
            $table->string('vehicle_type_name_snapshot');
            $table->decimal('vehicle_multiplier_snapshot', 5, 2);
            $table->integer('duration_minutes');
            
            // Amounts
            $table->integer('subtotal_amount');
            $table->integer('extras_amount')->default(0);
            $table->integer('total_amount');
            $table->string('currency')->default('CLP');

            $table->dateTime('confirmed_at')->nullable();
            $table->dateTime('cancelled_at')->nullable();
            $table->dateTime('completed_at')->nullable();
            $table->timestamps();

            $table->index(['customer_id', 'created_at']);
            $table->index('service_id');
            $table->index(['bay_id', 'start_at', 'end_at']);
            $table->index(['status', 'start_at']);
            $table->index(['payment_status', 'start_at']);
        });

        Schema::create('booking_extras', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('booking_id')->constrained('bookings')->onDelete('cascade');
            $table->foreignUlid('extra_id')->nullable()->constrained('extras')->onDelete('set null');
            $table->string('name_snapshot');
            $table->integer('price_snapshot');
            $table->integer('duration_minutes_snapshot');
            $table->timestamps();

            $table->index('booking_id');
            $table->index('extra_id');
        });

        Schema::create('payments', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('booking_id')->constrained('bookings')->onDelete('cascade');
            $table->string('provider'); // MERCADO_PAGO, STRIPE, MANUAL
            $table->string('provider_payment_id')->nullable()->unique();
            $table->string('provider_preference_id')->nullable()->unique();
            $table->string('external_reference')->unique();
            $table->integer('amount');
            $table->string('currency')->default('CLP');
            $table->string('status')->default('PENDING');
            $table->string('raw_status')->nullable();
            $table->text('checkout_url')->nullable();
            $table->string('failure_code')->nullable();
            $table->text('failure_message')->nullable();
            $table->dateTime('expires_at')->nullable();
            $table->dateTime('paid_at')->nullable();
            $table->json('webhook_payload')->nullable();
            $table->timestamps();

            $table->index(['booking_id', 'status']);
            $table->index(['provider', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
        Schema::dropIfExists('booking_extras');
        Schema::dropIfExists('bookings');
        Schema::dropIfExists('schedule_blocks');
        Schema::dropIfExists('business_hours');
        Schema::dropIfExists('business_profiles');
        Schema::dropIfExists('work_bays');
        Schema::dropIfExists('service_extras');
        Schema::dropIfExists('extras');
        Schema::dropIfExists('services');
        Schema::dropIfExists('customer_vehicles');
        Schema::dropIfExists('vehicle_types');
        Schema::dropIfExists('customers');
    }
};
