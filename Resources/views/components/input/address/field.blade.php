@props(['name'])
<input type="hidden" {{ $attributes->merge($attrs) }} />
<div wire:ignore>
    <input type="text" data-google-address="{&quot;field&quot;: &quot;{{ $name }}&quot;}" class="form-control"
        autocomplete="off" wire:model.lazy="form_data.{{ $name }}_value" />
</div>
@push('styles')
    <style>
        .ap-input-icon.ap-icon-pin {
            right: 5px !important;
        }

        .ap-input-icon.ap-icon-clear {
            right: 10px !important;
        }

        .pac-container {
            z-index: 10000 !important;
        }
    </style>
@endpush

@push('scripts')
    <script>
        //Function that will be called by Google Places Library
        function initAutocomplete() {

            $('[data-google-address]').each(function() {
                var $this = $(this);
                var $addressConfig = $this.data('google-address');
                var $field = $('[name="' + $addressConfig.field + '"]');

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
                    }



                    $val = JSON.stringify(data);
                    $field.val($val);
                    @this.set('form_data.' + $addressConfig.field, $val);
                    @this.set('form_data.' + $addressConfig.field + '_value', value);
                });

                $this.change(function() {
                    if (!$this.val().length) {
                        $field.val("");
                    }
                });


            });

        }
    </script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google.maps_key') }}&libraries=places&callback=initAutocomplete"
        async defer></script>
@endpush
