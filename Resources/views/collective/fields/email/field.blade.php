@php
    $field = transFields(get_defined_vars());
    //dddx($field);
@endphp
@component($blade_component, get_defined_vars())
    @slot('label')
        {{ Form::label($name, $field->label, ['class' => 'control-label']) }}
    @endslot
    @slot('input')
        {{ Form::email($name, $value, $field->attributes) }}
    @endslot
@endcomponent
