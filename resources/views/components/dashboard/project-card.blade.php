@props(['title' => 'Project Title', 'tasks' => '2', 'dropdownID' => 'sample', 'completionRate' => '10'])

<div {{$attributes->merge(['class' => 'project-card'])}}">
    <div class="project-header">
        <span class="icon pink-icon"><i class="uil uil-constructor"></i></span>
        <div class="avatars">
            <img src="{{asset('assets/images/avatar1.jpg')}}" alt="User 1">
            <img src="{{asset('assets/images/avatar1.jpg')}}" alt="User 2">
            <img src="{{asset('assets/images/avatar1.jpg')}}" alt="User 3">
        </div>
        <div class="dropdown">
            <span class="three-dots" onclick="toggleDropdown('dropdown-{{$dropdownID}}')">&#8942;</span>
            <div class="dropdown-content" id="dropdown-{{$dropdownID}}">
                <a href="#">View More</a>
                <a href="#">Update</a>
                <a href="#">Delete</a>
            </div>
        </div>
    </div>
    <h2>{{$title}}</h2>
    <p>{{$tasks}} Tasks</p>
    <p class="progress-text">{{$completionRate}}% Completed</p>

    <div class="progress-container">
        <div class="progress-bar" style="width: {{$completionRate}}%;"></div>
    </div>
</div>
