<?php

use App\Entity\User;
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

$factory->define(App\Entity\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
        'status' => User::STATUS_WAIT,
        'verify_token' => str_random(20),
        'role' => User::ROLE_USER,
    ];
});

$factory->define(App\Entity\Profile::class, function (Faker $faker) {
    return [
        'user_id' => 1,
        'photo' => '/images/avatar.jpg',
        'character_id' => $faker->numberBetween(1, 9),
        'notification' => $faker->numberBetween(0, 1),
        'last_session' => $faker->dateTimeThisMonth(),
        'experience' => $faker->numberBetween(0, 5000),
    ];
});
