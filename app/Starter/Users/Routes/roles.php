<?php

Route::group(['prefix' => 'roles'], function () {
    Route::get('/', '\App\Starter\Users\Controllers\RolesController@getIndex');

    Route::get('/create', '\App\Starter\Users\Controllers\RolesController@getCreate');
    Route::post('/create', '\App\Starter\Users\Controllers\RolesController@postCreate');

    Route::get('/edit/{id}', '\App\Starter\Users\Controllers\RolesController@getEdit');
    Route::put('/edit/{id}', '\App\Starter\Users\Controllers\RolesController@postEdit');

    Route::get('/view/{id}', '\App\Starter\Users\Controllers\RolesController@getView');
    Route::get('/delete/{id}', '\App\Starter\Users\Controllers\RolesController@getDelete');
    Route::get('/export', '\App\Starter\Users\Controllers\RolesController@getExport');
});