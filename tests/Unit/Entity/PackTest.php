<?php

namespace Tests\Unit\Entity;

use App\Entity\Pack;
use App\Entity\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravelrus\LocalizedCarbon\LocalizedCarbon;
use Tests\TestCase;
use Carbon\Carbon;

class PackTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function last_session_field_is_carbon_instance()
    {
        $user = create(User::class);
        create(Pack::class, ['user_id' => $user->id]);

        $pack = Pack::where('user_id', $user->id)->first();

        $this->assertInstanceOf(LocalizedCarbon::class, $pack->last_session);
    }


    /** @test */
    public function correct_working_repeat_days()
    {
        $user = create(User::class);
        $this->repeat_day_is_today($user);
        $this->repeat_day_was_yesterday($user);
        $this->repeat_day_will_be_tomorrow($user);
    }

    private function repeat_day_is_today($user)
    {
        $pack = create(Pack::class, [
            'user_id' => $user->id,
            'repeat_days' => 3,
            'last_session' => Carbon::now()->startOfDay()->subDays(3),
        ]);
        $retrivedPack = Pack::find($pack->id);
        $this->assertTrue($retrivedPack->repeat_now);
        $this->assertEquals(0, $retrivedPack->repeat_in_days);
    }

    private function repeat_day_was_yesterday($user)
    {
        $pack2 = create(Pack::class, [
            'user_id' => $user->id,
            'repeat_days' => 3,
            'last_session' => Carbon::now()->startOfDay()->subDays(4),
        ]);
        $retrivedPack2 = Pack::find($pack2->id);
        $this->assertTrue($retrivedPack2->repeat_now);
        $this->assertEquals(-1, $retrivedPack2->repeat_in_days);
    }

    private function repeat_day_will_be_tomorrow($user)
    {
        $pack3 = create(Pack::class, [
            'user_id' => $user->id,
            'repeat_days' => 5,
            'last_session' => Carbon::now()->startOfDay()->subDays(4),
        ]);
        $retrivedPack3 = Pack::find($pack3->id);
        $this->assertFalse($retrivedPack3->repeat_now);
        $this->assertEquals(1, $retrivedPack3->repeat_in_days);
    }
}
