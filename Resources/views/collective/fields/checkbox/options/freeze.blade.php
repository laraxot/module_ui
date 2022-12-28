@php
$vals=$field->value;
if(!is_array($vals)){
    $vals=[];
}
@endphp
@foreach($vals as $val)
    <span class="badge badge-primary mr-1">{{$val}}</span>
@endforeach