<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (!app()->runningInConsole() || (Schema::hasTable('business_profiles') && Schema::hasTable('business_hours'))) {
            try {
                $profile = \App\Models\BusinessProfile::firstOrCreate(['id' => 'default']);
                view()->share('shopProfile', $profile);

                if (Schema::hasTable('services')) {
                    \App\Models\Service::where('slug', 'tratamiento-ceramico')->delete();
                    $orderPath = storage_path('app/category_order.json');
                    $navCategoryOrder = file_exists($orderPath) ? json_decode(file_get_contents($orderPath), true) : ['limpieza', 'correccion', 'ceramico', 'especiales'];
                    $navServices = \App\Models\Service::where('is_active', true)->orderBy('display_order')->get()->groupBy('category');
                    view()->share('navCategoryOrder', $navCategoryOrder);
                    view()->share('navServices', $navServices);
                }
            } catch (\Exception $e) {
                // Prevent database issues from crashing CLI/bootstrap
            }
        }
    }
}
