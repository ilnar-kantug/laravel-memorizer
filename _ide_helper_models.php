<?php
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Entity{
/**
 * App\Entity\User
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Entity\Cards\Card[] $cards
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Entity\Pack[] $packs
 * @property-read \App\Entity\Profile $profile
 */
	class User extends \Eloquent {}
}

namespace App\Entity{
/**
 * App\Entity\Level
 *
 */
	class Level extends \Eloquent {}
}

namespace App\Entity{
/**
 * App\Entity\Character
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Entity\Characteristic[] $characteristics
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Entity\Profile[] $profiles
 */
	class Character extends \Eloquent {}
}

namespace App\Entity\Cards{
/**
 * App\Entity\Cards\HtmlCard
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Entity\Cards\Card[] $cards
 */
	class HtmlCard extends \Eloquent {}
}

namespace App\Entity\Cards{
/**
 * App\Entity\Cards\Card
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Entity\Pack[] $packs
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $resource
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Entity\Tag[] $tags
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Entity\User[] $users
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Entity\Cards\Card onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Entity\Cards\Card withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Entity\Cards\Card withoutTrashed()
 */
	class Card extends \Eloquent {}
}

namespace App\Entity\Cards{
/**
 * App\Entity\Cards\ImageCard
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Entity\Cards\Card[] $cards
 */
	class ImageCard extends \Eloquent {}
}

namespace App\Entity{
/**
 * App\Entity\Characteristic
 *
 * @property-read \App\Entity\Character $character
 */
	class Characteristic extends \Eloquent {}
}

namespace App\Entity{
/**
 * App\Entity\Pack
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Entity\Cards\Card[] $cards
 * @property-read \App\Entity\User $user
 */
	class Pack extends \Eloquent {}
}

namespace App\Entity{
/**
 * App\Entity\Profile
 *
 * @property-read \App\Entity\Character $character
 * @property-read \App\Entity\User $user
 */
	class Profile extends \Eloquent {}
}

namespace App\Entity{
/**
 * App\Entity\Tag
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Entity\Cards\Card[] $cards
 */
	class Tag extends \Eloquent {}
}

