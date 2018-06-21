<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    public const MAX_LEVEL = 50;

    public $experience;
    public $experience_from;
    public $experience_to;

    protected $guarded = [];

    public function getCurrent($experience)
    {
        $this->experience = $experience;
        $levels = Level::all();
        foreach ($levels as $item) {
            if ($experience >= $item['experience_from'] && $experience <= $item['experience_to']) {
                $this->experience_from = $item['experience_from'];
                $this->experience_to = $item['experience_to'];

                return [
                    'current' => $item->level,
                    'current_experience' => $this->getCurrentLevelExp(),
                    'max_experience' => $this->getMaxLevelExp(),
                    'percentage' => $this->getPercentageOfLevel(),
                ];
            }
        }
    }

    public function getCurrentLevelExp()
    {
        return $this->experience - $this->experience_from;
    }

    public function getMaxLevelExp()
    {
        return $this->experience_to - $this->experience_from;
    }

    public function getPercentageOfLevel()
    {
        return round(100 * $this->getCurrentLevelExp() / $this->getMaxLevelExp());
    }
}
