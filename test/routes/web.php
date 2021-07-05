<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function(){

    Route::get('/users',[App\Http\Controllers\UsersController::class,'showUsersView'])->name('users.show');
    Route::post('/user-add',[App\Http\Controllers\UsersController::class,'addUser'])->name('user.add');    
    Route::get('/user-roles/{id}',[App\Http\Controllers\UsersController::class,'showUserRolesView'])->name('user.roles');
    Route::post('/assign-rol',[App\Http\Controllers\UsersController::class,'assignRol'])->name('rol.assign');
    Route::post('/unassign-rol',[App\Http\Controllers\UsersController::class,'unassignRol'])->name('rol.unassign');
    Route::get('/user-edit/{id}',[App\Http\Controllers\UsersController::class,'showEditUserView'])->name('user.edit');
    Route::post('/user-update',[App\Http\Controllers\UsersController::class,'updateUser'])->name('user.update');
    Route::get('/user-delete/{id}',[App\Http\Controllers\UsersController::class,'deleteUser'])->name('user.delete');
    Route::get('/roles',[App\Http\Controllers\RolesController::class,'showRolesView'])->name('roles.show');
    Route::post('/add-rol',[App\Http\Controllers\RolesController::class,'addRol'])->name('rol.add');
    Route::get('/edit-rol/{id}',[App\Http\Controllers\RolesController::class,'showEditRolView'])->name('rol.edit');
    Route::post('/update-rol',[App\Http\Controllers\RolesController::class,'updateRol'])->name('rol.update');
    Route::get('/delete-rol/{id}',[App\Http\Controllers\RolesController::class,'deleteRol'])->name('rol.delete');   
    
});