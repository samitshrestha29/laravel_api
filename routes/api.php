<?php

use App\Http\Controllers\Api\usercontroller;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('user/store', 'App\Http\Controllers\Api\Usercontroller@store');

Route::get('/test', function () {
    p(" working");
});
Route::get('users/get/{flag}', [usercontroller::class, 'index']);
Route::get('user/{id}', [usercontroller::class, 'show']);