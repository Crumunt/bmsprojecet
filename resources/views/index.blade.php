@extends('layouts.app-layout')

@section('page_header')
    <h1>Projects Dashboard</h1>
@endsection

@section('main-content')
    <div class="projects-section">
        <x-dashboard.project-card class="ios-project" completionRate="70" tasks="32" title="IOS Projects" dropdownID="ios" />

        <x-dashboard.project-card class="web-project" completionRate="50" tasks="124" title="Web Application"
            dropdownID="web1" />

        <x-dashboard.project-card class="web-project" completionRate="80" tasks="69" title="Web Application"
            dropdownID="web2" />
    </div>

    <div class="tasks-section">
        <div class="view-all-projects">
            <a href="#" class="view-all-link">View All Projects</a>
        </div>

        <x-dashboard.table class="tasks-table">
            <x-slot:tableHeaders>
                <th>Due Date</th>
                <th>Title</th>
                <th>Status</th>
                <th>Assignee</th>
                <th>Actions</th>
            </x-slot:tableHeaders>

            @php
                $dates = [14, 15, 16,17];
            @endphp

            @foreach ($dates as $date)
                <x-dashboard.table-content>
                    <td>{{$date}} Dec 2020</td>
                    <td>Implement new UX</td>
                    <td class="done">DONE</td>
                    <td>
                        <img src="{{ asset('assets/images/avatar1.jpg') }}" alt="Alejandro Wells">
                        Alejandro Wells
                    </td>
                    <td>
                        <x-dropdown :dropdownMenu="['View', 'Edit', 'Delete']" />
                    </td>
                </x-dashboard.table-content>
            @endforeach
        </x-dashboard.table>

    </div>
@section('sub-content')
    <div class="right-section">
        <div class="progress-box">
            <h3>Progress</h3>
            <x-circular-progress completionRate="37" progressTitle="Reports" />
            <x-circular-progress completionRate="83" progressTitle="Done" />
            <x-circular-progress completionRate="51" progressTitle="On-going" />
        </div>

        <div class="schedule-box">
            <h3>Reminders</h3>
            <ul id="schedule-list"></ul> <!-- Schedule items are displayed here -->
            <div class="input-container">
                <input type="text" id="schedule-input" placeholder="Add new Activity">
                <button id="add-schedule" onclick="addSchedule()">+ Add</button>
            </div>
        </div>
    </div>
@endsection
@endsection
