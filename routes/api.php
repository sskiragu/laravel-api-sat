<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/signup', [AuthController::class, 'signup']);
Route::post('/login', [AuthController::class, 'login']);

// Route::apiResource('profile', ProfileController::class)->middleware('auth:sanctum');
Route::group(['middleware' => 'auth:sanctum'], function(){
    Route::apiResource('profile', ProfileController::class);
    Route::post('/logout', [AuthController::class, 'logout']);
});
