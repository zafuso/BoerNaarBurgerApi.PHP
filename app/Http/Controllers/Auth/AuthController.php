<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\CreateUserRequest;
use App\Mail\ResetPasswordMail;
use App\Models\PasswordReset;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    protected function create(CreateUserRequest $request)
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
        $email = $request->email;
        if(!$this->validateEmail($email)) {
            return response()->json(['error' => 'Het opgegeven e-mailadres is onbekend.'], Response::HTTP_NOT_FOUND);
        }

        $token = $this->createToken($email);
        Mail::to($email)->send(new ResetPasswordMail($token->token));
        return response()->json(['message' => 'Wachtwoord reset e-mail is succesvol verzonden.'], Response::HTTP_OK);
    }

    public function validateEmail($email) {
        return !!User::where(['email' => $email])->first();
    }

    public function createToken($email)
    {
        $oldToken = PasswordReset::where(['email' => $email])->first();

        if($oldToken) {
            return $oldToken;
        }

        $token = Str::random(60);
        $this->saveToken($token, $email);
        return $token;
    }

    public function saveToken($token, $email) {
        $passwordReset = new PasswordReset;
        $passwordReset->email = $email;
        $passwordReset->token = $token;
        $passwordReset->save();
    }

    public function changePassword(ChangePasswordRequest $request) {
        return $this->getPasswordResetRow($request)->first() ? $this->updatePassword($request) : $this->notFound();
    }

    private function getPasswordResetRow($request) {
        return PasswordReset::where(['email' => $request->email, 'token' => $request->resetToken])->firstOrFail();
    }

    private function notFound(){
        return response()->json(['error' => 'E-mail adres incorrect of wachtwoord reset token verlopen.', Response::HTTP_UNPROCESSABLE_ENTITY]);
    }

    private function updatePassword($request){
        $user = User::whereEmail($request->email)->firstOrFail();
        $user->update(['password' => Hash::make($request->password)]);
        $this->getPasswordResetRow($request)->delete();
        return response()->json(['message' => 'Wachtwoord succesvol gewijzigd.'], Response::HTTP_CREATED);
    }

}
