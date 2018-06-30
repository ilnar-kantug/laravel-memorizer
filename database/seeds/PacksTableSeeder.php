<?php

use App\Entity\Cards\Card;
use App\Entity\Pack;
use App\Entity\User;
use Illuminate\Database\Seeder;

class PacksTableSeeder extends Seeder
{
    public function run()
    {
        $this->createPacks();

        $this->associateCardsWithPacks();
    }

    public function createPacks()
    {
        $users = User::all();
        foreach ($users as $user) {
            factory(Pack::class, rand(5, 10))->create(['user_id' => $user->id]);
        }
    }

    public function associateCardsWithPacks()
    {
        $packs = Pack::all();
        $cards = Card::all();

        foreach ($packs as $pack) {
            $cardsForPack = $cards->random(rand(5, 10));
            foreach ($cardsForPack as $currentCard) {
                $pack->cards()->attach($currentCard->id);
            }
        }
    }
}
