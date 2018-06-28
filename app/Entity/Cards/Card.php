<?php

namespace App\Entity\Cards;

use App\Entity\Pack;
use App\Entity\Tag;
use App\Entity\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Card extends Model
{
    use SoftDeletes;

    public const CARD_TYPE_IMAGE = ImageCard::class;
    public const CARD_TYPE_HTML = HtmlCard::class;

    public const NOT_REPEATED = 0;
    public const REPEATED = 1;

    protected $fillable = ['title'];

    protected $dates = ['deleted_at'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'cards_users', 'card_id', 'user_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'cards_tags', 'card_id', 'tag_id');
    }

    public function packs()
    {
        return $this->belongsToMany(Pack::class, 'cards_packs', 'card_id', 'pack_id');
    }

    public function resource()
    {
        return $this->morphTo();
    }
}
