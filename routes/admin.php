<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DriverController;
use App\Http\Controllers\Admin\DriverAvailabilityController;
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
| Admin Authentication Routes
|--------------------------------------------------------------------------
*/
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Protected Admin Routes
|--------------------------------------------------------------------------
|
| Only authenticated admins can access these routes
| Middleware: admin, prevent-back-history
|
*/
Route::middleware(['admin', 'prevent-back-history'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Drivers
    Route::resource('drivers', DriverController::class)->except(['show']);
    Route::resource('drivers/availability', DriverAvailabilityController::class)->except(['show']);

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
    Route::get('bookings/allbookings', [BookingsController::class, 'getAllBookings'])->name('bookings.all-bookings');

    // Permissions
    Route::resource('permissions', PermissionController::class)->except(['show']);
});
