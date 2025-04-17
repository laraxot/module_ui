@php
//dddx(debug_backtrace());
$val='--';
$coll=collect($field->options);
if(isset($field->value) && $field->value!="" && !is_object($field->value)){
    $val=$coll->get($field->value);
}elseif(is_object($field->value) && isset($field->value->row) &&  is_object($field->value->row) ){
    $val=Panel::make()->get($field->value)->optionLabel($field->value->row);
}elseif($field->value instanceof \Illuminate\Database\Eloquent\Model){
    $val=Panel::make()->get($field->value)->optionLabel($field->value);
}elseif($field->value instanceof \Illuminate\Support\Collection){
    //dddx('collection');
    $val='';
    foreach($field->value as $v){
        if($v instanceof \Illuminate\Database\Eloquent\Model){
            $val.='['.Panel::make()->get($v)->optionLabel($v).']';
        }else{
            $val.='--';
        }
    }
}else{
    //dddx($field->value);
}
@endphp
{{ $val }} 

