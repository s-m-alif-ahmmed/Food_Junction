<?php

use App\Http\Controllers\Web\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Web\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Web\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Web\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Web\Auth\NewPasswordController;
use App\Http\Controllers\Web\Auth\PasswordController;
use App\Http\Controllers\Web\Auth\PasswordResetLinkController;
use App\Http\Controllers\Web\Auth\RegisteredUserController;
use App\Http\Controllers\Web\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    // Forgot password - Step 1
    Route::get('/forgot/password', [RegisteredUserController::class, 'showForgotPasswordForm'])->name('forgot.password');
    Route::post('/forgot/password', [RegisteredUserController::class, 'handleForgotPassword'])->name('forgot.password.otp');

    // OTP Verification - Step 2
    Route::get('/verify-otp', [RegisteredUserController::class, 'showOtpVerificationForm'])->name('otp.verify.form');
    Route::post('/verify-otp', [RegisteredUserController::class, 'handleOtpVerification'])->name('otp.verify');

    // Reset Password - Step 3
    Route::get('/reset/password/{token}', [RegisteredUserController::class, 'showResetForm'])->name('reset.password.form');
    Route::post('/reset/password', [RegisteredUserController::class, 'handleResetPassword'])->name('reset.password');


    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});
