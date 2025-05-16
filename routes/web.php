<?php

use App\Http\Controllers\Web\Frontend\HomeController;
use App\Http\Controllers\Web\Backend\DashboardController;
use App\Http\Controllers\Web\Frontend\ContactController;
use App\Http\Controllers\Web\Frontend\ProductReviewController;
use App\Http\Controllers\Web\Frontend\CartController;
use App\Http\Controllers\Web\Frontend\OrderController;
use App\Http\Controllers\Web\Frontend\UserProfileController;
use App\Http\Controllers\Web\Frontend\SearchController;
use App\Http\Controllers\Web\Frontend\WishlistController;
use App\Http\Controllers\Web\Backend\Blog\BlogCommentConroller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

//! Route for Landing Page
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/faq', [HomeController::class, 'faq'])->name('faq');
Route::get('/about-us', [HomeController::class, 'about'])->name('about-us');
Route::get('/products', [HomeController::class, 'products'])->name('products');
Route::get('/products/{category_slug}', [HomeController::class, 'categoryProduct'])->name('category.products');
Route::get('/product/detail/{product_slug}', [HomeController::class, 'detail'])->name('product.detail');
Route::get('/confirm-order', [HomeController::class, 'confirmOrder'])->name('confirm.order');

//blog
Route::get('/blog', [HomeController::class, 'blog'])->name('blogs');
Route::get('/blog/detail/{slug}', [HomeController::class, 'blogDetail'])->name('blog.detail');

//Blog Comments
Route::post('/blog/{blogId}/comment/store', [BlogCommentConroller::class, 'store'])->name('comment.store');

Route::get('/videos', [HomeController::class, 'video'])->name('videos');

//Coupon Check
Route::post('/coupon-check', [OrderController::class, 'couponCheck'])->name('coupon.check');

//dynamic page
Route::get('/page/{page_slug}', [HomeController::class, 'dynamicPage'])->name('user.dynamic.page');

//Contact
Route::get('/contact', [ContactController::class, 'contact'])->name('contact');
Route::post('/contact/store', [ContactController::class, 'store'])->name('contact.store');

//Search
Route::get('/product/search', [SearchController::class, 'search'])->name('search');

//Sweet Review
Route::post('/sweet/review/store', [ProductReviewController::class, 'store'])->name('sweet.review.store');

//Cart
Route::get('/cart', [CartController::class, 'cart'])->name('cart');
Route::post('/add-cart', [CartController::class, 'addToCart'])->name('new.cart');
Route::post('/cart/remove', [CartController::class, 'removeFromCart'])->name('remove.cart');

//Order
Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');
Route::post('/new/order', [OrderController::class, 'newOrder'])->name('new.order');
Route::get('/order-complete', [OrderController::class, 'orderComplete'])->name('order.confirm');
Route::get('/order-detail/{tracking_id}', [OrderController::class, 'orderDetails'])->name('order.details');

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'userDashboard'])->name('user.dashboard');

    // User Profile Update
    Route::patch('/dashboard/setting/update', [UserProfileController::class, 'UpdateProfile'])->name('user.update.profile');
    Route::patch('/dashboard/setting/update/password', [UserProfileController::class, 'UpdatePassword'])->name('user.update.profile.password');

    //Wishlist
    Route::post('/wishlist/add/{id}', [WishlistController::class, 'add'])->name('product.wishlist.add');
    Route::delete('/wishlist/remove/{id}', [WishlistController::class, 'remove'])->name('product.wishlist.remove');


});

Route::get('/migrate', function () {
    Artisan::call('migrate');
    return 'Migration completed!';
});

Route::get('/migrate-fresh', function () {
    Artisan::call('migrate:fresh --seed');
    return 'Migration and seeding completed!';
});

require __DIR__ . '/auth.php';
