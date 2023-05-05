@php
    $field = transFields(get_defined_vars());
<<<<<<< HEAD
    //dddx($blade_component);
    //dddx(get_defined_vars());
=======
>>>>>>> 4a8c17c748c115a1ed0de97c2fc7506d68e4b299
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
