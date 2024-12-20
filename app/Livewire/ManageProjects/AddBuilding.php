<?php

namespace App\Livewire\ManageProjects;

use App\Models\Building;
use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Validate;

class AddBuilding extends Component
{

    public $contractors;

    public $currentStep = 1;

    public $building_name;
    public $contractor_name;
    public $building_location;
    public $budget;
    public $starting_date;
    public $end_date;

    // protected $listeners = ['loadData' => 'loadModalData'];

    public function mount()
    {
        // dd($this->contractors);
        $this->building_name = '';
        $this->contractor_name = '';
        $this->building_location = '';
        $this->budget = '';
        $this->starting_date = '';
        $this->end_date = '';
    }

    public function loadUpdateData($id)
    {
        // $building_data = $this->fetchBuildingData($id);
        $this->dispatch('loadUpdateData');
        // dd($building_data['tasks']);
    }


    public function addProject()
    {
        // dd($this->building_name, $this->contractor_id, $this->location, $this->budget, $this->starting_date, $this->end_date);


        try {
            $validatedData = $this->validate([
                'building_name' => 'required',
                'contractor_name' => 'required',
                'building_location' => 'required',
                'budget' => 'required',
                'starting_date' => 'required',
                'end_date' => 'required'
            ]);

            Building::create($validatedData);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }

        $last_record = Building::latest()->first();

        if ($last_record) {
            $this->dispatch('addProject', $last_record->id);
            $this->dispatch('refreshProjectSummary');
        }
    }

    public function render()
    {
        return view('livewire.manage-projects.add-building');
    }
}
