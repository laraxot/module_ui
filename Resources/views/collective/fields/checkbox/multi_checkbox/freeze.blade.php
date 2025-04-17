@php
//dddx(get_defined_vars());
//print_r(get_defined_vars());
@endphp
{{-- $field->value --}}
{{-- campo n'0 ID
    campo n'1 titolo da mostrare --}}

@foreach ($rows as $k => $v)
    {{-- Panel::make()->get($v)->optionLabel($v) --}}
    <span class="badge badge-secondary">{{ $v->{$related_fields[1]->name} }}</span>
@endforeach
