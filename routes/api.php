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

// Route::middleware('auth:sanctum')->GET('/user', '\App\Http\Controllers\API\APIController@login');

Route::POST('signin', \App\Http\Controllers\API\AuthController::class);

Route::GET('signout', \App\Http\Controllers\API\LogOutController::class);

Route::group(['middleware' => ['auth:sanctum']], function() {

    Route::GET('/students', '\App\Http\Controllers\API\APIController@getAll');
    Route::GET('/students/{id}', '\App\Http\Controllers\API\APIController@getOne');
    Route::POST('/students', '\App\Http\Controllers\API\APIController@new');
    Route::PUT('/students/{id}', '\App\Http\Controllers\API\APIController@update');
    Route::DELETE('/students/{id}', '\App\Http\Controllers\API\APIController@delete');

});


