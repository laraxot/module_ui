@props([
    //'label' => 'label',
    //'for' => false,
    //'noShadow' => false,
    //'isRequired' => false,
    //'error' => false,
    //'helpText' => false,
    //'optional' => false,
    'name' => null,
    'label' => null,
])

{{-- <br />[attributes]: {{ $attributes }} ]
<br />[div]: {{ $div_attrs }}]
<br />[label]: {{ $label_attrs }} ]
<br />[input]: {{ $input_attrs }} ] --}}

<div {{ $div_attrs }}>
    <x-input.label {{ $label_attrs }} />
    {{-- dddx($input_attrs) --}}
    <x-input {{ $input_attrs }} :options="$options" />
    @error($name)
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>
