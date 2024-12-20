<?php

namespace App\Livewire\ManagePlans;

use App\Models\ManageTasks;
use Livewire\Attributes\On;
use Livewire\Component;

class PlanList extends Component
{

    public $plans;

    public function mount()
    {
        $this->plans = ManageTasks::limit(5)->orderBy('created_at', 'DESC')->get();
    }

    #[On('updateHeader')]
    public function updatePlanHeader() {
        dd('Something like this');
    }

    public function render()
    {
        return view('livewire.manage-plans.plan-list');
    }
}
