<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserLogin;
use App\Http\Controllers\Customer\CustomerProfile;
use App\Http\Controllers\Customer\DriverAvailabilityController;
use App\Http\Controllers\Customer\BookingController;
use App\Http\Controllers\Customer\CustomerCarsController;
use Illuminate\Support\Facades\Auth; 

/*
|--------------------------------------------------------------------------
| Customer Authentication Routes
|--------------------------------------------------------------------------
*/
Route::get('/login', fn() => view('login_form'))->name('login');

Route::get('/logout', fn() => redirect('/')->name('logout'))->name('logout');

/*
|--------------------------------------------------------------------------
| Protected Customer Routes
|--------------------------------------------------------------------------
|
| Only authenticated customers can access these routes
| Middleware: customer, prevent-back-history
|
*/
Route::middleware(['Customer', 'prevent-back-history'])->group(function () {
    Route::get('/home', fn() => view('customer/home'))->name('home');
    Route::get('/myprofile', [CustomerProfile::class, 'show'])->name('myprofile');
    Route::get('/driver-availability', [DriverAvailabilityController::class, 'index'])->name('driver-availability');
    Route::post('/driver-availability', [DriverAvailabilityController::class, 'index'])->name('customer.driver-availability');
    Route::get('/available-drivers', [DriverAvailabilityController::class, 'getAvailableDrivers'])->name('available-drivers');
    // My Bookings for customers
    Route::get('/my-bookings', [BookingController::class, 'index'])->name('my-bookings');
    // Booking flow for customers
    Route::get('/booking', [BookingController::class, 'create'])->name('booking');
    Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
    
    Route::post('profile/{id}', [CustomerProfile::class, 'update'])->name('profile.update');
    Route::resource('mycars', CustomerCarsController::class)->except(['show']);
});
