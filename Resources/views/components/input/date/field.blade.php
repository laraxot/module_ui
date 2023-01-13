{{-- <input type="date" {{ $attributes->merge($attrs) }} /> --}}
<div class="date_flatpickr input-group mb-3" wire:ignore>
    <input type="date" {{ $attributes->merge($attrs)->merge(['data-input' => '']) }} />
    <div class="input-group-append">
        <a class="btn btn-outline-secondary" title="toggle" data-toggle>
            <i class="far fa-calendar-alt"></i>
        </a>
    </div>
    <div class="input-group-append">
        <a class="btn btn-outline-secondary" title="clear" data-clear>
            <i class="fas fa-times"></i>
        </a>
    </div>
</div>
