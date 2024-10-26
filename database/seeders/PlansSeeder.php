<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlansSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Plans::factory()->create([
            'name' => "Basic",
            'description' => "Maximum of 10 products, 10 pictures per product, 10 Runway videos and 10 videos per story in your store at a time. Store outlook customization is unavailable to the subscription. Sketch and comment boxes for the designer and shoe sections are also unavailable for this plan.",
            "price" => 0.00
        ]);
        \App\Models\Plans::factory()->create([
            'name' => "Gold",
            'description' => "A maximium 50 products, 20 pictures per product, 20 Runway videos and 20 videos per story can be uploaded by the vendor. This plan has limited outlook customization features with an increased probability of appearing at the top of the gallery. The comments box is available for this plan but the sketch box is unavailable. Pop up suggestions is not available for this plan.",
            "price" => 3000.00
        ]);
        \App\Models\Plans::factory()->create([
            'name' => "Platinum",
            'description' => "This plan has unlimited access to all features with vendors on this plan having a higher probability of appearing at the top of the general gallery as well as its section gallery. Stores on this plan with a 5 star rating have a higher probability of appearing at the top of the stores.",
            "price" => 6000.00
        ]);
    }
}
