<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CredentialController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\CredentialAccessController;

// Home route
Route::get('/', function () {
    return view('welcome');
});

// Authentication Routes...
require __DIR__.'/auth.php';

// Unified Dashboard Route for different user roles
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [HomeController::class, 'handleDashboard'])->name('user.dashboard');

    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/destroy', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Family Information Management Routes
    Route::get('/user/family', [ProfileController::class, 'manageFamily'])->name('user.family.manage');
    Route::put('/user/family', [ProfileController::class, 'updateFamilyInfo'])->name('user.family.update');

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

// SuperAdmin-specific Routes
Route::middleware(['auth', 'verified', 'superadmin'])->group(function () {
    Route::get('/superadmin/dashboard', [SuperAdminController::class, 'index'])->name('superadmin.dashboard');
    Route::get('/superadmin/family-info', [SuperAdminController::class, 'viewFamilyInfo'])->name('superadmin.family.index');
    Route::put('/superadmin/family-info/{id}/verify', [SuperAdminController::class, 'verifyFamilyInfo'])->name('superadmin.family.verify'); // Added verification route
});

// Route for close kin to access credentials
Route::get('/kin/access/{user}/{token}', [CredentialAccessController::class, 'accessCredentials'])->name('kin.access');

// Route for close kin to access credentials and show secure credentials
Route::get('/kin/secure-credentials/{user}/{token}', [CredentialAccessController::class, 'showSecureCredentials'])->name('kin.secureCredentials');
