@php
    //$val=null;
    $val = Form::getValueAttribute($name);
    $model=Form::getModel();

@endphp


<livewire:input.extra-fields :name="$name" :model="$model" :value="$val" />

<pre> {{ print_r($val,true) }} </pre>
