<?php

use App\Http\Controllers\Api\User\Auth\UserResetPasswordController;
use App\Http\Controllers\Api\User\Login\UserLoginController;
use App\Http\Controllers\Api\User\Register\UserRegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [UserLoginController::class, 'login']);
Route::post('/register', [UserRegisterController::class, 'register']);
Route::post('/forgotPassword', [UserResetPasswordController::class, 'forgotPassword']);
Route::post('/resetPassword', [UserResetPasswordController::class, 'reset'])->name('password.reset');


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
