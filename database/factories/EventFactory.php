<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $store = \App\Models\Store::first();
        return [
            'name' => fake()->name(),
            'description' => fake()->text(),
            'store_id' => $store->id,
            'event_type' => 1,
            'dated' => fake()->date(),
            'timed' => fake()->time()
        ];
    }
}
