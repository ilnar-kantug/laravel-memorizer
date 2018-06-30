<?php

namespace Tests\Unit\RepeatSession;

use App\Entity\User;
use App\UseCases\RepeatService;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class CacheTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function cache_key_is_correctly_build()
    {
        $user = create(User::class);
        $this->signIn($user);
        $service = new RepeatService();
        $packId = 1;
        $service->buildCacheKey($packId);

        $this->assertEquals('user_id.'.$user->id.'.pack_id.'.$packId, $service->cacheKey);
    }

    /** @test */
    public function cache_data_is_correctly_recieved()
    {
        $user = create(User::class);
        $this->signIn($user);
        $service = new RepeatService();
        $packId = 1;
        $service->buildCacheKey($packId);

        Cache::put($service->cacheKey, [1, 2, 3], 60);
        $arrayOfCards = $service->getCardsForSession();

        $this->assertEquals(1, $arrayOfCards[0]);
        $this->assertEquals(3, $arrayOfCards[2]);
        $this->assertEquals(3, count($arrayOfCards));
    }
}
