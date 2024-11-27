<?php

use App\Http\Controllers\Api\ApiAuthController;
use App\Http\Controllers\Api\ScheduleApiController;
use App\Http\Controllers\Api\SessionController;
use App\Http\Controllers\Api\UserApiController;
use Illuminate\Support\Facades\Route;

Route::get('/users', [UserApiController::class, 'index']);
Route::get('/profile/{id}', [UserApiController::class, 'show']);
Route::post('/check-in/{id}/{type}', [UserApiController::class, 'checkInRequest']);
Route::post('/check-out/{id}', [UserApiController::class, 'checkOutRequest']);


// Rotas para o ScheduleController
Route::get('/schedule/{id}/{month}', [ScheduleApiController::class, 'show']);

// Rotas para o SessionController
Route::get('session/{id}', [SessionController::class, 'show']);

// Rotas para o AuthController
Route::post('login', [ApiAuthController::class, 'login']);
Route::post('logout', [ApiAuthController::class, 'logout']);
