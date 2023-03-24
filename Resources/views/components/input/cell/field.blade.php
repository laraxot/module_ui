@foreach ($field->fields as $v)
    <label><strong>{{ $v->getLabel() }}</strong>: </label>
    <x-input.freeze :field="$v" :row="$row" /><br><br>
@endforeach
