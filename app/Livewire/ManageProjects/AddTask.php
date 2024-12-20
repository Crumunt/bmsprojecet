<?php

namespace App\Livewire\ManageProjects;

use App\Models\Building;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;
use Livewire\Component;

class AddTask extends Component
{

    protected $listeners = ['addProject' => 'storeTasks', 'loadTasks' => 'loadTasks'];


    public $task_name;
    public $task_target;
    public $active_section = 'Planning';
    public $modal_type = "add";
    public $tasks = [
        'Planning' => [
            'task_name' => [],
            'task_target' => [],
            // 'percentage_completed' => []
        ],
        'Construction' => [
            'task_name' => [],
            'task_target' => [],
            // 'percentage_completed' => []
        ],
        'Inspection' => [
            'task_name' => [],
            'task_target' => [],
            // 'percentage_completed' => []
        ],
        'Maintenance' => [
            'task_name' => [],
            'task_target' => [],
            // 'percentage_completed' => []
        ],
    ];
    public $percentage_completed = [];

    public function mount() {}

    public function addTask($stage, $index)
    {
        $this->active_section = $stage;

        // dd($this->tasks[$stage]['task_name'][1]);

        if (isset($this->tasks[$stage])) {
            array_push($this->tasks[$stage]['task_name'], $this->task_name);
            array_push($this->tasks[$stage]['task_target'], $this->task_target);
            array_splice($this->percentage_completed, $index, 0, 0.00);

            // dd($this->tasks[$stage], count($this->tasks[$stage]['task_name']), $this->percentage_completed, $index);
            $this->task_name = '';
            $this->task_target = '';
        }
    }

    private function resetTaskList()
    {
        $this->tasks = [
            'Planning' => [
                'task_name' => [],
                'task_target' => [],
                // 'percentage_completed' => []
            ],
            'Construction' => [
                'task_name' => [],
                'task_target' => [],
                // 'percentage_completed' => []
            ],
            'Inspection' => [
                'task_name' => [],
                'task_target' => [],
                // 'percentage_completed' => []
            ],
            'Maintenance' => [
                'task_name' => [],
                'task_target' => [],
                // 'percentage_completed' => []
            ],
        ];
    }

    #[On('resetEntities')]
    public function resetEntities()
    {
        $this->resetTaskList();
        $this->modal_type = 'add';
    }

    #[On('loadUpdateTasks')]
    public function loadTasks($tasks)
    {
        // dd($tasks);
        foreach ($tasks as $value) {
            array_push($this->tasks[$value['task_header']]['task_name'], $value['task_name']);
            array_push($this->tasks[$value['task_header']]['task_target'], $value['task_percentage']);
            // array_push($this->tasks[$value['task_header']]['percentage_completed'], $value['percentage_completed']);
            array_push($this->percentage_completed, $value['percentage_completed']);
        }
        // dd($this->percentage_completed);

        $this->modal_type = "update";
    }

    public function removeTask($stage, $index)
    {

        $this->active_section = $stage;

        unset($this->tasks[$stage]['task_name'][$index]);
        unset($this->tasks[$stage]['task_target'][$index]);

        // re-index the array
        $index = 0;
        foreach ($this->tasks as $stage => $taskData) {
            $this->tasks[$stage]['task_name'] = array_values($taskData['task_name']);
            $this->tasks[$stage]['task_target'] = array_values($taskData['task_target']);
            $this->percentage_completed[$index] = array_values($this->percentage_completed[$index]);
        }
    }

    public function storeTasks($building_id)
    {
        foreach ($this->tasks as $stage => $data) {
            foreach ($data['task_name'] as $index => $taskName) {
                Task::create([
                    'task_header' => $stage,
                    'task_name' => $taskName,
                    'task_percentage' => $data['task_target'][$index],
                    'building_id' => $building_id
                ]);
            }
        }

        $this->resetTaskList();

        $this->dispatch('refreshProjectList');
    }

    public function storePercentage($stage, $index)
    {
        $this->tasks[$stage]['percentage_completed'][$index] = $this->percentage_completed;
    }

    #[On('updateTasks')]
    public function updateTasks($building_id)
    {
        // dd($this->percentage_completed['Planning']['Site Survey and Assessment']['percentage']);
        $array_index = 0;
        $overall_task_percentage = 0;
        $overall_task_progress = 0;
        // dd($this->percentage_completed);
        foreach ($this->tasks as $stage => $data) {
            foreach ($data['task_name'] as $index => $taskName) {
                Task::updateOrCreate(
                    ['building_id' => $building_id, 'task_header' => $stage, 'task_name' => $taskName],
                    [
                        'task_header' => $stage,
                        'task_name' => $taskName,
                        'task_percentage' => $data['task_target'][$index],
                        'percentage_completed' => $this->percentage_completed[$array_index] ?? 0
                    ]
                );
                $overall_task_percentage += $data['task_target'][$index];
                $overall_task_progress += $this->percentage_completed[$array_index] ?? 0;


                $array_index++;
            }
        }
        $array_index = 0;

        $completion_rate = ($overall_task_progress / $overall_task_percentage) * 100;

        Building::find($building_id)
            ->update([
                'completion_rate' => $completion_rate
            ]);
        // $overall_task_percentage = 0;
        // $overall_task_progress = 0;
        // foreach ($project['tasks'] as $task) {
        //     $overall_task_percentage += $task['task_percentage'];
        //     $overall_task_progress += $task['percentage_completed'];
        // }
        // $this->completion_rate = (($overall_task_progress / $overall_task_percentage) * 100);

        // dd($taskModel);
        $this->resetTaskList();
        $this->dispatch('refreshProjectList');
    }

    public function render()
    {
        return view('livewire.manage-projects.add-task');
    }
}
