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
}
