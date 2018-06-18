<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    protected $guarded = [];

    public function profiles()
    {
        return $this->hasMany(Profile::class);
    }

    public function characteristics()
    {
        return $this->hasMany(Characteristic::class);
    }
}
