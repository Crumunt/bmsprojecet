<?php

namespace App\Livewire\ManageProjects;

use App\Models\Building;
use Livewire\Component;

class ConfirmDeleteModal extends Component
{

    protected $listeners = ['confirmDelete' => 'promptDelete'];

    public $building_id;
    public $building_name;

    public function promptDelete($building_data) {
        $this->building_name = $building_data['building_name'];
        $this->building_id = $building_data['id'];
        // dd($this->buildingData);
    }

    public function destroyProject($id) {
        $project = Building::find($id);

        if($project) {
            $project->delete();
        }

        $this->dispatch('refreshProjectList');
        $this->dispatch('refreshProjectSummary');
    }

    public function render()
    {
        return view('livewire.manage-projects.confirm-delete-modal');
    }
}
