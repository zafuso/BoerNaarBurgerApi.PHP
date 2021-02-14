<?php

use App\Http\Controllers\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
*/

Route::get('/users', [UsersController::class, 'index']);
Route::middleware('auth')->get('/user/{id}', [UsersController::class, 'show']);

Route::post('/users/create', [UsersController::class, 'store']);

Route::get('login', [UsersController::class, 'logIn']);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
