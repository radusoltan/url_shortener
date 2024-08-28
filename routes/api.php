<?php

use App\Http\Controllers\UrlController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Get logged-in User data
Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

// API Routes
Route::middleware('auth:sanctum')->group(function () {

    // Get URLs collection
    Route::get('/urls', [UrlController::class, 'index']);
    Route::post('/urls', [UrlController::class, 'store']);
    Route::get('/urls/{url}', [UrlController::class, 'show']);
    Route::put('/urls/{url}', [UrlController::class, 'update']);
    Route::delete('/urls/{url}', [UrlController::class, 'destroy']);

    // logout
    Route::post('/logout', [\App\Http\Controllers\API\AuthController::class, 'logout']);

});

//API login and logout routes

Route::post('login',[\App\Http\Controllers\API\AuthController::class, 'login']);
Route::post('register',[\App\Http\Controllers\API\AuthController::class, 'register']);
