<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Plans;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            StateSeeder::class,
            UsertypeSeeder::class,
            UserSeeder::class,
            CategorySeeder::class,
            ProductCategorySeeder::class,
            StoreSeeder::class,
            ProductSeeder::class,
            TransactionSeeder::class,
            MessageSeeder::class,
            PlansSeeder::class,
            EventTypeSeeder::class,
            EventSeeder::class,
            ProductcommentsSeeder::class
        ]);
    }
}
