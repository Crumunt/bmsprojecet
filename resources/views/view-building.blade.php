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
        height: 500px;
    }
</style>

@section('main-content')
    <div class="top-content d-flex gap-5">
        <div class="building-wrapper border rounded-5 overflow-hidden shadow col-3"
            style="max-width: 400px; max-height: 400px;">
            <img src="{{ asset('assets/images/image.jpg') }}" alt="" class="d-block object-fit-cover w-100 h-100">
        </div>

        <div class="col-8 building-info-wrapper row justify-content-evenly align-items-center">
            <div class="d-flex flex-column w-50">
                <x-forms.input class="form-floating w-100" value="Oakwood Plaza" state="disabled"
                    label="Building Name"></x-forms.input>
                <x-forms.input class="form-floating w-100" value="James Hargrove" state="disabled"
                    label="Contractor"></x-forms.input>
                <x-forms.input class="form-floating w-100" value="Hargrove Construction Inc." state="disabled"
                    label="Company"></x-forms.input>
            </div>
            <div class="d-flex flex-column w-50">
                <x-forms.input class="form-floating" value="$2,500,000" state="disabled" label="Budget"></x-forms.input>
                <x-forms.input class="form-floating" value="March 15, 2024" state="disabled"
                    label="Starting Date"></x-forms.input>
                <x-forms.input class="form-floating" value="September 30, 2025" state="disabled"
                    label="Due Date"></x-forms.input>
            </div>
        </div>
    </div>
    <div class="map-container mt-5">
        <div class="header">
            <h1>Map</h1>
        </div>
        <div class="map-container border shadow rounded-3 overflow-hidden">
            <div id="map"></div>
        </div>
    </div>
    <div class="tasks-container mt-5">
        <div class="header">
            <h1>Tasks</h1>
        </div>
        <div class="tasks-wrapper">
            @php
                $stages = ['Planning', 'Construction', 'Inspection', 'Maintenance'];
                $tasks = [
                    'Planning' => [
                        'Conduct site analysis and feasibility study.' =>
                            'Complete within 4 weeks; identify potential issues.',
                        'Develop architectural and engineering designs.' => 'Finalize designs by the end of week 8.',
                        'Create a detailed project timeline and milestones.' =>
                            'Develop and approve the timeline by week 10.',
                        'Prepare and submit necessary permits and approvals.' =>
                            'Submit all permits within 2 weeks after finalizing designs.',
                        'Establish a project budget and funding sources.' =>
                            'Finalize the budget by week 12, securing 100% of funding.',
                    ],
                    'Construction' => [
                        'Mobilize construction equipment and materials to the site.' =>
                            'Complete mobilization within 1 week after permit approval.',
                        'Lay the foundation and structure according to plans.' =>
                            'Finish foundation work within 6 weeks.',
                        'Install electrical and plumbing systems.' => 'Complete installations by week 18.',
                        'Complete exterior and interior finishes.' =>
                            'Finish all finishes within 8 weeks after installations.',
                        'Conduct regular safety meetings and ensure compliance with regulations.' =>
                            'Hold weekly safety meetings with a 100% attendance rate.',
                    ],
                    'Inspection' => [
                        'Perform initial site inspections and assessments.' =>
                            'Complete initial inspection by the end of week 2.',
                        'Schedule and conduct periodic inspections during construction.' =>
                            'Conduct inspections bi-weekly throughout construction.',
                        'Review contractor compliance with design specifications.' =>
                            'Review compliance at each major milestone.',
                        'Address any identified issues or deficiencies.' =>
                            'Resolve issues within 5 days of identification.',
                        'Finalize inspection reports and obtain certificates of occupancy.' =>
                            'Submit final reports within 2 weeks of project completion.',
                    ],
                    'Maintenance' => [
                        'Develop a routine maintenance schedule for the building.' =>
                            'Create the schedule within 1 month post-construction.',
                        'Conduct regular inspections of systems (HVAC, plumbing, electrical).' =>
                            'Perform inspections quarterly.',
                        'Address repairs and replacements as needed.' =>
                            'Complete repairs within 2 weeks of identification.',
                        'Keep detailed records of maintenance activities and costs.' =>
                            'Update records after each maintenance activity.',
                        'Evaluate and update maintenance plans based on building performance.' =>
                            'Review and update plans annually.',
                    ],
                ];
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
                                        <th>Completion Rate</th>
                                    </x-slot:tableHeaders>

                                    @foreach ($tasks[$stage] as $task => $item)
                                        <x-dashboard.table-content>
                                            <td>{{ $task }}</td>
                                            <td>{{ $item }}</td>
                                            <td class="d-flex align-items-center gap-2">
                                                <div class="progress-container">
                                                    <div class="progress-bar bg-success"
                                                        style="width: {{ $stage == 'Planning' ? '100%' : '0%' }}">
                                                    </div>
                                                </div>
                                                <p>{{ $stage == 'Planning' ? '100%' : '0%' }}</p>
                                            </td>
                                        </x-dashboard.table-content>
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
