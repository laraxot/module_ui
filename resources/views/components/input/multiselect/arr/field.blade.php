@props([
    'options' => [],
    'arr' => [],
    'value' => null,
])
@php
    
    if (!Arr::isAssoc($options)) {
        $options = array_combine($options, $options);
    }
    if (is_string($value)) {
        $value = str_replace('&quot;', '"', $value);
    }
    if (isJson($value)) {
        $value = json_decode($value);
    }
@endphp


<select class="form-select" name="{{ $name }}" {{ $attributes->merge($attrs) }} multiple>
    @foreach ($options as $key => $option)
        <option value="{{ $key }}">
            {{ $option }}
        </option>
    @endforeach
</select>

{{-- implode('-', $this->form_data['times']) --}}
