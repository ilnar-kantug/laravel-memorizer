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
}
