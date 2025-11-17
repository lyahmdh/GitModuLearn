<?php

use Illuminate\Support\Facades\Route;

// =============================
// Public Controllers
// =============================
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\SubmoduleController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\RoleSwitchController;

// =============================
// Mentee Controllers
// =============================
use App\Http\Controllers\Mentee\MenteeDashboardController;
use App\Http\Controllers\Mentee\MenteeModuleController;
use App\Http\Controllers\Mentee\MenteeSubmoduleController;
use App\Http\Controllers\Mentee\MenteeProgressController;

// =============================
// Mentor Controllers
// =============================
use App\Http\Controllers\Mentor\MentorDashboardController;
use App\Http\Controllers\Mentor\MentorModuleController;
use App\Http\Controllers\Mentor\MentorSubmoduleController;

// =============================
// Admin Controllers
// =============================
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminMentorRequestController;
use App\Http\Controllers\Admin\AdminCourseController;
use App\Http\Controllers\Admin\AdminModuleController;
use App\Http\Controllers\Admin\AdminSubmoduleController;
use App\Http\Controllers\Admin\AdminReviewController;
use App\Http\Controllers\Admin\AdminFeedbackController;
use App\Http\Controllers\Admin\AdminLogController;


// ==========================================
//  PUBLIC ROUTES (NO AUTH REQUIRED)
// ==========================================

Route::get('/', [LandingPageController::class, 'index'])->name('landing');

// Public module browsing
Route::get('/modules', [ModuleController::class, 'index'])->name('modules.index');
Route::get('/modules/{module}', [ModuleController::class, 'show'])->name('modules.show');

// Public submodule view (read-only)
Route::get('/submodules/{submodule}', [SubmoduleController::class, 'show'])
    ->name('submodules.show');


// ==========================================
//  AUTH ROUTES (BREEZE DEFAULT)
// ==========================================

// Breeze handles:
// - login
// - register
// - forgot password
// - reset password
// - email verification
require __DIR__ . '/auth.php';


// ==========================================
//  ROLE SWITCH (MENTEE <-> MENTOR)
// ==========================================
Route::middleware(['auth'])->group(function () {
    Route::post('/switch-role', [RoleSwitchController::class, 'switch'])
        ->name('role.switch');
});


// ==========================================
//  MENTEE ROUTES
// ==========================================
Route::middleware(['auth', 'role:mentee'])
    ->prefix('mentee')
    ->name('mentee.')
    ->group(function () {

        Route::get('/dashboard', [MenteeDashboardController::class, 'index'])
            ->name('dashboard');

        Route::get('/modules', [MenteeModuleController::class, 'index'])
            ->name('modules.index');

        Route::get('/modules/{module}', [MenteeModuleController::class, 'show'])
            ->name('modules.show');

        Route::get('/submodules/{submodule}', [MenteeSubmoduleController::class, 'show'])
            ->name('submodules.show');

        Route::post('/submodules/{submodule}/mark-done', [MenteeProgressController::class, 'markDone'])
            ->name('submodules.markDone');

        Route::post('/modules/{module}/review', [ReviewController::class, 'store'])
            ->name('review.store');

        Route::post('/feedback', [FeedbackController::class, 'store'])
            ->name('feedback.store');
    });


// ==========================================
//  MENTOR ROUTES
// ==========================================
Route::middleware(['auth', 'role:mentor', 'mentor.approved'])
    ->prefix('mentor')
    ->name('mentor.')
    ->group(function () {

        Route::get('/dashboard', [MentorDashboardController::class, 'index'])
            ->name('dashboard');

        // Module CRUD (mentor)
        Route::resource('modules', MentorModuleController::class);

        // Submodule CRUD
        Route::resource('submodules', MentorSubmoduleController::class);
    });


// ==========================================
//  ADMIN ROUTES
// ==========================================
Route::prefix('admin')->name('admin.')->group(function () {

    // -----------------------------
    // Admin Login (NO AUTH REQUIRED)
    // -----------------------------
    Route::get('/login', [AdminLoginController::class, 'showLoginForm'])
        ->name('login');

    Route::post('/login', [AdminLoginController::class, 'login'])
        ->name('login.submit');
});


Route::middleware(['auth:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');

        // User management
        Route::resource('users', AdminUserController::class);

        // Mentor approval
        Route::resource('mentor-requests', AdminMentorRequestController::class);

        // Course management
        Route::resource('courses', AdminCourseController::class);

        // Module & Submodule
        Route::resource('modules', AdminModuleController::class);
        Route::resource('submodules', AdminSubmoduleController::class);

        // Review moderation
        Route::resource('reviews', AdminReviewController::class)->only(['index','destroy']);

        // Feedback moderation
        Route::resource('feedback', AdminFeedbackController::class)->only(['index','destroy']);

        // Admin logs
        Route::get('/logs', [AdminLogController::class, 'index'])
            ->name('logs.index');
    });

