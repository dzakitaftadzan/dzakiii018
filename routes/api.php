<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    // Route Public
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);

    // Route Protected
    Route::middleware('auth:sanctum')->group(function () {
        // Categories
        Route::apiResource('categories', CategoryController::class)->except(['destroy']);
        Route::delete('categories/{category}', [CategoryController::class, 'destroy'])->middleware('role:admin');

        // Items
        Route::apiResource('items', ItemController::class)->except(['destroy']);
        Route::delete('items/{item}', [ItemController::class, 'destroy'])->middleware('role:admin');
    });
});
