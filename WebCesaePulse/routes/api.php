<?php

use App\Http\Controllers\Api\ApiAuthController;
use App\Http\Controllers\Api\ScheduleController;
use App\Http\Controllers\Api\SessionController;
use App\Http\Controllers\UserApiController;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::get('/users', [UserApiController::class, 'index']);
Route::get('/profile/{id}', [UserApiController::class, 'show']);
Route::post('/check-in/{id}/{type}', [UserApiController::class, 'checkInRequest']);
Route::post('/check-out/{id}', [UserApiController::class, 'checkOutRequest']);


// Rotas para o ScheduleController
Route::get('/schedule/{id}', [ScheduleController::class, 'show'])->name('api.schedule.show');

// Rotas para o SessionController
Route::get('session/{id}', [SessionController::class, 'show'])->name('api.session.show');

// Rotas para o AuthController
Route::post('login', [ApiAuthController::class, 'login'])->name('api.login');
Route::post('logout', [ApiAuthController::class, 'logout'])->name('api.logout');
