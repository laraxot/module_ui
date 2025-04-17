@foreach ($field->fields as $k => $v)
    <div style="border-bottom:1px darkgray;">
        <b>{{ $v->label ?? $v->name }}</b> : {{ Theme::inputFreeze($v,$row) }}
    </div>
@endforeach
