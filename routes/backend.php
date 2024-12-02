<?php

use App\Http\Controllers\Web\Backend\DashboardController;
use App\Http\Controllers\Web\Backend\UserController;
use App\Http\Controllers\Web\Frontend\ContactController;
use App\Http\Controllers\Web\Backend\Product\ProductController;
use App\Http\Controllers\Web\Backend\Product\CouponController;
use App\Http\Controllers\Web\Backend\Order\AdminOrderController;
use Illuminate\Support\Facades\Route;

//! Route for Dashboard
Route::get('/dashboard', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard');

//! Route for Users Page
Route::controller(UserController::class)->group(function () {
    Route::get('/user', 'index')->name('user.index');
    Route::get('/user/status/{id}', 'status')->name('user.status');
    Route::delete('/user/destroy/{id}', 'destroy')->name('user.destroy');
});

//! Route for Contact Page
Route::controller(ContactController::class)->group(function () {
    Route::get('/contact', 'index')->name('contact.index');
    Route::get('/contact/show/{id}', 'show')->name('contact.show');
    Route::get('/contact/status/{id}', 'status')->name('contact.status');
    Route::delete('/contact/destroy/{id}', 'destroy')->name('contact.destroy');
});

//! Route for Product
Route::controller(ProductController::class)->group(function () {
    Route::get('/sweets', 'index')->name('sweets.index');
    Route::get('/sweets/create', 'create')->name('sweets.create');
    Route::post('/sweets/store', 'store')->name('sweets.store');
    Route::get('/sweets/show/{id}', 'show')->name('sweets.show');
    Route::get('/sweets/edit/{id}', 'edit')->name('sweets.edit');
    Route::patch('/sweets-page/update/{id}', 'update')->name('sweets.update');
    Route::get('/sweets/status/{id}', 'status')->name('sweets.status');
    Route::delete('/sweets/delete/{id}', 'destroy')->name('sweets.destroy');
});

//! Route for coupon
Route::controller(CouponController::class)->group(function () {
    Route::get('/coupons', 'index')->name('coupons.index');
    Route::get('/coupons/create', 'create')->name('coupons.create');
    Route::post('/coupons/store', 'store')->name('coupons.store');
    Route::get('/coupons/show/{id}', 'show')->name('coupons.show');
    Route::get('/coupons/edit/{id}', 'edit')->name('coupons.edit');
    Route::patch('/coupons-page/update/{id}', 'update')->name('coupons.update');
    Route::get('/coupons/status/{id}', 'status')->name('coupons.status');
    Route::delete('/coupons/delete/{id}', 'destroy')->name('coupons.destroy');
});

//! Route for coupon
Route::controller(AdminOrderController::class)->group(function () {
    Route::get('/orders', 'index')->name('orders.index');
    Route::get('/orders/show/{id}', 'show')->name('orders.show');
    Route::get('/orders/sweets/{id}', 'sweets')->name('orders.sweets');
    Route::get('/orders/invoice/{id}', 'invoice')->name('orders.invoice');
    Route::post('/orders/status/{id}', 'status')->name('orders.status');
    Route::delete('/orders/delete/{id}', 'destroy')->name('orders.destroy');
});
