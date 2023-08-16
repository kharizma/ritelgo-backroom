<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\EmailValidationController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Backroom\Master\UserController;
use App\Http\Controllers\Backroom\Master\BusinessTypeController;
use App\Http\Controllers\Backroom\Master\PackageSubscriptionController;
use App\Http\Controllers\Backroom\Master\PackageSubscriptionDetailController;
use App\Http\Controllers\Backroom\InvoiceController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('show-login');
    Route::post('/login', [LoginController::class, 'login'])->name('login');
});

Route::get('/email/verify/{id}/{hash}', EmailValidationController::class)->middleware(['signed'])->name('verification.verify');

Route::get('/logout', LogoutController::class)->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/home', HomeController::class)->name('home');

    Route::resource('invoices',InvoiceController::class)->only([
        'index'
    ]);

    Route::prefix('master')->as('master.')->group(function () {
        Route::resource('business-types',BusinessTypeController::class)->only([
            'index', 'store', 'update', 'destroy'
        ]);

        Route::resource('users',UserController::class)->except([
            'show'
        ]);
        Route::put('/users/activate/{user}', [UserController::class,'activate'])->name('users.activate');
        Route::put('/users/deactivate/{user}', [UserController::class,'deactivate'])->name('users.deactivate');

        Route::resource('package-subscriptions',PackageSubscriptionController::class)->only([
            'index', 'store', 'update'
        ]);

        Route::resource('package-subscription-details',PackageSubscriptionDetailController::class);
    });
});