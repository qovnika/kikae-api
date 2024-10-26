<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LiketypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Liketype::factory()->create([
            'name' => "Product Likes",
            'description' => "Product Likes"
        ]);
        \App\Models\Liketype::factory()->create([
            'name' => "Store Likes",
            'description' => "Store Likes"
        ]);
        \App\Models\Liketype::factory()->create([
            'name' => "Gallery Likes",
            'description' => "Gallery Likes"
        ]);
    }
}
