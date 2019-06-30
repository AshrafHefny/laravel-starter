<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(\App\Starter\Options\Option::class, function (Faker $faker) {
    return [
        'type' =>  config('option_types')[array_rand(config('option_types'))],
        'title:en' =>  'Option '.$faker->sentence(2),
        'title:ar' =>  'Option '.$faker->sentence(2),
        'is_active'=>1,
        'created_by'=>2
    ];
});
