<?php

use App\Http\Controllers\Web\Backend\DashboardController;
use App\Http\Controllers\Web\Backend\UserController;
use App\Http\Controllers\Web\Frontend\ContactController;
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
