<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public $toTruncate = [
        'users',
        'profiles',
        'cards',
        'cards_users',
        'tags',
        'cards_tags',
        'packs',
        'cards_packs',
        'html_cards',
        'image_cards'
    ];

    public function run()
    {
        $this->truncateTables();
        $this->call(UsersTableSeeder::class);
        $this->call(CardsTableSeeder::class);
        $this->call(TagsTableSeeder::class);
        $this->call(PacksTableSeeder::class);
    }

    private function truncateTables()
    {
        Eloquent::unguard();
        //disable foreign key check for this connection before running truncate()
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        foreach ($this->toTruncate as $table) {
            DB::table($table)->truncate();
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
