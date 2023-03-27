@php
    /**
     * https://github.com/crlcu/multiselect
     * bower install multiselect-two-sides
     */
    
    //strani errori jquery
    $field = transFields(get_defined_vars());
    
    Theme::addScript('ui::js/multiselect.js');
    
    //dddx(get_defined_vars());
    if (isset($options['field'])) {
        $field_options = $options['field']->options;
    } else {
        $field_options = [];
    }
    
    $model = Form::getModel();
    
    $name = $field->name;
    
    $field_id = str()->slug($name, '_');
    $field_name = dottedToBrackets($name);
    $name_dot = bracketsToDotted($name);
    //dddx(Arr::get($model, $name_dot));
    // $rows = $model->$name();
    $rows = Arr::get($model, $name_dot);
    
    $val = $field->value;
    
    if (!is_iterable($val)) {
        $val = [];
    }
    
    if ($rows instanceof \Illuminate\Database\Eloquent\Collection) {
        //qui ci passa
        $related = $rows->first();
        //così funziona su http://pfed.lan2/admin/pfed/it/edit/company_profiles/22
        $val = $rows;
        //dddx($val);
    } else {
        $related = $rows->getRelated();
    }
    
    $_panel = Panel::make()->get($related);
@endphp


<fieldset class="form-group container-fluid border p-2">
    <legend class="col-form-label col-sm-2 pt-0 w-auto">
        <h4>{{ $field_name }}</h4>
    </legend>

    <div class="row" style="border:1px solid  dark;">
        <div class="col-sm-12">
            <p>{{ trans('lu::help.nota_multiselect') }}</p>
        </div>
        <br style="clear:both" />
        <div class="row">
            <div class="col-sm-5">
                <select name="{{ $field_name }}[from][]" id="multiselect{{ $field_id }}"
                    class="form-control multiselect" size="8" multiple="multiple">
                    @foreach ($field_options as $k => $v)
                        <option value="{{ $k }}">{{ $v }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-2">
                <button type="button" id="multiselect{{ $field_id }}_rightAll" class="btn btn-block">
                    <i class="fas fa-angle-double-right"></i>
                </button>
                <button type="button" id="multiselect{{ $field_id }}_rightSelected" class="btn btn-block">
                    <i class="fas fa-chevron-right"></i>
                </button>
                <button type="button" id="multiselect{{ $field_id }}_leftSelected" class="btn btn-block">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button type="button" id="multiselect{{ $field_id }}_leftAll" class="btn btn-block">
                    <i class="fas fa-angle-double-left"></i>
                </button>
            </div>

            <div class="col-sm-5">

                <select name="{{ $field_name }}[to][]" id="multiselect{{ $field_id }}_to" class="form-control"
                    size="8" multiple="multiple">
                    {{-- altrimenti ti mette sia quelli con user_id null che con user_id --}}

                    @foreach ($val as $k => $v)
                        <option value="{{ $_panel->optionId($v) }}">{{ $_panel->optionLabel($v) }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</fieldset>

@once
    @push('scripts')
        <script type="text/javascript">
            if (typeof $ == 'undefined') {
                var $ = jQuery;
            }
            //jQuery is not a function
            //jQuery(document).ready(function($) {
            $(function() {
                $('.multiselect').multiselect();

            });
        </script>
    @endpush
@endonce
