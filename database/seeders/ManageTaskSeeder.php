<?php

namespace Database\Seeders;

use App\Models\ManageTasks;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ManageTaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        ManageTasks::create([
            'task_header' => 'todo',
            'task_name' => '5:00pm meeting',
            'task_desc' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quas numquam repellendus ex provident, et adipisci animi natus, libero quasi culpa architecto voluptate consectetur debitis aliquid officiis ducimus.',
            'end_date' => '2025-01-12'
        ]);
    }
}
