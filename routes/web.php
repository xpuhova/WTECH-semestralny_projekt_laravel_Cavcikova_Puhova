<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;

Route::get('/', function () {
    return view('landing_page.index');
})->name('home');

Route::get('/register', function () {
    return view('pages.auth.register');
})->name('register');

Route::get('/profile', function () {
    return view('profile.user_profile');
})->middleware('auth')->name('profile');

Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

Route::get('/login', function () {
    return view('pages.auth.login');
})->name('login');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login.store');
