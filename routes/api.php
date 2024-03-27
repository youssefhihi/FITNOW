<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\ProgressController;
use Laravel\Sanctum\Sanctum;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|*/
Route::post('/auth/register', [UserController::class, 'createUser']);
Route::post('/auth/login', [UserController::class, 'loginUser']);   
Route::middleware('auth:sanctum')->group(function () {
Route::get('/progress', [ProgressController::class,'index']);
Route::post('/progress/add', [ProgressController::class,'store']);
Route::put('/progress/update/{progress}', [ProgressController::class,'update']);
Route::patch('/progress/update-status/{progress}', [ProgressController::class,'edit']);
Route::delete('/progress/delete/{progress}', [ProgressController::class,'destroy']);
Route::post('/logout', [UserController::class,'logout']);
});