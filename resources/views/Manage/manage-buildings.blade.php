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
    #map,
    #updateMap {
        height: 300px;
    }
</style>

@section('page_header')
    <div class="d-flex justify-content-between align-items-center">
        <div class="projects-container p-4">
            {{-- <h1 class="pb-2">Manage Projects</h1> --}}
            <div class="project-summary">
                <livewire:manage-projects.project-summary />
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
        <div>
            <livewire:manage-projects.project-list />
        </div>
        <div class="modalGroup">
            {{-- Basic Info Modal --}}
            <livewire:manage-projects.add-building />
            <livewire:manage-projects.update-modal />
            <livewire:manage-projects.confirm-delete-modal />
        </div>

        <script>
            function initializeUpdateMap() {

            }
        </script>
    @endsection
