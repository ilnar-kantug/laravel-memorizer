<?php

namespace App\Entity;

use App\Entity\Cards\Card;
use App\Entity\Pack;
use App\Entity\Profile;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function cards()
    {
        return $this->belongsToMany(Card::class, 'cards_users', 'user_id', 'card_id');
    }

    public function packs()
    {
        return $this->hasMany(Pack::class);
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }
}
