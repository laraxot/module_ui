@php
    extract($attributes);
    $field = transFields(get_defined_vars());
    if (isset($options['field'])) {
        $options = $options['field']->options;
    }
    // extract($attributes);
    // $field = transFields(get_defined_vars());
    $val = Form::getValueAttribute($field->name);
    if (is_object($val)) {
        //dddx([$field->name,$val,]);
<<<<<<< HEAD
    
        if (method_exists($val, 'getKey')) {
            $val = $val->getKey();
        }
=======
        if(method_exists($val,'getKey')){
            $val = $val->getKey();
        }
        
>>>>>>> 3651566 (.)
    }
@endphp

@component($blade_component, get_defined_vars())
    @slot('label')
        {{ Form::label($name, $field->label, ['class' => 'control-label form-label']) }}
    @endslot
    @slot('input')
        {{--
        {{ Form::select($name, $options, $value, $field->attributes) }}
        --}}
        {{ Form::select($name, $options, $val, $field->attributes) }}
    @endslot
@endcomponent