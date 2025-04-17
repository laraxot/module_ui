@php
    $field=transFields(get_defined_vars());
    $src=Form::getValueAttribute($name);
	if($src=='') $src=asset('/img/nophoto.jpg');
    Theme::add($comp_ns.'/js/stand-alone-button.js');
	$field->attributes['id']='post_image_src';
	//dddx(get_defined_vars());
@endphp
@component($blade_component,get_defined_vars())
	@slot('label')
		{{ Form::label($name, $field->label , ['class' => 'control-label']) }}
    @endslot
    @slot('input')
    <div class="card mb-3" >

		<div class="input-group">
			<span class="input-group-btn">
				<a id="lfm_{{ $name }}" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
					<i class="fa fa-picture-o"></i> Choose
				</a>
			</span>
			<input id="thumbnail" class="form-control" type="text" name="filepath">
		</div>
		<img id="holder" style="margin-top:15px;max-height:100px;">








	</div>





    @endslot
@endcomponent

@push('scripts')
<script>

	var route_prefix = '/filemanager';
 	$('#lfm_{{ $name }}').filemanager('image', {prefix: route_prefix});
</script>

@endpush

