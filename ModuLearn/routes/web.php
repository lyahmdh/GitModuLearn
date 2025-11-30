<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\API\AdminMentorVerificationController;
use App\Http\Controllers\API\ModuleController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\SubmoduleController;
use App\Http\Controllers\API\LikeController;
use App\Http\Controllers\UI\LandingController;
use App\Http\Controllers\UI\LessonController;
use App\Http\Controllers\UI\Dashboard\MenteeDashboardController;
use App\Http\Controllers\UI\Dashboard\MentorDashboardController;
use App\Http\Controllers\UI\Dashboard\AdminDashboardController;
use App\Http\Controllers\API\MentorVerificationController;


/*
|--------------------------------------------------------------------------
| Login dan Register
|--------------------------------------------------------------------------
*/

// Login
Route::get('/login', [AuthenticatedSessionController::class, 'create'])
    ->middleware('guest')
    ->name('login');

// Register
Route::get('/register', [RegisteredUserController::class, 'create'])
    ->middleware('guest')
    ->name('register');


/*
|--------------------------------------------------------------------------
| Landing Page
|--------------------------------------------------------------------------
*/
Route::get('/', [LandingController::class, 'index'])->name('landing');
Route::get('/landing-login', [LandingController::class, 'landingLogin'])->name('landing-login');


Route::get('/dashboard', function () {
    $user = auth()->user();

    if ($user->role === 'admin') {
        return redirect()->route('dashboard.admin');
    }

    if ($user->role === 'mentor') {
        return redirect()->route('dashboard.mentor');
    }

    // default mentee
    return redirect()->route('dashboard.mentee');
})->middleware('auth')->name('dashboard');

/*
|--------------------------------------------------------------------------
| Dashboard (user harus login)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // mentee dashboard
    Route::middleware('is_mentee')->group(function () {
        Route::get('/dashboard/mentee', [MenteeDashboardController::class, 'index'])->name('dashboard.mentee');
        Route::get('/dashboard/mentee/likes', [MenteeDashboardController::class, 'likedModules'])->name('dashboard.mentee.likes');
        Route::get('/dashboard/mentee/progress', [MenteeDashboardController::class, 'progress'])->name('dashboard.mentee.progress');
        Route::get('/dashboard/mentee/profile', [MenteeDashboardController::class, 'editProfile'])->name('dashboard.mentee.profile');
        
    });

    // mentor dashboard
    Route::middleware('is_mentor')->group(function () {
        Route::get('/dashboard/mentor', [MentorDashboardController::class, 'index'])->name('dashboard.mentor');

        // My Modules (modul milik mentor sendiri)
        Route::get('/dashboard/mentor/my-modules', [MentorDashboardController::class, 'myModules'])->name('dashboard.mentor.modules.my-modules');
        Route::get('/dashboard/mentor/my-modules/create', [MentorDashboardController::class, 'createModule'])->name('dashboard.mentor.modules.create');
        Route::post('/dashboard/mentor/my-modules', [MentorDashboardController::class, 'storeModule'])->name('dashboard.mentor.modules.store');
        Route::get('/dashboard/mentor/my-modules/{id}/edit', [MentorDashboardController::class, 'editModule'])->name('dashboard.mentor.modules.edit');
        Route::put('/dashboard/mentor/my-modules/{id}', [MentorDashboardController::class, 'updateModule'])->name('dashboard.mentor.modules.update');

        // Likes & Profile
        Route::get('/dashboard/mentor/likes', [MentorDashboardController::class, 'likedModules'])->name('dashboard.mentor.likes');
        Route::get('/dashboard/mentor/progress', [MentorDashboardController::class, 'progress'])->name('dashboard.mentor.progress');
        Route::get('/dashboard/mentor/profile', [MentorDashboardController::class, 'editProfile'])->name('dashboard.mentor.profile');

        // Submodules untuk mentor
        Route::get('/dashboard/mentor/my-modules/{module}/submodules', [SubmoduleController::class, 'index'])->name('dashboard.mentor.submodules.index');
        Route::get('/dashboard/mentor/my-modules/{module}/submodules/create', [SubmoduleController::class, 'create'])->name('dashboard.mentor.submodules.create');
        Route::post('/dashboard/mentor/my-modules/{module}/submodules', [SubmoduleController::class, 'store'])->name('dashboard.mentor.submodules.store');
        Route::get('/dashboard/mentor/my-modules/{module}/submodules/{submodule}/edit', [SubmoduleController::class, 'edit'])->name('dashboard.mentor.submodules.edit');
        Route::put('/dashboard/mentor/my-modules/{module}/submodules/{submodule}', [SubmoduleController::class, 'update'])->name('dashboard.mentor.submodules.update');
        Route::delete('/dashboard/mentor/my-modules/{module}/submodules/{submodule}', [SubmoduleController::class, 'destroy'])->name('dashboard.mentor.submodules.destroy');
    });

    // admin dashboard
    Route::middleware('is_admin')->group(function () {
        Route::get('/dashboard/admin', [AdminDashboardController::class, 'index'])->name('dashboard.admin');
        Route::get('/dashboard/admin/users', [AdminDashboardController::class, 'users'])->name('dashboard.admin.users');
        Route::get('/dashboard/admin/modules', [AdminDashboardController::class, 'modules'])->name('dashboard.admin.modules');
        Route::get('/dashboard/admin/categories', [AdminDashboardController::class, 'categories'])->name('dashboard.admin.categories');
        Route::post('/dashboard/admin/categories', [CategoryController::class, 'store'])->name('api.categories.store');
        Route::delete('/dashboard/admin/categories/{category}', [CategoryController::class, 'destroy'])->name('api.categories.delete');
        Route::get('/dashboard/admin/mentor-approval', [AdminDashboardController::class, 'mentorApproval'])->name('dashboard.admin.mentorApproval');
        Route::post('/admin/mentor-verification/{id}/approve', [AdminMentorVerificationController::class, 'approve'])->name('admin.mentorVerification.approve');
        Route::post('/admin/mentor-verification/{id}/reject', [AdminMentorVerificationController::class, 'reject'])->name('admin.mentorVerification.reject');
        Route::delete('/dashboard/admin/modules/{module}', [ModuleController::class, 'destroy'])->name('admin.modules.destroy');
    });

});

// Route::middleware('auth')->group(function () {
//     Route::post('/modules', [ModuleController::class, 'store'])->name('api.modules.store');
// });

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


/*
|--------------------------------------------------------------------------
| Custom Routes (Semua Developer)
| Diletakkan DI BAWAH route bawaan, tetapi DI ATAS auth.php
|--------------------------------------------------------------------------
*/

/* ======================================================
| Developer 1 - User & Mentor Verification (WEB)
| - User: view mentor verification form (guest must login to submit)
| - Admin: approve / reject (admin panel)
======================================================*/

Route::middleware(['auth'])->group(function () {
    Route::get('/mentor/verification', function () {
        return view('mentor.submit');
    })->name('mentor.verification.form');

    Route::post('/mentor/verification', [MentorVerificationController::class, 'store']
    )->name('mentor.verification.store');
});




// Mentor verification UI (show form). Guests can view the form page but submission requires auth.
Route::get('/mentor/verification', function () {
    return view('mentor.submit'); // simple blade for upload/submit form (frontend will call API)
})->name('mentor.verification.form');


// Admin panel for mentor verification (approve/reject) - admin only
Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/admin/mentor-verification', [AdminMentorVerificationController::class, 'index'])
         ->name('admin.mentorVerification.index');

    Route::post('/admin/mentor-verification/{id}/approve', [AdminMentorVerificationController::class, 'approve'])
         ->name('admin.mentorVerification.approve');

    Route::post('/admin/mentor-verification/{id}/reject', [AdminMentorVerificationController::class, 'reject'])
         ->name('admin.mentorVerification.reject');
});

/*
|--------------------------------------------------------------------------
| Pelajaran (PUBLIC: Guest boleh akses)
|--------------------------------------------------------------------------
| - Halaman list modul (search & filter)
| - Blade: modules/index.blade.php
*/
Route::get('/pelajaran', [LessonController::class, 'index'])
    ->name('pelajaran.index'); // guest allowed


/*
|--------------------------------------------------------------------------
| Modul (AUTH ONLY)
|--------------------------------------------------------------------------
| - Guest TIDAK boleh akses modul detail
| - Jika guest buka /pelajaran/modul/{id} → redirect otomatis ke login
| - Blade: modules/show.blade.php
*/
Route::get('/pelajaran/modul/{id}', [LessonController::class, 'showModule'])
    ->middleware('auth')
    ->name('pelajaran.module.show');


/*
|--------------------------------------------------------------------------
| Submodule (AUTH ONLY)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // Show submodule
    Route::get(
        '/pelajaran/modul/{moduleId}/submodul/{submoduleId}',
        [LessonController::class, 'showSubmodule']
    )->name('pelajaran.submodule.show');

    // Toggle complete / undo
    Route::post(
        '/pelajaran/modul/{moduleId}/submodul/{submoduleId}/toggle',
        [LessonController::class, 'toggleSubmodule']
    )->name('pelajaran.submodule.toggle');

});



/* ======================================================
| Developer 4 - Likes (WEB)
| - Like button in UI will call API; provide optional fallback web post (redirect)
======================================================*/

Route::middleware('auth')->group(function () {
    Route::post('/modules/{id}/like', [LikeController::class, 'toggle'])
        ->name('modules.like');
});


/*
|--------------------------------------------------------------------------
| Breeze Authentication Routes
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';