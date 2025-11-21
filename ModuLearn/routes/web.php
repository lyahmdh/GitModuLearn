<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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
|--------------------------------------------------------------------------
| Semua blok rute developer diletakkan DI BAWAH route bawaan,
| tetapi DI ATAS auth.php
|--------------------------------------------------------------------------
*/


/* ======================================================
| Developer 1 - User & Mentor Verification (WEB)
====================================================== */
Route::prefix('mentor')->group(function () {

    // Form pengajuan verifikasi mentor
    Route::get('/verification', function () {
        return view('mentor.submit'); // contoh view
    });

    // User submit verifikasi
    Route::post('/verification', [
        App\Http\Controllers\MentorVerificationController::class,
        'submit'
    ])->middleware('auth');
});

/* Admin - Approve / Reject Verification */
Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/admin/mentor-verification', [
        App\Http\Controllers\AdminMentorVerificationController::class,
        'index'
    ]);

    Route::post('/admin/mentor-verification/{id}/approve', [
        App\Http\Controllers\AdminMentorVerificationController::class,
        'approve'
    ]);

    Route::post('/admin/mentor-verification/{id}/reject', [
        App\Http\Controllers\AdminMentorVerificationController::class,
        'reject'
    ]);
});



/* ======================================================
| Developer 2 - Module & Category (WEB)
====================================================== */
Route::get('/modules', [
    App\Http\Controllers\ModuleController::class,
    'index'
]);

Route::get('/categories', [
    App\Http\Controllers\CategoryController::class,
    'index'
]);



/* ======================================================
| Developer 3 - Submodule & Progress (WEB)
====================================================== */
Route::get('/submodules/{id}', [
    App\Http\Controllers\SubmoduleController::class,
    'show'
])->name('submodule.show');



/* ======================================================
| Developer 4 - Likes (WEB)
====================================================== */
Route::post('/like', [
    App\Http\Controllers\LikeController::class,
    'store'
])->middleware('auth');



/*
|--------------------------------------------------------------------------
| Breeze Authentication Routes
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';
