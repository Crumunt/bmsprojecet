@props(['action' => '', 'formID' => ''])

<form action="{{$action}}" id="{{$formID}}">
    {{$slot}}
</form>
