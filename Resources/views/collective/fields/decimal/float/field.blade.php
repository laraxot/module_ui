@php
$field = transFields(get_defined_vars());
$field->attributes = array_merge($field->attributes, ['step' => '0.001']);

@endphp
@component($blade_component, get_defined_vars())
    @slot('label')
        {{ Form::label($name, $field->label, ['class' => 'control-label']) }}
    @endslot
    @slot('input')
        <div class="input-group">
            {{ Form::number($name, $value, $field->attributes) }}
            <span class="input-group-addon">
                <span {{-- class="glyphicon glyphicon-calendar" --}}>.xx</span>
            </span>
        </div>
    @endslot
@endcomponent
