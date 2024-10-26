<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Category::factory()->create([
            'name' => "Designers",
            'description' => "Designers"
        ]);
        \App\Models\Category::factory()->create([
            'name' => "Styles",
            'description' => "Styles"
        ]);
        \App\Models\Category::factory()->create([
            'name' => "Shoes",
            'description' => "Shoes"
        ]);
        \App\Models\Category::factory()->create([
            'name' => "Fabrics",
            'description' => "Fabrics"
        ]);
        \App\Models\Category::factory()->create([
            'name' => "Make-Up",
            'description' => "Make-Up"
        ]);
        \App\Models\Category::factory()->create([
            'name' => "Accessories",
            'description' => "Accessories"
        ]);
        \App\Models\Category::factory()->create([
            'name' => "Multipurpose",
            'description' => "All categories"
        ]);
    }
}
