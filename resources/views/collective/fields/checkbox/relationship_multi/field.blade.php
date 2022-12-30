@php
$field = transFields(get_defined_vars());
$row = Form::getModel();
$rows = $row->{$name}();
$related = $rows->getRelated()->all();
$value = $row->{$name}->modelKeys();
@endphp


@component($blade_component, get_defined_vars())
    @slot('label')
    @endslot
    @slot('input')
        <fieldset class="form-group container-fluid border p-2">
            <legend class="col-form-label col-sm-2 pt-0 w-auto">
                <h4>{{ $name }}</h4>
            </legend>

            <div class="form-group row">
                {{ Form::bsHidden($name . '[]', 0) }}
                @foreach ($related as $rel)
                    <div class="form-check">
                        <label class="control-label form-check-label">
                            {{ $rel->title }}

                            <input class="form-control form-check-input" type="checkbox" name="{{ $name }}[]"
                                value="{{ $rel->getKey() }}" {{ in_array($rel->getKey(), $value) ? 'checked' : '' }} />
                        </label>
                    </div>
                @endforeach
            </div>
            <br />
        </fieldset>
    @endslot
@endcomponent
