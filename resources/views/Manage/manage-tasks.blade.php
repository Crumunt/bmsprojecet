@extends('layouts.app-layout')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/tasks.css') }}">
@endpush

@push('scripts')
@endpush


@section('page_header')
@endsection

@section('main-content')
    <!-- Main Content with Projects and Task List -->
    <div class="kanban-container">

        <div class="kanban-board">
            <!-- To Do Column -->
            <div class="kanban-column" id="todo-column">
                <h2>To Do</h2>
                <div class="add-card-btn" data-bs-target="#addTaskModal" data-bs-toggle="modal"
                    onclick="openModal('todo-column')">+ Add another card</div>
            </div>

            <!-- In Progress Column -->
            <div class="kanban-column" id="inprogress-column">
                <h2>In Progress</h2>
                <div class="add-card-btn" data-bs-target="#addTaskModal" data-bs-toggle="modal"
                    onclick="openModal('inprogress-column')">+ Add another card</div>
            </div>

            <!-- Done Column -->
            <div class="kanban-column" id="done-column">
                <h2>Done</h2>
                <div class="add-card-btn" data-bs-target="#addTaskModal" data-bs-toggle="modal"
                    onclick="openModal('done-column')">+ Add another card</div>
            </div>

            <!-- Deployed Column -->
            <div class="kanban-column" id="deployed-column">
                <h2>Deployed</h2>
                <div class="add-card-btn" data-bs-target="#addTaskModal" data-bs-toggle="modal"
                    onclick="openModal('deployed-column')">+ Add another card</div>
            </div>
        </div>

        <!-- Add Task Modal -->
        <x-manage-projects.modal modalID="addTaskModal" modalSize="lg">
            <x-slot:pageTitle>Add New Task</x-slot:pageTitle>
            <x-forms.form formID="addTaskForm">
                <x-forms.input id="taskName" name="taskName" placeholder="Task Name" required />
                <!-- Changed input to textarea -->
                <textarea id="description" name="description" placeholder="Task Description" rows="3" style="resize:vertical;"></textarea>

                <div class="date-row">
                    <div class="date-field">
                        <label for="startDate">Start Date</label>
                        <input type="date" id="startDate" name="startDate">
                    </div>

                    <div class="date-field">
                        <label for="dueDate">Due Date</label>
                        <input type="date" id="dueDate" name="dueDate">
                    </div>
                </div>
            </x-forms.form>
            <x-slot:modalControls>
                <!-- Hidden input to store column ID -->
                <input type="hidden" id="columnId" name="columnId">

                <button id="addTaskBtn" class="btn-primary" type="submit" onclick="addTaskCard(event);">Add Task</button>
            </x-slot:modalControls>
        </x-manage-projects.modal>

        <div id="editTaskModal" class="modal modal-dialog-sm">
            <div class="modal-content">
                <span class="close" onclick="closeEditModal()">&times;</span>
                <h2>Edit Task</h2>
                <form id="editTaskForm">
                    <input type="text" id="editTaskName" name="editTaskName" placeholder="Task Name" required>

                    <!-- Changed input to textarea -->
                    <textarea id="editDescription" name="editDescription" placeholder="Task Description" rows="3"
                        style="resize:vertical;"></textarea>

                    <div class="date-row">
                        <div class="date-field">
                            <label for="editStartDate">Start Date</label>
                            <input type="date" id="editStartDate" name="editStartDate">
                        </div>

                        <div class="date-field">
                            <label for="editDueDate">Due Date</label>
                            <input type="date" id="editDueDate" name="editDueDate">
                        </div>
                    </div>

                    <!-- Hidden input to store column ID -->
                    <input type="hidden" id="editColumnId" name="editColumnId">

                    <button id="saveChangesBtn" class="btn-primary" type="submit">Save Changes</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Open Modal for Adding Cards
        function openModal(columnId) {
            document.getElementById('columnId').value = columnId;
            // document.getElementById('addTaskModal').style.display = 'flex';
        }

        // // Close modal function
        function closeModal() {
            document.getElementById('addTaskModal').style.display = 'none';
        }

        // Calculate Remaining Days
        function calculateRemainingDays(startDate, dueDate) {
            const startingDay = new Date(startDate);
            const dueDay = new Date(dueDate);

            // reset hours to midnight
            const startingMidnight = new Date(startingDay.setHours(0,0,0,0));
            const dueMidnight = new Date(dueDay.setHours(0,0,0,0));
            const timeDiff = dueMidnight - startingMidnight;
            const daysLeft = Math.ceil(timeDiff / (1000 * 60 * 60 * 24));
            console.log(daysLeft)

            return daysLeft >= 0 ? `${daysLeft} days left` : 'Overdue';
        }

        // Handle Form Submission to Add a New Card

        function addTaskCard(e) {
            e.preventDefault();
            console.log('adding task card')

            const taskName = document.getElementById('taskName').value;
            const taskDescription = document.getElementById('description').value;
            const startDate = document.getElementById('startDate').value;
            const dueDate = document.getElementById('dueDate').value;
            const columnId = document.getElementById('columnId').value;

            if (!taskName || !columnId) {
                console.error("Task name or column ID is missing.");
                return;
            }

            const remainingDays = calculateRemainingDays(startDate, dueDate);
            console.log(remainingDays)
            const uniqueId = `dropdown-${Date.now()}`;
            const newCard = document.createElement('div');
            newCard.classList.add('kanban-card');
            newCard.setAttribute('draggable', 'true');
            newCard.setAttribute('data-task-name', taskName);

            const formattedDescription = taskDescription.replace(/\n/g, '<br>');

            newCard.innerHTML = `
        <div class="kanban-card-header">
            <h3>${taskName}</h3>
            <div class="edit-dropdown">
                <i class="uil uil-edit" onclick="toggleDropdown('${uniqueId}')"></i>
                <div id="${uniqueId}" class="dropdown-content">
                    <a href="#" onclick="editTask('${taskName}')">Edit</a>
                    <a href="#" onclick="deleteTask('${taskName}')">Delete</a>
                </div>
            </div>
        </div>
        <p>${formattedDescription}</p>
        <div class="due-date">
            <i class="uil uil-calendar-alt"></i>
            <span class="remaining-days">${remainingDays}</span>
        </div>
    `;

            const column = document.getElementById(columnId);
            if (column) {
                column.appendChild(newCard);
                addDragAndDropListeners(newCard);
            } else {
                console.error("Column not found: ", columnId);
            }

            $('#addTaskModal').modal('hide')
        }

        // Drag-and-Drop Logic
        let draggedItem = null;

        function addDragAndDropListeners(item) {
            item.addEventListener('dragstart', function() {
                draggedItem = this;
                setTimeout(() => this.style.display = 'none', 0);
            });

            item.addEventListener('dragend', function() {
                setTimeout(() => {
                    this.style.display = 'block';
                    draggedItem = null;
                }, 0);
            });
        }

        // Allow dropping in columns
        const columns = document.querySelectorAll('.kanban-column');
        columns.forEach(column => {
            column.addEventListener('dragover', function(e) {
                e.preventDefault();
            });

            column.addEventListener('drop', function() {
                if (draggedItem) {
                    this.appendChild(draggedItem);
                }
            });
        });

        // Close modal when clicking outside the modal content
        window.onclick = function(event) {
            const addTaskModal = document.getElementById('addTaskModal');
            const editTaskModal = document.getElementById('editTaskModal');

            if (event.target == addTaskModal) {
                closeModal();
            } else if (event.target == editTaskModal) {
                closeEditModal();
            }
        };

        // Open Edit Modal function
        function openEditModal(taskName, taskDescription, dueDate) {
            const modal = document.getElementById('editTaskModal');
            modal.style.display = 'flex';
            document.getElementById('editTaskName').value = taskName;
            document.getElementById('editTaskDescription').value = taskDescription;
            document.getElementById('editDueDate').value = dueDate;
        }

        // Close Edit Modal function
        function closeEditModal() {
            document.getElementById('editTaskModal').style.display = 'none';
        }

        // Edit Task function
        function editTask(taskName) {
            const taskDescription = "Task description placeholder"; // Replace with real data
            const dueDate = "2023-12-31"; // Replace with real data
            openEditModal(taskName, taskDescription, dueDate);
        }

        // Delete Task function
        function deleteTask(taskName) {
            const taskCard = document.querySelector(`[data-task-name="${taskName}"]`);
            if (taskCard) {
                taskCard.remove();
                alert(`Task "${taskName}" has been deleted.`);
            } else {
                console.error("Task not found: ", taskName);
            }
        }
    </script>
@endsection
