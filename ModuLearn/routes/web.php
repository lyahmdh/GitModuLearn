<?php

use Illuminate\Support\Facades\Route;

// =============================
// Public Controllers
// =============================
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\PublicModuleController;
Route::get('/', [PublicModuleController::class, 'index']);
use App\Http\Controllers\SubmoduleController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\RoleSwitchController;

// =============================
// Mentee Controllers
// =============================
use App\Http\Controllers\Mentee\MenteeDashboardController;
use App\Http\Controllers\Mentee\MenteeModuleController;
Route::get('/mentee/dashboard', [MenteeModuleController::class, 'dashboard']);
use App\Http\Controllers\Mentee\MenteeSubmoduleController;
use App\Http\Controllers\Mentee\MenteeProgressController;

// =============================
// Mentor Controllers
// =============================
use App\Http\Controllers\Mentor\MentorDashboardController;
use App\Http\Controllers\Mentor\MentorModuleController;
Route::get('/mentor/dashboard', [MentorModuleController::class, 'dashboard']);
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
Route::get('/admin/dashboard', [AdminModuleController::class, 'dashboard']);
use App\Http\Controllers\Admin\AdminSubmoduleController;
use App\Http\Controllers\Admin\AdminReviewController;
use App\Http\Controllers\Admin\AdminFeedbackController;
use App\Http\Controllers\Admin\AdminLogController;

use App\Http\Controllers\CourseController;

Route::get('/', function () {
    return view('welcome');
});

// ROUTES UNTUK COURSE
Route::resource('courses', CourseController::class);
Route::get('/pelajaran', [CourseController::class, 'index'])->name('pelajaran.index');
Route::get('/pelajaran/{id}', [CourseController::class, 'show'])->name('pelajaran.show');


// ==========================================
//  PUBLIC ROUTES (NO AUTH REQUIRED)
// ==========================================

Route::get('/', [LandingPageController::class, 'index'])->name('landing');

// Public module browsing
Route::get('/modules', [ModuleController::class, 'index'])->name('modules.index');
Route::get('/modules/{module}', [ModuleController::class, 'show'])->name('modules.show');

// Public submodule view (read-only)
use App\Http\Controllers\Public\PublicSubmoduleController;

Route::get('/submodules/{submodule}', [PublicSubmoduleController::class, 'show'])
    ->name('submodules.show');

// ==========================================
//  DASHBOARD ROUTES
// ==========================================
// Universal dashboard route (after login)
Route::get('/dashboard', function () {
    $user = auth()->user();

    if (!$user) {
        return redirect()->route('login');
    }

    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    if ($user->role === 'mentor') {
        return redirect()->route('mentor.dashboard');
    }

    return redirect()->route('mentee.dashboard'); // default mentee
})->name('dashboard')->middleware('auth');

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
use App\Http\Controllers\RoleController;
Route::middleware('auth')->get('/switch-role', [RoleController::class, 'switch'])
    ->name('role.switch');


// ==========================================
//  MENTEE ROUTES
// ==========================================
Route::middleware(['auth', 'role:mentee'])
    ->prefix('mentee')
    ->name('mentee.')
    ->group(function () {

        Route::get('/dashboard', [MenteeDashboardController::class, 'index'])
            ->name('dashboard');

        // LIST MODULE
        Route::get('/modules', [MenteeModuleController::class, 'index'])
            ->name('modules.index');

        // SHOW MODULE (detail + list submodule)
        Route::get('/modules/{module}', [MenteeModuleController::class, 'show'])
            ->name('modules.show');

        // SHOW SUBMODULE (BENAR)
        Route::get('/modules/{module}/submodules/{submodule}', [MenteeSubmoduleController::class, 'show'])
            ->name('submodules.show');

        // MARK DONE
        Route::post('/modules/{module}/submodules/{submodule}/mark-done',
            [MenteeProgressController::class, 'markDone']
        )->name('submodules.markDone');

        // REVIEW MODULE
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

