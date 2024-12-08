<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\AuthController;

Route::post('/login', [AuthController::class, 'login']);

// Group routes with common 'auth:sanctum' middleware
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/todos/status/{todo}', [TodoController::class, 'status']);
    Route::apiResource('todos', TodoController::class);
});
