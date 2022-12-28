@php
/*
NOTA BENE:
per utilizzare questo componente, la tabella/modello utilizzato deve avere un/il campo "parent_id"


esempio di utilizzo
(object) [
    'type' => 'SelectParent',
    'name' => 'parent_id',
    'comment' => null,
    'col_size' => 2,
],

*/
//dddx(get_defined_vars());
//$options = [];
extract($attributes);
$field = transFields(get_defined_vars());
//dddx($field);
$row = Form::getModel();
//dddx($row);
$row_panel = Panel::make()->get($row);
$row_panel->setBuilder($row->with(['post']));


$options = $row_panel->optionsTree();

//dddx($blade_component);
//dddx($options);
@endphp

@component($blade_component, get_defined_vars())
    @slot('label')
        {{ Form::label($name, $field->label, ['class' => 'control-label']) }}
    @endslot
    @slot('input')
        {{ Form::select($name, $options, $value, $field->attributes) }}
    @endslot
@endcomponent
