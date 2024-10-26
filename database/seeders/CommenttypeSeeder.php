<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommenttypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Commenttype::factory()->create([
            'title' => "Product Comments",
            'desc' => "Product comments"
        ]);
        \App\Models\Commenttype::factory()->create([
            'title' => "Store Comments",
            'desc' => "Store comments"
        ]);
        \App\Models\Commenttype::factory()->create([
            'title' => "Gallery Comments",
            'desc' => "Gallery comments"
        ]);
    }
}
