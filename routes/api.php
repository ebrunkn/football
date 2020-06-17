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

Route::namespace('API')->group(function () {

    Route::post('login', 'LoginController@login');
    Route::middleware('auth:adminapi')->group(function () {
        Route::get('players', 'PlayerController@index');
        Route::post('players/substitute', 'PlayerController@substituteSave');
        Route::get('teams', 'TeamController@index');
        Route::post('teams/assign', 'TeamController@assignSave');
    });
});

