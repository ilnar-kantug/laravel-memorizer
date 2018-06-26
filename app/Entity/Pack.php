<?php

namespace App\Entity;

use App\Entity\Cards\Card;
use App\Entity\User;
use Illuminate\Database\Eloquent\Model;
use Laravelrus\LocalizedCarbon\Traits\LocalizedEloquentTrait;

class Pack extends Model
{
    use LocalizedEloquentTrait;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function cards()
    {
        return $this->belongsToMany(Card::class, 'cards_packs', 'pack_id', 'card_id');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
