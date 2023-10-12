<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;


class UserAuthController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {

        $request->validated();

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken($user->name)->plainTextToken;

        return response()->json([
            "data" =>  $user,
            "token" =>  $token,
        ],201);
    }



    /**
     * login a user
     */
    public function login(LoginUserRequest $request)
    {
      $request->validated($request->all());

      if (!Auth::attempt($request->only(['email', 'password']))) {
            return response()->json([
                    'error' => 'provided credentials are incorrect'
            ], 401);
      }

      $user = User::where('email', $request->input('email'))->first();

      $token = $user->createToken($user->name)->plainTextToken;

      return response()->json([
        "data" =>  $user,
        "token" =>  $token,
      ], 200);

    }


    /**
     * Remove the specified resource from storage.
     */
    public function logout()
    {
        Auth::user()->currentAccessToken()->delete();

        return response()->json([], 204);
    }
}
