<?php

namespace App\Livewire\ManageTasks;

use App\Models\ManageTasks;
use Livewire\Attributes\On;
use Livewire\Component;

class TaskModal extends Component
{
    public $task_id;
    public $task_header;
    public $task_name;
    public $task_desc;
    public $end_date;
    public $update_data = 0;
    public $delete_data = 0;

    public function addTask($task_header)
    {
        $this->task_header = $task_header;

        ManageTasks::create([
            'task_header' => $this->task_header,
            'task_name' => $this->task_name,
            'task_desc' => $this->task_desc,
            'end_date' => $this->end_date
        ]);

        $this->clearFields();
        $this->dispatch('refreshTaskData');
    }

    public function clearModal()
    {
        $this->clearFields();
    }

    private function clearFields()
    {
        $this->task_id = '';
        $this->task_header = '';
        $this->task_name = '';
        $this->task_desc = '';
        $this->end_date = '';
        $this->update_data =  0;
        $this->delete_data = 0;
    }

    #[On('loadModal')]
    public function loadData($tasks, $isUpdate)
    {
        // dd($tasks);
        $this->initializeTask($tasks);
        if ($isUpdate == 'update') {
            $this->update_data = 1;
        } else {
            $this->delete_data = 1;
        }

        // dd([$this->update_data, $this->delete_data]);
    }

    private function initializeTask($tasks)
    {
        $this->task_id = $tasks['id'];
        $this->task_header = $tasks['task_header'];
        $this->task_name = $tasks['task_name'];
        $this->task_desc = $tasks['task_desc'];
        $this->end_date = $tasks['end_date'];
    }

    public function updateData($id)
    {
        $task = ManageTasks::find($id);
        if ($task) {
            $task->update([
                'task_header' => $this->task_header,
                'task_name' => $this->task_name,
                'task_desc' => $this->task_desc,
                'end_date' => $this->end_date
            ]);
        }

        $this->clearFields();
        $this->dispatch('refreshTaskData');
    }

    public function deleteData($id)
    {
        $task = ManageTasks::find($id);
        if ($task) {
            $task->delete();
        }

        $this->clearFields();
        $this->dispatch('refreshTaskData'); 
    }

    public function render()
    {
        return view('livewire.manage-tasks.task-modal');
    }
}
