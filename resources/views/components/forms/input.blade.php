@props([
    'id' => '',
    'name' => '',
    'placeholder' => '',
    'type' => 'text',
    'label' => '',
    'state' => ''
])

<div {{$attributes->merge(['class' => 'mb-3 mt-3'])}}>
    <input type="{{$type}}" {{$attributes->merge(['class' => 'form-control'])}} id="{{$id}}" placeholder="{{$placeholder}}" name="{{$name}}" {{$state}}>
    <label for="{{$id}}">{{$label}}</label>
</div>
