@props([
    'pageTitle' => '',
    'modalControls' => '',
    'modalID' => '',
    'modalSize' => 'xl',
    'modalAddon' => '',
    'modalHeader' => '',
    'headerAddon' => '',
    'wireEvent' => '',
])

<div class="modal fade" id="{{ $modalID }}" aria-hidden="true" aria-labelledby="{{ $modalID }}" tabindex="-1">
    <div class="modal-dialog {{ 'modal-' . $modalSize }} modal-dialog-centered {{ $modalAddon }}">
        <div class="modal-content">
            <div class="modal-header {{ $headerAddon }}">
                <h1 class="modal-title fs-5" id="{{ $modalHeader }}">{{ $pageTitle }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    wire:click.prevent="{{ $wireEvent }}"></button>
            </div>
            <div class="modal-body">
                {{ $slot }}
            </div>
            <div class="modal-footer">
                {{ $modalControls }}
            </div>
        </div>
    </div>
</div>
