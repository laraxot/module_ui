@php
    $field = transFields(get_defined_vars());
    
    if (isset($options['field'])) {
        $field_options = $options['field']->options;
    } else {
        $field_options = [];
    }
    
    $rules = $field->value;
    
    //dddx($rules);
    
    if (!is_iterable($rules)) {
        $rules = [];
    }
@endphp


<fieldset class="form-group container-fluid border p-2">
    {{-- <legend class="col-form-label col-sm-2 pt-0 w-auto">
        <h4>{{ $name }}</h4>
    </legend> --}}

    <button type="button" class="btn btn-primary" id="btn-rules" onclick="$('#rules').toggleClass('d-none');">
        Add Rules
    </button>

    <div class="row" style="border:1px solid  dark;">
        {{-- must toggle the rules with id = rules --}}

        <br style="clear:both" />
        <div class="row d-none" id="rules">
            {{-- @if (collect($field_options)->count() > 10) --}}

            @foreach (collect($field_options)->chunk((int) count($field_options) / 3) as $chunk)
                <div class="col-sm-4">
                    @foreach ($chunk as $real_value => $rule)
                        <p>{{ $rule['comment'] }}</p>
                        <div class="input-group mt-3">
                            <div class="input-group-text">
                                <input class="form-check-input" id="{{ $rule['name'] }}"
                                    name="{{ $name }}[{{ $rule['name'] }}][checked]" type="checkbox"
                                    value="{{ $rules[$rule['name']]['checked'] ?? 'true' }}"
                                    @if (isset($rules[$rule['name']]['checked'])) checked @endif>
                                <label for="ckbx1" class="d-block mx-2">
                                    {{ $rule['name'] }}
                                </label>
                            </div>
                            @foreach ($rule['params'] as $param => $type)
                                @if ($type != '')
                                    <input id="{{ $rule['name'] }}_{{ $param }}"
                                        name="{{ $name }}[{{ $rule['name'] }}][{{ $param }}]"
                                        type="{{ $type }}" class="form-control"
                                        placeholder="{{ $param }}" 3
                                        value="{{ $rules[$rule['name']][$param] ?? '' }}" />
                                @endif
                            @endforeach
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
                </div> 
            @endif --}}
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
