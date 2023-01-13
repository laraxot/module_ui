@php
    $values=$field->value ?? [];
@endphp
@foreach($values as $value)
    <span class="badge badge-xs">{{$value}}</span>
@endforeach