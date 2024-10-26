<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\EventType::factory()->create([
            'title' => "Pre-Recorded",
            'description' => "This is a pre-recorded event"
        ]);
        \App\Models\EventType::factory()->create([
            'title' => "Live",
            'description' => "This is a Live event"
        ]);
    }
}
