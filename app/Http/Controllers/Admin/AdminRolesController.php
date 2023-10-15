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
}
