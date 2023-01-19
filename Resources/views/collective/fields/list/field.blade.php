@php
if (isset($options['field'])) {
    $options = $options['field']->options;
}
extract($attributes);
$field = transFields(get_defined_vars());
$value = Form::getValueAttribute($name);

@endphp


@component($blade_component, get_defined_vars())
    @slot('label')
        {{ Form::label($name, $field->label, ['class' => 'control-label']) }}
    @endslot
    @slot('input')
        <input type="hidden" name="{{ $name }}" value="{{ $value }}" />
        <div class="list_checkbox_{{ $name }} ">
            @foreach ($options as $v)
                <div class="card" style="width: 20rem;display:inline-block;">
                    <div class="card-body">
                        <input type="checkbox" name="{{ $v['key'] }}" value="{{ $v['key'] }}" />{{ $v['label'] }}
                    </div>
                     <ul class="list-group list-group-flush">
                        @foreach($v['sons'] as $son)
                        <li class="list-group-item">
                            <input type="checkbox" name="{{ $son['key'] }}" value="{{ $son['key'] }}" />{{ $son['label'] }}
                        </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>




        {{-- Form::select($name, $options, $value, $field->attributes) --}}
    @endslot
@endcomponent

@push('scripts')
    <script>
        $(document).ready(function() {
            let values = $('input[name="{{ $name }}"]').val().split(',');

            values.forEach(function(v) {
                $('.list_checkbox_{{ $name }} input[name="' + v + '"]').prop('checked', true);
            });

            console.log(values);
        });

        $(document).on('change', '.list_checkbox_{{ $name }}', function() {

            let list = new Array();

            $(this).find('input[type="checkbox"]').each(function(i, e) {

                if (e.checked === true) {
                    list.push(e.value);
                }

            });

            $('input[name="{{ $name }}"]').val(list.join());

            /*if (this.checked) {

            } else {

            }*/
        });
    </script>
@endpush
