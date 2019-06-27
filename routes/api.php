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

Route::name('api.')->group(function() {


    Route::namespace('Auth')->name('auth.')->prefix('auth')->group(function() {
        Route::post('login', 'LoginController@login')->name('login');
        Route::post('register', 'RegisterController@register')->name('register');
        Route::post('send_email_verification/{email}', 'RegisterController@sendEmailVerification')->name('send_email_verification');
        Route::get('verification', 'RegisterController@verification')->name('verification');
        Route::post('recovery/{email}', 'RegisterController@recovery')->name('recovery');
        Route::put('change_password', 'RegisterController@changePassword')->name('change_password');
    });


    Route::middleware('jwt.auth')->group(function(){

        Route::namespace('Auth')->name('auth.')->prefix('auth')->group(function() {
            Route::post('logout', 'LoginController@logout')->name('logout');
            Route::put('refresh', 'LoginController@refresh')->name('refresh');
            Route::get('me', 'LoginController@me')->name('me');
        });


        Route::apiResources([
            'users' => 'UsersController',
            'roles' => 'RolesController',
            'permissions' => 'PermissionsController',
        ]);

        Route::get('users/{user}/roles', 'UsersRolesController@index')->name('users.roles.index');
        Route::put('users/{user}/roles', 'UsersRolesController@sync')->name('users.roles.sync');

        Route::get('roles/{role}/permissions', 'RolesPermissionsController@index')->name('roles.permissions.index');
        Route::put('roles/{role}/permissions', 'RolesPermissionsController@sync')->name('roles.permissions.sync');


    });
});
