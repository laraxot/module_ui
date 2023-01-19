@php
    $field = transFields(get_defined_vars());
    
    $val = Form::getValueAttribute($name);
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> c65baac (.)
    if(!is_array($val)){
        $val=[];
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
=======
    
@endphp
{{-- dddx($field->options) --}}
<<<<<<< HEAD
<livewire:input.arr.assoc :name="$name" :value="$val"></livewire:input.arr.assoc>
>>>>>>> f532fb8 (up)
=======
@component($blade_component, get_defined_vars())
    @slot('label')
        {{ Form::label($name, $field->label, ['class' => 'control-label form-label']) }}
    @endslot
    @slot('input')
        <livewire:input.arr.assoc :name="$name" :value="$val"></livewire:input.arr.assoc>
    @endslot
@endcomponent
>>>>>>> 992e8c4 (up)
