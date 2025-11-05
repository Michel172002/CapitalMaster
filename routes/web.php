<?php

use App\Http\Controllers\Auth\Login;
use App\Http\Controllers\Auth\Register as AuthRegister;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [AuthRegister::class, 'index'])->name('register');
Route::get('/login', [Login::class, 'index'])->name('login');
Route::post('/logout', [Login::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
});
