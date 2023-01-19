@props([
    //'label' => 'label',
    //'for' => false,
    //'noShadow' => false,
    //'isRequired' => false,
    //'error' => false,
    //'helpText' => false,
    //'optional' => false,
    //'name' => null,
    //'label' => null,
])

{{-- <br />[attributes]: {{ $attributes }} ]
<br />[div]: {{ $div_attrs }}]
<br />[label]: {{ $label_attrs }} ]
<br />[input]: {{ $input_attrs }} ] --}}

<div {{ $div_attrs }}>
    <x-input.label :name="$field->name" :id="$field->name"   />
    <x-input :name="$field->name" :type="$field->type" :class="$field->getInputClass()" wire:model="form_data.{{ $field->getNameDot() }}" :options="$field->options"/>
    @error($field->name)
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    
</div>
