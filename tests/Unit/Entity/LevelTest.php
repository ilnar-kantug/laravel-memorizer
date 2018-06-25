<?php

namespace Tests\Unit\Entity;

use App\Entity\Level;
use App\Entity\Profile;
use App\Entity\User;
use CharactersSeeder;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravelrus\LocalizedCarbon\LocalizedCarbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LevelTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function levels()
    {
        $level = new Level();
        $faker = \Faker\Factory::create();
        $seeder = new CharactersSeeder($faker);
        $seeder->createLevels();

        $level_data = $level->getCurrent(0);
        $this->assertEquals(1, $level_data['current']);
        $this->assertEquals(0, $level_data['current_experience']);
        $this->assertEquals(100, $level_data['max_experience']);
        $this->assertEquals(0, $level_data['percentage']);
        $level_data = $level->getCurrent(100);
        $this->assertEquals(2, $level_data['current']);
        $this->assertEquals(0, $level_data['current_experience']);
        $this->assertEquals(100, $level_data['max_experience']);
        $this->assertEquals(0, $level_data['percentage']);
        $level_data = $level->getCurrent(110);
        $this->assertEquals(2, $level_data['current']);
        $this->assertEquals(10, $level_data['current_experience']);
        $this->assertEquals(100, $level_data['max_experience']);
        $this->assertEquals(10, $level_data['percentage']);
    }

}
