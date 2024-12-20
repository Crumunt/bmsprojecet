<div>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
    <x-manage-projects.modal modalID="confirmDeleteModal">
        <x-slot:pageTitle>Delete Project</x-slot:pageTitle>

        <p class='h4'>Are you sure you want to delete: <span>{{ $building_name }}</span>?</p>

        <x-slot:modalControls>
            <button class="btn btn-warning" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
            <button class="btn btn-success" wire:click.prevent="destroyProject({{ $building_id }})"
                data-bs-dismiss="modal" aria-label="Close">Confirm</button>
        </x-slot:modalControls>
    </x-manage-projects.modal>
</div>
