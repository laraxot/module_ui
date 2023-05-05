@php
    $field = transFields(get_defined_vars());
<<<<<<< HEAD
    $field->attributes = array_merge($field->attributes, ['step' => '0.01']);
    
=======
    $field->attributes['step'] = '0.01';
>>>>>>> e723df785962a32cfea807fe3cfe8354a0d087ca
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
