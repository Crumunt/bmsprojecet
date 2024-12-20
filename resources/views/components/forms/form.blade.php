@props(['action' => '', 'formID' => ''])

<form action="{{$action}}" id="{{$formID}}">
    @csrf
    {{$slot}}
</form>
