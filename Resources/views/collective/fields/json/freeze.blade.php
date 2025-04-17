@if(is_array($field->value))
<pre>{{ print_r($field->value,true) }}</pre>
@else
{{ $field->value }}
@endif
