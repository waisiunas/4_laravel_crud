<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\UserTrashedController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [UserController::class, 'index'])->name('users');
Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
Route::post('/user/create', [UserController::class, 'store']);
Route::get('/user/{user}/edit', [UserController::class, 'edit'])->name('user.edit');
Route::post('/user/{user}/edit', [UserController::class, 'update']);
Route::get('/user/{user}/destroy', [UserController::class, 'destroy'])->name('user.destroy');

Route::get('/trashed/users', [UserTrashedController::class, 'index'])->name('trashed.users');
Route::get('user/{id}/recover', [UserTrashedController::class, 'recover'])->name('user.recover');
Route::get('user/{id}/delete', [UserTrashedController::class, 'delete'])->name('user.delete');
