<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
| Ini route yang akan dipakai oleh semua developer.
| Setiap developer punya blok route sendiri agar tidak konflik saat merge.
|--------------------------------------------------------------------------
*/


/* ======================================================
| Developer 1 - User & Mentor Verification
|======================================================*/
Route::prefix('user')->group(function () {

    // Public user-related API
    Route::get('/profile', [App\Http\Controllers\UserController::class, 'profile'])->middleware('auth:sanctum');

    // Mentor Verification - User submit request
    Route::post('/mentor-verification', [App\Http\Controllers\MentorVerificationController::class, 'submit'])
        ->middleware('auth:sanctum');

});

/* Admin - verify mentor */
Route::prefix('admin')->middleware(['auth:sanctum', 'is_admin'])->group(function () {
    Route::get('/mentor-verification', [App\Http\Controllers\AdminMentorVerificationController::class, 'index']);
    Route::post('/mentor-verification/{id}/approve', [App\Http\Controllers\AdminMentorVerificationController::class, 'approve']);
    Route::post('/mentor-verification/{id}/reject', [App\Http\Controllers\AdminMentorVerificationController::class, 'reject']);
});



/* ======================================================
| Developer 2 - Module & Category
|======================================================*/
Route::prefix('modules')->group(function () {

    Route::get('/', [App\Http\Controllers\ModuleController::class, 'index']);
    Route::post('/', [App\Http\Controllers\ModuleController::class, 'store']);
    Route::get('/{id}', [App\Http\Controllers\ModuleController::class, 'show']);

});

/* Category */
Route::prefix('categories')->group(function () {

    Route::get('/', [App\Http\Controllers\CategoryController::class, 'index']);
    Route::post('/', [App\Http\Controllers\CategoryController::class, 'store']);

});



/* ======================================================
| Developer 3 - Submodule & Progress
|======================================================*/
Route::prefix('submodules')->group(function () {

    Route::get('/{id}', [App\Http\Controllers\SubmoduleController::class, 'show']);
    Route::post('/', [App\Http\Controllers\SubmoduleController::class, 'store']);

});

/* Progress */
Route::prefix('progress')->middleware('auth:sanctum')->group(function () {
    
    Route::post('/mark', [App\Http\Controllers\ProgressController::class, 'markProgress']);

});



/* ======================================================
| Developer 4 - Likes
|======================================================*/
Route::prefix('likes')->middleware('auth:sanctum')->group(function () {

    Route::post('/', [App\Http\Controllers\LikeController::class, 'store']);
    Route::delete('/{id}', [App\Http\Controllers\LikeController::class, 'destroy']);

});
