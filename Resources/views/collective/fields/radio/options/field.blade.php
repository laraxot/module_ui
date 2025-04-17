@props([
    'options' => [],
])
<ul class="list-group">
    @foreach ($options as $k => $v)
        @php
            $input_id = Str::slug($name . '-' . $k);
        @endphp
        <li class="list-group-item">
            <input class="form-check-input me-1" type="radio" name="{{ $name }}" value="{{ $k }}"
                id="{{ $input_id }}" wire:model="form_data.{{ $name }}">
            <label class="form-check-label" for="{{ $input_id }}">{{ $v }}</label>
        </li>
    @endforeach
</ul>
