<div>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    <x-manage-projects.modal wire:ignore.self modalID="addUserModal" modalSize="lg" wireEvent="clearModal">
        {{-- {{ dd($modalStatus) }} --}}
        <x-slot:pageTitle>
            {{ $modalStatus == 'update' ? "Update User" : ($modalStatus == 'delete' ? "Delete User" : 'Add User') }}
        </x-slot:pageTitle>

        @if ($modalStatus == 'delete')
            <p class="h4">Are you sure you want to delete the user: <strong>{{ $username }}</strong> ?</p>
        @else
            <x-forms.form formID="addUserForm">
                @if ($modalStatus == 'update')
                    <x-forms.input wire:model="username" id="username" class="form-floating" label="Username" />
                    <x-forms.input wire:model="email" id="email" type="email" class="form-floating"
                        label="Email" />
                    <x-forms.select wire:model="user_type" id="user_type" class="form-floating" label="User Type">
                        <option value="" selected>N/A</option>
                        <option value="admin">Admin</option>
                        <option value="sub-admin">Sub-Admin</option>
                        {{-- <option value="contractor">Contractor</option> --}}
                    </x-forms.select>
                @else
                    <x-forms.input wire:model="username" id="username" class="form-floating" label="Username" />
                    <x-forms.input wire:model="email" id="email" type="email" class="form-floating"
                        label="Email" />
                    <x-forms.select wire:model="user_type" id="user_type" class="form-floating" label="User Type">
                        <option value="" selected>N/A</option>
                        <option value="admin">Admin</option>
                        <option value="sub-admin">Sub-Admin</option>
                        {{-- <option value="contractor">Contractor</option> --}}
                    </x-forms.select>
                    <x-forms.input wire:model="password" id="password" type="password" class="form-floating"
                        label="Password" />
                    <x-forms.input wire:model="confirm_password" id="confirm_password" type="password"
                        class="form-floating" label="Confirm Password" />
                @endif
            </x-forms.form>
        @endif

        <x-slot:modalControls>
            <div class="py-2">
                <button class="btn btn-success btn-lg"
                    wire:click={{ $modalStatus == 'update' ? "updateUser($user_id)" : ($modalStatus == 'delete' ? "confirmDeleteUser($user_id)" : 'addUser') }}
                    data-bs-dismiss="modal">{{ $modalStatus == 'update' ? 'Update User' : ($modalStatus == 'delete' ? 'Delete User' : 'Add User') }}</button>
            </div>
        </x-slot:modalControls>
    </x-manage-projects.modal>
</div>
