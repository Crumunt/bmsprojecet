@extends('layouts.app-layout')

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
@endpush

@push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="{{ asset('assets/js/manage_building.js') }}" defer></script>
@endpush

<style>
    #map {
        height: 300px;
    }
</style>

@section('page_header')
    <div class="d-flex justify-content-between align-items-center">
        <div class="projects-container">
            <h1 class="pb-2">Manage Projects</h1>
            <div class="project-summary">
                <div class="summary-items d-flex gap-2">
                    <div class="summary-item">
                        <strong class="h2">45</strong>
                        <span>In Progress</span>
                    </div>
                    <div class="summary-item">
                        <strong class="h2">12</strong>
                        <span>In Progress</span>
                    </div>
                    <div class="summary-item">
                        <strong class="h2">10</strong>
                        <span>Upcoming</span>
                    </div>
                    <div class="summary-item">
                        <strong class="h2">67</strong>
                        <span>Total Project</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2 mb-3">
            <button type="button" class="btn btn-outline-success rounded-pill px-5" data-bs-target="#modalToggle"
                data-bs-toggle="modal">
                <div class="text text-left py-2 pl-3">
                    <span class="fw-bold">+</span>
                </div>
            </button>
        </div>
@endsection

    @section('main-content')
        <div class="projects-section mt-5" id="project_row">
            @for ($i = 0; $i < 5; $i++)
                <x-dashboard.project-card title="Project Number#{{ $i + 1 }}" tasks="{{ rand(1, 10) }}"
                    dropdownID="{{ $i }}" completionRate="{{ rand(1, 100) }}" />
            @endfor
        </div>
        <div class="modalGroup">
            {{-- Basic Info Modal --}}
            <x-manage-projects.modal modalID="modalToggle" modalAddon="modal-dialog-scrollable">
                <x-slot:pageTitle>Add Building</x-slot:pageTitle>

                <x-forms.form formID="buildingForm" data-multi-step>

                    <div class="common_info" data-step>
                        <x-forms.input class="form-floating" id="building_name" name="building_name"
                            label="Building Name" />
                        <x-forms.input class="form-floating" id="contractor_name" name="contractor_name"
                            label="Contractor Name" />

                        <div class="location-group">
                            <x-forms.input type="text" class="form-floating" id="building_location" disabled
                                label="Building Location" aria-label="Building Location" aria-describedby="button-addon2" />
                            <div id="map"></div>
                        </div>

                        <x-forms.input class="form-floating" name="company_name" label="Company Name" />
                        <x-forms.input class="form-floating" name="allocated_budget" label="Budget" />
                        <x-forms.input class="form-floating" name="start_date" type="date" label="Staring Date" />
                        <x-forms.input class="form-floating" name="end_date" type="date" label="Expected End Date" />
                    </div>
                    <div class="building_tasks d-none" data-step>
                        @php
                            $stages = ['Planning', 'Construction', 'Inspection', 'Maintenance'];
                        @endphp

                        <div class="accordion" id="accordionExample">
                            @foreach ($stages as $stage)
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapse{{ $loop->index }}" aria-expanded="false"
                                            aria-controls="collapse{{ $loop->index }}">
                                            {{ $stage }}
                                        </button>
                                    </h2>
                                    <div id="collapse{{ $loop->index }}" class="accordion-collapse collapse"
                                        data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <x-dashboard.table class="tasks-table" tableID="{{ strtolower($stage) }}_tasks">
                                                <x-slot:tableHeaders>
                                                    <th>Task Name</th>
                                                    <th>Target</th>
                                                    <th>Actions</th>
                                                </x-slot:tableHeaders>
                                            </x-dashboard.table>

                                            <hr>
                                            <div class="input-group d-flex gap-2">
                                                <x-forms.input name="task_name" id="{{ strtolower($stage) }}_input"
                                                    label="Task Name" class="form-floating" />
                                                <x-forms.input name="task_target" id="{{ strtolower($stage) }}_target"
                                                    label="Task Objective" class="form-floating" />
                                            </div>
                                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                                <button class="btn btn-success addTaskButton me-md-2"
                                                    id="{{ strtolower($stage) }}">Add
                                                    Task</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </x-forms.form>

                <x-slot:modalControls>
                    <button class="btn btn-warning d-none formControlButton" data-previous type="button">Previous</button>
                    <button class="btn btn-primary formControlButton" data-next>Next</button>
                    <button class="btn btn-success d-none" id="addBuilding" type="submit">Submit</button>
                </x-slot:modalControls>
            </x-manage-projects.modal>

        </div>
    @endsection
