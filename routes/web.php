<?php
/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */


Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
], function () {
    Route::group([], function () {
        Route::group(['prefix' => 'auth'], function () {
            require base_path('app/Starter/Users/Routes/auth.php');
        });

        Route::group(['middleware' => ['auth']], function () {
            require base_path('app/Starter/Users/Routes/web.php');
            require base_path('app/Starter/Users/Routes/roles.php');
            require base_path('app/Starter/Config/Routes/web.php');
            require base_path('app/Starter/Profile/Routes/web.php');
            require base_path('app/Starter/Options/Routes/web.php');
            require base_path('app/Starter/Translator/Routes/web.php');
            Route::get('/', 'DashBoardController@getIndex');
        });
    });
});
