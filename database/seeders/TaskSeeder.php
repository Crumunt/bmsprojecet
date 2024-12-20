<?php

namespace Database\Seeders;

use App\Models\Building;
use App\Models\Task;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $building = Building::find(1);

        $tasks = [
            // Planning
            ['task_header' => 'Planning', 'task_name' => 'Site Survey and Assessment', 'task_percentage' => 3.0, 'building_id' => $building->id],
            ['task_header' => 'Planning', 'task_name' => 'Blueprint Design Approval', 'task_percentage' => 4.0, 'building_id' => $building->id],
            ['task_header' => 'Planning', 'task_name' => 'Budget Estimation and Allocation', 'task_percentage' => 3.0, 'building_id' => $building->id],

            // Construction
            ['task_header' => 'Construction', 'task_name' => 'Foundation Laying', 'task_percentage' => 4.0, 'building_id' => $building->id],
            ['task_header' => 'Construction', 'task_name' => 'Structural Framework Installation', 'task_percentage' => 4.0, 'building_id' => $building->id],
            ['task_header' => 'Construction', 'task_name' => 'Utilities Installation', 'task_percentage' => 2.0, 'building_id' => $building->id],

            // Inspection
            ['task_header' => 'Inspection', 'task_name' => 'Structural Integrity Check', 'task_percentage' => 5.0, 'building_id' => $building->id],
            ['task_header' => 'Inspection', 'task_name' => 'Utility Systems Inspection', 'task_percentage' => 3.0, 'building_id' => $building->id],
            ['task_header' => 'Inspection', 'task_name' => 'Compliance Audit', 'task_percentage' => 2.0, 'building_id' => $building->id],

            // Maintenance
            ['task_header' => 'Maintenance', 'task_name' => 'Routine Cleaning and Repairs', 'task_percentage' => 2.5, 'building_id' => $building->id],
            ['task_header' => 'Maintenance', 'task_name' => 'Utility System Maintenance', 'task_percentage' => 5.0, 'building_id' => $building->id],
            ['task_header' => 'Maintenance', 'task_name' => 'Safety System Checks', 'task_percentage' => 2.5, 'building_id' => $building->id],
        ];

        foreach ($tasks as $task) {
            Task::create($task);
        }
    }
}
