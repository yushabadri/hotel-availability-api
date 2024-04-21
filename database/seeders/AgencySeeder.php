<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Agency;

class AgencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Agency for Horizon
        Agency::create([
            'name' => 'Horizon',
            'email' => 'Horizon@example.com',
            'password' => bcrypt('agency'), 
        ]);

        // Agency for Dreams
        Agency::create([
            'name' => 'Dreams',
            'email' => 'Dreams@example.com',
            'password' => bcrypt('agency'), 
        ]);
    }
}
