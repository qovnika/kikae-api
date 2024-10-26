<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsertypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Usertype::factory()->create([
            'name' => "Customer",
            'description' => "Default Customer"
        ]);
        \App\Models\Usertype::factory()->create([
            'name' => "Vendor Administrator",
            'description' => "Vendor - Manager of a store"
        ]);
        \App\Models\Usertype::factory()->create([
            'name' => "Vendor",
            'description' => "Vendor - Owner and manager of a store"
        ]);
        \App\Models\Usertype::factory()->create([
            'name' => "Administrator",
            'description' => "Entire application administrator"
        ]);
    }
}
