<?php

namespace App\Livewire\ManageProjects;

use App\Models\Building;
use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;

class UpdateModal extends Component
{
    public $update_building_id;
    public $update_contractors;
    public $update_building_name;
    public $update_contractor_name;
    public $update_building_location;
    public $update_budget;
    public $update_starting_date;
    public $update_end_date;
    public $completion_rate;
    // protected $listeners = ['loadUpdateModal' => 'loadBuildingData'];

    public function mount()
    {
        // $this->update_contractors = User::has('contractor')->get();
        $this->completion_rate = 0;
    }

    #[On('loadUpdateModal')]
    public function loadBuildingData($building_data)
    {
        $this->update_building_id = $building_data['id'];
        $this->update_building_name = $building_data['building_name'];
        $this->update_contractor_name = $building_data['contractor_name'];
        $this->update_building_location = $building_data['building_location'];
        $this->update_budget = $building_data['budget'];
        $this->update_starting_date = $building_data['starting_date'];
        $this->update_end_date = $building_data['end_date'];

        $this->dispatch('loadUpdateTasks', $building_data['tasks']);
    }

    public function updateProject($id)
    {
        $project = Building::with('tasks')->find($id);
        if ($project) {

            // dd($this->completion_rate);
            $project->update([
                'building_name' => $this->update_building_name,
                'contractor_name' => $this->update_contractor_name,
                'building_location' => $this->update_building_location,
                'budget' => $this->update_budget,
                'starting_date' => $this->update_starting_date,
                'end_date' => $this->update_end_date
            ]);

            // dd($project);
            $this->dispatch('updateTasks', $id);
            $this->dispatch('refreshProjectSummary');
        }
    }

    public function closeModal()
    {
        $this->dispatch('resetEntities');
    }

    public function render()
    {
        return view('livewire.manage-projects.update-modal');
    }
}
