{{ print_r($value,true) }}
@if(is_iterable($field->fields))
    @foreach ($field->fields as $v)
        <b>{{ $v->name }}</b>: <x-input.freeze :field="$v" :row="$row" /><br/>
    @endforeach
@else
    {{-- dddx(['value'=>$value,'field'=>$field,'row'=>$row]) --}}
@endif