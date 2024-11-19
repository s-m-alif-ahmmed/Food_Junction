<?php

use App\Http\Controllers\Web\Frontend\HomeController;
use App\Http\Controllers\Web\Backend\DashboardController;
use Illuminate\Support\Facades\Route;

//! Route for Landing Page
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/food-junction/{page_slug}', [HomeController::class, 'dynamicPage'])->name('user.dynamic.page');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/sweets', [HomeController::class, 'sweets'])->name('sweets');
Route::get('/sweets/detail', [HomeController::class, 'detail'])->name('sweets.detail');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'userDashboard'])->name('user.dashboard');
});

require __DIR__ . '/auth.php';
