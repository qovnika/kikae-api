<?php

namespace Database\Factories;

use App\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
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
            "tx_ref" => fake()->phoneNumber(),
            "transaction_id" => fake()->phoneNumber(),
            "status" => "Successful",
            "user_id" => 1
        ];
    }
}
