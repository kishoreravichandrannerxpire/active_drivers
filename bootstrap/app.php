<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\CustomerMiddleware;
use App\Http\Middleware\DriverMiddleware;
use App\Http\Middleware\PreventBackHistory;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
       using: function () {
            Route::middleware('web')->group(base_path('routes/web.php'));
            Route::middleware('web')->prefix('admin')->name('admin.')->group(base_path('routes/admin.php'));
            Route::middleware('web')->prefix('customer')->name('customer.')->group(base_path('routes/customer.php'));
            Route::middleware('web')->prefix('driver')->name('driver.')->group(base_path('routes/driver.php'));
        },
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (\Illuminate\Foundation\Configuration\Middleware $middleware) {
        $middleware->alias([
            'admin_or_anonymous' => AdminMiddleware::class,
            'admin' => AdminMiddleware::class,
            'prevent-back-history' => PreventBackHistory::class,
            'Customer' => CustomerMiddleware::class,
            'Driver' => DriverMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
