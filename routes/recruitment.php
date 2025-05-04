<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\ApplicantController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/{locale?}', [RegisteredUserController::class, 'create'])
        ->defaults('locale', 'fr')
        ->name('register');
    Route::get('/{locale?}/{id}', [ApplicantController::class, 'notification'])
        ->defaults('locale', 'fr')
        ->name('applicants.done');

    Route::post('register', [RegisteredUserController::class, 'store']);
    Route::post('applicants', [ApplicantController::class, 'store'])->name('applicants.store');
});

