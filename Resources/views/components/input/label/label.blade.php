@props([
    'label' => null,
    'name' => 'no-name',
    'id' => null,
])
<label {{ $attributes->merge(['for'=>$id]) }} >{{ $label ?? trans($tradKey . '.' . $name . '.label') }}</label>
