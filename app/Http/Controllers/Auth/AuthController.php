<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUser;
use App\Mail\ResetPasswordMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    protected function create(CreateUser $request)
    {
        User::create([
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);

        return $this->login($request);
    }

    public function login(Request $request) {
        $credentials = $request->only(['email','password']);

        if(!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Het opgegeven e-mailadres of wachtwoord is incorrect.'], Response::HTTP_UNAUTHORIZED);
        }

        return $this->respondWithToken($token);
    }

    public function me()
    {
        return response()->json(auth()->user());
    }


    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user()
        ]);
    }

    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'Uitloggen succesvol.']);
    }

    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    public function resetPassword(Request $request) {
        if(!$this->validateEmail($request->email)) {
            return response()->json(['error' => 'Het opgegeven e-mailadres is onbekend.'], Response::HTTP_NOT_FOUND);
        }

        Mail::to($request->email)->send(new ResetPasswordMail);
        return response()->json(['message' => 'Wachtwoord reset e-mail is succesvol verzonden.'], Response::HTTP_OK);
    }

    public function validateEmail($email) {
        return !!User::where(['email' => $email])->first();
    }

}
