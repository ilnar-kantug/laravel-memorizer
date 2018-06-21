<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class Characteristic extends Model
{
    protected $guarded = [];

    public function character()
    {
        return $this->belongsTo(Character::class, 'character_id', 'id');
    }

    public static function getCurrent($level, $character_id)
    {
        $characteristics = self::all();
        foreach ($characteristics as $item) {
            if ($level >= $item->level_from && $level <= $item->level_to && $character_id == $item->character_id) {
                return [
                    'title' => $item->title,
                    'avatar' => $item->avatar,
                ];
            }
        }
    }
}
