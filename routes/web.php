<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\KycVerificationAdminController;
use App\Http\Controllers\Admin\PropertyAdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Tenant\TenantDashboardController;
use App\Http\Controllers\Landlord\LandlordDashboardController;
use App\Http\Controllers\Landlord\PropertyController as LandlordPropertyController;
use App\Http\Controllers\Agent\AgentDashboardController;
use App\Http\Controllers\Agent\PropertyController as AgentPropertyController;
use App\Http\Controllers\KycVerificationController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\SettingsController;
use App\Models\Property;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $properties = Property::with('owner')
        ->where('status', 'available')
        ->where('is_verified', true)
        ->latest('published_at')
        ->take(6)
        ->get();
    
    $teamMembers = \App\Models\TeamMember::active()->ordered()->get();
    
    return view('welcome', compact('properties', 'teamMembers'));
});

// Public Property Routes
Route::get('/properties', [PropertyController::class, 'index'])->name('properties.index');
Route::get('/properties/{slug}', [PropertyController::class, 'show'])->name('properties.show');

Route::get('/dashboard', function () {
    $user = auth()->user();
    
    return match($user->role) {
        'admin' => redirect()->route('admin.dashboard'),
        'tenant' => redirect()->route('tenant.dashboard'),
        'landlord' => redirect()->route('landlord.dashboard'),
        'agent' => redirect()->route('agent.dashboard'),
        default => redirect('/'),
    };
})->middleware(['auth', 'verified'])->name('dashboard');

// Admin Routes
Route::middleware(['auth', 'verified', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    
    // User Management
    Route::resource('users', UserController::class);
    
    // Property Management
    Route::prefix('properties')->name('properties.')->group(function () {
        Route::get('/', [PropertyAdminController::class, 'index'])->name('index');
        Route::get('/{property}', [PropertyAdminController::class, 'show'])->name('show');
        Route::patch('/{property}/verify', [PropertyAdminController::class, 'verify'])->name('verify');
        Route::patch('/{property}/reject', [PropertyAdminController::class, 'reject'])->name('reject');
        Route::patch('/{property}/notes', [PropertyAdminController::class, 'updateNotes'])->name('notes');
    });
    
    // KYC Verification Management
    Route::prefix('kyc')->name('kyc.')->group(function () {
        Route::get('/', [KycVerificationAdminController::class, 'index'])->name('index');
        Route::get('/{kycVerification}', [KycVerificationAdminController::class, 'show'])->name('show');
        Route::post('/{kycVerification}/approve', [KycVerificationAdminController::class, 'approve'])->name('approve');
        Route::post('/{kycVerification}/reject', [KycVerificationAdminController::class, 'reject'])->name('reject');
        Route::post('/{kycVerification}/under-review', [KycVerificationAdminController::class, 'markUnderReview'])->name('under-review');
        Route::post('/{kycVerification}/notes', [KycVerificationAdminController::class, 'updateNotes'])->name('notes');
    });
    
    // Team Management
    Route::resource('team', \App\Http\Controllers\Admin\TeamMemberController::class)->except(['show']);
});

// Tenant Routes
Route::middleware(['auth', 'verified', 'role:tenant'])->prefix('tenant')->name('tenant.')->group(function () {
    Route::get('/dashboard', [TenantDashboardController::class, 'index'])->name('dashboard');
});

// Landlord Routes
Route::middleware(['auth', 'verified', 'role:landlord'])->prefix('landlord')->name('landlord.')->group(function () {
    Route::get('/dashboard', [LandlordDashboardController::class, 'index'])->name('dashboard');
    Route::resource('properties', LandlordPropertyController::class);
    
    // Document Management
    Route::resource('documents', \App\Http\Controllers\Landlord\DocumentController::class);
    Route::get('documents/{document}/download', [\App\Http\Controllers\Landlord\DocumentController::class, 'download'])->name('documents.download');
});

// Agent Routes
Route::middleware(['auth', 'verified', 'role:agent'])->prefix('agent')->name('agent.')->group(function () {
    Route::get('/dashboard', [AgentDashboardController::class, 'index'])->name('dashboard');
    Route::resource('properties', AgentPropertyController::class);
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Settings Routes
    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('/', [SettingsController::class, 'index'])->name('index');
        Route::patch('/profile', [SettingsController::class, 'updateProfile'])->name('profile.update');
        Route::patch('/password', [SettingsController::class, 'updatePassword'])->name('password.update');
        Route::patch('/notifications', [SettingsController::class, 'updateNotifications'])->name('notifications.update');
        Route::patch('/privacy', [SettingsController::class, 'updatePrivacy'])->name('privacy.update');
        Route::delete('/account', [SettingsController::class, 'deleteAccount'])->name('account.delete');
    });
    
    // KYC Verification Routes (for agents and landlords)
    Route::prefix('kyc')->name('kyc.')->group(function () {
        Route::get('/create', [KycVerificationController::class, 'create'])->name('create');
        Route::post('/submit', [KycVerificationController::class, 'store'])->name('submit');
        Route::get('/status', [KycVerificationController::class, 'status'])->name('status');
    });
});

require __DIR__.'/auth.php';
