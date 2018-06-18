<?php

use App\Entity\Cards\Card;
use App\Entity\Tag;
use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    public function run()
    {
        $this->createTags();

        $this->associateTagsWithCards();
    }

    public function attachTagToCard($card, $tags)
    {
        $card->tags()->attach($tags->random()->id);
    }

    public function createTags()
    {
        factory(Tag::class, 10)->create();
    }

    public function associateTagsWithCards()
    {
        $tags = Tag::all();
        $cards = Card::all();

        foreach ($cards as $card) {
            $numberOfTags = rand(1, 5);
            while ($numberOfTags > 0) {
                $this->attachTagToCard($card, $tags);
                $numberOfTags--;
            }
        }
    }
}
