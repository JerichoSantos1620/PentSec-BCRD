<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DocumentController;
use Illuminate\Support\Facades\Route;

// Redirect root to login
Route::get('/', fn () => redirect('/login'));

// External Agency routes (standalone, no auth required)
Route::get('/agency-login', fn () => view('auth.agency-login'))->name('agency-login');
Route::get('/verification-portal', fn () => view('verification-portal'))->name('verification-portal');

// Authentication routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');
});

Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');

// User routes
Route::middleware('auth')->group(function () {
    Route::get('/personal-data-sheet', [UserController::class, 'personalDataSheet'])->name('user.personal-data-sheet');
    Route::post('/personal-data-sheet', [UserController::class, 'storePersonalData'])->name('user.personal-data-sheet.store');
    Route::get('/personal-data-sheet/download', [UserController::class, 'downloadPdf'])->name('user.personal-data-sheet.download');

    // Document submission routes
    Route::get('/submit-document', [DocumentController::class, 'submitDocument'])->name('documents.submit');
    Route::post('/submit-document', [DocumentController::class, 'storeDocument'])->name('documents.store');
    Route::get('/submissions', [DocumentController::class, 'submissions'])->name('documents.submissions');
    Route::get('/submissions/{id}', [DocumentController::class, 'viewSubmission'])->name('documents.view');
});

// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/document-queue', [AdminController::class, 'documentQueue'])->name('admin.document-queue');
    Route::get('/document-preview/{userId}', [AdminController::class, 'documentPreview'])->name('admin.document-preview');

    // Document review routes
    Route::get('/review-queue', [AdminController::class, 'reviewQueue'])->name('admin.review-queue');
    Route::post('/review-document/{id}', [AdminController::class, 'reviewDocument'])->name('admin.review-document');

    // Analytics routes
    Route::get('/analytics', [AdminController::class, 'analytics'])->name('admin.analytics');
});
