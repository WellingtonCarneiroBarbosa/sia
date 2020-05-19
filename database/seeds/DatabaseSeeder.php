<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            AdminSeeder::class,
            UserSeeder::class,
        ]);

        factory(\App\User::class, 100)->create();
        factory(\App\Models\Chats\Message::class, 1000)->create();
    }
}
