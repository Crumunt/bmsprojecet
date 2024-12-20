@props(['name' => '', 'id' => '', 'label' => 'Select Header'])




<div {{ $attributes->merge(['class' => 'mb-3 mt-3']) }}>
    <select name="{{ $name }}" id="{{ $id }}" {{ $attributes->merge(['class' => 'form-control']) }}>
        {{ $slot }}
    </select>
    <label for="{{ $id }}">{{ $label }}</label>
</div>
