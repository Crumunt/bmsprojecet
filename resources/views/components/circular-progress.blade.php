@props([
    'completionRate' => '',
    'progressTitle' => 'circular_title',
    'totalCount' => '1',
])

<div {{ $attributes->merge(['class' => 'circular-progress']) }}>
    <div class="circle" data-percent="{{ $completionRate == 0 ? 0 : ($completionRate / $totalCount) * 100 }}">
        <div class="inner-circle">{{ $completionRate == 0 ? 0 : ($completionRate / $totalCount) * 100 }}%</div>
    </div>
    <p>{{ $progressTitle }}</p>
</div>
