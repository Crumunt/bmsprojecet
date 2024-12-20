<div>
    {{-- In work, do what you enjoy. --}}
    <x-manage-projects.modal wire:ignore.self modalID="updateModal" modalAddon="modal-dialog-scrollable" wireEvent="closeModal">
        <x-slot:pageTitle>Update Project</x-slot:pageTitle>

        <div class="update_common_info" data-step>
            <x-forms.input wire:model="update_building_name" class="form-floating" id="building_name" name="building_name"
                label="Building Name" />

            <x-forms.input wire:model="update_contractor_name" class="form-floating" id="update_contractor_name"
                name="update_contractor_name" label="Contractor Name" />

            <div class="location-group">
                <x-forms.input wire:model="update_building_location" type="text" class="form-floating "
                    id="update_building_location" label="Building Location" />

                <div id="updateMap" class=""></div>
            </div>

            <x-forms.input wire:model="update_budget" class="form-floating" name="allocated_budget" label="Budget" />

            <x-forms.input wire:model="update_starting_date" class="form-floating" name="start_date" type="date"
                label="Staring Date" />

            <x-forms.input wire:model="update_end_date" class="form-floating" name="end_date" type="date"
                label="Expected End Date" />

        </div>
        <div class="update_building_tasks d-none" data-step>
            <livewire:manage-projects.add-task>
        </div>
        <x-slot:modalControls>
            <button id="prevPageButton" class="btn btn-warning d-none updateControlButton" data-previous
                type="button">Previous</button>
            <button id="nextPageButton" class="btn btn-primary updateControlButton" type="button"
                data-next>Next</button>
            <button class="btn btn-success d-none" id="updateBuilding" type="submit" data-bs-dismiss="modal"
                aria-label="Close" wire:click.prevent="updateProject({{ $update_building_id }})">Update</button>
        </x-slot:modalControls>

    </x-manage-projects.modal>

</div>
