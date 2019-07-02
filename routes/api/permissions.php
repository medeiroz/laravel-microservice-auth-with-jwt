<?php

use Illuminate\Http\Request;


Route::middleware(['jwt.auth', 'verified'])->group(function(){

    /** Permissions **/
    Route::middleware('permission:permissions.read')->group(function() {
        Route::get('permissions', 'PermissionsController@index')
            ->name('permissions.index');

        Route::post('permissions', 'PermissionsController@store')
            ->name('permissions.store')
            ->middleware('permission:permissions.store');

        Route::get('permissions/{permission}', 'PermissionsController@show')
            ->name('permissions.show');

        Route::match(['put', 'patch'], 'permissions/{permission}', 'PermissionsController@update')
            ->name('permissions.update')
            ->middleware('permission:permissions.update');

        Route::delete('permissions/{permission}', 'PermissionsController@destroy')
            ->name('permissions.destroy')
            ->middleware('permission:permissions.destroy');
    });

});
