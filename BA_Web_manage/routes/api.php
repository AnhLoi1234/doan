<?php

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/admin-register','Admin\C_Admin@register');
Route::post('/admin-login','Admin\C_Admin@login');
Route::get('/admin-information','Admin\C_Admin@adminAuth')->middleware(['auth:api_admin','scopes:admin']);


//user
Route::post('/user-register-check','User\C_User@confirmEmail');
Route::post('/user-register','User\C_User@register');
Route::post('/user-login','User\C_User@login');
Route::get('/user-information','User\C_User@userAuth')->middleware(['auth:api_user','scopes:user']);