<?php

use App\Http\Controllers\Api\V1\ContactController;
use App\Http\Controllers\Api\V1\UserController;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
Route::prefix('v1')->group(function () {
    Route::middleware('auth:sanctum')->group(function () {
        Route::apiResource('users', UserController::class);
        Route::apiResource('contacts', ContactController::class);
    });
});

Route::prefix('v2')->group(function () {

    Route::middleware('auth:sanctum')->group(function () {
        // Future v2 routes will go here
    });
});
require __DIR__ . '/auth.php';
