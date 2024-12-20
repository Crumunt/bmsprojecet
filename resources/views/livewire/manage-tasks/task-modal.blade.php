<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
    <x-manage-projects.modal wire:ignore.self modalID="addTaskModal" modalSize="lg" wireEvent="clearModal">
        <x-slot:pageTitle>
            {{ $update_data == 1 ? 'Update Task' : ($delete_data == 1 ? 'Delete Task' : 'Add New Task') }}
        </x-slot:pageTitle>
        @if ($delete_data == 1)
            <p class="text-dark h4">Are you sure you want to delete <strong>"{{ $task_name }}"</strong> ?</p>
        @else
            <x-forms.form formID="addTaskForm">
                <x-forms.input id="taskName" name="taskName" placeholder="Task Name" required wire:model="task_name" />
                <!-- Changed input to textarea -->
                <textarea id="description" name="description" placeholder="Task Description" rows="3" style="resize:vertical;"
                    wire:model="task_desc"></textarea>

                <div class="date-row">
                    <div class="date-field">
                        <label for="dueDate">Due Date</label>
                        <input type="date" id="dueDate" name="dueDate" wire:model="end_date">
                    </div>
                </div>
            </x-forms.form>
        @endif
        <x-slot:modalControls>
            <!-- Hidden input to store column ID -->
            {{-- <input type="hidden" id="columnId" name="columnId"> --}}

            <button id="addTaskBtn" class="btn-primary"
                {{ $update_data == 1 ? "wire:click.prevent=updateData($task_id)" : ($delete_data == 1 ? "wire:click.prevent=deleteData($task_id)" : '') }}
                type="submit" data-bs-dismiss="modal">
                {{ $update_data == 1 ? 'Update' : ($delete_data == 1 ? 'Delete' : 'Add Task') }}
            </button>
        </x-slot:modalControls>
    </x-manage-projects.modal>
</div>
