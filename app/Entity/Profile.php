<?php

namespace App\Entity;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Laravelrus\LocalizedCarbon\Traits\LocalizedEloquentTrait;

class Profile extends Model
{
    use LocalizedEloquentTrait;

    protected $fillable = [
        'user_id',
        'photo',
        'character_id',
        'notification',
        'last_session',
        'experience'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function character()
    {
        return $this->belongsTo(Character::class, 'character_id', 'id');
    }

    public function addExperience($experience)
    {
        $this->experience += $experience;
        $this->save();
    }

    public function changeSessionDate()
    {
        $this->last_session = Carbon::now();
        $this->save();
    }
}
