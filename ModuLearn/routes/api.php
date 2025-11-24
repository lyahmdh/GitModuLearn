<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ModuleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubmoduleController;
use App\Http\Controllers\SubmoduleProgressController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\MentorVerificationController;

/*
|--------------------------------------------------------------------------
| API Routes (modular)
|--------------------------------------------------------------------------
|
| Struktur: /api/{domain}/...
| - Public endpoints (no auth) return JSON for listing/search/filter
| - Authenticated endpoints use 'auth:sanctum'
|
*/

/* ======================================================
| Developer 2 - Module & Category (API)
| - GET /api/modules  => browse + supports query params: category, keyword, sort, page
| - GET /api/modules/search => helper route (same controller)
| - GET /api/modules/filter => helper route (same controller)
| - POST /api/modules => create module (mentor only: verified_mentor)
| - PUT /api/modules/{module} => update module (mentor only)
| - DELETE /api/modules/{module} => delete module (admin only)
|
| - GET /api/categories => list categories (public)
| - POST/PUT/DELETE /api/categories => admin only
======================================================*/

// Modules — listing & search (public)
Route::get('/modules', [ModuleController::class, 'index']);           // supports ?category=&keyword=&sort=
Route::get('/modules/search', [ModuleController::class, 'index']);    // alias for search
Route::get('/modules/filter', [ModuleController::class, 'index']);    // alias for filter

// Module CRUD (authenticated)
Route::middleware(['auth:sanctum', 'verified_mentor'])->group(function () {
    Route::post('/modules', [ModuleController::class, 'store']);      // create by verified mentor
    Route::put('/modules/{module}', [ModuleController::class, 'update']);
});

// Module delete: admin only
Route::middleware(['auth:sanctum', 'is_admin'])->group(function () {
    Route::delete('/modules/{module}', [ModuleController::class, 'destroy']);
});

// Categories
Route::get('/categories', [CategoryController::class, 'index']);     // public list
Route::middleware(['auth:sanctum', 'is_admin'])->group(function () {
    Route::post('/categories', [CategoryController::class, 'store']);
    Route::put('/categories/{category}', [CategoryController::class, 'update']);
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy']);
});


/* ======================================================
| Developer 3 - Submodule & Progress (API)
| - Submodule endpoints are nested under modules
| - CRUD for submodules => verified mentors only
| - Progress mark => authenticated users (mentee/mentor) via POST
======================================================*/

// Submodules listing per module (public data, but content viewing may require auth depending frontend)
Route::get('/modules/{module}/submodules', [SubmoduleController::class, 'index']);

// Submodule CRUD (mentor only, verified)
Route::middleware(['auth:sanctum', 'verified_mentor'])->group(function () {
    Route::post('/modules/{module}/submodules', [SubmoduleController::class, 'store']);
    Route::put('/submodules/{submodule}', [SubmoduleController::class, 'update']);
    Route::delete('/submodules/{submodule}', [SubmoduleController::class, 'destroy']);
});

// Progress (mark as done) — authenticated users
Route::middleware('auth:sanctum')->post('/progress/mark', [SubmoduleProgressController::class, 'markAsDone']);


/* ======================================================
| Developer 4 - Likes (API)
| - Toggle like on module
| - Authenticated users only (mentee or mentor)
======================================================*/
Route::middleware('auth:sanctum')->post('/modules/{module}/like', [LikeController::class, 'toggle']);


/* ======================================================
| Developer 1 - Mentor Verification (API)
| - User submits verification details/documents (authenticated)
| - User can view their verification history (authenticated)
| - Admin approval/reject is done via WEB admin panel (AdminMentorVerificationController)
======================================================*/
Route::middleware('auth:sanctum')->group(function () {
    // submit verification (user)
    Route::post('/mentor/verification', [MentorVerificationController::class, 'store']);

    // user checks their verifications
    Route::get('/mentor/verification/me', [MentorVerificationController::class, 'index']);
});


/* ======================================================
| Extra: utility endpoints (optional)
| - profile info (for SPA)
======================================================*/
Route::middleware('auth:sanctum')->get('/me', function (Request $request) {
    return response()->json($request->user());
});

