<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminCatalogController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Public static pages
Route::get('/nosotros', [PageController::class, 'nosotros'])->name('nosotros');
Route::get('/limpieza-y-detallado', [PageController::class, 'limpiezaYDetallado'])->name('limpieza-y-detallado');
Route::get('/sellado-ceramico', [PageController::class, 'selladoCeramico'])->name('sellado-ceramico');
Route::get('/pulido-de-autos-santiago', [PageController::class, 'pulidoDeAutos'])->name('pulido-de-autos');
Route::get('/proteccion-parabrisas-santiago', [PageController::class, 'proteccionParabrisas'])->name('proteccion-parabrisas');
Route::get('/detailing-interior', [PageController::class, 'detailingInterior'])->name('detailing-interior');
Route::get('/tratamiento-ceramico', [PageController::class, 'tratamientoCeramico'])->name('tratamiento-ceramico');
Route::get('/restauracion-de-focos', [PageController::class, 'restauracionDeFocos'])->name('restauracion-de-focos');
Route::get('/sitemap.xml', [PageController::class, 'sitemap'])->name('sitemap');

// Redirects for legacy SEO/Next.js paths
Route::redirect('/cotizar', '/reserva');
Route::redirect('/pulido-de-autos', '/pulido-de-autos-santiago');

// Booking Flow routes
Route::get('/reserva', [BookingController::class, 'showReservaPage'])->name('booking.reserva');
Route::get('/reserva/{publicId}', [BookingController::class, 'show'])->name('booking.status');
Route::get('/api/bookings/availability', [BookingController::class, 'getAvailability'])->middleware('throttle:api');
Route::get('/api/bookings/month-status', [BookingController::class, 'getMonthStatus'])->middleware('throttle:api');
Route::post('/api/bookings', [BookingController::class, 'store'])->middleware('throttle:bookings');
Route::post('/api/bookings/draft-lead', [BookingController::class, 'saveDraftLead'])->middleware('throttle:api');
Route::post('/api/payments/webhook', [BookingController::class, 'webhook'])->middleware('throttle:webhooks');

Route::get('/dashboard', function () {
    if (auth()->user()->isAdmin()) {
        return redirect()->route('admin.dashboard');
    }
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:ADMIN'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/calendario', [AdminController::class, 'calendario'])->name('admin.calendario');
    Route::get('/admin/citas', [AdminController::class, 'citasIndex'])->name('admin.citas');
    Route::get('/admin/leads', [AdminController::class, 'leadsIndex'])->name('admin.leads');
    Route::get('/admin/clientes', [\App\Http\Controllers\AdminController::class, 'clientesIndex'])->name('admin.clientes');

    // Analíticas
    Route::get('/admin/paginas', [\App\Http\Controllers\AdminCatalogController::class, 'paginasIndex'])->name('admin.paginas');
    Route::get('/api/admin/paginas/map-data', [\App\Http\Controllers\AdminCatalogController::class, 'paginasMapData']);
    Route::post('/admin/paginas/seo', [\App\Http\Controllers\AdminCatalogController::class, 'seoUpdate'])->name('admin.paginas.seo');

    // API calls from admin front-end
    Route::get('/api/admin/calendario/events', [AdminController::class, 'getCalendarioEvents']);
    Route::post('/api/admin/schedule-blocks', [AdminController::class, 'storeScheduleBlock']);
    Route::delete('/api/admin/schedule-blocks/{id}', [AdminController::class, 'deleteScheduleBlock']);
    Route::post('/api/admin/bookings', [AdminController::class, 'storeBooking']);
    Route::put('/api/admin/bookings/{id}/status', [AdminController::class, 'updateBookingStatus']);
    Route::delete('/api/admin/bookings/{id}', [AdminController::class, 'deleteBooking']);
    Route::post('/api/admin/leads/{id}/status', [AdminController::class, 'updateLeadStatus']);
    Route::delete('/api/admin/leads/{id}', [AdminController::class, 'deleteLead']);

    // Catalog Services
    Route::get('/admin/servicios', [AdminCatalogController::class, 'servicesIndex'])->name('admin.servicios');
    Route::get('/admin/servicios/crear', [AdminCatalogController::class, 'servicesCreate'])->name('admin.servicios.create');
    Route::get('/admin/servicios/{id}/editar', [AdminCatalogController::class, 'servicesEdit'])->name('admin.servicios.edit');
    Route::post('/admin/servicios', [AdminCatalogController::class, 'servicesStore']);
    Route::put('/admin/servicios/{id}', [AdminCatalogController::class, 'servicesUpdate'])->name('admin.servicios.update');
    Route::delete('/admin/servicios/{id}', [AdminCatalogController::class, 'servicesDelete'])->name('admin.servicios.delete');
    Route::post('/admin/servicios/{id}/move-up', [AdminCatalogController::class, 'servicesMoveUp'])->name('admin.servicios.move-up');
    Route::post('/admin/servicios/{id}/move-down', [AdminCatalogController::class, 'servicesMoveDown'])->name('admin.servicios.move-down');
    Route::post('/admin/categorias/{cat}/move-up', [AdminCatalogController::class, 'categoriesMoveUp'])->name('admin.categorias.move-up');
    Route::post('/admin/categorias/{cat}/move-down', [AdminCatalogController::class, 'categoriesMoveDown'])->name('admin.categorias.move-down');

    // Catalog Extras
    Route::get('/admin/extras', [AdminCatalogController::class, 'extrasIndex'])->name('admin.extras');
    Route::get('/admin/extras/crear', [AdminCatalogController::class, 'extrasCreate'])->name('admin.extras.create');
    Route::get('/admin/extras/{id}/editar', [AdminCatalogController::class, 'extrasEdit'])->name('admin.extras.edit');
    Route::post('/admin/extras', [AdminCatalogController::class, 'extrasStore']);
    Route::put('/admin/extras/{id}', [AdminCatalogController::class, 'extrasUpdate'])->name('admin.extras.update');
    Route::delete('/admin/extras/{id}', [AdminCatalogController::class, 'extrasDelete'])->name('admin.extras.delete');

    // Catalog VehicleTypes
    Route::get('/admin/vehiculos', [AdminCatalogController::class, 'vehiclesIndex'])->name('admin.vehiculos');
    Route::post('/admin/vehiculos', [AdminCatalogController::class, 'vehiclesStore']);
    Route::put('/admin/vehiculos/{id}', [AdminCatalogController::class, 'vehiclesUpdate'])->name('admin.vehiculos.update');
    Route::delete('/admin/vehiculos/{id}', [AdminCatalogController::class, 'vehiclesDelete'])->name('admin.vehiculos.delete');

    // Payments configs
    Route::get('/admin/pasarelas', [AdminCatalogController::class, 'pasarelasIndex'])->name('admin.pasarelas');
    Route::post('/admin/pasarelas', [AdminCatalogController::class, 'pasarelasUpdate']);

    // Settings config
    Route::get('/admin/configuracion', [AdminCatalogController::class, 'configuracionIndex'])->name('admin.configuracion');
    Route::post('/admin/configuracion', [AdminCatalogController::class, 'configuracionUpdate']);
    Route::post('/api/admin/configuracion/test-smtp', [AdminCatalogController::class, 'testSmtp']);

    // Security WAF
    Route::get('/admin/seguridad', [\App\Http\Controllers\SecurityWafController::class, 'index'])->name('admin.seguridad');
    Route::post('/admin/seguridad/settings', [\App\Http\Controllers\SecurityWafController::class, 'updateSettings'])->name('admin.seguridad.settings');
    Route::post('/admin/seguridad/block', [\App\Http\Controllers\SecurityWafController::class, 'blockIp'])->name('admin.seguridad.block');
    Route::delete('/admin/seguridad/unblock/{id}', [\App\Http\Controllers\SecurityWafController::class, 'unblockIp'])->name('admin.seguridad.unblock');
    Route::post('/admin/seguridad/whitelist', [\App\Http\Controllers\SecurityWafController::class, 'whitelistIp'])->name('admin.seguridad.whitelist');
    Route::delete('/admin/seguridad/unwhitelist/{id}', [\App\Http\Controllers\SecurityWafController::class, 'unwhitelistIp'])->name('admin.seguridad.unwhitelist');
    Route::post('/admin/seguridad/clear-logs', [\App\Http\Controllers\SecurityWafController::class, 'clearLogs'])->name('admin.seguridad.clear-logs');

    // Manual documentation
    Route::get('/admin/documentacion', [AdminCatalogController::class, 'documentacionIndex'])->name('admin.documentacion');

    // Hero Sliders CRUD
    Route::get('/admin/sliders', [\App\Http\Controllers\AdminHeroController::class, 'index'])->name('admin.sliders');
    Route::post('/admin/sliders', [\App\Http\Controllers\AdminHeroController::class, 'store'])->name('admin.sliders.store');
    Route::put('/admin/sliders/{id}', [\App\Http\Controllers\AdminHeroController::class, 'update'])->name('admin.sliders.update');
    Route::delete('/admin/sliders/{id}', [\App\Http\Controllers\AdminHeroController::class, 'destroy'])->name('admin.sliders.destroy');
});

require __DIR__.'/auth.php';

