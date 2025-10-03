<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class userseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'anish',
            'email' => 'anishkumar15691@gmail.com',
            'password' => bcrypt('123456'),
            'roles_id' => 1, // Assuming '1' is the ID for the admin role
        ]); 
    }
}
