@php
    // dddx(get_defined_vars());
    extract($attributes);
    $field = transFields(get_defined_vars());
    $field->attributes['class'] .= ' select2';
    if (isset($options['field'])) {
        $options = $options['field']->options;
    }
    // extract($attributes);
    // $field = transFields(get_defined_vars());
    // $field->attributes['class'] .= ' select2';
    // dddx($field->attributes);
    // dddx($field->col_size);
@endphp

@component($blade_component, get_defined_vars())
    @slot('label')
        {{ Form::label($name, $field->label, ['class' => 'control-label']) }}
    @endslot
    @slot('input')
        {{ Form::select($name, $options, $value, $field->attributes) }}
    @endslot
@endcomponent


@push('scripts')
    <script>
        $(".select2").select2({
            theme: "bootstrap"
        });
    </script>
@endpush
