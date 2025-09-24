<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\DriverAvailabilityController;

Route::get('/driver/availability/form', function () {
    return view('driver_availability');
});

Route::post('/driver/availability', [DriverAvailabilityController::class, 'store'])->name('availability.store');


use App\Http\Controllers\Admin\DriverController;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('drivers', DriverController::class)->except(['show']);
});


use App\Http\Controllers\Admin\BannerController;
Route::get('/admin/banners/index', [BannerController::class, 'index']);
Route::resource('/admin/banners', BannerController::class)->except(['show']);
Route::get('/admin/view-banners', [BannerController::class, 'viewActive'])->name('admin.banners.view');

use App\Http\Controllers\HomeController;
Route::get('/home', function () {
    return view('home');
});

use App\Http\Controllers\Admin\UserController;
Route::get('/admin/user/form', [UserController::class, 'showform'])->name('admin.user.form');
Route::post('/admin/user/submit', [UserController::class, 'submitform'])->name('admin.user.submit');

use App\Http\Controllers\Admin\LoginController;

Route::get('/admin/login', [LoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [LoginController::class, 'login'])->name('admin.login.submit');
Route::get('/admin/logout', [LoginController::class, 'logout'])->name('admin.logout');

// Protect dashboard using manual session check (NOT auth middleware)
Route::get('/admin/dashboard', function () {
    if (!session()->has('admin')) {
        return redirect()->route('admin.login')->withErrors(['msg' => 'Please login first']);
    }
    return view('admin.dashboard');
})->name('admin.dashboard');

use App\Http\Controllers\Admin\DashboardController;
Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

use App\Http\Controllers\Admin\CustomerController;
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('customers', CustomerController::class)->except(['show']);
});

use App\Http\Controllers\Admin\CarController;
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('cars', CarController::class)->except(['show']);
});