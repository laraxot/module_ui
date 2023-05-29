@php
    $val = Form::getValueAttribute($name);
    
@endphp
<div class="form-group col-sm-12">
    {{ var_export($val, true) }}
</div>
