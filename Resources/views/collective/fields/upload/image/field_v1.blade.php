@php
	$field=transFields(get_defined_vars());
	$src=Form::getValueAttribute($name);
	if($src=='') $src=asset('/img/nophoto.jpg');
	Theme::add('/dist/laravel-filemanager/js/lfm.js');
	Theme::add('/dist/laravel-filemanager/css/lfm.css');
	//Theme::add($comp_ns.'/js/stand-alone-button.js');
	Theme::add($comp_ns.'/js/uploadimgv1.js');
	$field->attributes['id']='post_image_src';
@endphp
@component($blade_component,get_defined_vars())
	@slot('label')
		{{ Form::label($name, $field->label , ['class' => 'control-label']) }}
	@endslot
	@slot('input')
		{{--
		<div class="row">
 			<div class="col">
  				<img id="holder" style="margin-top:15px;max-height:100px;"  src="{{ $src }}">
  			</div>
			<div class="col">
				<div class="input-group">
   					<span class="input-group-btn">
     					<a id="lfm" data-input="{{ $field->attributes['id'] }}" data-preview="holder" class="btn btn-primary">
       						<i class="fa fa-picture-o"></i> Choose
     					</a>
   					</span>
					{{ Form::text($name, $value, $field->attributes) }}
 				</div>
 			</div>
  		</div>
  		--}}
	<div class="card mb-3" >
		<div class="row no-gutters">
			<div class="col-md-4">
				<img id="holder" class="card-img" src="{{ $src }}">
			</div>
			<div class="col-md-8">
				<div class="card-body">
					<div class="input-group">
   						<span class="input-group-btn">
     						<a id="lfm" data-input="{{ $field->attributes['id'] }}" data-preview="holder" class="btn btn-primary">
       							<i class="fa fa-picture-o"></i> Choose
     						</a>
   						</span>
						{{ Form::text($name, $value, $field->attributes) }}
 					</div>
				</div>
			</div>
		</div>
	</div>
	@endslot
@endcomponent
