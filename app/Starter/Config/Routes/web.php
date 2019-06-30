<?php

Route::group(['prefix' => 'configs'], function () {
    Route::get('/edit', '\App\Starter\Config\Controllers\ConfigsController@getEdit');
    Route::put('/edit', '\App\Starter\Config\Controllers\ConfigsController@postEdit');
});
