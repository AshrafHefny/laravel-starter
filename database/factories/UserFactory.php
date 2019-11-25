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

$factory->define(App\Starter\Users\User::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName(),
        'last_name' => $faker->lastName(),
        'email' => $faker->unique()->safeEmail,
        'mobile_number'=>'0122'.rand(1111111, 9999999),
        'password' => '12345678',
        'confirmed' => 1,
        'is_active' => 1,
        'created_by' => 2,
        'type'  => 'admin',
    ];
});
