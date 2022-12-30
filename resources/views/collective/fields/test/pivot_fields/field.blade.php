@php
$model = Form::getModel(); //Modules\Food\Models\Profile
if (!method_exists($model, $name)) {
    dddx('create relationship [' . $name . '] on [' . get_class($model) . ']');
}
$user = Auth::user();
$user_id = is_object($user) ? $user->user_id : 'NO-SET';
$rows = $model->$name();

$pivot_class = $rows->getPivotClass();
$pivot = new $pivot_class();
$pivot_panel = Theme::panelModel($pivot);
$pivot_panel->setRows($rows);
$pivot_fields = $pivot_panel->getFields(['act' => 'edit']);

$val = $model->$name;

$related = $rows->getRelated();
$_panel = Theme::panelModel($related);
$all = $related->get();

@endphp
<fieldset>
    <legend><b>@lang($trad.'.'.$name.'.title')</b></legend>
    @foreach ($all as $k => $v)
        <div class="row">
            @foreach ($pivot_fields as $pf)
                @php
                    //$input_name=$name.'['.$v->post_id.'][pivot]['.$pf->name.']';
                    $input_name = $name . '.' . $v->post_id . '.pivot.' . $pf->name . '';
                    $input_name = dottedToBrackets($input_name);
                    $input_type = 'bs' . $pf->type;
                    if (isset($pf->sub_type)) {
                        $input_type .= $pf->sub_type;
                    }

                    //$input_value=(isset($field->value)?$field->value:null);
                    if (!isset($pf->col_size)) {
                        $pf->col_size = 12;
                    }
                    if (!isset($pf->attributes)) {
                        $pf->attributes = [];
                    }
                    $input_attrs = $pf->attributes;
                    $input_value = isset($field->value) ? $field->value : null;
                    $input_attrs['label'] = $v->title;
                    $input_attrs['text'] = $v->txt;
                    $name_sub = last(explode('.', $pf->name));
                    $vv = $val->where('post_id', $v->post_id)->first();
                    if ($vv == null) {
                        $vv = [];
                    } else {
                        $vv = $vv->toArray();
                    }

                    $input_value = Arr::get($vv, 'pivot.' . $pf->name);

                    if ($vv == [] && $input_value == '') {
                        //forzatura
                        $input_value = $v->{$pf->name};
                    }

                @endphp

                @if ($input_type == 'bsHidden')
                    {{ Form::$input_type($input_name, $input_value, $input_attrs) }}
                @else
                    <div class="col">
                        {{ Form::$input_type($input_name, $input_value, $input_attrs) }}
                    </div>
                @endif

            @endforeach
        </div>
    @endforeach
</fieldset>
