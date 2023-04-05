@props(['contentPadding' => true, 'onSubmit' => null])
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content shadow-3">
    <div class="modal-header"> 
        @if ($title ?? false)
            <h5 class="modal-title">{{ $title }}</h5>
        @endif
        <div class="text-xs ms-auto">
            <button type="button" class="btn-close" wire:click="$emit('modal.close')" aria-label="Close"></button>
        </div>
    </div>
    <form wire:submit.prevent="{{ $onSubmit }}">
    <div @class(['modal-body', 'px-0 py-0' => !$contentPadding]) style="margin:5px;">
        {{ $slot }}
    </div>
    @if ($buttons ?? false)
        <div class="modal-footer">
            {{ $buttons }}
        </div>
    @endif
    </form>
    </div>
    </div>


