<div>
    <input class="form-control" type="text" wire:model="new_key" />
    <input class="form-control" type="text" wire:model="value" />
    <button class="btn btn-primary" wire:click="addArr">+</button>
    @foreach ($value as $key => $val)
        {{-- {{ dddx([$key, $val]) }} --}}
        <input type="text" name="{{ $name }}[]" wire:model="form_data.{{ $name }}.{{ $key }}">
    @endforeach
</div>
