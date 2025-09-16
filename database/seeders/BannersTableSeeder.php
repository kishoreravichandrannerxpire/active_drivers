<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Banner;

class BannersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Banner::create([
            'title' => 'Summer Sale',
            'type' => 'Promotional',
            'description' => 'Get up to 50% off on selected items during our summer sale!',
            'image' => 'banners/summer_sale.jpg',
            'alt_text' => 'Summer Sale Banner',
            'link' => 'https://example.com/summer-sale',
            'status' => 1,
            'created_by' => 'admin',
        ]);
    }
}
