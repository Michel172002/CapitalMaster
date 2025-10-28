<?php

use App\Http\Controllers\Auth\Login;
use App\Http\Controllers\Auth\Register as AuthRegister;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [AuthRegister::class, 'index']);
Route::get('/login', [Login::class, 'index'])->name('login');
