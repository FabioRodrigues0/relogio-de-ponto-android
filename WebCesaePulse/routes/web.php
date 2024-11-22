<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StatisticController;

Route::get('/', function () {
    return redirect('/login');
});

//users
Route::get('/home', [UserController::class, 'home'])->name('home.page')->middleware('auth');
Route::get('/users', [UserController::class, 'index'])->name('users.home')->middleware('auth');
Route::get('/users_delete/{id}', [UserController::class, 'deleteUser'])->name('users.delete');
Route::get('/user_profile/{id}', [UserController::class, 'showUserProfile'])->name('user.profile');
Route::post('/password_request', [UserController::class, 'passwordRequest'])->name('user.password');
Route::post('/check_in', [UserController::class, 'checkInRequest'])->name('user.checkIn');
Route::post('/check_out', [UserController::class, 'checkOutRequest'])->name('user.checkOut');

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
Route::post('/admin_password_request/{id}', [AdminController::class, 'concludePasswordRequest'])->name('admin.password');
Route::get('/admin/home', [AdminController::class, 'adminHome'])->name('admin.get')->middleware('auth');

//Route::get('/statistics', [StatisticController::class, 'statistics']);
Route::get('/admin/statistics', [StatisticController::class, 'statistics'])->name('admin.statistics');
Route::fallback(function(){
    return '<h1> Esta página não existe! </h1>';
});
