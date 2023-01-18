@php
    $out=$field->value;

    if(is_array($field->value)){
        $out='Array ??';
    }else{

    }
@endphp
{{ $out }}
