<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserLogin;
use App\Http\Controllers\Customer\DashboardCustomer;
use App\Http\Controllers\Customer\CustomerProfile;

/*
|--------------------------------------------------------------------------
| Customer Authentication Routes
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', fn() => view('login_form'))->name('login');
});

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

    Route::resource('profile', CustomerProfile::class);
});
