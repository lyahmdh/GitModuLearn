<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminMentorVerificationController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubmoduleController;
use App\Http\Controllers\LikeController;

/*
|--------------------------------------------------------------------------
| Default Breeze Routes
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
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


/* ======================================================
| Developer 2 - Module & Category (WEB)
| - List pages (public/guest)
| - Detail page for module: require auth to open (clicking a module redirects to login if guest)
======================================================*/

// Modules listing page (public: guest can search/filter but not open module)
Route::get('/modules', function () {
    return view('modules.index'); // frontend will consume API for data & interactions
})->name('modules.index')->middleware('guest_access');

// Module detail page: require login (clicking a module should redirect to login for guests)
Route::get('/modules/{id}', function ($id) {
    return view('modules.show', ['moduleId' => $id]); // frontend loads data via API
})->middleware('auth')->name('modules.show');

// Categories listing page (public)
Route::get('/categories', function () {
    return view('categories.index');
})->name('categories.index')->middleware('guest_access');


/* ======================================================
| Developer 3 - Submodule & Progress (WEB)
| - Submodule page can be same as module detail; detail content fetched by JS/API
======================================================*/

// If you want a dedicated submodule view:
Route::get('/modules/{moduleId}/submodules/{submoduleId}', function ($moduleId, $submoduleId) {
    return view('submodules.show', ['moduleId' => $moduleId, 'submoduleId' => $submoduleId]);
})->middleware('auth')->name('submodules.show');


/* ======================================================
| Developer 4 - Likes (WEB)
| - Like button in UI will call API; provide optional fallback web post (redirect)
======================================================*/

// Optional fallback route (POST) — but frontend should use API for likes
Route::post('/like', function (\Illuminate\Http\Request $request) {
    // For fallback only: you can redirect or handle via controller
    return redirect()->back();
})->middleware('auth')->name('like.fallback');


/*
|--------------------------------------------------------------------------
| Breeze Authentication Routes
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';
