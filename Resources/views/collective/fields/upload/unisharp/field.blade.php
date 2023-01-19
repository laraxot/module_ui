{{ Theme::add('/vendor/laravel-filemanager/js/lfm.js') }}
{{ Theme::add('/vendor/laravel-filemanager/css/lfm.css') }}
{{ Theme::add('backend::includes/components/form/unisharp/js/uploadimg.js') }}
@php
$src=Form::getValueAttribute($name);
if($src=='') $src='/images/nophoto.png';
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

