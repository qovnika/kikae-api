<?php

namespace Database\Factories;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $trans = Transaction::first();

        return [
            "price" => fake()->randomFloat(2, 0, 900000),
            "units" => fake()->randomNumber(),
            "product_id" => 1,
            "transaction_id" => $trans->id
        ];
    }
}
