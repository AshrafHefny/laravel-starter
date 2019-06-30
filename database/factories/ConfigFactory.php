<?php

use App\Starter\Config\Config;
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
$factory->define(Config::class, function (Faker $faker) {
    foreach (config("translatable.locales") as $lang) {
        $record[$lang] = $faker->sentence(3);
    }
    return [
        'type' => 'Basic Information',
        'field' => 'field_' . str_random(10),
        'en'  => ['label' => $faker->colorName , 'value' => $faker->hexColor],
        'ar'  => ['label' => $faker->colorName , 'value' => $faker->hexColor],
        'created_by' => 2,
    ];
});
