<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\Auth\UserAuthController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Admin\AdminUserController;

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


Route::prefix('v1')->group(function (){

    Route::group(['prefix' => 'users'], function() {
        Route::post('signup', [UserAuthController::class, 'store']);
        Route::post('login', [UserAuthController::class, 'login']);

        Route::middleware('auth:sanctum')->group(function() {
            // Route::get('profile', [UserProfileController::class, 'index']);
            Route::post('logout', [UserAuthController::class, 'logout']);
        });
    });


    Route::prefix('admin')->group(function(){
        Route::post('login', [AdminAuthController::class, 'login']);

        Route::middleware(['auth:sanctum', 'role:super-admin'])->group(function() {
            Route::get('/users', [AdminUserController::class, 'index']);
            Route::post('/logout', [AdminAuthController::class, 'logout']);
        });

    });

});




