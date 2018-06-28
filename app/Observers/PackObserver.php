<?php

namespace App\Observers;

use App\Entity\Pack;
use App\Helpers\Packs\ObserverHelper;

class PackObserver
{
    private $helper;

    public function __construct(ObserverHelper $helper)
    {
        $this->helper = $helper;
    }

    public function retrieved(Pack $pack)
    {
        $pack->last_session = $this->helper->makeDateCarbon($pack->last_session);
        $repeat_day = $this->helper->getRepeatDate($pack);
        $now = $this->helper->getTodayDate();
        $pack->repeat_now = $this->helper->doNeedToRepeatNow($repeat_day, $now);
        $pack->repeat_in_days = $this->helper->getRepeatInHowManyDays($repeat_day, $now);
    }

    public function saving(Pack $pack)
    {
        if (!$pack->slug) {
            $pack->slug = str_slug(substr($pack->title, 0, 50).' '.str_random(8));
        }
        unset($pack->repeat_now);
        unset($pack->repeat_in_days);
    }
}
