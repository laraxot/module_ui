<div>
    <h3>{{ $name }}
        <button type="button" class="btn btn-primary" wire:click="addArr()"> + </button>
    </h3>
    @foreach ($form_data[$name] ?? [] as $k => $v)
        <div>
            <input type="text" name="{{ $name }}[{{ $k }}]" value="{{ $v }}"
                wire:model="form_data.{{ $name }}.{{ $k }}">
            <button type="button" class="btn btn-danger" wire:click="subArr({{ $k }})"> - </button>
        </div>
    @endforeach
</div>
