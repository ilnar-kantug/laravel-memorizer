<?php

namespace Tests\Unit\RepeatSession;

use App\Entity\Cards\Card;
use App\Entity\User;
use App\UseCases\RepeatService;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GeneratingSessionTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function generated_cards_for_session()
    {
        $imageCardNumber = 4;
        $htmlCardNumber = 4;
        $cardsPerSession = 50;
        $countCardsPerSession = ($imageCardNumber+$htmlCardNumber)*($cardsPerSession/100);
        $service = new RepeatService();

        $user = create(User::class);
        $this->signIn($user);

        $pack = createPackWithCards($imageCardNumber, $htmlCardNumber, $cardsPerSession, $user);

        $service->buildCacheKey($pack->id);

        $cardsInSession = $service->generateCardsForSession($pack);

        $this->assertEquals($countCardsPerSession, count($cardsInSession));
        $this->assertEquals($cardsInSession, $service->getCardsForSession());
        foreach ($cardsInSession as $card) {
            $this->assertEquals($card, Card::NOT_REPEATED);
        }
    }
}
