<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
<<<<<<< HEAD
=======
use App\Http\Controllers\AdminController;
>>>>>>> 8b50b1e126fa07bd56be6fe16c04f7796e3503e5

Route::get('/', function () {
    return view('welcome');
});

<<<<<<< HEAD
Route::get('/home', [UserController::class, 'home'])->name('home.page');
Route::get('/users', [UserController::class, 'index'])->name('users.home');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get("/register", [AuthController::class, 'register'])->name('register.get');
Route::post("/create_user", [AuthController::class, 'createUser'])->name('user.create');

=======
//users
Route::get('/home', [UserController::class, 'home'])->name('home.page')->middleware('auth');
Route::get('/users', [UserController::class, 'index'])->name('users.home')->middleware('auth');
Route::get('/users_delete/{id}', [UserController::class, 'deleteUser'])->name('users.delete');

//autenticação
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get("/register", [AuthController::class, 'register'])->name('register.get');
Route::post("/create_user", [AuthController::class, 'createUser'])->name('user.create');

>>>>>>> 8b50b1e126fa07bd56be6fe16c04f7796e3503e5
//contacts
Route::get("/view_contact/{id}", [UserController::class, 'viewContact'])->name('userContact.view');
Route::post("/update_contact", [UserController::class, 'updateUser'])->name('update.contact');

<<<<<<< HEAD
=======
//Admin
Route::get('/admin_home', [AdminController::class, 'adminHome'])->name('admin.home')->middleware('auth');

//fallback
>>>>>>> 8b50b1e126fa07bd56be6fe16c04f7796e3503e5
Route::fallback(function(){
    return '<h1> Esta página não existe! </h1>';
});
