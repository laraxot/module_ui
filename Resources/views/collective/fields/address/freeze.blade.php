@php
    $data=new \stdClass;
    if(isJson($field->value)){
        $data=json_decode($field->value);
    }
@endphp
{{ $data->value ?? ' ' }}
