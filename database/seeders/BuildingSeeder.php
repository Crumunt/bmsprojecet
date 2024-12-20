<?php

namespace Database\Seeders;

use App\Models\Building;
use App\Models\Login;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BuildingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $building = Building::create([
            'building_name' => 'Lingap Park Fountain',
            'contractor_name' => 'Lorem Ipsum',
            'building_location' => '34.052235, -118.243683',
            'budget' => '75000000',
            'starting_date' => '2023-01-10',
            'end_date' => '2025-01-10'
        ]);
    }
}
