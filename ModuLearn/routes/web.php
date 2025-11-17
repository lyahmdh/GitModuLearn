<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LogoutController;

// Dashboard
use App\Http\Controllers\Dashboard\MenteeDashboardController;
use App\Http\Controllers\Dashboard\MentorDashboardController;
use App\Http\Controllers\Dashboard\AdminDashboardController;

// Mentee
use App\Http\Controllers\Mentee\MenteeModuleController;
use App\Http\Controllers\Mentee\MenteeSubmoduleController;
use App\Http\Controllers\Mentee\MenteeProfileController;

// Mentor
use App\Http\Controllers\Mentor\MentorModuleController;
use App\Http\Controllers\Mentor\MentorSubmoduleController;
use App\Http\Controllers\Mentor\MentorProfileController;
use App\Http\Controllers\Mentor\MentorVerificationController;

// Admin
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminModuleController;
use App\Http\Controllers\Admin\AdminSubmoduleController;
use App\Http\Controllers\Admin\AdminVerificationApprovalController;
use App\Http\Controllers\Admin\AdminLogController;


/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/', [LandingPageController::class, 'index'])->name('landing');

Route::get('/login', [LoginController::class, 'showLoginForm'])
    ->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::get('/register', [RegisterController::class, 'showRegisterForm'])
    ->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::post('/logout', [LogoutController::class, 'logout'])
    ->name('logout');


/*
|--------------------------------------------------------------------------
| AUTHENTICATED ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | MENTEE ROUTES
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:mentee'])->prefix('mentee')->name('mentee.')->group(function () {

        // dashboard
        Route::get('/dashboard', [MenteeDashboardController::class, 'index'])
            ->name('dashboard');

        // module browsing
        Route::get('/modules', [MenteeModuleController::class, 'index'])
            ->name('modules.index');

        Route::get('/modules/{id}', [MenteeModuleController::class, 'show'])
            ->name('modules.show');

        // submodules
        Route::get('/modules/{module_id}/submodules/{id}', [MenteeSubmoduleController::class, 'show'])
            ->name('submodules.show');

        // profile
        Route::get('/profile', [MenteeProfileController::class, 'index'])
            ->name('profile');
        Route::post('/profile/update', [MenteeProfileController::class, 'update'])
            ->name('profile.update');

    });


    /*
    |--------------------------------------------------------------------------
    | MENTOR ROUTES
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:mentor'])->prefix('mentor')->name('mentor.')->group(function () {

        // dashboard
        Route::get('/dashboard', [MentorDashboardController::class, 'index'])
            ->name('dashboard');

        // verification page for unverified mentors
        Route::get('/verification', [MentorVerificationController::class, 'index'])
            ->name('verification');
        Route::post('/verification/submit', [MentorVerificationController::class, 'submit'])
            ->name('verification.submit');

        // Only verified mentors:
        Route::middleware(['mentor.verified'])->group(function () {

            // modules
            Route::get('/modules', [MentorModuleController::class, 'index'])
                ->name('modules.index');
            Route::get('/modules/create', [MentorModuleController::class, 'create'])
                ->name('modules.create');
            Route::post('/modules/store', [MentorModuleController::class, 'store'])
                ->name('modules.store');

            Route::get('/modules/{id}/edit', [MentorModuleController::class, 'edit'])
                ->name('modules.edit');
            Route::post('/modules/{id}/update', [MentorModuleController::class, 'update'])
                ->name('modules.update');
            Route::delete('/modules/{id}/delete', [MentorModuleController::class, 'destroy'])
                ->name('modules.delete');

            // submodules
            Route::get('/modules/{module_id}/submodules/create', [MentorSubmoduleController::class, 'create'])
                ->name('submodules.create');
            Route::post('/modules/{module_id}/submodules/store', [MentorSubmoduleController::class, 'store'])
                ->name('submodules.store');

            // profile
            Route::get('/profile', [MentorProfileController::class, 'index'])
                ->name('profile');
            Route::post('/profile/update', [MentorProfileController::class, 'update'])
                ->name('profile.update');
        });
    });


    /*
    |--------------------------------------------------------------------------
    | ADMIN ROUTES
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {

        // dashboard
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');

        // users
        Route::get('/users', [AdminUserController::class, 'index'])
            ->name('users.index');
        Route::post('/users/update-role', [AdminUserController::class, 'updateRole'])
            ->name('users.updateRole');

        // categories
        Route::resource('/categories', AdminCategoryController::class);

        // modules
        Route::resource('/modules', AdminModuleController::class);

        // submodules
        Route::resource('/submodules', AdminSubmoduleController::class);

        // mentor verification approval
        Route::get('/mentor-verification', [AdminVerificationApprovalController::class, 'index'])
            ->name('verification.index');
        Route::post('/mentor-verification/approve', [AdminVerificationApprovalController::class, 'approve'])
            ->name('verification.approve');
        Route::post('/mentor-verification/reject', [AdminVerificationApprovalController::class, 'reject'])
            ->name('verification.reject');

        // admin log
        Route::get('/logs', [AdminLogController::class, 'index'])
            ->name('logs.index');
    });
});
