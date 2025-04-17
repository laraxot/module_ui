@php
foreach ($field->fields as $k => $v) {
    //try{
    echo Theme::inputFreeze($v,$row);
    echo '  ';
    //}catch(\Exception $e){
    //	dddx($e);
    //}
}
@endphp
