<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::namespace('Admin')->group(function () {

    Route::get('login', 'LoginController@login')->name('login');
    Route::post('login', 'LoginController@loginProcess');

    Route::middleware('admin')->group(function () {

        Route::get('logout', 'LoginController@logout');
        Route::get('/', 'DashboardController@index');
        Route::get('/ajax-data', 'DashboardController@ajaxData');

        Route::prefix('teams')->group(function(){
            Route::get('/', 'TeamController@index');
            Route::get('add', 'TeamController@add');
            Route::get('edit/{id}', 'TeamController@edit');
            Route::post('save/{id?}', 'TeamController@save');
            Route::get('delete/{id}', 'TeamController@delete');
            Route::get('assign/{teamId?}', 'TeamController@assign');
            Route::post('assign', 'TeamController@assignSave');
            Route::get('players/{teamId}', 'PlayerController@index');
        });

        Route::prefix('players')->group(function(){
            Route::get('/', 'PlayerController@index');
            Route::get('add', 'PlayerController@add');
            Route::get('edit/{id}', 'PlayerController@edit');
            Route::post('save/{id?}', 'PlayerController@save');
            Route::get('delete/{id}', 'PlayerController@delete');
        });

        Route::prefix('imports')->group(function(){
            Route::get('/{type}', 'DataImportController@import');
            Route::post('/{type}', 'DataImportController@importToDB');
            Route::get('sample-excel/{type}', 'DataImportController@downloadSample');
        });

    });
    
});
