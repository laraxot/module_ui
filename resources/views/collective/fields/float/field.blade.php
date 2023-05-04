@php
    $field = transFields(get_defined_vars());
<<<<<<< HEAD
    //dddx($blade_component);
    //dddx(get_defined_vars());
    $field->attributes['step'] = '0.01';
@endphp
@component($blade_component, get_defined_vars())
    @slot('label')
        {{ Form::label($name, $field->label, ['class' => 'control-label form-label']) }}
    @endslot
    @slot('input')
        {{ Form::number($name, $value, $field->attributes) }}
=======
    $field->attributes = array_merge($field->attributes, ['step' => '0.01']);
    
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
>>>>>>> eb9ac63612a2a9a65cf3585dad0a6f569a9685af
    @endslot
@endcomponent
