@php
//funzionante, da mettere in documentazione!!!

//ps: però come si installa???

Theme::add('theme::dist/js/app.js');
Theme::add('theme::dist/css/app.css');
$field = transFields(get_defined_vars());
$field->attributes['class'] = 'form-control tinymce';
@endphp
@component($blade_component, get_defined_vars())
    @slot('label')
        {{ Form::label($name, $field->label, ['class' => 'control-label']) }}
    @endslot
    @slot('input')
        <br /><br />
        {{ Form::textarea($name, $value, $field->attributes) }}
    @endslot
@endcomponent
