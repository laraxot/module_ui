@php
//dddx(debug_backtrace());
@endphp
{{ collect($field->options)->get($field->value) }}
