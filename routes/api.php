<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
*/

//login
Route::post('login', [LoginController::class, 'login']);

//get authenticated user
Route::get('/user', [UsersController::class, 'index']);

// update authenticated user
Route::patch('/user', [UsersController::class, 'update']);

// (soft)delete user
Route::delete('/user/{id}', [UsersController::class, 'destroy']);

//create user
Route::post('/user/create', [RegisterController::class, 'create']);

/*
|--------------------------------------------------------------------------
| Service Routes
|--------------------------------------------------------------------------
*/

