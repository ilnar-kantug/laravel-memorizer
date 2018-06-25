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

    public const STATUS_WAIT = 0;
    public const STATUS_ACTIVE = 1;

    public const ROLE_ADMIN = 1;
    public const ROLE_USER = 2;
    public const ROLE_MODERATOR = 3;

    protected $fillable = [
        'name', 'email', 'password', 'verify_token', 'role'
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

    public function isModerator()
    {
        return $this->role === self::ROLE_MODERATOR;
    }

    public function isAdmin()
    {
        return $this->role === self::ROLE_ADMIN;
    }
}
