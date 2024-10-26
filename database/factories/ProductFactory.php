<?php

namespace Database\Factories;

use App\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $store = Store::first();
        
        return [
            'price' => fake()->randomFloat(2, 0, 900000),
            'old_price' => fake()->randomFloat(2, 0, 900000),
            'name' => fake()->name(),
            'description' => fake()->text(),
            'units' => fake()->randomNumber(),
            'store_id' => $store->id,
            'category_id' => 1,
            'product_category_id' => 1,
            'bespoke' => false
        ];
    }
}
