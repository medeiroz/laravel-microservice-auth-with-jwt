<?php

use Illuminate\Http\Request;


Route::middleware(['jwt.auth', 'verified'])->group(function() {

    /** Users **/
    Route::middleware('permission:users.read')->group(function() {
        Route::get('users', 'UsersController@index')
            ->name('users.index');

        Route::post('users', 'UsersController@store')
            ->name('users.store')
            ->middleware('permission:users.store');

        Route::get('users/{user}', 'UsersController@show')
            ->name('users.show');

        Route::match(['put', 'patch'], 'users/{user}', 'UsersController@update')
            ->name('users.update')
            ->middleware('permission:users.update');

        Route::delete('users/{user}', 'UsersController@destroy')
            ->name('users.destroy')
            ->middleware('permission:users.destroy');
    });


    /** Users -> Roles **/
    Route::middleware('permission:users.roles.read')->group(function() {
        
        Route::get('users/{user}/roles', 'UsersRolesController@index')
            ->name('users.roles.index');

        Route::put('users/{user}/roles', 'UsersRolesController@sync')
            ->name('users.roles.sync')
            ->middleware('permission:users.roles.update');
    });

});

