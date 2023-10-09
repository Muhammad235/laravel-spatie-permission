<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AdminController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


/**
 *  The code below is how a typical route should be when using spatie and sanctum for authenciation
 *
 * **/


//only admin and system admin can access this route

// Route::prefix('admin')->middleware(['auth:sanctum', 'role:super-admin|system-admin'])->group(function () {

//         Route::get('/users', function() {
//             return response()->json([

//                 "users" => User::with('roles')->get()
//             ]);
//         });
// });


// Route::post('/login', [AdminController::class, 'login']);



$api = app('Dingo\Api\Routing\Router');


$api->version('v1', function ($api) {

    $api->get('hello', function(){
        return "config";
    });
});
