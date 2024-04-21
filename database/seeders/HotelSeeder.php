<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Hotel;

class HotelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hotel for Horizon
        Hotel::create([
            'property_id' => 1, // Hotel Seaside
            'agency_id' => 1, // Horizon
            'name' => NULL,
            'description' => 'Enjoy exclusive access to our private beach and rooftop dining at Hotel Seaside.',
            'description_license' => NULL, 
            'address' => NULL, 
            'rating' => 4.5,
            'facilities' => ['Private Beach', 'Rooftop Dining', 'Spa', 'Pool'],
        ]);

        // Hotel for Dreams
        Hotel::create([
            'property_id' => 1, // Hotel Seaside
            'agency_id' => 2, // Dreams
            'name' => 'Hotel Seaside Retreat',
            'description' => NULL,
            'description_license' => NULL, 
            'address' => NULL, 
            'rating' => 4.2,
            'facilities' => ['Adventure Tours', 'Spa', 'Heated Pool', 'Exclusive Lounge'],
        ]);
    }
}
