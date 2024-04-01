<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CredentialController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;

// Home route
Route::get('/', function () {
    return view('welcome');
});

// Authentication Routes...
require __DIR__.'/auth.php';

// Unified Dashboard Route
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        // Check if the authenticated user is an admin
        if (Auth::user()->role === 'admin') {
            // Redirect admin to the admin dashboard
            return app(HomeController::class)->adminDashboard();
        }
        
        // For regular users, proceed to the user dashboard
        return app(HomeController::class)->userDashboard();
    })->name('user.dashboard');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Credentials Routes for users
    Route::resource('credentials', CredentialController::class)->except(['show']);
    // Explicitly defining the "show" route for credentials to distinguish between user and admin views
    Route::get('/credentials/{credential}', [CredentialController::class, 'show'])->name('credentials.show')->middleware('can:view,credential');
});

// Admin-specific Routes
Route::middleware(['auth', 'verified', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    // Admin user management
    Route::get('/admin/users', [AdminController::class, 'index'])->name('admin.users.index');
    Route::get('/admin/users/create', [AdminController::class, 'create'])->name('admin.users.create');
    Route::post('/admin/users', [AdminController::class, 'store'])->name('admin.users.store');
    Route::get('/admin/users/{user}/edit', [AdminController::class, 'edit'])->name('admin.users.edit');
    Route::put('/admin/users/{user}', [AdminController::class, 'update'])->name('admin.users.update');
    Route::delete('/admin/users/{user}', [AdminController::class, 'destroy'])->name('admin.users.destroy');
    Route::get('/admin/users/{user}', [AdminController::class, 'show'])->name('admin.users.show');

    // Adding the route for marking a user as deceased
    Route::post('/admin/users/{user}/deceased', [AdminController::class, 'markUserAsDeceased'])->name('admin.users.deceased');

    // Route for viewing a specific credential's details as an admin
    Route::get('/admin/credentials/{credential}', [AdminController::class, 'showCredentialDetails'])->name('admin.credentials.show');

    // Assuming you want a route for admins to view all credentials of a specific user
    Route::get('/admin/users/{user}/credentials', [AdminController::class, 'showCredentials'])->name('admin.users.credentials.show');
});

// Middleware to ensure user is an admin. Ensure this middleware is defined.
// Example admin middleware registration in app/Http/Kernel.php:
// 'admin' => \App\Http\Middleware\AdminMiddleware::class,
