@php
	$label=isset($attributes['label'])?$attributes['label']:trans($view.'.field.'.$name);
	$placeholder=trans($view.'.field.'.$name.'_placeholder');
	$dayOfWeek= \Carbon\Carbon::now()->dayOfWeek;

	$daynames=[
		trans('theme::txt.day_names.sun'),
		trans('theme::txt.day_names.mon'),
		trans('theme::txt.day_names.tue'),
		trans('theme::txt.day_names.wed'),
		trans('theme::txt.day_names.thu'),
		trans('theme::txt.day_names.fri'),
		trans('theme::txt.day_names.sat'),
	];
@endphp
<div class="form-group{{ $errors->has($name) ? ' has-error' : '' }}">
	{{ Form::label($name, $label , ['class' => 'control-label']) }}
	{{ Form::select($name, $daynames,null,['class'=>'form-control','placeholder'=>$placeholder]) }}
	@if ( $errors->has($name) )
		<span class="help-block">
			<strong>{{ $errors->first($name) }}</strong>
		</span>
	@endif
	<small class="form-text text-muted">{{ trans($view.'.field.'.$name.'_help') }} </small>
</div>