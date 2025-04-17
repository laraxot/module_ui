@php
	Theme::add('/vendor/laravel-filemanager/js/lfm.js');
	Theme::add('/vendor/laravel-filemanager/css/lfm.css');
	Theme::add('backend::includes/components/form/unisharp/js/imgman.js');
	$src=Form::getValueAttribute($name);
	if($src=='') $src='/images/nophoto.png';

@endphp
<style>
.btn-file {
	position: relative;
	overflow: hidden;
}
.btn-file input[type=file] {
	position: absolute;
	top: 0;
	right: 0;
	min-width: 100%;
	min-height: 100%;
	font-size: 100px;
	text-align: right;
	filter: alpha(opacity=0);
	opacity: 0;
	outline: none;
	background: white;
	cursor: inherit;
	display: block;
}
</style>


<div class="form-group{{ $errors->has($name) ? ' has-error' : '' }}" >
	<div class="col-md-4">
		{{ Form::label($name,  trans($lang.'.'.$name), ['class' => 'control-label']) }}
	</div>
	<div class="col-md-6">
		<img id="holder" style="margin-top:15px;max-height:100px;" src="{{ asset($src) }}" />
		<div class="input-group">
			<span class="input-group-addon btn btn-default btn-file">
				<a id="lfm_img" data-input="{{ $name }}" data-preview="holder" >
					<i class="fa fa-folder-open-o"></i> Sfoglia
				</a>
			</span>
			{{ Form::text($name, $value, array_merge(['class' => 'form-control'], $attributes)) }}
		</div>
	</div>
</div>


{{--
@php

@endphp

<div class="form-group{{ $errors->has($name) ? ' has-error' : '' }}" >
	<div class="col-md-4">
		{{ Form::label($name,  trans($lang.'.'.$name), ['class' => 'control-label']) }}
	</div>
	<div class="col-md-6">
		<span class="input-group-btn">
			<img id="holder" style="margin-top:15px;max-height:100px;" src="{{ $src }}">
			<a id="lfm" data-input="{{ $name }}" data-preview="holder" class="btn btn-primary">
				<i class="fa fa-picture-o"></i> Choose
			</a>
		</span>
		{{ Form::text($name, $value, array_merge(['id'=>$name, 'class' => 'form-control'], $attributes)) }}
	</div>
</div>
--}}

