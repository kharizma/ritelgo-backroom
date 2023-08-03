<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\EmailValidationController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\HomeController;

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

Route::get('/email/verify/{id}/{hash}', EmailValidationController::class)->middleware(['auth', 'signed'])->name('verification.verify');

Route::get('/logout', LogoutController::class)->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/home', HomeController::class)->name('home');
});