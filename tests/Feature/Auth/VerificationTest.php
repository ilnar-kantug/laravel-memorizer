<?php

namespace Tests\Feature\Auth;

use App\Entity\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VerificationTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function unverified_user_cant_login()
    {
        $user = create(User::class);

        $this->assertEquals(User::STATUS_WAIT, $user->status);
        $this->assertNotNull($user->verify_token);

        $this->get(route('login'));

        $this->post(route('login'), [
            'email' => $user->email,
            'password' => 'secret'
        ])->assertStatus(302)->assertRedirect(back()->getTargetUrl());

        $this->assertTrue(search_in_toastr_session(__('flashes.not_verified_user')));

        $this->assertGuest();
    }

    /** @test */
    public function user_can_be_verified()
    {
        $user = create(User::class);

        $this->get(route('register.verify', ['token' => 'INVALID_TOKEN']))
            ->assertRedirect(route('login'));

        $this->assertTrue(search_in_toastr_session(__('flashes.no_verify_token')));

        $this->get(route('register.verify', ['token' => $user->verify_token]))
            ->assertRedirect(route('dashboard'));

        $this->assertTrue(search_in_toastr_session(__('flashes.verified_token')));

        $user = User::find($user->id);

        $this->assertEquals(User::STATUS_ACTIVE, $user->status);
        $this->assertNull($user->verify_token);
    }

    /** @test */
    public function user_can_login_if_verified()
    {
        $user = create(User::class);

        $this->get(route('register.verify', ['token' => $user->verify_token]));

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'secret'
        ])->assertStatus(302)->assertRedirect(route('dashboard'));

        $this->assertAuthenticated();
    }
}
