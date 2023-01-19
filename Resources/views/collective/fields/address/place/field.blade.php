@php
	$field=transFields(get_defined_vars());
	$field->attributes['class'].=' place';
@endphp
@component($blade_component,get_defined_vars())
	@slot('label')
		{{ Form::label($name, $field->label , ['class' => 'control-label']) }}
	@endslot
	@slot('input')
		{{ Form::text($name, $value, $field->attributes) }}
	@endslot
@endcomponent


@push('scripts')
<script>
	$(document).ready(function(){
		$(".place").focus(function() {
    		geolocate();
		});


	});


	// This example displays an address form, using the autocomplete feature
	// of the Google Places API to help users fill in the information.

	// This example requires the Places library. Include the libraries=places
	// parameter when you first load the API. For example:
	// <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

	var placeSearch, autocomplete;
	var componentForm = {
		street_number: 'short_name',
		route: 'long_name',
		locality: 'long_name',
		administrative_area_level_1: 'short_name',
		country: 'long_name',
		postal_code: 'short_name'
	};
	function initAutocomplete() {
		  // Create the autocomplete object, restricting the search to geographical
		  // location types.
		  console.log('initAutocomplete');
		  $( ".place" ).each(function( index ) {
		  	$this=$(this)[0];
		  	console.log($this);
		  	autocomplete = new google.maps.places.Autocomplete($this,{types: ['geocode']});
		  });

		  // When the user selects an address from the dropdown, populate the address
		  // fields in the form.
		  //autocomplete.addListener('place_changed', fillInAddress);
	}
	function fillInAddress() {
		// Get the place details from the autocomplete object.
		//hidePopoverMessage( '#autocomplete' );
		var place = autocomplete.getPlace();
		fillFields(place);

	}

	function fillFields(place){
		//console.log(place);
		for (var component in componentForm) {
			//document.getElementById(component).value = '';
			//document.getElementById(component).disabled = false;
			//alert(component);
			$('input[name="'+component+'"]').val('');
		}
		if(place.geometry!=undefined){
			$('input[name="lat"]').val(place.geometry.location.lat());
			$('input[name="lng"]').val(place.geometry.location.lng());
		}
		// Get each component of the address from the place details
		// and fill the corresponding field on the form.
		if(place.address_components!=undefined){
			for (var i = 0; i < place.address_components.length; i++) {
				var addressType = place.address_components[i].types[0];
				if (componentForm[addressType]) {
					var val = place.address_components[i][componentForm[addressType]];
					//document.getElementById(addressType).value = val;
					$('input[name="'+addressType+'"]').val(val);
				}
			}
		}
	}
	// Bias the autocomplete object to the user's geographical location,
	// as supplied by the browser's 'navigator.geolocation' object.
	function geolocate() {
		if (navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(function(position) {
				var geolocation = {
					lat: position.coords.latitude,
					lng: position.coords.longitude
				};
				var circle = new google.maps.Circle({
					center: geolocation,
					radius: position.coords.accuracy
				});
				autocomplete.setBounds(circle.getBounds());
			});
		}
	}


	function showPopoverMessage( input, message, placement ) {
		$(input).addClass('address-insert-incomplete').popover({
			html : true,
			content : message,
			placement: placement
		}).popover('show');
	}

	function hidePopoverMessage( input ) {
		$(input).removeClass('address-insert-incomplete').popover('destroy');
	}




</script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?language=it&key={{ config('services.google.maps_key') }}&libraries=places&callback=initAutocomplete" async defer></script>

@endpush