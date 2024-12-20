<div class="projects-section mt-5" id="project_row">
    {{-- Do your work, then step back. --}}
    @foreach ($buildingData as $index => $data)
        <x-dashboard.project-card building_name="{{ $data->building_name }}" id="{{ $data->id }}"
            completionRate="{{ round($completion_rate[$index], 2) }}" tasks="{{ $data->tasks->count() }}" />
    @endforeach
</div>
