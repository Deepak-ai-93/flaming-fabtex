<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Here is where you can register web routes for your application. These
| routes are loaded by the ServiceProvider within a given middleware group.
| Most of them will be selected by the RequestController.
*/

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes(['register' => false]);

// Shop routes
Route::get('/shop', [\App\Http\Controllers\HomeController::class, 'shop'])->name('shop.index');
Route::get('/shop/{category?}', [\App\Http\Controllers\HomeController::class, 'shop'])->where('category', '.*');

// Product routes
Route::get('/product/{slug}', [\App\Http\Controllers\HomeController::class, 'product'])->name('product.show');

// Cart routes
Route::get('/cart', [\App\Http\Controllers\HomeController::class, 'cart'])->name('cart.index');

// Checkout routes
Route::get('/checkout', [\App\Http\Controllers\HomeController::class, 'checkout'])->name('checkout.index');

// Account routes (guest checkout + optional login)
Route::get('/my-account', [\App\Http\Controllers\HomeController::class, 'account'])->name('account.dashboard');
Route::get('/my-account/orders', [\App\Http\Controllers\HomeController::class, 'orders'])->name('account.orders');
Route::get('/my-account/orders/{id}', [\App\Http\Controllers\HomeController::class, 'orderDetail'])->name('account.order');
Route::get('/my-account/profile', [\App\Http\Controllers\HomeController::class, 'profile'])->name('account.profile');

// Quote/RFQ routes
Route::get('/request-a-quote', [\App\Http\Controllers\HomeController::class, 'quote'])->name('quote.index');

// Content pages
Route::view('/about-us', 'pages.about')->name('page.about');
Route::view('/infrastructure', 'pages.infrastructure')->name('page.infrastructure');
Route::view('/our-store', 'pages.our-store')->name('page.store');
Route::view('/contact-us', 'pages.contact')->name('page.contact');
Route::view('/privacy-policy', 'pages.privacy')->name('page.privacy');
Route::view('/refund-returns', 'pages.refund')->name('page.refund');

// Blog routes
Route::get('/blog', [\App\Http\Controllers\HomeController::class, 'blog'])->name('blog.index');
Route::get('/blog/{slug}', [\App\Http\Controllers\HomeController::class, 'blogPost'])->name('blog.show');