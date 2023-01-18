@php
    //dddx(get_defined_vars());
@endphp
@foreach($row->{$field->name} as $v)
    {{ $v->label }} : {{ $row->{$v->nome} }}<br/>
@endforeach