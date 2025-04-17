@php
$node = class_basename($row) . '-' . $field->value;
//<a href="#{{ $node }}" id="{{ $node }}">{{ $field->value }}</a> perchè un link?
//non e' un link ma un ancora mi serve per dare il focus alla riga
@endphp
<a href="#{{ $node }}" id="{{ $node }}">{{ $field->value }}</a>
