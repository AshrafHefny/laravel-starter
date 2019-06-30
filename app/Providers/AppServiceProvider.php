<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('mobile', function ($attribute, $value, $parameters, $validator) {
            if ($value == '') {
                return true;
            }
            if (!trim($value) && intval($value) != 0) {
                return true;
            }
            return preg_match('/^\d+$/', $value) && strlen($value) == 11;
        });
    }
}
