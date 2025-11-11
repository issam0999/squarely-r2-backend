<?php

use App\Http\Controllers\Api\V1\CenterController;
use App\Http\Controllers\Api\V1\ContactController;
use App\Http\Controllers\Api\V1\UserController;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum', 'verified')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::prefix('v1')->group(function () {
        Route::apiResource('users', UserController::class);
        Route::apiResource('contacts', ContactController::class);
        Route::apiResource('centers', CenterController::class);
    });
});
require __DIR__.'/auth.php';
