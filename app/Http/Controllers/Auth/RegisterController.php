<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /**
     * Create a new user instance after a valid registration.
     *
     * @param Request $request
     * @return User
     */
    protected function create(Request $request)
    {
        return User::create([
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);
    }
}
