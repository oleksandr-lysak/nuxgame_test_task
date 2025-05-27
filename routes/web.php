<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\UserController;


// Main page and registration
Route::get('/', [RegistrationController::class, 'showForm'])->name('register.form');
Route::post('/register', [RegistrationController::class, 'register'])->name('register.submit');

// Group of routes for user unique link actions
Route::prefix('link')->name('user.link.')->group(function () {
    Route::get('{token}', [UserController::class, 'show'])->name('show');
    Route::post('{token}/regenerate', [UserController::class, 'regenerate'])->name('regenerate');
    Route::post('{token}/deactivate', [UserController::class, 'deactivate'])->name('deactivate');
    Route::post('{token}/lucky', [UserController::class, 'lucky'])->name('lucky');
    Route::get('{token}/history', [UserController::class, 'history'])->name('history');
});
