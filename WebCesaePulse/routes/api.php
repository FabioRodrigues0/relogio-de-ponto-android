<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserApiController;
use App\Http\Controllers\Api\ScheduleController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::get('/users', [UserApiController::class, 'index'])->name('api.users.index');
Route::get('/profile/{id}', [UserApiController::class, 'show'])->name('api.profile.show');


// Rotas para o ScheduleController
Route::get('/schedules', [ScheduleController::class, 'index']);  // Listar todos os horários
Route::get('/schedules/{id}', [ScheduleController::class, 'show']);  // Exibir um horário específico
Route::put('/schedules/{id}', [ScheduleController::class, 'update']);  // Atualizar um horário
