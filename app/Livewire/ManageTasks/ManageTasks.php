<?php

namespace App\Livewire\ManageTasks;

use App\Models\ManageTasks as ModelsManageTasks;
use Livewire\Attributes\On;
use Livewire\Component;

class ManageTasks extends Component
{

    public $tasks;

    public function mount()
    {
        // $this->tasks = ModelsManageTasks::all();
        $this->fetchTasks();
        // dd($this->tasks);
    }

    #[On('refreshTaskData')]
    public function reloadTaskData()
    {
        $this->fetchTasks();
    }

    public function loadTaskData($id, $modalState)
    {
        $task = $this->fetchTask($id);
        $this->dispatch('loadModal', $task, $modalState);
    }

    // public function loadDeleteData($id) {
    //     $task = $this->fetchTask($id);
    //     $this->dispatch('loadDeleteData', $task);
    // }

    private function fetchTasks()
    {
        $this->tasks = ModelsManageTasks::all();
    }

    private function fetchTask($id)
    {
        return ModelsManageTasks::find($id);
    }

    public function updateTaskHeader($order) {
        dd($order);
    }

    public function render()
    {
        return view('livewire.manage-tasks.manage-tasks');
    }
}
