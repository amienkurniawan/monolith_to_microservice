<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsersController;
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

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout']);
Route::get('test', [AuthController::class, function () {
    return "test 8016 ok";
}]);

Route::middleware(['auth:api'])->group(function () {
    Route::get('user', [AuthController::class, 'user']);

    Route::apiResource('users', UsersController::class);
    Route::put('users/info', [AuthController::class, 'updateInfo']);
    Route::put('users/password', [AuthController::class, 'updatePassword']);
    Route::get('admin', [AuthController::class, 'authenticated'])->middleware('scope:admin');
    Route::get('influencer', [AuthController::class, 'authenticated'])->middleware('scope:influencer');
});
