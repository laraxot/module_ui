@php
/**
 * https://github.com/crlcu/multiselect
 * bower install multiselect-two-sides
 */
//Theme::addScript('/theme/bc/multiselect/dist/js/multiselect.js');
$options = [];
extract($attributes);
$field = transFields(get_defined_vars());
//dddx(get_defined_vars());

$model = Form::getModel();
$val = $model->$name;
//dddx($model);
//$user=Auth::user();
//$user_id=is_object($user)?$user->user_id:'NO-SET';
$model_linked = $model->$name()->getRelated();
$_panel = Theme::panelModel($model_linked);
$_panel->setBuilder($model_linked->query());
//$all=$_panel->options();
/*

 $data=request()->all();
 $all=$_panel->rows($data)->get();
 //*/
$all = $_panel->options();
//dddx(get_class($_panel));//Modules\Progressioni\Models\Panels\SchedePanel
@endphp
{{-- @component($blade_component, get_defined_vars())
	@slot('label')
	{{ Form::label($name, $field->label , ['class' => 'control-label']) }}
	@endslot
	@slot('input')
		Form::text($name,$options,$value, $field->attributes)
	@endslot
@endcomponent --}}
{{--  --}}
<br style="clear:both" />
<p>{{ trans('lu::help.nota_multiselect') }}</p><br />
<div class="row">
    <br style="clear:both" />
    <div class="col-sm-5">
        <select name="{{ $name }}[from][]" id="multiselect" class="form-control" size="8" multiple="multiple">
            @foreach ($all as $k => $v)
                <option value="{{ $_panel->optionId($v) }}">{{ $_panel->optionLabel($v) }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-sm-2">
        <button type="button" id="multiselect_rightAll" class="btn btn-block">
            <i class="fas fa-angle-double-right"></i>
        </button>
        <button type="button" id="multiselect_rightSelected" class="btn btn-block">
            <i class="fas fa-chevron-right"></i>
        </button>
        <button type="button" id="multiselect_leftSelected" class="btn btn-block">
            <i class="fas fa-chevron-left"></i>
        </button>
        <button type="button" id="multiselect_leftAll" class="btn btn-block">
            <i class="fas fa-angle-double-left"></i>
        </button>
    </div>

    <div class="col-sm-5">
        <select name="{{ $name }}[to][]" id="multiselect_to" class="form-control" size="8"
            multiple="multiple">
            @foreach ($val as $k => $v)
                <option value="{{ $_panel->optionId($v) }}">{{ $_panel->optionLabel($v) }}</option>
            @endforeach
        </select>
    </div>

</div>
{{--  --}}
{{-- @push('scripts')
<script type="text/javascript">
jQuery(document).ready(function($) {
    $('#multiselect').multiselect();
});
</script>
@endpush --}}
