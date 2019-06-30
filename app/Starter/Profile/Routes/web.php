<?php

Route::group(['prefix' => 'profile'], function () {
    Route::get('edit/', '\App\Starter\Profile\Controllers\ProfileController@getEdit')->name('profile.get.edit');
    Route::post('edit/', '\App\Starter\Profile\Controllers\ProfileController@postEdit')->name('profile.post.edit');

    Route::get('/logout', '\App\Starter\Profile\Controllers\ProfileController@getLogout')->name('profile.get.logout');
});
