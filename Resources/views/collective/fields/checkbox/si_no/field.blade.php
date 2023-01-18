@php
$field = transFields(get_defined_vars());
//$field->attributes['class'].=' custom-control-input';
//dddx($blade_component);
@endphp
@component($blade_component, get_defined_vars())
    @slot('label')
        {{ Form::label($name, $field->label, ['class' => 'control-label']) }}
    @endslot
    @slot('input')
        {{ Form::select($name, ['0' => 'No', '1' => 'Si'], $value, $field->attributes) }}
    @endslot
@endcomponent
