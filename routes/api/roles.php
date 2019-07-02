<?php

use Illuminate\Http\Request;


Route::middleware(['jwt.auth', 'verified'])->group(function(){

    /** Roles **/
    Route::middleware('permission:roles.read')->group(function() {
        Route::get('roles', 'RolesController@index')
            ->name('roles.index');

        Route::post('roles', 'RolesController@store')
            ->name('roles.store')
            ->middleware('permission:roles.store');

        Route::get('roles/{role}', 'RolesController@show')
            ->name('roles.show');

        Route::match(['put', 'patch'], 'roles/{role}', 'RolesController@update')
            ->name('roles.update')
            ->middleware('permission:roles.update');

        Route::delete('roles/{role}', 'RolesController@destroy')
            ->name('roles.destroy')
            ->middleware('permission:roles.destroy');
    });


    /** Roles -> Permissions **/
    Route::middleware('permission:users.roles.read')->group(function() {

        Route::get('roles/{role}/permissions', 'RolesPermissionsController@index')
            ->name('roles.permissions.index')
            ->middleware('permission:permissions.store');

        Route::put('roles/{role}/permissions', 'RolesPermissionsController@sync')
            ->name('roles.permissions.sync')
            ->middleware('permission:permissions.store');
    });

});
