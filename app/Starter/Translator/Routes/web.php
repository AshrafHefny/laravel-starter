<?php

Route::group(['prefix' => 'translator'], function () {
Route::get('/', '\App\Starter\Translator\Controllers\TranslatorController@getIndex');

Route::get('/edit/{id}', '\App\Starter\Translator\Controllers\TranslatorController@getEdit');
Route::put('/edit/{id}', '\App\Starter\Translator\Controllers\TranslatorController@postEdit');

});
