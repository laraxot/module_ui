@php

$field = transFields(get_defined_vars());
//dddx($field);

@endphp
@component($blade_component, get_defined_vars())

    @slot('label')
        @php
        //dddx([$field->attributes, $field->attributes['style'], !empty($field->attributes['style']) && strpos($field->attributes['style'], 'display:none') !== false]);
        @endphp

        @if (!empty($field->attributes['style']) && strpos($field->attributes['style'], 'display:none') !== false)
        @else
            {{ Form::label($name, $field->label, ['class' => 'control-label']) }}
        @endif
    @endslot
    @slot('input')
        @php

        try {
            echo Form::text($name, $value, $field->attributes);
        } catch (\Exception $e) {
            /*
                                                                                                                                                                                                                                                                        dddx(['field_name'=>$name,
                                                                                                                                                                                                                                                                        'value'=>$value,
                                                                                                                                                                                                                                                                        'err'=>$e->getMessage()
                                                                                                                                                                                                                                                                        ]);
                                                                                                                                                                                                                                                                        */
            echo $e->getMessage();
        }
        @endphp
    @endslot

@endcomponent
