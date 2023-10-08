<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    // public function login(Request $request)
    // {
    // //   $request->validated($request->all());

    //   if (!Auth::attempt($request->only(['email', 'password']))) {
    //     return 'Email or password is not correct';
    //   }

    //   $admin = User::where('email', $request->input('email'))->first();

    //   return response()->json([
    //     'admin' => $admin,
    //     'token' => $admin->createToken($user->name)->plainTextToken
    //   ]);

    // }

    public function login(Request $request)
    {
        // $request->validated($request->all());

        $admin = User::where('email', $request->email)->first();

        if (!$admin || password_verify($request->password, $admin->password)) {
            return response()->json([
                'error' => 'The provided credentials are incorrect',
            ], 401);
        }

      return response()->json([
        'admin' => $admin,
        'token' => $admin->createToken($admin->name)->plainTextToken
      ], 200);

    }

}
