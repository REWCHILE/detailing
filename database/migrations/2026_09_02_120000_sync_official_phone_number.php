<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('business_profiles')) {
            DB::table('business_profiles')->updateOrInsert(
                ['id' => 'default'],
                [
                    'phone' => '+56 9 5102 4782',
                    'whatsapp' => '56951024782',
                ]
            );
            DB::table('business_profiles')->whereNotNull('id')->update([
                'phone' => '+56 9 5102 4782',
                'whatsapp' => '56951024782',
            ]);
        }
    }

    public function down(): void
    {
    }
};
