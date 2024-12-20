@props(['building_name' => 'Project Title', 'tasks' => '2', 'id' => '0', 'completionRate' => '10'])

<div {{ $attributes->merge(['class' => 'project-card']) }}">
    <div class="project-header">
        <span class="icon pink-icon"><i class="uil uil-constructor"></i></span>
    </div>
    <h3>{{ $building_name }}</h3>
    <p>{{ $tasks }} Tasks</p>
    <p class="progress-text">{{ $completionRate }}% Completed</p>

    <div class="progress-container">
        <div class="progress-bar bg-success progress-bar-striped progress-bar-animated"
            style="width: {{ $completionRate }}%;"></div>
    </div>
    <div class="project-actions d-flex justify-content-center gap-2">
        <a class="btn btn-primary {{ Route::currentRouteName() == 'dashboard' ? 'w-100' : '' }}"
            href="{{ route('view_building', ['id' => $id]) }}">View</a>
        @if (Route::currentRouteName() != 'dashboard')
            <button class="btn btn-success" data-bs-target="#updateModal" data-bs-toggle="modal"
                wire:click.prevent="loadUpdateData({{ $id }})">Update</button>
            <button class="btn btn-danger" data-bs-target="#confirmDeleteModal" data-bs-toggle="modal"
                wire:click="confirmDelete({{ $id }})">Delete</button>
        @endif
    </div>
</div>
