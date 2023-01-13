<div>
    <div class="w-100 mb-3">
        <h3 class="float-left">{{ $label ?? $name }}</h3>
    </div>
    @foreach ($form_data[$name] ?? [] as $k => $v)
        <div class="input-group" :wire:key="'group-'.$model_id">
            <input type="text" wire:model.lazy="form_data.{{ $name }}.{{ $k }}"
                value="{{ $v }}" name="{{ $name }}[]" class="form-control" />
        </div>
    @endforeach
</div>
