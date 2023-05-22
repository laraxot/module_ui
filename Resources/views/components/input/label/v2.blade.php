@props([
    'label' => null,
    'name' => 'no-name',
    'id' => null,
])
<label {{ $attributes->merge($attrs) }} >{{ $label }}</label>
