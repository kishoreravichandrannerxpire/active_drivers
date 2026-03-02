<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Driver\DriverAvailabilityController;
use App\Http\Controllers\Driver\DriverProfileController;
use App\Http\Controllers\UserLogin;
use Illuminate\Support\Facades\Auth;


/*
|--------------------------------------------------------------------------
| Driver Authentication Routes
|--------------------------------------------------------------------------
*/
Route::get('/login', fn() => view('login_form'))->name('login');

Route::get('/logout', fn() => redirect('/')->name('logout'))->name('logout');

/*
|--------------------------------------------------------------------------
| Protected Driver Routes
|--------------------------------------------------------------------------
|
| Only authenticated drivers can access these routes
| Middleware: driver, prevent-back-history
|
*/
Route::middleware(['Driver', 'prevent-back-history'])->group(function () {
    // Route::get('/home', fn() => view('driver/home'))->name('home');
    Route::get('/home', [DriverAvailabilityController::class, 'index'])->name('home');

    Route::get('/profile', [DriverProfileController::class, 'show'])->name('profile');
    Route::post('/profile/update', [DriverProfileController::class, 'update'])->name('profile.update');

    Route::resource('availability', DriverAvailabilityController::class)->except(['create', 'show']);
});

Route::middleware(['auth', 'can:isDriver'])->group(function () {
    Route::get('/driver/home', function () {
        return view('driver.home');
    })->name('driver.home');
});
