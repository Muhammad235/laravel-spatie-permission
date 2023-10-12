<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\AdminLoginRequest;


class AdminAuthController extends Controller
{

    /**
     * login a user
     */

    public function login(AdminLoginRequest $request)
    {
        $request->validated($request->all());

        $admin = User::where('email', $request->email)->first();

        if (!$admin || !Hash::check($request->password, $admin->password)) {
           return response()->json([
                'error' => 'provided credentials are incorrect'
           ], 401);
        }

        $token = $admin->createToken($admin->name)->plainTextToken;

        return response()->json([
            "data" =>  $admin,
            "token" =>  $token,
        ],200);
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
