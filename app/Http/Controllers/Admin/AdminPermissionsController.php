<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserPermissionsResource;

class AdminPermissionsController extends Controller
{
    public function show(User $user)
    {
        $permissions = $user->getAllPermissions();

        return  UserPermissionsResource::collection($permissions);

    }
}


