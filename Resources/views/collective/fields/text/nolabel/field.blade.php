@php

$field = transFields(get_defined_vars());
//dddx($field);
@endphp
@component($blade_component, get_defined_vars())

    @slot('label')
        {{-- Form::label($name,$field->label,['class'=>'control-label']) --}}
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
