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
    //dddx($this->form_data);
@endphp


<select wire:model="form_data.times" name="{{ $name }}" class="form-select" multiple>
    @foreach ($options as $k => $option)
        <option wire:key="option-{{ $option }}" value="{{ $option }}">{{ $option }}</option>
    @endforeach
</select>
