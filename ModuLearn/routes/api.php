<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ModuleApiController;

Route::middleware('auth:sanctum')->group(function () {

    // return all modules for dashboard widget
    Route::get('/modules', [ModuleApiController::class, 'index']);

});
