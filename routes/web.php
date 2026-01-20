<?php

// Admin Routes
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
Route::get('/', fn() => view('home')); //removed welcome page

Route::get('/driver/availability/form', fn() => view('driver_availability'));
Route::post('/driver/availability', [DriverAvailabilityController::class, 'store'])->name('availability.store');

Route::get('/customer/create/form', fn() => view('customer_create_form'));

Route::get('/home', fn() => view('home'))->name('home');

Route::get('/test-middleware', function () {
    $middleware = app()->make(\App\Http\Middleware\AdminMiddleware::class);
    return 'Middleware exists: ' . get_class($middleware);
});

Route::get('/home/driver', fn() => view('driver_home'))->name('driver.home');


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
Route::prefix('admin')->name('admin.')->middleware(['admin','Customer','prevent-back-history'])->group(function () {
    
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
// Route::resource('cvs', App\Http\Controllers\CvsController::class);

// Customer Routes
use App\Http\Controllers\Customer\LoginCustomer;

Route::get('/home/customer', fn() => view('customer/customer_home'))->name('customer.home');

Route::prefix('customer')->group(function () {
    Route::get('/login', [LoginCustomer::class, 'showLoginForm'])->name('customer.login');
    Route::post('login', [LoginCustomer::class, 'login'])->name('customer.login.submit');
    Route::get('/logout', [LoginCustomer::class, 'logout'])->name('customer.logout');
});
Route::prefix('customer')->name('customer.')->middleware(['Customer','prevent-back-history'])->group(function () {
    
    Route::get('/dashboard', [App\Http\Controllers\Customer\DashboardCustomer::class, 'index'])->name('dashboard');

    Route::resource('profile', App\Http\Controllers\Customer\CustomerProfile::class);

});

use App\Http\Controllers\TrialController;

Route::get('/trial', [TrialController::class, 'index'])
    ->name('trial');
Route::get('/trial2', [TrialController::class, 'second'])
    ->name('trial2');        

Route::get('/login_form', [TrialController::class, 'login_form'])
    ->name('login_form');