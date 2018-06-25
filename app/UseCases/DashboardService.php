<?php

namespace App\UseCases;

use App\Entity\Characteristic;
use App\Entity\Level;
use App\Entity\User;
use Illuminate\Support\Facades\Auth;

class DashboardService
{
    private $level;

    public function __construct(Level $level)
    {
        $this->level = $level;
    }

    public function getUserInfo()
    {
        $user = User::with(['profile.character', 'packs.cards'])->find(Auth::user()->id);

        $user->sortedPacks = $user->packs->sortBy('repeat_in_days');

        $user->level = $this->level->getCurrent($user->profile->experience);
        $user->characteristics = Characteristic::getCurrent(
            $user->level['current'],
            $user->profile->character_id
        );

        return $user;
    }
}
