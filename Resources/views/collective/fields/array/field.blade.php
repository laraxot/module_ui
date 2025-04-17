@php
    $field = transFields(get_defined_vars());
    
    $val = Form::getValueAttribute($name);
    if (!is_array($val)) {
        $val = [];
    }
@endphp
{{-- dddx($field->options) --}}
@component($blade_component, get_defined_vars())
    @slot('label')
        {{ Form::label($name, $field->label, ['class' => 'control-label form-label']) }}
    @endslot
    @slot('input')
        <livewire:input.arr.assoc :name="$name" :value="$val"></livewire:input.arr.assoc>
    @endslot
@endcomponent
