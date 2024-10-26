@props(['tableID' => ''])

<table {{$attributes->merge(['class'=>''])}} id="{{$tableID}}">
    <thead>
        <tr>
            {{-- <th>Due Date</th>
            <th>Title</th>
            <th>Status</th>
            <th>Assignee</th>
            <th>Actions</th> --}}
            {{ $tableHeaders }}
        </tr>
    </thead>
    <tbody id="{{$tableID}}">
        {{ $slot }}
    </tbody>
</table>
