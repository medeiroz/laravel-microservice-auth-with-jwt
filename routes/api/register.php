<?php

use Illuminate\Http\Request;


Route::namespace('Auth')->name('register.')->prefix('register')->group(function() {

    /** Register **/
    Route::post('register', 'RegisterController@register')
        ->name('register');

    Route::post('send_email_verification/{email}', 'RegisterController@sendEmailVerification')
        ->name('send_email_verification');

    Route::get('verification', 'RegisterController@verification')
        ->name('verification');

    Route::post('recovery/{email}', 'RegisterController@recovery')
        ->name('recovery');

    Route::put('change_password', 'RegisterController@changePassword')
        ->name('change_password');
});

