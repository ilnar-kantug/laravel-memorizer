<?php

namespace Tests\Unit\Entity;

use App\Entity\Profile;
use App\Entity\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravelrus\LocalizedCarbon\LocalizedCarbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function check_user_role()
    {
        $user = create(User::class, ['role'=>User::ROLE_USER]);
        $this->assertFalse($user->isAdmin());

        $admin = create(User::class, ['role'=>User::ROLE_ADMIN]);
        $this->assertTrue($admin->isAdmin());

        $moderator = create(User::class, ['role'=>User::ROLE_MODERATOR]);
        $this->assertTrue($moderator->isModerator());
    }
}
