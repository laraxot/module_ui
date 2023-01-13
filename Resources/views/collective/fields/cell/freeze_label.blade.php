@foreach ($field->fields as $k => $v)
    <div style="border-bottom:1px darkgray;">
        {{ $v->label ?? $v->name }} : {{ Theme::inputFreeze($v,$row) }}
    </div>
@endforeach
