<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('welcome');
});

//users
Route::get('/home', [UserController::class, 'home'])->name('home.page')->middleware('auth');
Route::get('/users', [UserController::class, 'index'])->name('users.home')->middleware('auth');
Route::get('/users_delete/{id}', [UserController::class, 'deleteUser'])->name('users.delete');

//autenticação
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get("/register", [AuthController::class, 'register'])->name('register.get');
Route::post("/create_user", [AuthController::class, 'createUser'])->name('user.create');

//contacts
Route::get("/view_contact/{id}", [UserController::class, 'viewContact'])->name('userContact.view');
Route::post("/update_contact", [UserController::class, 'updateUser'])->name('update.contact');

//Admin
Route::get('/admin_home', [AdminController::class, 'adminHome'])->name('admin.home')->middleware('auth');
Route::get('/admin_search', [AdminController::class, 'adminSearch'])->name('admin.search')->middleware('auth');


//fallback
Route::fallback(function(){
    return '<h1> Esta página não existe! </h1>';
});
