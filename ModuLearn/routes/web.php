<?php

use Illuminate\Support\Facades\Route;

// Public Controllers
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\PublicModuleController;
use App\Http\Controllers\PublicCategoryController;

// Mentee Controllers
use App\Http\Controllers\MenteeDashboardController;
use App\Http\Controllers\MenteeModuleController;
use App\Http\Controllers\MenteeSubmoduleController;
use App\Http\Controllers\MenteeProgressController;
use App\Http\Controllers\RoleSwitchController;

// Mentor Controllers
use App\Http\Controllers\MentorDashboardController;
use App\Http\Controllers\MentorModuleController;
use App\Http\Controllers\MentorSubmoduleController;

// Admin Controllers
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\AdminModuleController;
use App\Http\Controllers\AdminUserController;



/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES (Guest + Non-login)
|--------------------------------------------------------------------------
*/

// Landing Page
Route::get('/', [LandingPageController::class, 'index'])->name('landing');

// Public category list
Route::get('/categories', [PublicCategoryController::class, 'index'])->name('public.categories');

// Public modules list
Route::get('/modules', [PublicModuleController::class, 'index'])->name('public.modules');

// Public module details
Route::get('/modules/{module}', [PublicModuleController::class, 'show'])->name('public.modules.show');




/*
|--------------------------------------------------------------------------
| AUTHENTICATED USER ROUTES (Mentor + Mentee, both use same login)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | ROLE SWITCHING
    |--------------------------------------------------------------------------
    */
    Route::get('/switch-role', [RoleSwitchController::class, 'switch'])->name('switch.role');


    /*
    |--------------------------------------------------------------------------
    | MENTEE ROUTES
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:mentee'])->prefix('mentee')->name('mentee.')->group(function () {

        // Dashboard
        Route::get('/dashboard', [MenteeDashboardController::class, 'index'])->name('dashboard');

        // Browse modules
        Route::get('/modules', [MenteeModuleController::class, 'index'])->name('modules.index');
        Route::get('/modules/{module}', [MenteeModuleController::class, 'show'])->name('modules.show');

        // Access submodules
        Route::get('/submodules/{submodule}', [MenteeSubmoduleController::class, 'show'])->name('submodules.show');

        // Mark as done
        Route::post('/submodules/{submodule}/done', [MenteeProgressController::class, 'markAsDone'])
            ->name('submodules.done');

        // History / Progress
        Route::get('/progress', [MenteeProgressController::class, 'index'])->name('progress');
    });



    /*
    |--------------------------------------------------------------------------
    | MENTOR ROUTES
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:mentor', 'mentor.approved'])->prefix('mentor')->name('mentor.')->group(function () {

        // Dashboard
        Route::get('/dashboard', [MentorDashboardController::class, 'index'])->name('dashboard');

        /*
        |--------------------------------------------------------------------------
        | MODULE CRUD
        |--------------------------------------------------------------------------
        */
        Route::get('/modules', [MentorModuleController::class, 'index'])->name('modules.index');
        Route::get('/modules/create', [MentorModuleController::class, 'create'])->name('modules.create');
        Route::post('/modules', [MentorModuleController::class, 'store'])->name('modules.store');
        Route::get('/modules/{module}/edit', [MentorModuleController::class, 'edit'])->name('modules.edit');
        Route::put('/modules/{module}', [MentorModuleController::class, 'update'])->name('modules.update');
        Route::delete('/modules/{module}', [MentorModuleController::class, 'destroy'])->name('modules.destroy');

        /*
        |--------------------------------------------------------------------------
        | SUBMODULE CRUD (belongs to mentor's module)
        |--------------------------------------------------------------------------
        */
        Route::get('/modules/{module}/submodules/create', [MentorSubmoduleController::class, 'create'])->name('submodules.create');
        Route::post('/modules/{module}/submodules', [MentorSubmoduleController::class, 'store'])->name('submodules.store');
        Route::get('/submodules/{submodule}/edit', [MentorSubmoduleController::class, 'edit'])->name('submodules.edit');
        Route::put('/submodules/{submodule}', [MentorSubmoduleController::class, 'update'])->name('submodules.update');
        Route::delete('/submodules/{submodule}', [MentorSubmoduleController::class, 'destroy'])->name('submodules.destroy');
    });

});




/*
|--------------------------------------------------------------------------
| ADMIN ROUTES (Different Login)
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->group(function () {

    // Admin Login (custom)
    Route::get('/login', [AdminDashboardController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminDashboardController::class, 'login'])->name('login.submit');

    Route::middleware(['auth:admin'])->group(function () {

        // Dashboard
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');


        /*
        |--------------------------------------------------------------------------
        | MANAGE CATEGORIES
        |--------------------------------------------------------------------------
        */
        Route::get('/categories', [AdminCategoryController::class, 'index'])->name('categories.index');
        Route::get('/categories/create', [AdminCategoryController::class, 'create'])->name('categories.create');
        Route::post('/categories', [AdminCategoryController::class, 'store'])->name('categories.store');
        Route::get('/categories/{category}/edit', [AdminCategoryController::class, 'edit'])->name('categories.edit');
        Route::put('/categories/{category}', [AdminCategoryController::class, 'update'])->name('categories.update');
        Route::delete('/categories/{category}', [AdminCategoryController::class, 'destroy'])->name('categories.destroy');


        /*
        |--------------------------------------------------------------------------
        | MANAGE MODULES
        |--------------------------------------------------------------------------
        */
        Route::get('/modules', [AdminModuleController::class, 'index'])->name('modules.index');
        Route::get('/modules/{module}', [AdminModuleController::class, 'show'])->name('modules.show');
        Route::delete('/modules/{module}', [AdminModuleController::class, 'destroy'])->name('modules.destroy');


        /*
        |--------------------------------------------------------------------------
        | MANAGE USERS (Mentor + Mentee)
        |--------------------------------------------------------------------------
        */
        Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');

        // Approval mentor
        Route::post('/users/{user}/approve', [AdminUserController::class, 'approveMentor'])->name('users.approve');
        Route::post('/users/{user}/reject', [AdminUserController::class, 'rejectMentor'])->name('users.reject');

        // Delete user
        Route::delete('/users/{user}', [AdminUserController::class, 'destroy'])->name('users.destroy');
    });
});


/*
|--------------------------------------------------------------------------
| AUTH ROUTES (Laravel Breeze)
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';

