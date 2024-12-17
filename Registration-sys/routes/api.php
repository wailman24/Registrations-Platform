<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\UserController;
use Illuminate\Auth\Events\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/* Route::get('/api', function (Request $request) {
    
})->middleware('auth:sanctum'); */

Route::post('login', [UserController::class, 'Login']);
Route::post('register', [UserController::class, 'store']);

Route::middleware(['auth:sanctum', 'IsUser'])->group(function () {
    Route::post('user/participate', [ParticipantController::class, 'store']); //participate as not a leader
});
Route::middleware(['auth:sanctum', 'IsTL'])->group(function () {
    Route::post('lead/participate', [ParticipantController::class, 'store']); //create a team and participate
});

Route::middleware(['auth:sanctum', 'IsAdmin'])->group(function () {
    Route::apiResource('participants', ParticipantController::class);
    Route::apiResource('team', TeamController::class);
    Route::apiResource('role', RoleController::class);
    Route::get('getallusers', [UserController::class, 'index']);
});
