<?php

use Illuminate\Http\Request;


Route::namespace('Auth')->name('register.')->prefix('register')->group(function() {

    /** Register **/
    Route::post('create', 'RegisterController@create')
        ->name('create');

    Route::post('send_email_verification/{email}', 'RegisterController@sendEmailVerification')
        ->name('send_email_verification');

    Route::get('verification', 'RegisterController@verification')
        ->name('verification');

    Route::post('recovery/{email}', 'RegisterController@recovery')
        ->name('recovery');

    Route::put('update_password', 'RegisterController@updatePassword')
        ->name('update_password');
});

