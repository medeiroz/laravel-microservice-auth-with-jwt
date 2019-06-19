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

Route::name('api.')->group(function(){

    Route::post('auth/login', 'AuthController@login')->name('login');

    Route::middleware('jwt.auth')->group(function(){

        Route::post('auth/logout', 'AuthController@logout')->name('logout');
        Route::post('auth/refresh', 'AuthController@refresh')->name('refresh');
        Route::get('auth/me', 'AuthController@me')->name('me');

        Route::apiResources([
            'users' => 'UsersController',
            'roles' => 'RolesController',
            'permissions' => 'PermissionsController',
        ]);

        Route::get('users/{user}/roles', 'UsersRolesController@index')->name('users.roles.index');
        Route::put('users/{user}/roles', 'UsersRolesController@sync')->name('users.roles.sync');

        //Route::get('transfers/{id}/{relations}/{index?}', 'TransfersController@relations')
        //    ->name('transfers.relations');

    });
});
