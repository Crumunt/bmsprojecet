<!-- The best way to take care of the future is to take care of the present moment. - Thich Nhat Hanh -->
@props(['building_name' => 'Project Title', 'tasks' => '2', 'id' => 'sample', 'completionRate' => '10'])

<div {{ $attributes->merge(['class' => 'project-card']) }}">
    <div class="project-header">
        <span class="icon pink-icon"><i class="uil uil-constructor"></i></span>
        <div class="avatars">
            <img class="user-avatar" src={{ asset('assets/images/avatar1.jpg') }} alt="User 1">
            <img class="user-avatar" src={{ asset('assets/images/avatar1.jpg') }} alt="User 2">
            <img class="user-avatar" src={{ asset('assets/images/avatar1.jpg') }} alt="User 3">
        </div>
    </div>
    <h3>{{ $building_name }}</h3>
    <p>{{ $tasks }} Tasks</p>
    <p class="progress-text">{{ $completionRate }}% Completed</p>

    <div class="progress-container">
        <div class="progress-bar bg-success progress-bar-striped progress-bar-animated"
            style="width: {{ $completionRate }}%;"></div>
    </div>
    <div class="project-actions d-flex justify-content-center gap-2">
        {{-- <a class="btn btn-primary" href="{{ route('view_building') }}">View</a> --}}
        <button class="btn btn-success w-100" data-bs-target="#uploadImageModal" data-bs-toggle="modal">Update
            Progress</button>
    </div>
</div>
