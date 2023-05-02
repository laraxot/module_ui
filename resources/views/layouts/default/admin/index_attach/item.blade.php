{!! Form::bsOpen($row,'store') !!}
<div class="row">
@php
	//*
	$excludes=$_panel->pivot_key_names;
	$fields=collect($_panel->fields())
			->filter(function($item) use($excludes) {
				return !in_array($item->name,$excludes);
			})
			->all()
			;
	//*/

@endphp
@foreach($fields as $field)
@php
	$input='bs'.Str::studly($field->type);
	$input_name=collect(explode('.',$field->name))->map(function ($v, $k){
		return $k==0?$v:'['.$v.']';
	})->implode('');
	$input_value=(isset($field->value)?$field->value:null);
	if(!isset($field->col_size))$field->col_size=12;
	if(!isset($field->attributes)) $field->attributes=[];
	$input_attrs=$field->attributes;
@endphp
	<div class="col-sm-{{ $field->col_size }}">
	{!! Form::$input($input_name,$input_value,$input_attrs) !!}
	</div>
@endforeach
</div>

{{--
<div class="row">
	<div class="input-group mb-3">
		<input type="text" class="form-control col-md-2" readonly="1" name="test" value="..." >
		<input type="text" class="form-control typeahead " data-url="/admin/food/it/cuisine_cat?query=%QUERY%" data-id="test" data-name="test">
	</div>
</div>
--}}
{{Form::bsSubmit('save')}}
{!! Form::close() !!}
