<?php

use App\Entity\Pack;
use App\Entity\User;
use Faker\Generator as Faker;

$factory->define(Pack::class, function (Faker $faker) {
    $users = User::all();
    return [
        'title' => $faker->word,
        'repeat_days' => $faker->numberBetween(2, 30),
        'cards_per_session' => $faker->numberBetween(1, 10),
        'last_session' => $faker->dateTimeThisMonth(),
        'user_id'=>$users->random()->id
    ];
});
