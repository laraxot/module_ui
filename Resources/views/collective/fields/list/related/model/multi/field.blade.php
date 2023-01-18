@php
//dddx(get_defined_vars());
$field = transFields(get_defined_vars()); //in xot helper
$row = Form::getModel();
$related_model = Theme::xotModel($field->related_name);
$related_panel = Panel::make()->get($related_model);
$all = $related_model->get();
//dddx($all);
$val = Form::getValueAttribute($name);

@endphp
@component($blade_component, get_defined_vars())
    @slot('label')
        {{ Form::label($name, $field->label, ['class' => 'control-label']) }}
    @endslot
    @slot('input')
        <input type="hidden" name="{{ $name }}" id="{{ $name }}" value="{{ $val }}">
        <div class="row">
            @foreach ($all as $v)
                <div class="card">
                    <div class="card-body">
                        {{ $related_panel->optionLabel($v) }}
                        <input type="checkbox" class="{{ $name }}_list" value="{{ $related_panel->optionId($v) }}"
                            class="form-check-input" {{ $related_panel->optionId($v) == $val ? 'checked' : '' }}>
                    </div>
                </div>
            @endforeach
        </div>
    @endslot
@endcomponent

@push('scripts')
    <script>
        $(function() { //document ready
            $('.{{ $name }}_list').change(function() {
                $('#{{ $name }}').val('');
                $('.{{ $name }}_list').each(function(index) {
                    if ($(this).prop('checked')) {
                        var old_val = $('#{{ $name }}').val();
                        if (old_val == '') {
                            $('#{{ $name }}').val($(this).val());
                        } else {
                            $('#{{ $name }}').val(old_val + ',' + $(this).val());
                        }
                    }
                });
            });
        });
    </script>
@endpush
