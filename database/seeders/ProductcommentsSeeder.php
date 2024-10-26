<?php

namespace Database\Seeders;

use App\Models\Productcomments;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductcommentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Productcomments::factory()->count(10)->create();
    }
}
