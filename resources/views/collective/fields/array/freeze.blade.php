@php
    $values=$field->value ?? [];
@endphp
@foreach($values as $key => $value)
    {{--
    <span class="badge badge-xs">{{$value}}</span>
    --}}
    <span class="badge bg-soft-primary text-primary rounded-pill">{{ $key }}: {{ $value }}</span>
@endforeach
