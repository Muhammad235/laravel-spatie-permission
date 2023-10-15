<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
// use App\Models\UserProfile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminRolesController extends Controller
{
    public function show(User $user)
    {
        return $user->getRoleNames();
    }

    public function changeRole(User $user, Request $request)
    {
       $updateRole = $user->syncRoles([$request->role]);

       if (! $updateRole) {
            return response()->json([
                'error' => "Role does not exist"
            ], 200);
       }

        return response()->json([
            'message' => "Role updated successfully"
        ], 200);
    }
}
