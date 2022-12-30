@php
    extract($attributes);
    $field = transFields(get_defined_vars());
    if (isset($options['field'])) {
        $options = $options['field']->options;
    }
    // extract($attributes);
    // $field = transFields(get_defined_vars());
    $val = Form::getValueAttribute($field->name);
    if(is_object($val)){
        //dddx([$field->name,$val,]);
        $val=$val->getKey();
    }
@endphp

@component($blade_component, get_defined_vars())
    @slot('label')
        {{ Form::label($name, $field->label, ['class' => 'control-label']) }}
    @endslot
    @slot('input')
        {{--
        {{ Form::select($name, $options, $value, $field->attributes) }}
        --}}
        {{ Form::select($name, $options, $val, $field->attributes) }}
    @endslot
@endcomponent
