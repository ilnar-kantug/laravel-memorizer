<?php

namespace App\Entity\Cards;

use Illuminate\Database\Eloquent\Model;

class ImageCard extends Model
{
    protected $guarded = [];

    public function cards()
    {
        return $this->morphMany(Card::class, 'resource');
    }
}
