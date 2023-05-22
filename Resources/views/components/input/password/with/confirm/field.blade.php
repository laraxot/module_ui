{{--  
@php
	$field=transFields(get_defined_vars());
	$name_conf=bracketsToDotted($name).'_confirmation';
	$name_conf=dottedToBrackets($name_conf);
	$without_div=false;
	if(isset($attributes['without_div'])){
		$without_div=$attributes['without_div'];
	}
@endphp
@if($without_div)
@else
<div class="row col-md-12" >
	<div class="col-md-6">
@endif
		{{ Form::bsPassword($name) }}
@if($without_div)
@else
</div>
<div class="col-md-6">
@endif
	{{ Form::bsPassword($name_conf) }}
@if($without_div)
@else

</div>
</div>
@endif
--}}
@php
    $attrs1=$attrs;
    $attrs1['name']=$attrs1['name'].'_confirmation';
@endphp
<x-input.group type="password" {{ $attributes->merge($attrs) }} label="password" />
<x-input.group type="password" {{ $attributes->merge($attrs1) }} label="_confirmation" />