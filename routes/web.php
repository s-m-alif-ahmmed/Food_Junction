<?php

use App\Http\Controllers\Web\Frontend\HomeController;
use App\Http\Controllers\Web\Backend\DashboardController;
use App\Http\Controllers\Web\Frontend\ContactController;
use App\Http\Controllers\Web\Frontend\ProductReviewController;
use App\Http\Controllers\Web\Frontend\CartController;
use Illuminate\Support\Facades\Route;

//! Route for Landing Page
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/food-junction/{page_slug}', [HomeController::class, 'dynamicPage'])->name('user.dynamic.page');
Route::get('/sweets', [HomeController::class, 'sweets'])->name('sweets');
Route::get('/sweets/detail/{product_slug}', [HomeController::class, 'detail'])->name('sweets.detail');
Route::get('/checkout', [HomeController::class, 'checkout'])->name('checkout');
Route::get('/confirm-order', [HomeController::class, 'confirmOrder'])->name('confirm.order');

//Contact
Route::get('/contact', [ContactController::class, 'contact'])->name('contact');
Route::post('/contact/store', [ContactController::class, 'store'])->name('contact.store');

//Sweet Review
Route::post('/sweet/review/store', [ProductReviewController::class, 'store'])->name('sweet.review.store');

//Cart
Route::get('/cart', [CartController::class, 'cart'])->name('cart');
Route::post('/add-cart', [CartController::class, 'addToCart'])->name('new.cart');
Route::post('/cart/remove', [CartController::class, 'removeFromCart'])->name('remove.cart');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'userDashboard'])->name('user.dashboard');
});

require __DIR__ . '/auth.php';
