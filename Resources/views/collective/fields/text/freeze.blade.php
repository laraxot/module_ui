@php
    $out=$field->value;

    if(is_array($field->value)){
        $out='<pre>'.print_r($field->value,true).'</pre>';
    }else{

    }
@endphp
{!! $out !!}
