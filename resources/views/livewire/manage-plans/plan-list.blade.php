<div>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
    <x-dashboard.table class="tasks-table">
        <x-slot:tableHeaders>
            <th>Due Date</th>
            <th>Title</th>
            <th>Status</th>
        </x-slot:tableHeaders>

        @php
            $header_arr = [
                'todo' => 'To Do',
                'inprogress' => 'In Progress',
                'done' => 'Done',
            ];
            $style_arr = [
                'todo' => 'text-primary',
                'inprogress' => 'text-warning',
                'done' => 'text-success',
            ];
        @endphp

        @foreach ($plans as $plan_item)
            <x-dashboard.table-content>
                <td>{{ $plan_item->end_date }}</td>
                <td>{{ $plan_item->task_name }}</td>
                <td class="{{ $style_arr[$plan_item->task_header] }}">{{ $header_arr[$plan_item->task_header] }}</td>
            </x-dashboard.table-content>
        @endforeach

        {{-- @for ($i = 0; $i < 5; $i++)
            <x-dashboard.table-content>
                <td>{{ rand(1, 31) }} Dec 2020</td>
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
        @endfor --}}
    </x-dashboard.table>
</div>
