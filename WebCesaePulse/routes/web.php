<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [UserController::class, 'home'])->name('home.page');
Route::get('/users', [UserController::class, 'index'])->name('users.home');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get("/register", [AuthController::class, 'register'])->name('register.get');
Route::post("/create_user", [AuthController::class, 'createUser'])->name('user.create');

//contacts
Route::get("/view_contact/{id}", [UserController::class, 'viewContact'])->name('userContact.view');
Route::post("/update_contact", [UserController::class, 'updateUser'])->name('update.contact');

Route::fallback(function(){
    return '<h1> Esta página não existe! </h1>';
});
