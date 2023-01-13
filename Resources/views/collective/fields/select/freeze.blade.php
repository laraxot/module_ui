@php
//dddx(debug_backtrace());
$val='--';
$coll=collect($field->options);
if(isset($field->value) && $field->value!="" && !is_object($field->value)){
    $val=$coll->get($field->value);
}elseif(is_object($field->value) && is_object($field->value->row) ){
    $val=Panel::make()->get($field->value)->optionLabel($field->value->row);
}
@endphp
{{ $val }} 

