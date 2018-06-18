<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    public const MAX_LEVEL = 50;

    protected $guarded = [];
}
