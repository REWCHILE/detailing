<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;

return Application::configure(basePath: dirname(__DIR__))
    ->registered(function ($app) {
        $app->usePublicPath(
            is_dir(base_path('../public_html'))
                ? base_path('../public_html')
                : base_path('public')
        );
    })
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Web Application Firewall (WAF) to intercept threats
        $middleware->prepend(\App\Http\Middleware\WebApplicationFirewall::class);
        // Global security headers on every response
        $middleware->append(\App\Http\Middleware\SecurityHeaders::class);
        // Track page visits with geolocation (skips admin/api/assets automatically)
        $middleware->append(\App\Http\Middleware\TrackPageVisit::class);

        $middleware->alias([
            'role' => \App\Http\Middleware\RoleMiddleware::class,
        ]);
        $middleware->validateCsrfTokens(except: [
            'api/payments/webhook',
            'api/bookings/draft-lead',
            'api/bookings/*',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->shouldRenderJsonWhen(
            fn (Request $request) => $request->is('api/*'),
        );
    })
    ->booting(function () {
        // Rate limiter: public API endpoints
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->ip());
        });

        // Rate limiter: booking creation (stricter)
        RateLimiter::for('bookings', function (Request $request) {
            return Limit::perMinute(5)->by($request->ip());
        });

        // Rate limiter: webhooks
        RateLimiter::for('webhooks', function (Request $request) {
            return Limit::perMinute(30)->by($request->ip());
        });
    })
    ->create();

