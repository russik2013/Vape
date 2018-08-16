<?php

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

Route::get('/', function () {
    return view('welcome');
});
Route::group(['prefix' => 'admin'], function (){

    Route::resource("tanks","TankController");

    Route::get('tanks/delete/{id}', 'TankController@destroy')->name('tanks.delete');

    Route::group(['prefix' => 'settings'], function (){

        Route::get('/', 'AdminController@settings')->name('settings.all');
        Route::get('delete/{id}', 'AdminController@settingsDelete')->name('settings.delete');
        Route::get('setting/{id?}', 'AdminController@settingsCreate')->name('settings.create');
        Route::get('show/{id}', 'AdminController@settingsShow')->name('settings.show');
        Route::post('create', 'AdminController@store')->name('settings.store');
    });

    Route::resource('liquids','LiquidController');
    Route::get('liquids/delete/{id}', 'LiquidController@destroy')->name('liquids.delete');
});


