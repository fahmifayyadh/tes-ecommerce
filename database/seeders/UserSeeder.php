<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123456789'),
            'role' => 1
        ]);

        User::create([
            'name' => 'user 1',
            'email' => 'user1@gmail.com',
            'password' => bcrypt('123456789'),
            'role' => 2
        ]);
    }
}
