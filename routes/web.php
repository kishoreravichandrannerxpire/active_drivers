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


use App\Http\Controllers\DriverController;

Route::get('/driver-form', [DriverController::class, 'showForm'])->name('driver.form');
Route::post('/driver-form', [DriverController::class, 'submitForm'])->name('driver.submit');


use App\Http\Controllers\BannerController;

Route::resource('banners', BannerController::class);
Route::get('/view-banners', [BannerController::class, 'viewActive'])->name('banners.view');