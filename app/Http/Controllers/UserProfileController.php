<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Resources\UserResource;
use App\Http\Requests\UserProfileRequest;
use App\Http\Requests\UpdateUserProfileRequest;

class UserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user =  new UserResource(auth()->user());

        return response()->json([
            "data" =>  $user,
        ],200);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserProfileRequest $request)
    {
        $request->validated(); // You don't need to pass $request->all()

        $user = auth()->user();

        if (! $user) {
            return response()->json([
                "error" =>  "User is unauthenticated",
            ], 401);
        }

        $createProfile = $user->userProfile()->create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'gender' => $request->gender,
            'active' => true,
        ]);

        return response()->json([
            "data" =>  $createProfile,
        ], 200);
    }



    /**
     * Update the specified resource in storage.
     */
    // public function update(UserProfileRequest $request, UserProfile $userProfile)
    // {

    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserProfile $userProfile)
    {
        //
    }
}
