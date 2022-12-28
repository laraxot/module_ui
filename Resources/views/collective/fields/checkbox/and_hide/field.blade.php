@php
    $field=transFields(get_defined_vars());
    $field->attributes['class']='toggle_hide';
    Theme::add($comp_ns.'/js/andHide.js');
@endphp
@component($blade_component,get_defined_vars())
	@slot('label')
		{{ Form::label($name, $field->label , ['class' => 'control-label']) }}
	@endslot
    @slot('input')
        {{ Form::bsHidden($name,0) }}  {{-- se non selezionato restituisce 0 al posto di null --}}
        {{ Form::checkbox($name, 1,$value, $field->attributes) }}
	@endslot
@endcomponent
