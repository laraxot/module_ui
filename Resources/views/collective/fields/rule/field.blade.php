@php
    //dd(app(\Modules\UI\Actions\GetRulesWithParamsAction::class)->execute());
    
    $field = transFields(get_defined_vars());
    
    //Theme::addScript('ui::js/multiselect.js');
    
    if (isset($options['field'])) {
        $field_options = $options['field']->options;
    } else {
        $field_options = [];
    }
    
    //$model = Form::getModel();
    //$rows = $model->$name();
    
    $val = $field->value;
    
    if (!is_iterable($val)) {
        $val = [];
    }
    
    //$related = $rows->getRelated();
    //$_panel = Panel::make()->get($related);
    
@endphp


<fieldset class="form-group container-fluid border p-2">
    <legend class="col-form-label col-sm-2 pt-0 w-auto">
        <h4>{{ $name }}</h4>
    </legend>

    <div class="row" style="border:1px solid  dark;">
        <br style="clear:both" />
        <div class="row">
            @if (collect($field_options)->count() > 10)
                @foreach (collect($field_options)->chunk((int) count($field_options) / 2) as $chunk)
                    <div class="col-sm-6">

                        @foreach ($chunk as $real_value => $rule)
                            <div class="input-group mt-3">
                                <div class="input-group-text">
                                    <input class="form-check-input" id="ckbx1" type="checkbox" value="">
                                    <label for="ckbx1" class="d-block mx-2">
                                        {{ $rule['name'] }}
                                    </label>
                                </div>
                                <input type="text" class="form-control" placeholder="{{ $rule['comment'] }}" />
                            </div>
                        @endforeach
                    </div>
                @endforeach
                {{-- @else
                <div class="col-sm-12">
                    @foreach (collect($field_options) as $real_value => $text)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="{{ $real_value }}">
                            <label class="form-check-label" for="{{ $real_value }}">
                                {{ $text }}
                            </label>
                        </div>
                    @endforeach
                </div> --}}
            @endif
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
