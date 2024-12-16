<?php

use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\UserController;
use Illuminate\Auth\Events\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/* Route::get('/api', function (Request $request) {
    
})->middleware('auth:sanctum'); */

Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('participants', ParticipantController::class);
});
Route::post('login', [UserController::class, 'Login']);
Route::post('register', [UserController::class, 'store']);
