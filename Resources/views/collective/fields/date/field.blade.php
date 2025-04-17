@php
$field = transFields(get_defined_vars());
$fields['attributes']['data-input'] = 'data-input';
if (isset($value)) {
    $val = $value;
} else {
    //$row=Form::getModel();
    //dddx($row->{$field->name});
    //dddx($field->name);
    $val = Form::getValueAttribute($field->name);
}

//if($val==null) $val=Carbon\Carbon::now();
//dddx($name);
//
//    dddx($val->year);
//}

if (!is_object($val)) {
    $model = Form::getModel();
    $class = get_class($model);
    $msg = [
        'name' => $name,
        'val' => $val,
        'class' => $class,
        'model' => $model,
        'tips' => 'Add [' . $name . '] into protected $dates in ' . $class,
    ];
    //dddx($msg);
    $val1 = $val;

    if ($val1 != null) {
        try {
            $val1 = Carbon\Carbon::parse($val)->format('d/m/Y');
        } catch (\Exception $e) {
            $val1 = Carbon\Carbon::createFromFormat('d/m/Y', $val)->format('d/m/Y');
        }
    }
} else {
    if ($val->year < 1) {
        $val1 = '';
    } else {
        $val1 = $val->format('d/m/Y');
    }
}
if ($val1 == null) {
    $val1 = '';
}
@endphp
@component($blade_component, get_defined_vars())
    @slot('label')
        {{ Form::label($name, $field->label, ['class' => 'control-label']) }}
    @endslot
    @slot('input')
        {{-- {{ Form::text($name, $value, $field->attributes) }}
        [{{ $val }}][{{ $val1 }}] --}}
        <div class="date_flatpickr input-group mb-3">
            {{-- <input type="text" placeholder="Select Date.." data-input class="form-control" > <!-- input is mandatory -->
            [{{ $val1 }}] --}}
            {{ Form::text($name, $val1, ['data-input', 'class' => 'form-control']) }}
            <div class="input-group-append">
                <a class="btn btn-outline-secondary" title="toggle" data-toggle>
                    <i class="far fa-calendar-alt"></i>
                </a>
            </div>
            <div class="input-group-append">
                <a class="btn btn-outline-secondary" title="clear" data-clear>
                    <i class="fas fa-times"></i>
                </a>
            </div>
        </div>
    @endslot
@endcomponent
