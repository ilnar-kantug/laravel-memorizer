<?php

use App\Entity\Character;
use App\Entity\Characteristic;
use App\Entity\Level;
use App\Entity\Profile;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class CharactersSeeder extends Seeder
{
    public $faker;

    public function __construct(Faker $faker)
    {
        $this->faker = $faker;
    }

    public function run()
    {
        $this->createCharacters();

        $this->createCharacteristics();

        $this->createLevels();

        $this->associateProfilesWithCharacters();
    }

    public function createCharacters()
    {
        factory(Character::class, 10)->create();
    }

    public function createCharacteristics()
    {
        $characters = Character::all();
        foreach ($characters as $character) {
            $this->createCharacteristicForEachLevel($character);
        }
    }

    public function createCharacteristicForEachLevel($character)
    {
        $avatar_url = '/images/avatar.jpg';
        Characteristic::create([
            'character_id' => $character->id,
            'title' => $this->faker->firstName,
            'level_from' => 1,
            'level_to' => 2,
            'avatar' => $avatar_url,
        ]);
        Characteristic::create([
            'character_id' => $character->id,
            'title' => $this->faker->firstName,
            'level_from' => 3,
            'level_to' => 4,
            'avatar' => $avatar_url,
        ]);
        Characteristic::create([
            'character_id' => $character->id,
            'title' => $this->faker->firstName,
            'level_from' => 5,
            'level_to' => 9,
            'avatar' => $avatar_url,
        ]);
        Characteristic::create([
            'character_id' => $character->id,
            'title' => $this->faker->firstName,
            'level_from' => 10,
            'level_to' => 14,
            'avatar' => $avatar_url,
        ]);
        Characteristic::create([
            'character_id' => $character->id,
            'title' => $this->faker->firstName,
            'level_from' => 15,
            'level_to' => 24,
            'avatar' => $avatar_url,
        ]);
        Characteristic::create([
            'character_id' => $character->id,
            'title' => $this->faker->firstName,
            'level_from' => 25,
            'level_to' => 49,
            'avatar' => $avatar_url,
        ]);
        Characteristic::create([
            'character_id' => $character->id,
            'title' => $this->faker->firstName,
            'level_from' => 50,
            'level_to' => 100,
            'avatar' => $avatar_url,
        ]);
    }

    public function createLevels()
    {
        for ($i=1; $i <= Level::MAX_LEVEL; $i++) {
            $step = $i*100;
            Level::create([
                'level' => $i,
                'experience_from' => $i == 1 ? $i - 1 : $step - 100,
                'experience_to' => $step,
            ]);
        }
    }

    public function associateProfilesWithCharacters()
    {
        $profiles = Profile::all();
        $characters = Character::all();
        foreach ($profiles as $profile) {
            $profile->character()->associate($characters->random());
            $profile->save();
        }
    }
}
