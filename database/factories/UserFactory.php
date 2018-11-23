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

$factory->define(App\Models\User::class, function (Faker $faker) {
    return [
        'name' => 'lx',
        'is_admin' => 1,
        'email' => 'lx@lx.com',
        'password' => '$2y$10$ftZted3OZXuZLGtGKEkvCOzH2tOSf102UE2b5uQDccKBKD4pqOHHq', // aaaaaa
        'remember_token' => str_random(16),
    ];
});
