<?php
use Illuminate\Http\Request;

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
// https://laravel.com/docs/5.8/api-authentication#hashing-tokens
// https://medium.com/techcompose/create-rest-api-in-laravel-with-authentication-using-passport-133a1678a876
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('register', 'Api\AuthController@register');
Route::post('login','Api\AuthController@login');
