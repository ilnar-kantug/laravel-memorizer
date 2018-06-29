<?php

namespace App\UseCases;

use App\Entity\Cards\Card;
use App\Entity\Level;
use App\Entity\Pack;
use App\Entity\Profile;
use DomainException;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;

class RepeatService
{
    public $cacheKey;

    public function handleRequest($id)
    {
        $pack = $this->getCurrentPack($id);

        $this->buildCacheKey($id);

        $this->checkPermissions($pack);

        $cardsInSession = $this->getCardsForSession();

        if (empty($cardsInSession)) {
            $cardsInSession = $this->generateCardsForSession($pack);
        }

        $cardsInSession = $this->ifCurrentCardIsRepeated($cardsInSession, request()->get('card'));

        $sessionStats = $this->getSessionStats($pack, $cardsInSession);

        return $this->getCardToRepeat($cardsInSession, $pack, $sessionStats);
    }


    public function getCardToRepeat($cardsInSession, $pack, $sessionStats)
    {
        $cardToRepeat = $this->getNextCard($cardsInSession);

        if (!$cardToRepeat) {
            return $this->sessionIsCompleted($sessionStats, $pack);
        }

        $cardToRepeat = Card::with('resource')->find($cardToRepeat);

        if ($cardToRepeat->resource_type == Card::CARD_TYPE_IMAGE) {
            $view = 'imagecard';
        } else {
            $view = 'htmlcard';
        }
        return view('ajax.repeat.'. $view .'', [
            'card' => $cardToRepeat,
            'pack' => $pack,
            'sessionStats' => $sessionStats])->render();
    }


    public function getNextCard($cardsInSession)
    {
        foreach ($cardsInSession as $key => $card) {
            if ($card == 0) {
                return $key;
            }
        }
        return false;
    }

    public function cardRepeated($repeatedCard, $cardsInSession)
    {
        foreach ($cardsInSession as $key => $card) {
            if ($repeatedCard == $key) {
                $cardsInSession[$key] = Card::REPEATED;
                Cache::put($this->cacheKey, $cardsInSession, 60);
            }
        }
        return $cardsInSession;
    }


    public function buildCacheKey($id)
    {
        $this->cacheKey = 'user_id.'.Auth::user()->id.'.pack_id.'.$id;
    }

    public function checkPermissions($pack)
    {
        if (!Gate::allows('show-pack', $pack)) {
            abort(403, 'You are not allowed!');
        }
    }

    public function generateCardsForSession($pack)
    {
        $cardsIds = $pack->cards->pluck('id')->toArray();
        $cardsIdCount = count($cardsIds);
        $numberOfCardsForSession = (int) ceil($cardsIdCount*$pack->cards_per_session/100);
        if ($pack->cards_per_session == Pack::ALL_CARDS) {
            $cardsForSession = $cardsIds;
        } else {
            $cardsForSession = array_random($cardsIds, $numberOfCardsForSession);
        }

        foreach ($cardsForSession as $card) {
            $cardsInSession[$card] = Card::NOT_REPEATED;
        }

        Cache::put($this->cacheKey, $cardsInSession, 60);

        return $cardsInSession;
    }

    public function ifCurrentCardIsRepeated($cardsInSession, $cardInGetRequest)
    {
        if ($cardInGetRequest) {
            if (in_array($cardInGetRequest, array_keys($cardsInSession))) {
                return $this->cardRepeated($cardInGetRequest, $cardsInSession);
            }
        }
        return $cardsInSession;
    }

    public function sessionIsCompleted($sessionStats, $pack)
    {
        Cache::forget($this->cacheKey);
        $this->updateProfile($sessionStats);
        $pack->changeSessionDate();

        return view('ajax.repeat.session-completed', [
            'experience' => $this->calcEarnedExperience($sessionStats)
        ])->render();
    }

    public function getSessionStats($pack, $cardsInSession)
    {
        $allCardsTitles = $pack->cards->pluck('title', 'id');
        foreach ($allCardsTitles as $keyCardTitle => $valueCardTitle) {
            foreach ($cardsInSession as $keyCardInSession => $valueCardInSession) {
                if ($keyCardTitle == $keyCardInSession) {
                    $sessionStats['cards'][] = [
                        'title' => $valueCardTitle,
                        'repeated' => $valueCardInSession
                    ];
                }
            }
        }
        $countRepeatedCards = array_count_values($cardsInSession);
        $sessionStats['count_cards_in_session'] = count($cardsInSession);
        $sessionStats['count_cards_in_pack'] = count($allCardsTitles);
        $sessionStats['count_repeated_cards_in_session'] = $countRepeatedCards[''.Card::REPEATED.''] ?? 0;
        $sessionStats['count_not_repeated_cards_in_session'] = $countRepeatedCards[''.Card::NOT_REPEATED.''] ?? 0;

        return $sessionStats;
    }

    public function getCardsForSession()
    {
        return Cache::get($this->cacheKey);
    }

    public function updateProfile($sessionStats)
    {
        $experience = $this->calcEarnedExperience($sessionStats);
        $profile = Profile::where('user_id', Auth::user()->id)->first();
        $profile->addExperience($experience);
        $profile->changeSessionDate();
    }

    public function calcEarnedExperience($sessionStats)
    {
        return $sessionStats['count_repeated_cards_in_session'] * Level::EXPERIENCE_PER_CARD;
    }

    public function getCurrentPack($id)
    {
        $pack = Pack::getById($id);

        if ($pack->cards->count() == 0) {
            throw new DomainException('No cards in pack');
        }

        return $pack;
    }
}
