<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Store>
 */
class StoreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "name" => fake()->name(),
            "address" => fake()->address(),
            "email" => fake()->email(),
            "phone" => fake()->phoneNumber(),
            "user_id" => 1,
            "category_id" => 1,
            "state_id" => 1,
            "product_category_id" => 4,
            "description" => fake()->text(),
            "hash" => str_replace("/", "", Hash::make(fake()->email()))
        ];
    }
}
