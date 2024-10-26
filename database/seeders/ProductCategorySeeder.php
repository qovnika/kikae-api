<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\ProductCategory::factory()->create([
            'name' => "Men",
            'description' => "Men's wears"
        ]);
        \App\Models\ProductCategory::factory()->create([
            'name' => "Women",
            'description' => "Women's wears"
        ]);
        \App\Models\ProductCategory::factory()->create([
            'name' => "Kids",
            'description' => "Kids' wears"
        ]);
        \App\Models\ProductCategory::factory()->create([
            'name' => "All",
            'description' => "All wears"
        ]);
    }
}
