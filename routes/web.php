<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CredentialController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CredentialAccessController;

// Home route
Route::get('/', function () {
    return view('welcome');
});

// Authentication Routes...
require __DIR__.'/auth.php';

// Unified Dashboard Route
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        if (Auth::user()->role === 'admin') {
            return app(HomeController::class)->adminDashboard();
        }
        return app(HomeController::class)->userDashboard();
    })->name('user.dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('credentials', CredentialController::class)->except(['show']);
    Route::get('/credentials/{credential}', [CredentialController::class, 'show'])
         ->name('credentials.show')->middleware('can:view,credential');

    Route::post('mfa/verify-qr', [AuthenticatedSessionController::class, 'verifyQrCode'])->name('mfa.verifyQr');
    Route::get('mfa/verify-qr-code', function () {
        return view('auth.qr-code-verify');
    })->name('mfa.verifyQrCodeForm');
    Route::post('mfa/verify-qr-code', [AuthenticatedSessionController::class, 'verifyQrCode'])->name('mfa.submitQrCodeVerification');
});

// Admin-specific Routes
Route::middleware(['auth', 'verified', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/users', [AdminController::class, 'index'])->name('admin.users.index');
    Route::get('/admin/users/create', [AdminController::class, 'create'])->name('admin.users.create');
    Route::post('/admin/users', [AdminController::class, 'store'])->name('admin.users.store');
    Route::get('/admin/users/{user}/edit', [AdminController::class, 'edit'])->name('admin.users.edit');
    Route::put('/admin/users/{user}', [AdminController::class, 'update'])->name('admin.users.update');
    Route::delete('/admin/users/{user}', [AdminController::class, 'destroy'])->name('admin.users.destroy');
    Route::get('/admin/users/{user}', [AdminController::class, 'show'])->name('admin.users.show');

    Route::post('/admin/users/{user}/deceased', [AdminController::class, 'markUserAsDeceased'])->name('admin.users.deceased');
    Route::get('/admin/credentials/{credential}', [AdminController::class, 'showCredentialDetails'])->name('admin.credentials.show');
    Route::get('/admin/users/{user}/credentials', [AdminController::class, 'showCredentials'])->name('admin.users.credentials.show');
});

// Route for close kin to access credentials
Route::get('/kin/access/{user}/{token}', [CredentialAccessController::class, 'accessCredentials'])->name('kin.access');

// Middleware to ensure user is an admin
// Ensure this middleware is defined in app/Http/Kernel.php:
// 'admin' => \App\Http\Middleware\AdminMiddleware::class,
