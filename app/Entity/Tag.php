<?php

namespace App\Entity;

use App\Entity\Cards\Card;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $guarded = [];

    public function cards()
    {
        return $this->belongsToMany(Card::class, 'cards_tags', 'tag_id', 'card_id');
    }
}
