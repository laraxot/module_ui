@php
$row = Form::getModel();
dddx(get_defined_vars());
//dd(get_defined_vars()['__data']);
//$opts=$
$field = $options['field'];
$rows = $row->{$field->relationship}();
$related = $rows->getRelated();
$related_panel = Panel::make()->get($related);
$related_panel->setBuilder($related->query());
//dddx($related_panel->optionsSelect());
//dddx($related->all());
/*
 dddx($related);
 $opts=$rows->all();
 */
$opts = $related_panel->optionsSelect();
$field = transFields(get_defined_vars());
//$field=transFields(get_defined_vars());
//dddx($field);
@endphp

@component($blade_component, get_defined_vars())
    @slot('label')
        {{ Form::label($name, $field->label, ['class' => 'control-label']) }}
    @endslot
    @slot('input')
        {{ Form::select($name, $opts, $value, $field->attributes) }}
    @endslot
@endcomponent
