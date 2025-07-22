<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'fleetify',
            'email' => 'fleetify@gmail.com',
            'password' => bcrypt('password'),
        ]);

        User::factory()->create([
            'name' => 'user test',
            'email' => 'user@gmail.com',
            'password' => bcrypt('password'),
        ]);
    }
}