<?php

use App\Http\Controllers\Web\Backend\DashboardController;
use App\Http\Controllers\Web\Backend\UserController;
use App\Http\Controllers\Web\Frontend\ContactController;
use App\Http\Controllers\Web\Backend\Product\ProductController;
use App\Http\Controllers\Web\Backend\Product\CouponController;
use App\Http\Controllers\Web\Backend\Order\AdminOrderController;
use App\Http\Controllers\Web\Backend\Product\CategoryController;
use App\Http\Controllers\Web\Backend\Faq\FaqController;
use App\Http\Controllers\Web\Backend\Cms\HomeBannerController;
use App\Http\Controllers\Web\Backend\Cms\HomeBottomBannerController;
use App\Http\Controllers\Web\Backend\Video\VideoController;
use App\Http\Controllers\Web\Backend\Blog\BlogController;
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

//! Route for Faq
Route::controller(FaqController::class)->group(function () {
    Route::get('/faqs', 'index')->name('faqs.index');
    Route::get('/faqs/create', 'create')->name('faqs.create');
    Route::post('/faqs/store', 'store')->name('faqs.store');
    Route::get('/faqs/show/{id}', 'show')->name('faqs.show');
    Route::get('/faqs/edit/{id}', 'edit')->name('faqs.edit');
    Route::patch('/faqs/update/{id}', 'update')->name('faqs.update');
    Route::get('/faqs/status/{id}', 'status')->name('faqs.status');
    Route::delete('/faqs/delete/{id}', 'destroy')->name('faqs.destroy');
});

//! Route for Video
Route::controller(VideoController::class)->group(function () {
    Route::get('/videos', 'index')->name('videos.index');
    Route::get('/videos/create', 'create')->name('videos.create');
    Route::post('/videos/store', 'store')->name('videos.store');
    Route::get('/videos/edit/{id}', 'edit')->name('videos.edit');
    Route::patch('/videos/update/{id}', 'update')->name('videos.update');
    Route::get('/videos/status/{id}', 'status')->name('videos.status');
    Route::delete('/videos/delete/{id}', 'destroy')->name('videos.destroy');
});

//! Route for Video
Route::controller(BlogController::class)->group(function () {
    Route::get('/blogs', 'index')->name('blogs.index');
    Route::get('/blogs/create', 'create')->name('blogs.create');
    Route::post('/blogs/store', 'store')->name('blogs.store');
    Route::get('/blogs/show/{id}', 'show')->name('blogs.show');
    Route::get('/blogs/edit/{id}', 'edit')->name('blogs.edit');
    Route::patch('/blogs/update/{id}', 'update')->name('blogs.update');
    Route::get('/blogs/status/{id}', 'status')->name('blogs.status');
    Route::delete('/blogs/delete/{id}', 'destroy')->name('blogs.destroy');
});

//! Route for Home Banner
Route::controller(HomeBannerController::class)->group(function () {
    Route::get('/cms/home-banner', 'index')->name('cms.home-banner.index');
    Route::get('/cms/home-banner/create', 'create')->name('cms.home-banner.create');
    Route::post('/cms/home-banner/store', 'store')->name('cms.home-banner.store');
    Route::get('/cms/home-banner/edit/{id}', 'edit')->name('cms.home-banner.edit');
    Route::patch('/cms/home-banner/update/{id}', 'update')->name('cms.home-banner.update');
    Route::get('/cms/home-banner/status/{id}', 'status')->name('cms.home-banner.status');
    Route::delete('/cms/home-banner/delete/{id}', 'destroy')->name('cms.home-banner.destroy');
});

//! Route for Home Bottom Banner
Route::controller(HomeBottomBannerController::class)->group(function () {
    Route::get('/cms/home-bottom-banner/edit', 'edit')->name('cms.home-bottom-banner.edit');
    Route::patch('/cms/home-bottom-banner/update', 'update')->name('cms.home-bottom-banner.update');
});

//! Route for Category
Route::controller(CategoryController::class)->group(function () {
    Route::get('/categories', 'index')->name('categories.index');
    Route::get('/categories/create', 'create')->name('categories.create');
    Route::post('/categories/store', 'store')->name('categories.store');
    Route::get('/categories/show/{id}', 'show')->name('categories.show');
    Route::get('/categories/edit/{id}', 'edit')->name('categories.edit');
    Route::patch('/categories/update/{id}', 'update')->name('categories.update');
    Route::get('/categories/status/{id}', 'status')->name('categories.status');
    Route::delete('/categories/delete/{id}', 'destroy')->name('categories.destroy');
});

//! Route for Product
Route::controller(ProductController::class)->group(function () {
    Route::get('/products', 'index')->name('products.index');
    Route::get('/products/create', 'create')->name('products.create');
    Route::post('/products/store', 'store')->name('products.store');
    Route::get('/products/show/{id}', 'show')->name('products.show');
    Route::get('/products/edit/{id}', 'edit')->name('products.edit');
    Route::patch('/products/update/{id}', 'update')->name('products.update');
    Route::get('/products/status/{id}', 'status')->name('products.status');
    Route::delete('/products/delete/{id}', 'destroy')->name('products.destroy');
});

//! Route for coupon
Route::controller(CouponController::class)->group(function () {
    Route::get('/coupons', 'index')->name('coupons.index');
    Route::get('/coupons/create', 'create')->name('coupons.create');
    Route::post('/coupons/store', 'store')->name('coupons.store');
    Route::get('/coupons/show/{id}', 'show')->name('coupons.show');
    Route::get('/coupons/edit/{id}', 'edit')->name('coupons.edit');
    Route::patch('/coupons/update/{id}', 'update')->name('coupons.update');
    Route::get('/coupons/status/{id}', 'status')->name('coupons.status');
    Route::delete('/coupons/delete/{id}', 'destroy')->name('coupons.destroy');
});

//! Route for coupon
Route::controller(AdminOrderController::class)->group(function () {
    Route::get('/orders', 'index')->name('orders.index');
    Route::get('/orders/show/{id}', 'show')->name('orders.show');
    Route::get('/orders/products/{id}', 'products')->name('orders.sweets');
    Route::get('/orders/invoice/{id}', 'invoice')->name('orders.invoice');
    Route::post('/orders/status/{id}', 'status')->name('orders.status');
    Route::delete('/orders/delete/{id}', 'destroy')->name('orders.destroy');
});
