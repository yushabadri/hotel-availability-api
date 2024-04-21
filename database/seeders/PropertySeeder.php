<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Property;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Property::create([
            'provider_id' => 1, // Hotel Provider
            'name' => 'Hotel Seaside',
            'description' => 'A luxurious beachfront getaway offering serene views and top-notch amenities.',
            'description_license' => 'by The Hotel Provider',
            'address' => '123 Coastal Ave, Sunnytown',
            'rating' => 4,
            'facilities' => ['Spa', 'Gym', 'Pool', 'Restaurant', 'Free Wi-Fi'],
        ]);
    }
}
