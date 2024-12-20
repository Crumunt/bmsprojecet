<div>
    {{-- Stop trying to control. --}}
    <div class="progress-box">
        <h3>Progress</h3>
        <x-circular-progress completionRate="{{$projects_report}}" totalCount="{{$total_projects}}" progressTitle="Projects" />
        <x-circular-progress completionRate="{{$plans_report}}" totalCount="{{$total_plans}}" progressTitle="Plans" />

    </div>
</div>
