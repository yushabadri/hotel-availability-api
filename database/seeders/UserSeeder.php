<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User associated with Horizon
        User::create([
            'agency_id' => 1, // Horizon
            'name' => 'John due 1',
            'email' => 'john.due1@example.com',
            'password' => bcrypt('user'), 
        ]);

        // User associated with Dreams
        User::create([
            'agency_id' => 2, // Dreams
            'name' => 'John due 2 ',
            'email' => 'john.due2@example.com',
            'password' => bcrypt('user'), 
        ]);

        // User without specific agency (To Show default Hotel Provider Information on hotel)
        User::create([
            'name' => 'John due 3',
            'email' => 'john.due3@example.com',
            'password' => bcrypt('user'), 
        ]);
    }
}
