<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request) {
        $credentials = $request->only(['email','password']);

        if(!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'incorrect email/password'], 401);
        }

        return response()->json(['token' => $token]);
    }
}
