@php
/*
(object) [
    //'type' => 'checkboxRelationshipMulti',
    'type' => 'checkboxRelationshipMultiGrouped',
    'name' => 'tags',
    'group_by'=>'tagCat.title', //tagCat è la relazione del modello Tag (derivato da tags)
    'comment' => null,
    'col_size' => 6,
],
*/

$field = transFields(get_defined_vars());
$row = Form::getModel();
$row_panel = Panel::make()->get($row);
$rows = $row->{$name}();
/*
$related = $rows
    ->getRelated()
    ->all()
    ->groupBy($field->group_by);
*/
$model_related = $rows->getRelated(); //non restituisce una collezione, ma il modello della relazione
$model_related_panel = Panel::make()->get($model_related)->setParent($row_panel); //TAG_PANEL
$options = $model_related_panel->options()->groupBy($field->group_by);

//([$row,$name]);
$value = $row->{$name}->modelKeys();

@endphp


@component($blade_component, get_defined_vars())
    @slot('label')
    @endslot
    @slot('input')
        <fieldset class="form-group container-fluid border {{-- p-2 --}}">
            <legend class="col-form-label {{-- col-sm-2 --}} pt-0 w-auto">
                <h4>{{ $name }}</h4>
            </legend>
            <div class="form-group row">
                {{ Form::bsHidden($name . '[]', 0) }}
                @foreach ($options as $group => $items)
                    <fieldset class="form-group container-fluid border {{-- p-2 --}}">
                        <legend class="col-form-label {{-- col-sm-2 --}} pt-0 w-auto">
                            <h4>{{ $group }}</h4>
                        </legend>
                        <div class="form-group row">
                            @foreach ($items as $rel)
                                <div class="form-check"
                                    style="border:1px dashed gray;height:80px;padding-right:5px;margin-right:5px;padding-bottom:5px;">
                                    <label class="control-label form-check-label">
                                        {{-- $rel->title --}} {{ $model_related_panel->optionLabel($rel) }}
                                        <input class="form-control form-check-input" type="checkbox" name="{{ $name }}[]"
                                            value="{{ $rel->getKey() }}"
                                            {{ in_array($rel->getKey(), $value) ? 'checked' : '' }} />
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <br />
                    </fieldset>
                @endforeach
            </div>
            <br />
        </fieldset>
    @endslot
@endcomponent
