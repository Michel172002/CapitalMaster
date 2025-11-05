<?php

use App\Http\Controllers\Auth\Login;
use App\Http\Controllers\Auth\Register as AuthRegister;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GoogleLoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [AuthRegister::class, 'index'])->name('register');
Route::get('/login', [Login::class, 'index'])->name('login');
Route::get('/google/redirect', [GoogleLoginController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('/google/callback', [GoogleLoginController::class, 'handleGoogleCallback'])->name('google.callback');
Route::post('/logout', [Login::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/complete-profile', [AuthRegister::class, 'completeProfile'])->name('complete-profile');
});
