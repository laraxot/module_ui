@foreach ($field->getFields() as $v)
    <b>{{ $v->getLabel() }}</b>: 
    <x-input.freeze :field="$v" :row="$row" />
    <br/>
@endforeach
