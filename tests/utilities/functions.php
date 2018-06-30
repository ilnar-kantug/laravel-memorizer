<?php

use App\Entity\Pack;
use App\Entity\Profile;
use App\Entity\User;

function create($class, $attributes = [], $times = null)
{
    return factory($class, $times)->create($attributes);
}

function make($class, $attributes = [], $times = null)
{
    return factory($class, $times)->make($attributes);
}

function rawData($class, $attributes = [])
{
    return factory($class)->raw($attributes);
}

function search_in_toastr_session($message)
{
    return in_array($message, array_column(session()->get('toastr::notifications'), 'message'));
}

function createPackWithCards($imageCardNumber = 1, $htmlCardNumber = 1, $cardsPerSession = 100, $user)
{
    factory(Profile::class)->create(['user_id' => $user->id]);

    $faker = \Faker\Factory::create();
    (new CardsTableSeeder($faker, $imageCardNumber, $htmlCardNumber))->run();

    factory(Pack::class, 1)->create([
        'user_id' => $user->id,
        'cards_per_session' => $cardsPerSession,
    ]);

    $pack = Pack::find(1);

    $user = User::with('cards')->find(1);

    foreach ($user->cards as $currentCard) {
        $pack->cards()->attach($currentCard->id);
    }

    $pack = Pack::with('cards')->find(1);

    return $pack;
}