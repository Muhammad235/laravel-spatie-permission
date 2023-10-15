<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Requests\AdminStoreUserRequest;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //user roles and permissions
        // $users = User::with('roles.permissions')->get();
        // $users = User::with('roles')->get();

        $users = UserResource::collection(User::paginate(10));

        if (!$users) {
            return response()->json(['error' => 'No users found'], 404);
        }

        return response()->json([
            "data" =>  $users,
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminStoreUserRequest $request)
    {

        $request->validated();

        //create a user or get the user if it been created already
        $user = User::firstOrCreate(['email' => $request->email],
        [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        $user->userProfile()->updateOrCreate(['user_id' => $user->id], [
        'firstname' => $request->firstname,
        'lastname' => $request->lastname,
        'gender' => $request->gender,
        'active' => true,
        ]);

        $user->assignRole('customer');

        $user_details = new UserResource($user);

        return response()->json([
            'data' => $user_details,
            'message' => "User created successfully"
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {

        $user_details = new UserResource($user);

        return response()->json([
            'data' => $user_details,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        // Revoke all tokens...
        $user->tokens()->delete();

        return response()->json([
            'message' => "User deleted successfully",
        ], 200);
    }
}


