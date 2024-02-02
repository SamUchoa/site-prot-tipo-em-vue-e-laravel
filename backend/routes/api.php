<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
});
Route::post('/logoutall', [AuthController::class, 'logoutAll']);
Route::post('/tokens', [AuthController::class, 'getTokens']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
