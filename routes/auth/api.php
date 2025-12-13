<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\LogoutController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\User\ProfileController;
use Illuminate\Support\Facades\Route;

    Route::post('/login', LoginController::class);
    Route::post('/register', RegisterController::class);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [LogoutController::class, 'destroy']);
        Route::get('/me', [ProfileController::class, 'show']);
        Route::put('/user/profile', [ProfileController::class, 'update']);
});
