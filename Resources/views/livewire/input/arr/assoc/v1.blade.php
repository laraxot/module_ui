<div>
    <button type="button" class="btn btn-primary" wire:click="addArr">+</button>
    @foreach ($form_data[$name] as $key => $val)
        {{-- {{ dddx([$key, $val]) }} 
        <input type="text" name="{{ $name }}[]" wire:model="form_data.{{ $name }}.{{$loop->index}}.{{ $key }}">
        --}}

        <div class="input-group mb-3">
            <input type="text" class="form-control" wire:model="form_data.{{ $name }}.{{ $key }}.k" />
            <input type="text" class="form-control" wire:model="form_data.{{ $name }}.{{ $key }}.v" />
            <div class="input-group-append">
                <button class="btn btn-danger btn-outline-secondary" type="button"
                    wire:click="subArr('{{ $key }}')">-</button>
            </div>
        </div>
        <div style="display:none">
            {{ $form_data[$name][$key]['k'] }} : {{ $form_data[$name][$key]['v'] }} <br />
            <input type="text" name="{{ $name }}[{{ $form_data[$name][$key]['k'] }}]"
                value="{{ $form_data[$name][$key]['v'] }}" />
        </div>
    @endforeach

</div>
