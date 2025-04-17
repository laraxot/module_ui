@if (is_array($field->value))
    {{ $field->value['value'] }}
@else
    @php
        //dddx(get_defined_vars());
    @endphp
    {{ $row->route }}, {{ $row->street_number }}<br />
    {{ $row->locality }}, {{ $row->administrative_area_level_2 }}, {{ $row->country }}
@endif
