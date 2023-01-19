@php
$field = transFields(get_defined_vars());
$val = Form::getValueAttribute($name);
$options=$field->options;
@endphp
<fieldset class="border p-2">
    <legend>{{ $field->label }}</legend>
    @foreach($field->options as $k=>$label)
        <div class="form-check">
            <input class="form-check-input" name="{{ $name }}[]" value="{{$k}}" type="checkbox" {{\in_array($k,$val)?'checked':''}}  >
            <label class="form-check-label">{{ $label }}</label>
        </div>
    @endforeach
</fieldset>

