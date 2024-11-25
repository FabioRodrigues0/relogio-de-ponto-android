<?php

use App\Http\Controllers\Api\ScheduleController;
use App\Http\Controllers\UserApiController;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::get('/users', [UserApiController::class, 'index'])->name('api.users.index');
Route::get('/profile/{id}', [UserApiController::class, 'show'])->name('api.profile.show');


// Rotas para o ScheduleController
Route::get('/schedule/{id}', [ScheduleController::class, 'show'])->name('api.schedule.show');

