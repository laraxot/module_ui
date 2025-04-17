<div>
    <h4>{{ $label }}</h4>
    @foreach($rows as $k=>$row)
        @php
            $checked=$value->search($row)!==false;
        @endphp
        <div class="form-check">
            <input wire:model.lazy="form_data.{{ $name }}.{{ $k }}" class="form-check-input" type="checkbox"
                value="{{ $row }}" id="check_{{ $row }}" {{ $checked?'checked':'' }}/>
            <label class="form-check-label" for="check_{{ $row }}">
                {{ $row }}
            </label>
        </div>
    @endforeach
</div>