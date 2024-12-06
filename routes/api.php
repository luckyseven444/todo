<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

Route::post('/login', function (Request $request) {

    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
        'device_name' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();

    if (! $user || ! Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'message' => 'The provided credentials are incorrect.',
        ]);
        // return response()->json([
        //     'message' => 'The provided credentials are incorrect.',
        // ]);
    }

    // return $user->createToken($request->device_name)->plainTextToken;
    return response()->json([
        'token' => $user->createToken($request->device_name)->plainTextToken,
    ]);
});

// Group routes with common 'auth:sanctum' middleware
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/todos/status', [TodoController::class, 'status']);
    Route::apiResource('todos', TodoController::class);
});
