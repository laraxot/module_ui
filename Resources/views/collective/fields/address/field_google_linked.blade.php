@php

/*
        input utilizzato con la tabella places
    */

$field = transFields(get_defined_vars());
$val = Form::getValueAttribute($name);
/*
    dddx($val);
    if(is_object($val)){
        $val=json_encode($val);
    };
    */
if (is_object($val)) {
    $val = $val->toJson();
}
$value = $val;
@endphp
@component($blade_component, get_defined_vars())
    @slot('label')
        {{ Form::label($name, $field->label, ['class' => 'control-label']) }}
    @endslot
    @slot('input')
        {{ Form::hidden($name, $value) }}
        <input type="text" data-google-address="{&quot;field&quot;: &quot;{{ $name }}&quot;}" class="form-control"
            autocomplete="off" />
        <div id="{{ $name }}_fields">
        </div>
    @endslot
@endcomponent
@push('styles')
    <style>
        .ap-input-icon.ap-icon-pin {
            right: 5px !important;
        }

        .ap-input-icon.ap-icon-clear {
            right: 10px !important;
        }

    </style>

@endpush

@push('scripts')
    <script>
        //Function that will be called by Google Places Library
        function initAutocomplete() {

            $('[data-google-address]').each(function() {
                var $this = $(this),
                    $addressConfig = $this.data('google-address'),
                    $field = $('[name="' + $addressConfig.field + '"]');
                var $extra_fields = $('#' + $addressConfig.field + '_fields');

                if ($field.val().length) {
                    //console.log($field.val());
                    var existingData = JSON.parse($field.val());
                    $this.val(existingData.value);
                }

                var $autocomplete = new google.maps.places.Autocomplete(
                    ($this[0]), {
                        types: ['geocode']
                    });

                $autocomplete.addListener('place_changed', function fillInAddress() {

                    var place = $autocomplete.getPlace();
                    console.log(place);
                    var value = $this.val();
                    var latlng = place.geometry.location;
                    var data = {
                        "value": value,
                        "latlng": latlng
                    };

                    for (var i = 0; i < place.address_components.length; i++) {
                        var addressType = place.address_components[i].types[0];
                        data[addressType] = place.address_components[i]['long_name'];
                        data[addressType + '_short'] = place.address_components[i]['short_name'];

                        $('<input>').attr({
                            'type': 'text',
                            'name': '{{ $name }}[' + addressType + ']',
                            'value': data[addressType]
                        }).appendTo($extra_fields);

                        $('<input>').attr({
                            'type': 'text',
                            'name': '{{ $name }}[' + addressType + '_short]',
                            'value': data[addressType + '_short']
                        }).appendTo($extra_fields);

                    }

                    $('<input>').attr({
                        'type': 'text',
                        'name': '{{ $name }}[latitude]',
                        'value': latlng.lat,
                    }).appendTo($extra_fields);
                    $('<input>').attr({
                        'type': 'text',
                        'name': '{{ $name }}[longitude]',
                        'value': latlng.lng,
                    }).appendTo($extra_fields);



                    $field.val(JSON.stringify(data));

                });

                $this.change(function() {
                    if (!$this.val().length) {
                        $field.val("");
                    }
                    $extra_fields.empty();
                });


            });

        }
    </script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google.maps_key') }}&libraries=places&callback=initAutocomplete"
        async defer></script>
@endpush
