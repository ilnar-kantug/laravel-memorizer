<?php

use App\Entity\Profile;
use App\Entity\User;
use App\UseCases\Auth\RegisterService;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class UsersTableSeeder extends Seeder
{
    /**
     * @var RegisterService
     */
    private $registerService;

    public function __construct(RegisterService $registerService)
    {
        $this->registerService = $registerService;
    }

    public function run(Faker $faker)
    {
        $this->createUsers();

        $this->createProfiles($faker);
    }

    public function createUsers()
    {
        $this->createAdmin();

        factory(User::class, 10)->create();

        $users =  User::all();

        foreach ($users as $user) {
            $this->registerService->verifyUser($user);
        }
    }

    public function createProfiles($faker)
    {
        $users = User::all();
        foreach ($users as $user) {
            factory(Profile::class)->create(['user_id' => $user->id]);
        }
    }

    public function createAdmin()
    {
        App\Entity\User::create([
            'name' => 'admin',
            'email' => 'admin@admin.admin',
            'password' => bcrypt('adminadmin'),
            'remember_token' => str_random(10),
            'status' => User::STATUS_ACTIVE,
            'role' => User::ROLE_ADMIN,
        ]);
    }
}
