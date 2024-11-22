<?php

use App\Http\Controllers\Api\ScheduleApiController;
use App\Http\Controllers\Api\UserApiController;
use Illuminate\Support\Facades\Route;


Route::get('/users', [UserApiController::class, 'index'])->name('api.users.index');
Route::get('/profile/{id}', [UserApiController::class, 'show'])->name('api.profile.show');


// Rotas para o ScheduleApiController
Route::get('/schedules', [ScheduleApiController::class, 'index']);  // Listar todos os horários
Route::get('/schedules/{id}', [ScheduleApiController::class, 'show']);  // Exibir um horário específico
Route::put('/schedules/{id}', [ScheduleApiController::class, 'update']);  // Atualizar um horário
