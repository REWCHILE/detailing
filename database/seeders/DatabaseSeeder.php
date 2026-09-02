<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Business Profile
        \App\Models\BusinessProfile::updateOrCreate(
            ['id' => 'default'],
            [
                'business_name' => 'High Contrast Detailing Center',
                'email' => 'contacto@highcontrastdetailing.cl',
                'phone' => '+56 9 5102 4782',
                'whatsapp' => '56951024782',
                'instagram' => '@highcontrastdc',
                'website' => 'https://highcontrastdetailing.cl',
                'address_line1' => 'Chicureo, Colina',
                'address_line2' => '',
                'city' => 'Colina',
                'region' => 'Región Metropolitana',
                'country_code' => 'CL',
                'timezone' => 'America/Santiago',
                'currency' => 'CLP',
                'booking_hold_minutes' => 15,
                'slot_interval_minutes' => 30,
                'lead_time_hours' => 12,
                'max_advance_days' => 60,
                'payment_gateway_enabled' => false,
                'payment_gateway_mode' => 'TEST',
            ]
        );

        // 2. Business Hours
        $businessHours = [
            ['weekday' => 'MONDAY', 'is_closed' => false, 'open_minute_of_day' => 9 * 60, 'close_minute_of_day' => 19 * 60],
            ['weekday' => 'TUESDAY', 'is_closed' => false, 'open_minute_of_day' => 9 * 60, 'close_minute_of_day' => 19 * 60],
            ['weekday' => 'WEDNESDAY', 'is_closed' => false, 'open_minute_of_day' => 9 * 60, 'close_minute_of_day' => 19 * 60],
            ['weekday' => 'THURSDAY', 'is_closed' => false, 'open_minute_of_day' => 9 * 60, 'close_minute_of_day' => 19 * 60],
            ['weekday' => 'FRIDAY', 'is_closed' => false, 'open_minute_of_day' => 9 * 60, 'close_minute_of_day' => 19 * 60],
            ['weekday' => 'SATURDAY', 'is_closed' => false, 'open_minute_of_day' => 9 * 60, 'close_minute_of_day' => 15 * 60],
            ['weekday' => 'SUNDAY', 'is_closed' => true, 'open_minute_of_day' => null, 'close_minute_of_day' => null],
        ];

        foreach ($businessHours as $hour) {
            \App\Models\BusinessHour::updateOrCreate(
                ['weekday' => $hour['weekday']],
                $hour
            );
        }

        // 3. Work Bays
        $workBays = [
            ['name' => 'Bahía 1', 'display_order' => 1],
            ['name' => 'Bahía 2', 'display_order' => 2],
        ];

        foreach ($workBays as $bay) {
            \App\Models\WorkBay::updateOrCreate(
                ['name' => $bay['name']],
                ['is_active' => true, 'display_order' => $bay['display_order']]
            );
        }

        // 4. Vehicle Types
        $vehicleTypes = [
            ['slug' => 'sedan', 'name' => 'Sedán', 'description' => 'Vehículo estándar de 4 puertas', 'price_multiplier' => 1.0, 'display_order' => 1],
            ['slug' => 'hatchback', 'name' => 'Hatchback', 'description' => 'Compacto y versátil', 'price_multiplier' => 0.9, 'display_order' => 2],
            ['slug' => 'suv', 'name' => 'SUV', 'description' => 'Mayor superficie, más detalle', 'price_multiplier' => 1.3, 'display_order' => 3],
            ['slug' => 'camioneta', 'name' => 'Camioneta', 'description' => 'Vehículo grande de trabajo', 'price_multiplier' => 1.4, 'display_order' => 4],
            ['slug' => 'deportivo', 'name' => 'Deportivo', 'description' => 'Vehículos de alto rendimiento', 'price_multiplier' => 1.5, 'display_order' => 5],
            ['slug' => 'moto', 'name' => 'Moto', 'description' => 'Motocicletas y scooters', 'price_multiplier' => 0.7, 'display_order' => 6],
        ];

        $vehicleTypeIds = [];
        foreach ($vehicleTypes as $vt) {
            $vtRecord = \App\Models\VehicleType::updateOrCreate(
                ['slug' => $vt['slug']],
                [
                    'name' => $vt['name'],
                    'description' => $vt['description'],
                    'price_multiplier' => $vt['price_multiplier'],
                    'display_order' => $vt['display_order'],
                    'is_active' => true,
                ]
            );
            $vehicleTypeIds[$vt['slug']] = $vtRecord->id;
        }

        // 5. Extras
        $extras = [
            ['slug' => 'pulido-focos', 'name' => 'Pulido de Focos', 'description' => 'Restauración de transparencia y brillo en focos delanteros y traseros.', 'price' => 15000, 'duration_minutes' => 30, 'display_order' => 1],
            ['slug' => 'limpieza-motor', 'name' => 'Limpieza de Motor', 'description' => 'Desengrase y limpieza profunda del compartimento del motor.', 'price' => 20000, 'duration_minutes' => 45, 'display_order' => 2],
            ['slug' => 'tratamiento-cuero', 'name' => 'Tratamiento de Cuero', 'description' => 'Hidratación y protección profesional de asientos y superficies de cuero.', 'price' => 18000, 'duration_minutes' => 40, 'display_order' => 3],
            ['slug' => 'eliminacion-olores', 'name' => 'Eliminación de Olores', 'description' => 'Tratamiento con ozono para eliminar olores persistentes del habitáculo.', 'price' => 12000, 'duration_minutes' => 30, 'display_order' => 4],
            ['slug' => 'proteccion-plastica', 'name' => 'Protección Plástica', 'description' => 'Restauración y protección UV de plásticos exteriores e interiores.', 'price' => 10000, 'duration_minutes' => 25, 'display_order' => 5],
        ];

        $extraIds = [];
        foreach ($extras as $ex) {
            $exRecord = \App\Models\Extra::updateOrCreate(
                ['slug' => $ex['slug']],
                [
                    'name' => $ex['name'],
                    'description' => $ex['description'],
                    'price' => $ex['price'],
                    'duration_minutes' => $ex['duration_minutes'],
                    'display_order' => $ex['display_order'],
                    'is_active' => true,
                ]
            );
            $extraIds[$ex['slug']] = $exRecord->id;
        }

        // 6. Services
        $services = [
            [
                'slug' => 'lavado-premium',
                'name' => 'Lavado Premium',
                'short_description' => 'Lavado exterior e interior con productos de alta gama.',
                'long_description' => 'Lavado exterior e interior con productos de alta gama. Incluye aspirado completo, limpieza de vidrios y acondicionamiento de plásticos.',
                'base_price' => 35000,
                'duration_minutes' => 90,
                'is_featured' => false,
                'display_order' => 1,
                'extras' => [
                    ['slug' => 'limpieza-motor', 'is_default' => false, 'is_required' => false],
                    ['slug' => 'proteccion-plastica', 'is_default' => true, 'is_required' => false],
                ],
            ],
            [
                'slug' => 'detailing-interior',
                'name' => 'Detailing Interior',
                'short_description' => 'Limpieza profunda del habitáculo y tratamiento interior premium.',
                'long_description' => 'Limpieza profunda del habitáculo. Tratamiento de cueros, plásticos, cielo, alfombras y eliminación de olores.',
                'base_price' => 65000,
                'duration_minutes' => 180,
                'is_featured' => true,
                'display_order' => 2,
                'extras' => [
                    ['slug' => 'tratamiento-cuero', 'is_default' => true, 'is_required' => false],
                    ['slug' => 'eliminacion-olores', 'is_default' => true, 'is_required' => false],
                ],
            ],
            [
                'slug' => 'detailing-completo',
                'name' => 'Detailing Completo',
                'short_description' => 'Limpieza profunda interior y exterior con terminación premium.',
                'long_description' => 'Limpieza profunda interior y exterior. Cada rincón del vehículo impecable con terminación premium.',
                'base_price' => 85000,
                'duration_minutes' => 240,
                'is_featured' => true,
                'display_order' => 3,
                'extras' => [
                    ['slug' => 'tratamiento-cuero', 'is_default' => false, 'is_required' => false],
                    ['slug' => 'limpieza-motor', 'is_default' => false, 'is_required' => false],
                    ['slug' => 'proteccion-plastica', 'is_default' => true, 'is_required' => false],
                ],
            ],
            [
                'slug' => 'pulido-de-autos',
                'name' => 'Pulido Profesional',
                'short_description' => 'Corrección de imperfecciones leves y recuperación de brillo.',
                'long_description' => 'Corrección de imperfecciones leves, swirl marks y micro rayaduras. Devuelve el brillo original.',
                'base_price' => 80000,
                'duration_minutes' => 240,
                'is_featured' => true,
                'display_order' => 4,
                'extras' => [
                    ['slug' => 'pulido-focos', 'is_default' => false, 'is_required' => false],
                    ['slug' => 'proteccion-plastica', 'is_default' => false, 'is_required' => false],
                ],
            ],
            [
                'slug' => 'correccion-de-pintura',
                'name' => 'Corrección de Pintura',
                'short_description' => 'Proceso avanzado multi-etapa para defectos severos de pintura.',
                'long_description' => 'Proceso de corrección avanzada en múltiples etapas para defectos severos de pintura.',
                'base_price' => 120000,
                'duration_minutes' => 360,
                'is_featured' => false,
                'display_order' => 5,
                'extras' => [
                    ['slug' => 'pulido-focos', 'is_default' => false, 'is_required' => false],
                ],
            ],
            [
                'slug' => 'tratamiento-ceramico',
                'name' => 'Tratamiento Cerámico',
                'short_description' => 'Protección cerámica profesional de alta durabilidad.',
                'long_description' => 'Protección cerámica profesional de alta durabilidad. Hidrofobicidad extrema y brillo duradero por años.',
                'base_price' => 150000,
                'duration_minutes' => 480,
                'is_featured' => true,
                'display_order' => 6,
                'extras' => [
                    ['slug' => 'pulido-focos', 'is_default' => false, 'is_required' => false],
                    ['slug' => 'proteccion-plastica', 'is_default' => false, 'is_required' => false],
                ],
            ],
            [
                'slug' => 'restauracion-de-focos',
                'name' => 'Restauración de Focos',
                'short_description' => 'Elimina opacidad y amarillamiento para recuperar visibilidad.',
                'long_description' => 'Elimina opacidad y amarillamiento de los focos. Recupera visibilidad y estética original.',
                'base_price' => 35000,
                'duration_minutes' => 60,
                'is_featured' => false,
                'display_order' => 7,
                'extras' => [],
            ],
        ];

        foreach ($services as $srv) {
            $srvRecord = \App\Models\Service::updateOrCreate(
                ['slug' => $srv['slug']],
                [
                    'name' => $srv['name'],
                    'short_description' => $srv['short_description'],
                    'long_description' => $srv['long_description'],
                    'base_price' => $srv['base_price'],
                    'duration_minutes' => $srv['duration_minutes'],
                    'is_featured' => $srv['is_featured'],
                    'display_order' => $srv['display_order'],
                    'is_active' => true,
                ]
            );

            // Sync relationship
            $syncData = [];
            foreach ($srv['extras'] as $exRel) {
                $extraId = $extraIds[$exRel['slug']] ?? null;
                if ($extraId) {
                    $syncData[$extraId] = [
                        'is_default' => $exRel['is_default'],
                        'is_required' => $exRel['is_required'],
                    ];
                }
            }
            $srvRecord->extras()->sync($syncData);
        }

        // 7. Admin User
        $adminEmail = env('ADMIN_EMAIL', 'admin@highcontrastdetailing.cl');
        $adminPassword = env('ADMIN_PASSWORD', 'admin123456');
        $adminName = env('ADMIN_NAME', 'Admin High Contrast');
        $adminPhone = env('ADMIN_PHONE', '+56 9 8765 4321');

        if (!\App\Models\User::where('email', $adminEmail)->exists()) {
            \App\Models\User::create([
                'email' => $adminEmail,
                'password' => bcrypt($adminPassword),
                'name' => $adminName,
                'phone' => $adminPhone,
                'role' => 'ADMIN',
                'status' => 'ACTIVE',
            ]);
        }

        // 8. Email Templates
        $emailTemplates = [
            [
                'key' => 'CONFIRMED',
                'name' => 'Confirmación de Reserva',
                'subject' => 'Reserva Confirmada: {servicio_nombre}',
                'title' => '¡Tu cita ha sido confirmada!',
                'body_text' => "Nos complace informarte que tu reserva ha sido programada con éxito. A continuación encontrarás todos los detalles del servicio.",
                'badge_text' => 'Confirmada',
                'badge_color' => '#22C55E',
            ],
            [
                'key' => 'CANCELLED',
                'name' => 'Cancelación de Reserva',
                'subject' => 'Reserva Cancelada: {servicio_nombre}',
                'title' => 'Tu cita ha sido cancelada',
                'body_text' => "Lamentamos informarte que tu reserva ha sido cancelada.\n\nMotivo: {motivo_cancelacion}",
                'badge_text' => 'Cancelada',
                'badge_color' => '#EF4444',
            ],
            [
                'key' => 'RESCHEDULED',
                'name' => 'Reagendamiento de Reserva',
                'subject' => 'Reserva Reagendada: {servicio_nombre}',
                'title' => 'Tu cita ha sido reagendada',
                'body_text' => "Te informamos que tu cita ha sido reprogramada a un nuevo horario. Por favor revisa los nuevos detalles a continuación.",
                'badge_text' => 'Reagendada',
                'badge_color' => '#F59E0B',
            ]
        ];

        foreach ($emailTemplates as $tpl) {
            \App\Models\EmailTemplate::updateOrCreate(
                ['key' => $tpl['key']],
                $tpl
            );
        }
    }
}
