@php
$field = transFields(get_defined_vars());
$field_options = $options['field']->options;
//dddx([get_defined_vars(), $_panel->row->tags->modelKeys()]);
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
                @foreach ($field_options as $group => $items)
                    <fieldset class="form-group container-fluid border ">
                        <legend class="col-form-label  pt-0 w-auto">
                            <h4>{{ $group }}</h4>
                        </legend>
                        <div class="form-group row">
                            @foreach ($items as $k => $v)
                                <div class="form-check"
                                    style="border:1px dashed gray;height:80px;padding-right:5px;margin-right:5px;padding-bottom:5px;">
                                    <label class="control-label form-check-label">
                                        {{ $v }}
                                        <input class="form-control form-check-input" type="checkbox" name="{{ $name }}[]"
                                            value="{{ $k }}"
                                            {{ in_array($k, $_panel->row->{$name}->modelKeys()) ? 'checked' : '' }} />
                                    </label>
                                </div>
                                <br />
                            @endforeach
                        </div>
                    </fieldset>
                @endforeach
            </div>
            <br />
        </fieldset>
    @endslot
@endcomponent
