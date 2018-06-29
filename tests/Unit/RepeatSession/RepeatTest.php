<?php

namespace Tests\Unit\RepeatSession;

use App\Entity\Level;
use App\Entity\Pack;
use App\Entity\Profile;
use App\Entity\User;
use App\UseCases\RepeatService;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class RepeatTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function card_is_repeated()
    {
        $service = new RepeatService();
        $cardsInSession = [
            '1' => 0,
            '3' => 0,
            '5' => 0,
        ];
        $cardId = '1';
        $cardsInSession = $service->ifCurrentCardIsRepeated($cardsInSession, $cardId);
        $expectedArray = [
            '1' => 1,
            '3' => 0,
            '5' => 0,
        ];
        $this->assertEquals($expectedArray, $cardsInSession);
    }

    /** @test */
    public function all_cards_are_repeated()
    {
        $service = new RepeatService();
        $cardsInSession = [
            '1' => 1,
            '3' => 1,
            '5' => 1,
        ];
        $cardId = '1';
        $cardsInSession = $service->ifCurrentCardIsRepeated($cardsInSession, $cardId);
        $expectedArray = [
            '1' => 1,
            '3' => 1,
            '5' => 1,
        ];
        $this->assertEquals($expectedArray, $cardsInSession);
    }

    /** @test */
    public function get_session_stats()
    {
        $user = create(User::class);
        $this->signIn($user);

        $pack = createPackWithCards(2, 2, 100, $user);
        $service = new RepeatService();
        $cardsInSession = [
            '1' => 0,
            '2' => 0,
            '3' => 0,
            '4' => 0,
        ];

        $sessionStats = $service->getSessionStats($pack, $cardsInSession);

        $card1 = $pack->cards->toArray()[0];
        $card4 = $pack->cards->toArray()[3];

        $this->assertEquals($card1['title'], $sessionStats['cards'][0]['title']);
        $this->assertEquals($card4['title'], $sessionStats['cards'][3]['title']);
        $this->assertEquals(count($cardsInSession), $sessionStats['count_cards_in_session']);
        $this->assertEquals(count($pack->cards), $sessionStats['count_cards_in_pack']);
        $this->assertEquals(0, $sessionStats['count_repeated_cards_in_session']);
        $this->assertEquals(4, $sessionStats['count_not_repeated_cards_in_session']);
    }

    /** @test */
    public function session_is_completed()
    {
        $user = create(User::class);
        $this->signIn($user);

        $pack = createPackWithCards(2, 0, 100, $user);

        $profileBeforeSession = Profile::find(1);
        $profileOldExperience = $profileBeforeSession->experience;

        $service = new RepeatService();
        $cardsInSession = [
            '1' => 1,
            '2' => 1
        ];

        $sessionStats = $service->getSessionStats($pack, $cardsInSession);
        $service->getCardToRepeat($cardsInSession, $pack, $sessionStats);

        $profileAfterSession = Profile::find(1);
        $profileNewExperience = $profileAfterSession->experience;

        $this->assertEquals(
            $profileOldExperience+(count($cardsInSession)*Level::EXPERIENCE_PER_CARD),
            $profileNewExperience
        );
        $this->assertNotEquals($profileBeforeSession->last_session, $profileAfterSession->last_session);

        $packAfterSession = Pack::find(1);

        $this->assertNotEquals($pack->last_session, $packAfterSession->last_session);
    }
}
