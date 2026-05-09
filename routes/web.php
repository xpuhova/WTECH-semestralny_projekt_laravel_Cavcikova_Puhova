<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProductController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;
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

Route::get('/product/{id}', [ProductController::class, 'detail'])->name('detail');

Route::get('/products/{page}', [ProductController::class, 'categoryPage'])
    ->name('category_page');

Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

Route::get('/login', function () {
    return view('pages.auth.login');
})->name('login');

Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');

Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');

Route::post('/cart/delete', [CartController::class, 'delete'])->name('cart.delete');

Route::get('/cart', [CartController::class, 'cart'])->name('cart');

Route::post('/checkout/storeAddress', [CheckoutController::class, 'storeAddress'])->name('checkout.storeAddress');

Route::get('/checkout/address', [CheckoutController::class, 'address'])->name('checkout.address');

Route::get('/checkout/payment', [CheckoutController::class, 'payment'])->name('checkout.payment');

Route::post('/checkout/makeOrder', [CheckoutController::class, 'makeOrder'])->name('checkout.makeOrder');

Route::get('/search', [ProductController::class, 'search'])->name('search');

Route::get('/admin', [AdminController::class, 'inventory'])->middleware(['auth', 'admin'])->name('admin.inventory');

Route::get('/admin/edit/{id}', [AdminController::class, 'edit'])->middleware(['auth', 'admin'])->name('admin.edit');

Route::put('/admin/edit/{product}', [AdminController::class, 'update'])->middleware(['auth', 'admin'])->name('admin.update');
