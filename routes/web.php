<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DriverAvailabilityController;
use App\Http\Controllers\Admin\DriverController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\CarController;
use App\Http\Controllers\Admin\BookingsController;
use App\Http\Controllers\Admin\PermissionController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', fn() => view('welcome'));

Route::get('/driver/availability/form', fn() => view('driver_availability'));
Route::post('/driver/availability', [DriverAvailabilityController::class, 'store'])->name('availability.store');

Route::get('/home', fn() => view('home'))->name('home');

Route::get('/test-middleware', function () {
    $middleware = app()->make(\App\Http\Middleware\AdminMiddleware::class);
    return 'Middleware exists: ' . get_class($middleware);
});


/*
|--------------------------------------------------------------------------
| Admin Authentication Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [LoginController::class, 'login'])->name('admin.login.submit');
    Route::get('/logout', [LoginController::class, 'logout'])->name('admin.logout');
});

/*
|--------------------------------------------------------------------------
| Protected Admin Routes
|--------------------------------------------------------------------------
|
| Only authenticated admins can access these routes
|
*/
Route::prefix('admin')->name('admin.')->middleware(['admin_or_anonymous'])->group(function () {
    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Drivers
    Route::resource('drivers', DriverController::class)->except(['show']);

    // Banners
    Route::resource('banners', BannerController::class)->except(['show']);
    Route::get('view-banners', [BannerController::class, 'viewActive'])->name('banners.view');

    // Users
    Route::resource('user', UserController::class)->except(['show']);

    // Customers
    Route::resource('customers', CustomerController::class)->except(['show']);

    // Cars
    Route::resource('cars', CarController::class)->except(['show']);

    // Bookings
    Route::resource('bookings', BookingsController::class)->except(['show']);
    Route::get('customers/{id}/cars', [BookingsController::class, 'getCustomerCars'])->name('customers.cars');

    //Permissions
    Route::resource('permissions', PermissionController::class)->except(['show']);
});
