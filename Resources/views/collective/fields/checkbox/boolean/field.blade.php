@php
    $field = transFields(get_defined_vars());
    
    $field->attributes['class'] = 'input-checkbox';
    
@endphp
@component($blade_component, get_defined_vars())
    @slot('label')
        {{ Form::label($name, $field->label, ['class' => 'control-label form-label']) }}
    @endslot
    @slot('input')
        {{-- Form::bsHidden($name,0) --}} {{-- se non selezionato restituisce 0 al posto di null --}}
        <input type="hidden" name="{{ $name }}" value="0">
        {{ Form::checkbox($name, 1, $value, $field->attributes) }}
    @endslot
@endcomponent
