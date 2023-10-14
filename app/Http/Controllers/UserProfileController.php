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
        $request->validated();

        $user = auth()->user();

        if (! $user) {
            return response()->json([
                "error" =>  "User is unauthenticated",
            ], 401);
        }

        $createProfile = $user->userProfile()->updateOrCreate([
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
    // public function update(UserProfileRequest $request, UserProfile $UserProfile)
    // {
    //     // Validate the request data
    //     $data = $request->validated();

    //     // Check if the user is authenticated
    //     if (!auth()->check()) {
    //         return response()->json([
    //             "error" =>  "User is unauthenticated",
    //         ], 401);
    //     }

    //     // Get the authenticated user
    //     $user = auth()->user();

    //     // Check if the authenticated user owns the user profile being updated
    //     if ($user->id !== $UserProfile->user_id) {
    //         return response()->json([
    //             "error" => "Unauthorized. You don't have permission to update this user profile.",
    //         ], 403);
    //     }

    //     $updateProfile = $UserProfile->update($data);

    //     return response()->json([
    //         "data" => $updateProfile,
    //         "message" => "User profile updated successfully",
    //     ]);
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserProfile $userProfile)
    {
        $user = auth()->user();
        $user->delete();

        // Revoke all tokens...
        $user->tokens()->delete();

    }
}
