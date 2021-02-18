<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;


class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return $this->authUser();
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
     * @return User
     */
    public function update(User $user)
    {
        $data = request()->validate([
            'first_name'            => '',
            'insertion'             => '',
            'last_name'             => '',
            'gender'                => '',
            'email'                 => '',
            'phone_number'          => '',
            'street'                => '',
            'house_number'          => '',
            'zipcode'               => '',
            'city'                  => '',
            'country'               => '',
            'iban'                  => '',
            'company'               => '',
            'vat_number'            => '',
            'date_of_birth'         => '',
            'has_accepted_terms'    => '',
            'custom_field_1'        => '',
            'custom_field_2'        => '',
            'user_type_id'          => '',
            'password'              => '',
            'avatar'                => '',
        ]);

        if (request('avatar')) {
            $imagePath = request('avatar')->store('uploads','public');

            $avatar = Image::make(public_path("storage/{$imagePath}"))->fit(1000,1000);
            $avatar->save();

            $imageArray = ['avatar' => $imagePath];
        }

        auth()->user()->update(array_merge(
            $data,
            $imageArray ?? []
        ));

        return $user;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        User::destroy($id);

        return response()->json(['user' => 'Successfully deleted user ' . $id]);
    }

}
