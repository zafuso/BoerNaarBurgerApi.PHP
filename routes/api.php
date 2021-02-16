<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
*/
//register (create user)
Route::post('/user/create', [AuthController::class, 'create']);

//login
Route::post('login', [AuthController::class, 'login']);

//get authenticated user
Route::get('/user', [UsersController::class, 'index']);

// update authenticated user
Route::patch('/user', [UsersController::class, 'update']);

// (soft)delete user
Route::delete('/user/{id}', [UsersController::class, 'destroy']);


/*
|--------------------------------------------------------------------------
| Service Routes
|--------------------------------------------------------------------------
*/

