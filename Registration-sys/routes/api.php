<?php

use App\Http\Controllers\UserController;
use Illuminate\Auth\Events\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::post('login', [UserController::class, 'Login']);
Route::post('register', [UserController::class, 'store']);
