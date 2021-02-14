<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return User[]|Collection|Response
     */
    public function index()
    {
        return User::all();
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name'            => ['required', 'string'],
            'last_name'             => ['required', 'string'],
            'email'                 => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'              => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return User|Model|Response
     */
    public function store(Request $request)
    {
        return User::create([
            'first_name'    => $request['first_name'],
            'last_name'     => $request['last_name'],
            'email'         => $request['email'],
            'password'      => Hash::make($request['password']),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return User|User[]|Collection|Model|Response
     */
    public function show($id)
    {
        return User::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return User|User[]|bool|Collection|Model
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->update($request->all());
        return $user;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return int
     */
    public function destroy($id)
    {
        return User::destroy($id);
    }

    public function logIn(Request $request) {
        $credentials = $request->only(['email','password']);

        $token = auth()->attempt($credentials);

        return $token;
    }

    public function getUser(Request $request) {

    }
}
