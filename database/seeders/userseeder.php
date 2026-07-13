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
            'email' => 'anishkumar15691@gmail.com',
            'mobile_number' => '9876543210',
            'password' => bcrypt('123456'),
            'roles_id' => 1,
        ]); 
    }
}
