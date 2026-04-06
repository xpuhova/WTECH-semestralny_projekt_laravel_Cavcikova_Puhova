<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing_page.index');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/profile', function () {
    return view('pages.settings.⚡profile');
})->middleware('auth')->name('profile.edit');

Route::get('/security', function () {
    return view('pages.settings.⚡security');
})->middleware('auth')->name('security.edit');
