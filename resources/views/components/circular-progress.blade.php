@props([
    'completionRate' => '',
    'progressTitle' => 'circular_title'
    ])

<div {{$attributes->merge(['class' => 'circular-progress'])}}>
    <div class="circle" data-percent="{{$completionRate}}">
        <div class="inner-circle">{{$completionRate}}%</div>
    </div>
    <p>{{$progressTitle}}</p>
</div>
