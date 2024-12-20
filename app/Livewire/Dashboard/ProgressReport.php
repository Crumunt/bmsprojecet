<?php

namespace App\Livewire\Dashboard;

use App\Models\Building;
use App\Models\ManageTasks;
use Livewire\Component;

class ProgressReport extends Component
{

    public $projects_report;
    public $total_projects;
    public $plans_report;
    public $total_plans;

    public function mount() {
        $plans = ManageTasks::where(['task_header' => 'done'])->get();
        $projects = Building::where(['completion_rate' => '100'])->get();
        $this->total_plans = ManageTasks::all()->count();
        $this->total_projects = Building::all()->count();

        // dd($this->total_plans, $this->total_projects);

        $this->projects_report = $projects->count();
        $this->plans_report = $plans->count();

        // dd($this->projects_report / $this->total_projects * 100);
    }

    public function render()
    {
        return view('livewire.dashboard.progress-report');
    }
}
