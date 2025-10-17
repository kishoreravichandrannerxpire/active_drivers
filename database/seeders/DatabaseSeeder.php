<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use Database\Seeders\userseeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

         
       //User::factory(10)->create();
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
         Role::create([
            'role_name' => 'Admin',   
        ]);
        Role::create([
            'role_name' => 'Driver',   
        ]);
        Role::create([
            'role_name' => 'Customer',   
        ]);
        Role::create([
            'role_name' => 'Anonymous',   
        ]);
        
        $this->call(userseeder::class);
        //$this->call(BannersTableSeeder::class);
        //$this->call(BannersTableSeeder::class);


    }
}
