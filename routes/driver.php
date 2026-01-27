<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DriverAvailabilityController;
use App\Http\Controllers\UserLogin;


/*
|--------------------------------------------------------------------------
| Driver Authentication Routes
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', fn() => view('login_form'))->name('login');
});

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
    Route::get('/home', fn() => view('driver/home'))->name('home');
    Route::get('/availability/form', fn() => view('driver_availability'))->name('availability.form');
    Route::post('/availability', [DriverAvailabilityController::class, 'store'])->name('availability.store');
});
