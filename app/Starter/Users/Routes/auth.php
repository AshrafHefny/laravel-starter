<?php
Route::get('/register', '\App\Starter\Users\Controllers\AuthController@getRegister');
Route::post('/register', '\App\Starter\Users\Controllers\AuthController@postRegister');

Route::get('/login', '\App\Starter\Users\Controllers\AuthController@getLogin');
Route::post('/login', '\App\Starter\Users\Controllers\AuthController@postLogin');

Route::get('/forgot-password', '\App\Starter\Users\Controllers\AuthController@getForgotPassword');
Route::post('/forgot-password', '\App\Starter\Users\Controllers\AuthController@postForgotPassword');

Route::get('/confirm', '\App\Starter\Users\Controllers\AuthController@getConfirm');
