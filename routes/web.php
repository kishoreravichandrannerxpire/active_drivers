<?php

// Admin Routes
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

//Trial routes
use App\Http\Controllers\TrialController;

Route::get('/trial', [TrialController::class, 'index'])
    ->name('trial');
Route::get('/trial2', [TrialController::class, 'second'])
    ->name('trial2');        

// login routes
use App\Http\Controllers\UserLogin;
Route::get('/login', [UserLogin::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserLogin::class, 'login'])->name('login.submit');
Route::post('/logout', [UserLogin::class, 'logout'])->name('logout');


// Signup route
Route::get('/signup', fn() => view('signup_form'))->name('signup');
Route::post('/signup', [UserController::class, 'store'])->name('signup.store');
