@php
    $field = transFields(get_defined_vars());
    $field->attributes['step'] = '0.01';
@endphp
@component($blade_component, get_defined_vars())
    @slot('label')
        {{ Form::label($name, $field->label, ['class' => 'control-label form-label']) }}
    @endslot
    @slot('input')
        {{ Form::number($name, $value, $field->attributes) }}
    @endslot
@endcomponent
