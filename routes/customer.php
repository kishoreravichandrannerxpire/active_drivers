<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserLogin;
use App\Http\Controllers\Customer\DashboardCustomer;
use App\Http\Controllers\Customer\CustomerProfile;
use App\Http\Controllers\Customer\DriverAvailabilityController;
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
    Route::get('/dashboard', [DashboardCustomer::class, 'index'])->name('dashboard');
    Route::get('/myprofile', [CustomerProfile::class, 'show'])->name('myprofile');
    Route::get('/driver-availability', [DriverAvailabilityController::class, 'index'])->name('driver-availability');
    Route::post('/driver-availability', [DriverAvailabilityController::class, 'index'])->name('customer.driver-availability');
    Route::get('/available-drivers', [DriverAvailabilityController::class, 'getAvailableDrivers'])->name('available-drivers');
    
    Route::post('profile/{id}', [CustomerProfile::class, 'update'])->name('profile.update');
});

Route::middleware(['auth', 'can:customer-home'])->group(function () {
    Route::get('/customer/home', function () {
return view('customer.home');
    })->name('customer.home');
});
