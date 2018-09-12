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
    Route::post('/settingsAndTanksParams', 'TankController@getSettingsAndTankParams')->name('getSettingsAndTankParams');
    Route::delete('detachSingleParam', 'TankController@detachSingleParam')->name('detachParamFromTank');

    Route::resource("liquids","LiquidController");

    Route::resource("users","UserController");
    Route::get('/settingForUser', 'UserController@getAdditionalViewForUsers')->name("additionalSettingsForUsers");

    Route::get('tanks/delete/{id}', 'TankController@destroy')->name('tanks.delete');
    Route::get('liquids/delete/{id}', 'LiquidController@destroy')->name('liquids.delete');
    Route::get('users/delete/{id}', 'UserController@destroy')->name('users.delete');
    Route::get('modes/delete/{id}', 'ModeController@destroy')->name('modes.delete');
    Route::get('settings/delete/{id}', 'SettingController@destroy')->name('settings.delete');

    Route::resource("modes", "ModeController")->except(['update', 'edit']);

    Route::resource("settings", "SettingController")->except(['update', 'edit']);

    Route::group(['prefix' => 'settings'], function ()
    {
        Route::post('getAllSettings', 'AdminController@getAllSettings')->name('settings.all.get');
    });
});


