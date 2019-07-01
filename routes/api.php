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


    Route::middleware(['jwt.auth', 'verified'])->group(function(){

        /** Auth **/
        Route::namespace('Auth')->name('auth.')->prefix('auth')->group(function() {
            Route::post('logout', 'LoginController@logout')->name('logout');
            Route::put('refresh', 'LoginController@refresh')->name('refresh');
            Route::get('me', 'LoginController@me')->name('me');
        });

        /** Users **/
        Route::middleware('permission:users.read')->group(function() {
            Route::get('users', 'UsersController@index')->name('users.index');
            Route::post('users', 'UsersController@store')->name('users.store')->middleware('permission:users.store');
            Route::get('users/{user}', 'UsersController@show')->name('users.show');
            Route::match(['put', 'patch'], 'users/{user}', 'UsersController@update')->name('users.update')->middleware('permission:users.update');
            Route::delete('users/{user}', 'UsersController@destroy')->name('users.destroy')->middleware('permission:users.destroy');
        });

        /** Roles **/
        Route::middleware('permission:roles.read')->group(function() {
            Route::get('roles', 'RolesController@index')->name('roles.index');
            Route::post('roles', 'RolesController@store')->name('roles.store')->middleware('permission:roles.store');
            Route::get('roles/{role}', 'RolesController@show')->name('roles.show');
            Route::match(['put', 'patch'], 'roles/{role}', 'RolesController@update')->name('roles.update')->middleware('permission:roles.update');
            Route::delete('roles/{role}', 'RolesController@destroy')->name('roles.destroy')->middleware('permission:roles.destroy');
        });

        /** Permissions **/
        Route::middleware('permission:permissions.read')->group(function() {
            Route::get('permissions', 'PermissionsController@index')->name('permissions.index');
            Route::post('permissions', 'PermissionsController@store')->name('permissions.store')->middleware('permission:permissions.store');
            Route::get('permissions/{permission}', 'PermissionsController@show')->name('permissions.show');
            Route::match(['put', 'patch'], 'permissions/{permission}', 'PermissionsController@update')->name('permissions.update')->middleware('permission:permissions.update');
            Route::delete('permissions/{permission}', 'PermissionsController@destroy')->name('permissions.destroy')->middleware('permission:permissions.destroy');
        });

        /** Users -> Roles **/
        Route::get('users/{user}/roles', 'UsersRolesController@index')->name('users.roles.index');
        Route::put('users/{user}/roles', 'UsersRolesController@sync')->name('users.roles.sync');

        /** Roles -> Permissions **/
        Route::get('roles/{role}/permissions', 'RolesPermissionsController@index')->name('roles.permissions.index');
        Route::put('roles/{role}/permissions', 'RolesPermissionsController@sync')->name('roles.permissions.sync');
    });
});
