<?php

namespace App\Livewire\ManageProjects;

use App\Models\Building;
use Livewire\Component;

class ProjectList extends Component
{
    protected $listeners = ['refreshProjectList' => 'refreshData'];
    public $buildingData;
    public $limit = '';
    public $completion_rate = [];

    public function mount()
    {
        $this->fetchBuildings();
        // dd($this->buildingData[0]->tasks[0]->percentage_completed);
        $this->loadCompletionRate();
    }

    public function refreshData()
    {
        $this->fetchBuildings();
        $this->completion_rate = [];
        $this->loadCompletionRate();
    }

    public function loadUpdateData($id)
    {
        $building_data = $this->fetchBuildingData($id);
        $this->dispatch('loadUpdateModal', $building_data);
    }


    private function fetchBuildings()
    {
        $this->buildingData = Building::with('tasks')->limit($this->limit)->orderBy('created_at', 'DESC')->get();
    }

    private function loadCompletionRate()
    {
        foreach ($this->buildingData as $data) {
            $overall_task_percentage = 0;
            $overall_task_progress = 0;
            foreach ($data->tasks as $task) {
                $overall_task_percentage += $task->task_percentage;
                $overall_task_progress += $task->percentage_completed;
            }
            array_push($this->completion_rate, ($overall_task_progress / ($overall_task_percentage == 0 ? 1 : $overall_task_percentage)) * 100);
        }
    }

    private function fetchBuildingData($id)
    {
        return Building::with('tasks')->find($id)->toArray();
        // $this->dispatch('loadModalData');
    }

    public function confirmDelete($id)
    {
        $projectData = $this->fetchBuildingData($id);
        $this->dispatch('confirmDelete', $projectData);
    }

    public function render()
    {
        return view('livewire.manage-projects.project-list');
    }
}
