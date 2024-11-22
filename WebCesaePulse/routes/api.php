<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserApiController;


// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::get('/users', [UserApiController::class, 'index'])->name('api.users.index');
Route::get('/profile/{id}', [UserApiController::class, 'show'])->name('api.profile.show');
