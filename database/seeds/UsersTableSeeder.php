<?php

use App\User;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class UsersTableSeeder extends Seeder
{
    public function run(Faker $faker)
    {
        $this->createUsers();

        $this->createProfiles($faker);
    }

    public function createUsers()
    {
        $this->createAdmin();

        factory(User::class, 10)->create();
    }

    public function createProfiles($faker)
    {
        $users = User::all();
        foreach ($users as $user) {
            $user->profile()->create([
                'user_id' => $user->id,
                'photo' => $faker->imageUrl(200, 200),
                'character_id' => $faker->numberBetween(1, 9),
                'notification' => $faker->numberBetween(0, 1),
                'last_session' => $faker->dateTimeThisMonth(),
                'experience' => $faker->numberBetween(0, 5000),
            ]);
        }
    }

    public function createAdmin()
    {
        App\User::create([
            'name' => 'admin',
            'email' => 'admin@admin.admin',
            'password' => bcrypt('adminadmin'),
            'remember_token' => str_random(10),
        ]);
    }
}
