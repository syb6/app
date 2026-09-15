<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\QuestionnaireController;
use Illuminate\Support\Facades\Route;

// Public Questionnaire Routes
Route::get('/', [QuestionnaireController::class, 'index'])->name('questionnaire.index');
Route::post('/submit', [QuestionnaireController::class, 'store'])->name('questionnaire.store');

// Admin Auth & Dashboard Routes
Route::prefix('admin')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
        Route::post('/login', [AdminController::class, 'login'])->name('admin.login.submit');
    });

    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');
    });
});