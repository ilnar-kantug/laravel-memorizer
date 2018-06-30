<?php

namespace App\Helpers\Packs;

use Carbon\Carbon;
use Laravelrus\LocalizedCarbon\LocalizedCarbon;

class ObserverHelper
{
    public function doNeedToRepeatNow($repeat_day, $now)
    {
        return $now->gte($repeat_day);
    }

    public function getRepeatInHowManyDays($repeat_day, $now)
    {
        return $now->diffInDays($repeat_day, false);
    }

    public function getRepeatDate($pack)
    {
        return $pack->last_session->copy()->addDays($pack->repeat_days)->startOfDay();
    }

    public function getTodayDate()
    {
        return Carbon::now()->startOfDay();
    }

    public function makeDateCarbon($last_session)
    {
        return LocalizedCarbon::instance(new Carbon($last_session));
    }
}