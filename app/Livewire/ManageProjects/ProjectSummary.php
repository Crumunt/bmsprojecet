<?php

namespace App\Livewire\ManageProjects;

use App\Models\Building;
use Livewire\Attributes\On;
use Livewire\Component;

class ProjectSummary extends Component
{
    public $in_progress;
    public $up_coming;
    public $total_projects;

    public function mount()
    {
        $this->getData();
    }

    #[On('refreshProjectSummary')]
    public function refreshData()
    {
        $this->getData();
    }

    private function getData()
    {
        $this->in_progress = Building::whereBetween('completion_rate', [1, 99])
            ->count();
        $this->up_coming = Building::where(['completion_rate' => 0])->count();
        $this->total_projects = Building::all()->count();
    }

    public function render()
    {
        return view('livewire.manage-projects.project-summary');
    }
}
