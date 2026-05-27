<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

         \App\Models\User::create([
             'name' => 'Test User',
             'email' => 'kizalu@gmail.com',
             'password'=>bcrypt(123456789),
             'isAdmin'=>1,
             'isEst'=>1
         ]);
    }
}
