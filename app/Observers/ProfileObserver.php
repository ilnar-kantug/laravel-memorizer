<?php

namespace App\Observers;

use App\Entity\Profile;
use Carbon\Carbon;
use Laravelrus\LocalizedCarbon\LocalizedCarbon;

class ProfileObserver
{
    public function retrieved(Profile $profile)
    {
        $profile->last_session = LocalizedCarbon::instance(new Carbon($profile->last_session));
    }
}
