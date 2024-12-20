<div>
    {{-- In work, do what you enjoy. --}}
    @php
        $stages = ['todo', 'inprogress', 'done'];
    @endphp
    <div class="kanban-board" wire:sortable="updateTaskHeader">
        @foreach ($stages as $stage)
            <div class="kanban-column" id="{{ $stage }}-column" wire:sortable.group="{{ $stage }}">
                <h2>{{ $stage == 'todo' ? 'To Do' : ($stage == 'inprogress' ? 'In Progress' : 'Done') }}</h2>
                <div class="add-card-btn" data-bs-target="#addTaskModal" data-bs-toggle="modal"
                    onclick="openModal('{{ $stage }}')">+ Add another card</div>
                @foreach ($tasks as $task)
                    @if ($task->task_header == $stage)
                        <div class="kanban-card" wire:sortable.item="{{ $task->id }}" wire:key="{{ $task->id }}"
                            draggable="true" data-task-name="{{ $task->task_name }}"
                            onmousedown="addDragAndDropListeners(this)">
                            <div class="kanban-card-header">
                                <h3>{{ $task->task_name }}</h3>
                            </div>
                            <p class="">{{ $task->task_desc }}</p>
                            <div class="bottom-sec d-flex justify-content-between">
                                <div class="button-group">
                                    <button class="btn btn-sm btn-warning"
                                        wire:click="loadTaskData({{ $task->id }}, 'update')"
                                        data-bs-target="#addTaskModal" data-bs-toggle="modal">Edit</button>
                                    <button class="btn btn-sm btn-danger"
                                        wire:click="loadTaskData({{ $task->id }}, 'del')"
                                        data-bs-target="#addTaskModal" data-bs-toggle="modal">Delete</button>
                                </div>
                                <div class="due-date">
                                    <i class="uil uil-calendar-alt"></i>
                                    <span class="remaining-days">
                                        @php
                                            $start_date = strtotime(Date('Y-m-d'));
                                            $end_date = strtotime($task->end_date);

                                            $diff = abs($end_date - $start_date);
                                            $days = $diff / (60 * 60 * 24);
                                        @endphp

                                        @if ($start_date > $end_date)
                                            Overdue
                                        @else
                                            {{ $days }} {{ $days > 1 ? 'days' : 'day' }} to go
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        @endforeach
    </div>


</div>
