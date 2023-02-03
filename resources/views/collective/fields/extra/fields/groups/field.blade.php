@php
    $val = Form::getValueAttribute($name);
    $model = Form::getModel();
@endphp

<livewire:input.extra-fields.groups :name="$name" :model="$model" :value="$val" />
