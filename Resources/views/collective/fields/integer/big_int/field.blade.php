@php
$field=transFields(get_defined_vars());
//dddx(get_defined_vars());
@endphp
@component($blade_component,get_defined_vars())
	@slot('label')
		{{ Form::label($name, $field->label , ['class' => 'control-label']) }}
	@endslot
	@slot('input')
		{{ Form::number($name,$value, $field->attributes) }}
    @endslot
@endcomponent