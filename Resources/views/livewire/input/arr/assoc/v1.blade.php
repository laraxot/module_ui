<div>
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> c65baac (.)
    <button type="button" class="btn btn-primary" wire:click="addArr">+</button>
    @foreach ($form_data[$name] as $key => $val)
        {{-- {{ dddx([$key, $val]) }} 
        <input type="text" name="{{ $name }}[]" wire:model="form_data.{{ $name }}.{{$loop->index}}.{{ $key }}">
        --}}
        
        <div class="input-group mb-3">
            <input type="text" class="form-control" wire:model="form_data.{{ $name }}.{{$key}}.k" />
            <input type="text" class="form-control" wire:model="form_data.{{ $name }}.{{$key}}.v" />
            <div class="input-group-append">
                <button class="btn btn-danger btn-outline-secondary" type="button" wire:click="subArr('{{ $key }}')">-</button>
            </div>
        </div>
        <div style="display:none">
            {{ $form_data[$name][$key]['k'] }} : {{ $form_data[$name][$key]['v'] }} <br/>
            <input type="text" name="{{ $name }}[{{ $form_data[$name][$key]['k'] }}]" value="{{ $form_data[$name][$key]['v'] }}" />
        </div>
<<<<<<< HEAD
    @endforeach
    
=======
    <input type="text" wire:model="new_key" />
    <input type="text" wire:model="value" />
    <button class="btn btn-primary" wire:click="addArr()">+</button>
=======
    <input class="form-control" type="text" wire:model="new_key" />
    <input class="form-control" type="text" wire:model="value" />
    <button class="btn btn-primary" wire:click="addArr">+</button>
>>>>>>> 992e8c4 (up)
    @foreach ($value as $key => $val)
        {{-- {{ dddx([$key, $val]) }} --}}
        <input type="text" name="{{ $name }}[]" wire:model="form_data.{{ $name }}.{{ $key }}">
    @endforeach
>>>>>>> f532fb8 (up)
=======
    @endforeach
    
>>>>>>> c65baac (.)
</div>
