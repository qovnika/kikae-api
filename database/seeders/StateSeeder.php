<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds."
     *"
     * @return void"
     */
    public function run()
    {
        \App\Models\State::factory()->create([
            'name' => "Abia"
        ]);
        \App\Models\State::factory()->create([
            'name' => "Adamawa"
        ]);
        \App\Models\State::factory()->create([
            'name' => "Akwa Ibom"
        ]);
        \App\Models\State::factory()->create([
            'name' => "Anambra"
        ]);
        \App\Models\State::factory()->create([
            'name' => "Bauchi"
        ]);
        \App\Models\State::factory()->create([
            'name' => "Bayelsa"
        ]);
        \App\Models\State::factory()->create([
            'name' => "Benue"
        ]);
        \App\Models\State::factory()->create([
            'name' => "Borno"
        ]);
        \App\Models\State::factory()->create([
            'name' => "Cross River"
        ]);
        \App\Models\State::factory()->create([
            'name' => "Delta"
        ]);
        \App\Models\State::factory()->create([
            'name' => "Ebonyi"
        ]);
        \App\Models\State::factory()->create([
            'name' => "Edo"
        ]);
        \App\Models\State::factory()->create([
            'name' => "Ekiti"
        ]);
        \App\Models\State::factory()->create([
            'name' => "Enugu"
        ]);
        \App\Models\State::factory()->create([
            'name' => "Federal Capital Terrirtory (Abuja)"
        ]);
        \App\Models\State::factory()->create([
            'name' => "Gombe"
        ]);
        \App\Models\State::factory()->create([
            'name' => "Imo"
        ]);
        \App\Models\State::factory()->create([
            'name' => "Jigawa"
        ]);
        \App\Models\State::factory()->create([
            'name' => "Kaduna"
        ]);
        \App\Models\State::factory()->create([
            'name' => "Kano"
        ]);
        \App\Models\State::factory()->create([
            'name' => "Katsina"
        ]);
        \App\Models\State::factory()->create([
            'name' => "Kebbi"
        ]);
        \App\Models\State::factory()->create([
            'name' => "Kogi"
        ]);
        \App\Models\State::factory()->create([
            'name' => "Kwara"
        ]);
        \App\Models\State::factory()->create([
            'name' => "Lagos"
        ]);
        \App\Models\State::factory()->create([
            'name' => "Nasarawa"
        ]);
        \App\Models\State::factory()->create([
            'name' => "Niger"
        ]);
        \App\Models\State::factory()->create([
            'name' => "Ogun"
        ]);
        \App\Models\State::factory()->create([
            'name' => "Ondo"
        ]);
        \App\Models\State::factory()->create([
            'name' => "Osun"
        ]);
        \App\Models\State::factory()->create([
            'name' => "Oyo"
        ]);
        \App\Models\State::factory()->create([
            'name' => "Plateau"
        ]);
        \App\Models\State::factory()->create([
            'name' => "Rivers"
        ]);
        \App\Models\State::factory()->create([
            'name' => "Sokoto"
        ]);
        \App\Models\State::factory()->create([
            'name' => "Taraba"
        ]);
        \App\Models\State::factory()->create([
            'name' => "Yobe"
        ]);
        \App\Models\State::factory()->create([
            'name' => "Zamfara"
        ]);
    }
}
