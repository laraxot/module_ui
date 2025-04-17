<div>
    <input type="hidden" name="{{ $name }}" value="{{ $value }}" />

    @foreach ($form_data as $k => $v)
        <input type="color" wire:model="form_data.{{ $k }}" wire:change="changeColor">
        <span class="btn btn-primary" wire:click="deleteColor({{ $k }})">-</span>
    @endforeach
    <span class="btn btn-primary" wire:click="addColor">+</span>
</div>
