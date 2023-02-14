@php
    $val = Form::getValueAttribute($name);
    $model = Form::getModel();
@endphp

<livewire:input.email.verified tpl="v1" :attrs="$attributes->merge($attrs)" :value="$val" />
