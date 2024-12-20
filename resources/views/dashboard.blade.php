@extends('layouts.app-layout')

@section('main-content')
    <div class="projects-section">
        {{-- <x-dashboard.project-card class="ios-project" completionRate="70" tasks="32" title="IOS Projects" dropdownID="ios" />

        <x-dashboard.project-card class="web-project" completionRate="50" tasks="124" title="Web Application"
            dropdownID="web1" />

        <x-dashboard.project-card class="web-project" completionRate="80" tasks="69" title="Web Application"
            dropdownID="web2" /> --}}

        <livewire:manage-projects.project-list :limit="3"/>
    </div>

    <div class="tasks-section">
        <div class="view-all-projects">
            <a href="{{route('manage_projects')}}" class="view-all-link">View All Projects</a>
        </div>

        <livewire:manage-plans.plan-list />

    </div>
@section('sub-content')
    <div class="right-section">
        {{-- <div class="progress-box">
            <h3>Progress</h3>
            <x-circular-progress completionRate="37" progressTitle="Reports" />
            <x-circular-progress completionRate="83" progressTitle="Done" />
            <x-circular-progress completionRate="51" progressTitle="On-going" />
        </div> --}}
        <livewire:dashboard.progress-report />

        <div class="schedule-box">
            <h3>Reminders</h3>
            <ul id="schedule-list"></ul> <!-- Schedule items are displayed here -->
            <div class="input-container">
                <input type="text" id="schedule-input" placeholder="Add new Activity">
                <button class="btn btn-success darker" /*id="add-schedule"*/ onclick="addSchedule()">Add</button>
            </div>
        </div>
    </div>
@endsection
@endsection
