@php
    $val1 = Form::getValueAttribute($name);
    //dddx($val1);
@endphp
<div class="form-group col-sm-12">
    <livewire:input.arr wire:class="col-md-12" type="elastic.filter_slim" :name="$name" :value="[$name => $val1]"
        label="" />
</div>
