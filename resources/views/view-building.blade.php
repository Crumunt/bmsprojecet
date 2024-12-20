@extends('layouts.app-layout')

@php
    $sectionClass = 'mt-5';
@endphp

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
@endpush

@push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
@endpush

<style>
    #map {
        height: 450px;
        width: 100%;
    }
</style>

@section('main-content')
    <div class="top-content mt-5">

        <div class="col building-info-wrapper row justify-content-evenly align-items-center">
            <div class="d-flex flex-column w-100">
                <div class="card bg-secondary">
                    <div class="card-header">
                        <h1>Building Info</h1>
                    </div>
                    <div class="card-body d-flex row">
                        <div class="info-wrapper col-6">
                            <div class="card-title">
                                <p class="h4">Building Name</p>

                                <span class="d-block ps-4">{{ $building_data->building_name }}</span>
                            </div>
                            <div class="card-title">
                                <p class="h4">Contractor Name</p>

                                <span class="d-block ps-4">{{ $building_data->contractor_name }}</span>
                            </div>
                            <div class="card-title">
                                <p class="h4">Allocated Budget</p>

                                <span class="d-block ps-4">{{ $building_data->budget }}</span>
                            </div>
                            <div class="card-title">
                                <p class="h4">Starting Date</p>

                                <span class="d-block ps-4">{{ $building_data->starting_date }}</span>
                            </div>
                            <div class="card-title">
                                <p class="h4">Due Date</p>

                                <span class="d-block ps-4">{{ $building_data->end_date }}</span>
                            </div>
                        </div>

                        <div class="map-container col-6">
                            <div class="map-container border shadow rounded-3 overflow-hidden">
                                <div id="map"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="d-flex flex-column w-50">
                <div class="map-container">
                    <div class="map-container border shadow rounded-3 overflow-hidden">
                        <div id="map"></div>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
    {{-- <div class="map-container mt-5">
        <div class="header">
            <h1>Map</h1>
        </div>
        <div class="map-container border shadow rounded-3 overflow-hidden">
            <div id="map"></div>
        </div>
    </div> --}}
    <div class="tasks-container mt-5">
        <div class="header row mb-2">
            <h1 class="col-10">Tasks</h1>
            <div class="col-2 d-flex align-items-center">
                <a href="{{ route('generate_report', ['id' => $building_data->id]) }}"
                    class=" btn btn-md btn-success">Generate Report</a>
            </div>
        </div>
        <div class="tasks-wrapper">
            @php
                $stages = ['Planning', 'Construction', 'Inspection', 'Maintenance'];
            @endphp

            <div class="accordion" id="accordionExample">
                @foreach ($stages as $stage)
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button {{ $loop->index == 0 ? '' : 'collapsed' }}" type="button"
                                data-bs-toggle="collapse" data-bs-target="#collapse{{ $loop->index }}"
                                aria-expanded="false" aria-controls="collapse{{ $loop->index }}">
                                {{ $stage }}
                            </button>
                        </h2>
                        <div id="collapse{{ $loop->index }}"
                            class="accordion-collapse collapse {{ $loop->index == 0 ? 'show' : '' }}"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <x-dashboard.table class="tasks-table" tableID="{{ strtolower($stage) }}_tasks">
                                    <x-slot:tableHeaders>
                                        <th>Task Name</th>
                                        <th class="col-auto"></th>
                                        <th>Target</th>
                                        <th class="col-auto"></th>
                                        <th>Task Completed</th>
                                        <th class="col-auto"></th>
                                        <th>Completion Rate</th>
                                    </x-slot:tableHeaders>

                                    @foreach ($building_data['tasks'] as $task)
                                        @if ($task->task_header == $stage)
                                            @php
                                                $task_completion_rate =
                                                    ($task->percentage_completed / $task->task_percentage) * 100;
                                            @endphp
                                            <x-dashboard.table-content>
                                                <td>{{ $task->task_name }}</td>
                                                <td class="col-auto"></td>
                                                <td>{{ $task->task_percentage }}</td>
                                                <td class="col-auto"></td>
                                                <td>{{ $task->percentage_completed }}</td>
                                                <td class="col-auto"></td>
                                                <td class="d-flex align-items-center gap-2">
                                                    <div class="progress-container">
                                                        <div class="progress-bar bg-success"
                                                            style="width: {{ $task_completion_rate }}%">
                                                        </div>
                                                    </div>
                                                    <p>{{ round($task_completion_rate, 2) }}</p>
                                                </td>
                                            </x-dashboard.table-content>
                                        @endif
                                    @endforeach
                                </x-dashboard.table>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <script>
        let map = L.map('map')
        map.setView([15.734, 120.930], 15);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        setTimeout(() => {
            map.invalidateSize();
        }, 200);

        let lat = 15.737308,
            lng = 120.926677;

        let marker = L.marker([lat, lng]).addTo(map)

        marker.bindPopup(
                `Building Location`)
            .openPopup();
    </script>
@endsection
