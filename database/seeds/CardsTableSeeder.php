<?php

use App\Entity\Cards\Card;
use App\Entity\Cards\HtmlCard;
use App\Entity\Cards\ImageCard;
use App\Entity\User;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class CardsTableSeeder extends Seeder
{
    public $faker;

    public function __construct(Faker $faker)
    {
        $this->faker = $faker;
    }

    public function run()
    {
        $this->createCardsAndResourceCards();

        $this->assosiateCardsWithUsers();
    }

    public function createImageCard()
    {
        $widthArr = [100, 200, 300, 400];
        $heightArr = [100, 200, 300, 400];
        $width = $widthArr[array_rand($widthArr, 1)];
        $height = $heightArr[array_rand($heightArr, 1)];
        $card_data = [
            'url' => $this->faker->imageUrl($width, $height),
            'width' => $width,
            'height' => $height,
        ];
        return ImageCard::create($card_data);
    }

    public function createHtmlCard()
    {
        $i = rand(1, 100);
        $card_data = [
            'data' => "<h2>$i - Lorem ipsum dolor.</h2><p>$i - Lorem ipsum dolor <strong>sit amet</strong>, consectetur adipisicing elit. Assumenda, velit.</p><hr><p>Lorem ipsum dolor sit amet.</p>",
        ];
        return HtmlCard::create($card_data);
    }

    public function createCardFromResourceCard($cardNumber, $type)
    {
        while ($cardNumber > 0) {
            $resourceCard = $type == Card::CARD_TYPE_HTML ? $this->createHtmlCard() : $this->createImageCard();
            $this->createCard($resourceCard);
            $cardNumber--;
        }
    }

    public function createCard($resourceCard)
    {
        $card = new Card();
        $resourceCard->cards()->save($card);
        $card->title = $this->faker->sentence(5);
        $card->save();
    }

    public function assosiateCardsWithUsers()
    {
        $users = User::all();
        $cards = Card::all();

        foreach ($cards as $card) {
            $card->users()->attach($users->random()->id);
        }
    }

    public function createCardsAndResourceCards()
    {
        $imageCardNumber = rand(20, 30);
        $htmlCardNumber = rand(20, 30);

        $this->createCardFromResourceCard($imageCardNumber, Card::CARD_TYPE_IMAGE);
        $this->createCardFromResourceCard($htmlCardNumber, Card::CARD_TYPE_HTML);
    }
}
