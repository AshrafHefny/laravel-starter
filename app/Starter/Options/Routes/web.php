<?php

Route::group(['prefix' => 'options'], function () {
    Route::get('/', '\App\Starter\Options\Controllers\OptionsController@getIndex');

    Route::get('/create', '\App\Starter\Options\Controllers\OptionsController@getCreate');
    Route::post('/create', '\App\Starter\Options\Controllers\OptionsController@postCreate');

    Route::get('/edit/{id}', '\App\Starter\Options\Controllers\OptionsController@getEdit');
    Route::put('/edit/{id}', '\App\Starter\Options\Controllers\OptionsController@postEdit');

    Route::get('/view/{id}', '\App\Starter\Options\Controllers\OptionsController@getView');
    Route::delete('/delete/{id}', '\App\Starter\Options\Controllers\OptionsController@getDelete')->name('options.delete');
});
