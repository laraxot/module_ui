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

    <x-input {{ $input_attrs }} :options="$options" value="{{ old($name) }}" />
    @error($name)
        {{-- <x-std tpl="alert.danger">{{ $message }}</x-std> --}}
        <div class="alert alert-danger">{{ $message }}</div>
        {{-- <div 
        style="background-color:#F38541;border: 0px;
        text-transform: uppercase;
        font-family: 'Inter';border-radius: 100px;
        color: #fff;
        text-align: center;
        "
        >{{ $message }}</div> --}}

        {{-- ARANCIONE #F38541 --}}
    @enderror
</div>
