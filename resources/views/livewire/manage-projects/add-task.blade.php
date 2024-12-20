<div>
    {{-- Because she competes with no one, no one can compete with her. --}}
    @php
        $stages = ['Planning', 'Construction', 'Inspection', 'Maintenance'];
    @endphp

    <div class="accordion" id="accordionExample">
        @php
            $outer_index = 0;
        @endphp
        @foreach ($stages as $stage)
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapse{{ $loop->index }}" aria-expanded="false"
                        aria-controls="collapse{{ $loop->index }}">
                        {{ $stage }}
                    </button>
                </h2>
                <div id="collapse{{ $loop->index }}"
                    class="accordion-collapse collapse {{ $stage === $active_section ? 'show' : '' }}"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <x-dashboard.table class="tasks-table" tableID="{{ strtolower($stage) }}_tasks">
                            <x-slot:tableHeaders>
                                <th class="col text-center">Task Name</th>
                                <th class="col-auto"></th>
                                <th class="col text-center">Target</th>
                                <th class="col-auto"></th>
                                <th class="col text-center">
                                    @if ($modal_type == 'add')
                                        Actions
                                    @else
                                        Percentage Completed
                                    @endif
                                </th>
                            </x-slot:tableHeaders>
                            @foreach ($tasks as $task_stage => $taskData)
                                @if ($task_stage === $stage)
                                    @foreach ($taskData['task_name'] as $index => $task)
                                        <tr>
                                            <td class="col text-center">
                                                {{ $task }}
                                            </td>
                                            <td class="col-auto"></td>
                                            <td class="col text-center">
                                                {{ $taskData['task_target'][$index] }}
                                            </td>
                                            <td class="col-auto"></td>
                                            <td class="col">
                                                @if ($modal_type == 'add')
                                                    <button class="btn btn-danger btn-sm m-auto"
                                                        wire:click.prevent="removeTask('{{ $stage }}',{{ $index }})">
                                                        Remove
                                                    </button>
                                                @else
                                                    <x-forms.input id="taskCompleted{{ $outer_index }}" type="tel"
                                                        wire:model="percentage_completed.{{ $outer_index }}"
                                                        {{-- wire:focusout="addPercentageToList('{{$stage}}', {{$index}}, '{{$task}}')" --}} name="taskCompleted"
                                                        class="w-75 text-center m-auto"
                                                        keyup="bindModel({{ $outer_index }})" />
                                                @endif
                                            </td>
                                        </tr>
                                        @php
                                            $outer_index++;
                                        @endphp
                                    @endforeach
                                @endif
                            @endforeach



                        </x-dashboard.table>

                        <hr>
                        <div class="input-group d-flex gap-2">
                            <x-forms.input wire:model="task_name" name="task_name" id="{{ strtolower($stage) }}_input"
                                label="Task Name" class="form-floating" />
                            <x-forms.input wire:model="task_target" name="task_target"
                                id="{{ strtolower($stage) }}_target" label="Task Objective" class="form-floating" />
                        </div>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button class="btn btn-success addTaskButton me-md-2" type="button"
                                id="{{ strtolower($stage) }}" wire:click="addTask('{{ $stage }}', {{$outer_index}})">
                                Add Task
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        @php
            $outer_index = 0;
        @endphp
    </div>
</div>
