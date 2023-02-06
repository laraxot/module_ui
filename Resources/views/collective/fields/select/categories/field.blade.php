@php
    $val = Form::getValueAttribute($name);
    $model = Form::getModel();
@endphp

<livewire:input.categories :name="$name" :model="$model" :value="$val" />
