<div class="form-check" wire:ignore>
    @foreach (collect($options)->unique() as $key => $option)
        <input type="checkbox" name="{{ $name }}[]" value="{{ $option['id'] }}"
            wire:model="form_data.{{ $name }}.{{ $option['id'] }}">
        <label class="form-check-label"><a href="#"
                onclick="Livewire.emit('modal.open','modal.consent.description',{'id':'{{ $option['id'] }}'})">{{ $option['name'] }}
            </a></label>
        <a href="#" onclick="Livewire.emit('modal.open','modal.consent.description',{'id':'{{ $option['id'] }}'})">
            <p>{{ substr($option['txt'], 0, 100) }}...</p>
        </a>
        <br>
    @endforeach
</div>
