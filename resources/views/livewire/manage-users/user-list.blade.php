<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
    <div class="button-group row">
        <div class="col-9"></div>
        <div class="col-3 d-flex justify-content-center">

            <button class="btn btn-success w-50" data-bs-target="#addUserModal" data-bs-toggle="modal">Add User</button>
        </div>
    </div>
    <x-dashboard.table class="tasks-table">
        <x-slot:tableHeaders>
            <th class="col-auto"></th>
            <th class="col">Name</th>
            <th class="col-auto"></th>
            <th class="col">Type</th>
            <th class="col-auto"></th>
            <th class="col">Email</th>
            <th class="col-auto"></th>
            <th class="col">Actions</th>
        </x-slot:tableHeaders>

        {{-- {{dd($users)}} --}}

        @foreach ($users as $user)
            <x-dashboard.table-content>
                <td class="col-auto"></td>
                <td class="col">{{ $user->name }}
                <td>
                <td class="col-auto"></td>
                <td class="col">{{ ucfirst($user->login->user_type) }}</td>
                <td class="col-auto"></td>
                <td class="col">{{ $user->email }}</td>
                <td class="col-auto"></td>
                <td class="col">
                    <button class="btn btn-warning" wire:click="loadUserData({{ $user->id }})"
                        data-bs-target="#addUserModal" data-bs-toggle="modal">Edit</button>
                    <button class="btn btn-danger" wire:click="confirmDelete({{ $user->id }})"
                        data-bs-target="#addUserModal" data-bs-toggle="modal">Delete</button>
                </td>
                <td></td>
            </x-dashboard.table-content>
        @endforeach

    </x-dashboard.table>
</div>
