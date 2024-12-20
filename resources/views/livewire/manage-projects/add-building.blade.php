<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    {{-- <x-forms.form wire:submit.prevent="addProject" formID="buildingForm" data-multi-step> --}}
    <x-manage-projects.modal wire:ignore.self modalID="modalToggle" modalAddon="modal-dialog-scrollable">
        <x-slot:pageTitle>Add Building</x-slot:pageTitle>

        <div class="common_info" data-step>
            <x-forms.input wire:model="building_name" class="form-floating" id="building_name" name="building_name"
                label="Building Name" />

            {{-- <x-forms.select wire:model="contractor_id" name="contractor" id="contractor" class="form-floating"
                    label='Contractor'>
                    <x-forms.option selected>Select...</x-forms.option>
                    @foreach ($contractors as $contractor)
                        <x-forms.option value="{{ $contractor->id }}">{{ $contractor->name }}</x-forms.option>
                    @endforeach
                </x-forms.select> --}}

            <x-forms.input wire:model="contractor_name" class="form-floating" id="contractor_name" name="contractor_name"
                label="Contractor Name" />

            <div class="location-group">
                <x-forms.input wire:model="building_location" type="text" class="form-floating "
                    id="building_location" label="Building Location" />

                <div id="map" class=""></div>
            </div>

            <x-forms.input wire:model="budget" class="form-floating" name="allocated_budget" label="Budget" />

            <x-forms.input wire:model="starting_date" class="form-floating" name="start_date" type="date"
                label="Staring Date" />

            <x-forms.input wire:model="end_date" class="form-floating" name="end_date" type="date"
                label="Expected End Date" />

        </div>
        <div class="building_tasks d-none" data-step>
            <livewire:manage-projects.add-task>
        </div>
        <x-slot:modalControls>
            <button class="btn btn-warning d-none formControlButton" data-previous type="button">Previous</button>
            <button class="btn btn-primary formControlButton" type="button" data-next>Next</button>
            <button class="btn btn-success d-none" id="addBuilding" type="submit" data-bs-dismiss="modal"
                aria-label="Close" wire:click.prevent="addProject">Submit</button>
        </x-slot:modalControls>

    </x-manage-projects.modal>
    {{-- </x-forms.form> --}}
</div>
