<?php

use App\Http\Controllers\Web\Backend\DashboardController;
use App\Http\Controllers\Web\Backend\UserController;
use Illuminate\Support\Facades\Route;

//! Route for Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

//! Route for Users Page
Route::controller(UserController::class)->group(function () {
    Route::get('/user', 'index')->name('user.index');
    Route::get('/user/status/{id}', 'status')->name('user.status');
    Route::delete('/user/destroy/{id}', 'destroy')->name('user.destroy');
});
