<?php

use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('users', [UserController::class, 'index']);

Route::post('register', [UserController::class, 'store']);
Route::post('login', [UserController::class, 'login']);
Route::post('logout', [UserController::class, 'destroy']);
Route::put('users/{user}/password', [UserController::class, 'update']);


Route::middleware('auth:sanctum')->get('user', function (Request $request) {
    return $request->user();
});
