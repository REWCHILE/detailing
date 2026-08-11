<?php
// Script temporal para correr las migraciones en producción
// Ajustado para la estructura donde public_html es la carpeta pública y detailing-app contiene el núcleo de Laravel.
require __DIR__.'/../detailing-app/vendor/autoload.php';
$app = require_once __DIR__.'/../detailing-app/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    echo "<h1>Ejecutando migraciones...</h1>";
    Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
    echo "<pre>" . Illuminate\Support\Facades\Artisan::output() . "</pre>";
    echo "<h2 style='color:green;'>¡Migración completada con éxito!</h2>";
    echo "<p style='color:red; font-weight:bold;'>Por seguridad, recuerda BORRAR este archivo (run_migrations.php) de public_html inmediatamente después de ejecutarlo.</p>";
} catch (\Exception $e) {
    echo "<h2 style='color:red;'>Ocurrió un error al migrar:</h2>";
    echo "<pre>" . $e->getMessage() . "</pre>";
}
