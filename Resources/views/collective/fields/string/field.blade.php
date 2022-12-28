@php
	$field=transFields(get_defined_vars());
	//dddx($field);
@endphp
@component($blade_component,get_defined_vars())
	@slot('label')
		{{ Form::label($name, $field->label , ['class' => 'control-label form-label']) }}
	@endslot
	@slot('input')
		{{ Form::text($name, $value, $field->attributes) }}
	@endslot
@endcomponent
