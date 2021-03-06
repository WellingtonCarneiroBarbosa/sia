<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@example.org',
            'cpf' => '13320819917',
            'cep' => '83065480',
            'email_verified_at' => now(),
            'profile_completed_at' => now(),
            'role_id' => '5',
            'password' => Hash::make('password'),
        ]);
    }
}
