@php
/*----ESEMPIO---
(object) [
    'type' => 'SelectRelationshipOne',
    'name' => 'articlecat', //nome relazione
    'comment' => null,
    'attributes' => ['placeholder' => 'metti quello che vuoi'],
],
*/
//dddx(get_defined_vars());
$model = Form::getModel();
$field = transFields(get_defined_vars());
$rows = $model->{$name}();
$value = optional($model->{$name})->getKey();

$related = $rows->getRelated();
$related_panel = Panel::make()->get($related);
$related_panel->setBuilder($related->query());
$opts = $related_panel->optionsSelect();
@endphp

@component($blade_component, get_defined_vars())
    @slot('label')
        @php
        //[{{ $value }}]
        @endphp
        {{ Form::label($name, $field->label, ['class' => 'control-label form-label']) }} {{-- $field->label_attributes --}}
    @endslot
    @slot('input')
        {{ Form::select($name, $opts, $value, $field->attributes) }}
    @endslot
@endcomponent
