@php
    $field = transFields(get_defined_vars());
    
    $val = Form::getValueAttribute($name);
    
@endphp
{{-- dddx($field->options) --}}
<livewire:input.arr.assoc :name="$name" :value="$val"></livewire:input.arr.assoc>
