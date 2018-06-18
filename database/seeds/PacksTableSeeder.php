<?php

use App\Entity\Cards\Card;
use App\Entity\Pack;
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
        factory(Pack::class, 30)->create();
    }

    public function associateCardsWithPacks()
    {
        $packs = Pack::all();
        $cards = Card::all();

        foreach ($packs as $pack) {
            $numberOfCards = rand(5, 10);
            while ($numberOfCards > 0) {
                $this->addCardToPack($pack, $cards);
                $numberOfCards--;
            }
        }
    }

    public function addCardToPack($pack, $cards)
    {
        $pack->cards()->attach($cards->random()->id);
    }
}
