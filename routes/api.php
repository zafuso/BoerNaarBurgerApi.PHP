<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/
//register (create user)
Route::post('/user/create', [AuthController::class, 'create']);

//login
Route::post('/login', [AuthController::class, 'login']);

//password reset
Route::post('/password-reset', [AuthController::class, 'resetPassword']);

/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
*/

//get authenticated user
Route::get('/user', [UsersController::class, 'index']);

// update authenticated user
Route::patch('/user', [UsersController::class, 'update']);

// (soft)delete user
Route::delete('/user/{id}', [UsersController::class, 'destroy']);

Route::get('/demo', function () {
    return new App\Mail\ResetPasswordMail();
});

