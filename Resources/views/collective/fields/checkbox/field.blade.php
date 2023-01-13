@php
$field = transFields(get_defined_vars());
//dddx(get_defined_vars());
@endphp
@component($blade_component, get_defined_vars())
    @slot('label')
        {{ Form::label($name, $field->label, ['class' => 'control-label']) }}
    @endslot
    @slot('input')
        {{ Form::bsHidden($name, 0) }} {{-- se non selezionato restituisce 0 al posto di null --}}
        {{ Form::checkbox($name, 1, $value, $field->attributes) }}
    @endslot
@endcomponent