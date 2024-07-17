<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CredentialController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\CredentialAccessController;
use App\Http\Controllers\UserGuideController;
use App\Http\Controllers\AuditLogController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DeathCertificateController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\AssetController;

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

    Route::post('/credentials/{credential}/encrypt', [CredentialController::class, 'encrypt'])->name('credentials.encrypt'); // Add this line
    Route::post('/credentials/{credential}/view-encrypted', [CredentialController::class, 'viewEncrypted'])->name('credentials.viewEncrypted');

    // Add this route for checking password strength
    Route::post('/check-password-strength', [CredentialController::class, 'checkPasswordStrength'])->name('check-password-strength');

    Route::post('mfa/verify-qr', [AuthenticatedSessionController::class, 'verifyQrCode'])->name('mfa.verifyQr');
    Route::get('mfa/verify-qr-code', function () {
        return view('auth.qr-code-verify');
    })->name('mfa.verifyQrCodeForm');
    Route::post('mfa/verify-qr-code', [AuthenticatedSessionController::class, 'verifyQrCode'])->name('mfa.submitQrCodeVerification');

    // User Guide Route
    Route::get('/user-guide', [UserGuideController::class, 'index'])->name('user.guide');

    // Feedback submission route
    Route::post('/submit-feedback', [FeedbackController::class, 'store'])->name('feedback.submit')->middleware('auth');

    // Contact Us route
    Route::get('/contact', [ContactController::class, 'index'])->name('contact.index')->middleware('auth');
    Route::post('/contact', [ContactController::class, 'store'])->name('contact.store')->middleware('auth');

    // Route for the Agreement page
    Route::get('/agreement', [UserController::class, 'agreement'])->name('user.agreement');
    Route::post('/agreement', [UserController::class, 'storeAgreement'])->name('user.agreement.store');

    // New routes for managing Wasiat, Hibah, and Waqf documents
    Route::resource('documents', DocumentController::class)->except(['show', 'edit', 'update']);

     // New routes for managing assets
    Route::resource('assets', AssetController::class)->except(['show', 'edit', 'update']);
});

// Admin-specific Routes
Route::middleware(['auth', 'verified', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
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

    // Audit Log Routes for Admins
    Route::get('/admin/audit-logs', [AuditLogController::class, 'index'])->name('admin.audit_logs.index');
    Route::get('/admin/audit-logs/{id}', [AuditLogController::class, 'show'])->name('admin.audit_logs.show');
    
    // Feedback Route for Admins
    Route::get('/admin/feedback', [AdminController::class, 'showFeedback'])->name('admin.feedback.index');

    // Complaints Route for Admins
    Route::get('/admin/complaints', [AdminController::class, 'showComplaints'])->name('admin.complaints.index');
    Route::delete('/admin/complaints/{complaint}', [AdminController::class, 'destroyComplaint'])->name('admin.complaints.destroy');
    Route::get('/admin/complaints/{complaint}/reply', [AdminController::class, 'showReplyForm'])->name('admin.complaints.showReplyForm');
    Route::post('/admin/complaints/{complaint}/reply', [AdminController::class, 'replyToComplaint'])->name('admin.complaints.reply');

    // Death Certificate Routes for Admins
    Route::get('/admin/death-certificates', [AdminController::class, 'viewDeathCertificates'])->name('admin.deathCertificates');
    Route::post('/admin/death-certificates/{id}/verify', [AdminController::class, 'verifyDeathCertificate'])->name('admin.deathCertificates.verify');
});

// SuperAdmin-specific Routes
Route::middleware(['auth', 'verified', 'superadmin'])->group(function () {
    Route::get('/superadmin/dashboard', [SuperAdminController::class, 'index'])->name('superadmin.dashboard');
    Route::get('/superadmin/family-info', [SuperAdminController::class, 'viewFamilyInfo'])->name('superadmin.family.index');
    Route::put('/superadmin/family-info/{id}/verify', [SuperAdminController::class, 'verifyFamilyInfo'])->name('superadmin.family.verify');
});

// Route for close kin to submit death certificate
Route::get('/kin/death-certificate', [DeathCertificateController::class, 'create'])->name('kin.deathCertificate');
Route::post('/kin/death-certificate', [DeathCertificateController::class, 'store'])->name('kin.deathCertificate.store');

// Route for close kin to access credentials
Route::get('/kin/access/{user}/{token}', [CredentialAccessController::class, 'accessCredentials'])->name('kin.access');

// Route for close kin to access credentials and show secure credentials
Route::get('/kin/secure-credentials/{user}/{token}', [CredentialAccessController::class, 'showSecureCredentials'])->name('kin.secureCredentials');

// Route to logout
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
