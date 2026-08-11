<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('page_seo')) {
            Schema::create('page_seo', function (Blueprint $table) {
                $table->id();
                $table->string('route_key')->unique();
                $table->string('page_name');
                $table->string('page_path');
                $table->text('seo_title')->nullable();
                $table->text('seo_description')->nullable();
                $table->timestamps();
            });

            // Seed default pages with current hardcoded values
            DB::table('page_seo')->insert([

            [
                'route_key' => 'home',
                'page_name' => 'Inicio',
                'page_path' => '/',
                'seo_title' => 'High Contrast Detailing Center | Car Detailing Premium en Chicureo',
                'seo_description' => 'Centro de detailing automotriz premium en Chicureo, Colina. Pulido profesional, recubrimiento cerámico Gtechniq, detallado de interior y protección de parabrisas.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'route_key' => 'nosotros',
                'page_name' => 'Nosotros',
                'page_path' => '/nosotros',
                'seo_title' => 'Nuestra Historia | High Contrast Detailing Center',
                'seo_description' => 'Conoce la historia de High Contrast Detailing Center, desde nuestros inicios en Estados Unidos hasta convertirnos en el centro de detailing de referencia en Santiago de Chile.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'route_key' => 'limpieza-y-detallado',
                'page_name' => 'Limpieza y Detallado',
                'page_path' => '/limpieza-y-detallado',
                'seo_title' => 'Limpieza y Detallado Automotriz en Chicureo | Detailing Premium',
                'seo_description' => 'Servicio profesional de lavado de autos y detailing automotriz en Chicureo. Limpieza profunda, lavado premium con snow foam y detallado interior. ¡Resultados de exhibición!',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'route_key' => 'sellado-ceramico',
                'page_name' => 'Sellado Cerámico',
                'page_path' => '/sellado-ceramico',
                'seo_title' => 'Sellado Cerámico en Santiago | Protección y Brillo Extremo 9H',
                'seo_description' => 'El mejor sellado cerámico en Santiago. Protección cerámica profesional Gtechniq para autos. Brillo permanente, hidrofobicidad y protección UV. ¡Cotiza tu ceramic coating ahora!',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'route_key' => 'pulido-de-autos',
                'page_name' => 'Pulido de Autos',
                'page_path' => '/pulido-de-autos-santiago',
                'seo_title' => 'Pulido de Autos en Santiago | Eliminación de Rayas y Brillo 8K',
                'seo_description' => 'Servicio profesional de pulido de autos en Santiago. Eliminación de rayas, corrección de pintura multi-etapa y restauración de brillo. ¡Resultados de exhibición garantizados!',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'route_key' => 'proteccion-parabrisas',
                'page_name' => 'Protección de Parabrisas',
                'page_path' => '/proteccion-parabrisas-santiago',
                'seo_title' => 'Protección de Parabrisas en Santiago | ExoShield SPRINT',
                'seo_description' => 'Especialistas en protección de parabrisas en Santiago. Tecnología ExoShield SPRINT TPU. Claridad excepcional para vehículos de uso ocasional. ¡Cotiza tu instalación!',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'route_key' => 'detailing-interior',
                'page_name' => 'Detailing Interior',
                'page_path' => '/detailing-interior',
                'seo_title' => 'Detailing Interior Profesional | High Contrast Detailing Center',
                'seo_description' => 'El detailing interior va más allá de una limpieza común. Es un proceso meticuloso que restaura cada superficie del habitáculo a su estado original o superior.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'route_key' => 'tratamiento-ceramico',
                'page_name' => 'Tratamiento Cerámico',
                'page_path' => '/tratamiento-ceramico',
                'seo_title' => 'Tratamiento Cerámico Profesional | High Contrast Detailing Center',
                'seo_description' => 'El tratamiento cerámico es la máxima expresión en protección de pintura automotriz. Nuestro coating cerámico 9H crea una barrera permanente contra los elementos.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'route_key' => 'restauracion-de-focos',
                'page_name' => 'Restauración de Focos',
                'page_path' => '/restauracion-de-focos',
                'seo_title' => 'Restauración de Focos | High Contrast Detailing Center',
                'seo_description' => 'Los focos opacos no solo afectan la estética de tu vehículo, sino también tu seguridad al reducir la potencia lumínica. Restauramos la transparencia original.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'route_key' => 'reserva',
                'page_name' => 'Cotizador / Reservas',
                'page_path' => '/reserva',
                'seo_title' => 'Cotizador Online & Reservas | High Contrast Detailing Center',
                'seo_description' => 'Cotiza y agenda el detallado automotriz de tu vehículo online. Chicureo, Colina.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
        }
    }


    public function down(): void
    {
        Schema::dropIfExists('page_seo');
    }
};
