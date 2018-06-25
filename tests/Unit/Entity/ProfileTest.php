<?php

namespace Tests\Unit\Entity;

use App\Entity\Profile;
use App\Entity\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravelrus\LocalizedCarbon\LocalizedCarbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProfileTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function last_session_field_is_carbon_instance()
    {
        $user = create(User::class);
        create(Profile::class, ['user_id' => $user->id]);

        $profile = Profile::where('user_id', $user->id)->first();

        $this->assertInstanceOf(LocalizedCarbon::class, $profile->last_session);
    }

}
