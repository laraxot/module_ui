@php
if (!is_object($row)) {
    return '';
}
$fields = $_panel->getFields(['act' => 'create']);
@endphp

{!! Form::bsOpen($row, 'store') !!}
<div class="row">
    @foreach ($fields as $field)
        {{-- @php
	$input='bs'.Str::studly($field->type);
	$input_name=collect(explode('.',$field->name))->map(function ($v, $k){
		return $k==0?$v:'['.$v.']';
	})->implode('');
	$input_value=(isset($field->value)?$field->value:null);
@endphp
	<div class="col-sm-{{ isset($field->col_size)?$field->col_size:12 }}">
	{!! Form::$input($input_name,$input_value) !!}
	</div> --}}
        {!! Theme::inputHtml(['row' => $row, 'field' => $field]) !!}
    @endforeach
</div>


<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('adm_theme::txt.close')</button>
    <button type="submit" class="btn btn-primary">@lang('adm_theme::txt.add_new')</button>
</div>
{!! Form::close() !!}
