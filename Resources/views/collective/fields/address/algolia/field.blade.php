@php
    $field=transFields(get_defined_vars());
    $label_class='control-label';
	$class="form-control border-0 shadow-0";
	$placeholder = "";
    if(isset($attributes['label_class'])){
        $label_class=$attributes['label_class'];
    }
	if(isset($attributes['class'])){
        $class=$attributes['class'];
    }
	if(isset($attributes['placeholder'])){
        $placeholder=$attributes['placeholder'];
    }
	//dddx(get_defined_vars());
@endphp
@component($blade_component,get_defined_vars())
    @slot('label')
            {{ Form::label($name, $field->label , ['class' => $label_class]) }}
        @endslot
	@slot('input')
		{{ Form::hidden($name, $value) }}
		<input type="text" data-address="{&quot;field&quot;: &quot;{{$name}}&quot;}"  class="{{ $class }}" autocomplete="off" id="autocomplete" placeholder="{{ $placeholder }}"/>
	@endslot
@endcomponent
@push('styles')
{{--
	leggi questo per cambiare colori, nel dropdown di algolia places
	https://community.algolia.com/places/documentation.html
--}}

<style>
.ap-suggestion { color:darkblue; text-align:left; border-bottom: 1px solid #efefef; }
.ap-address { color:darkgreen; }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/places.js@1.11.0"></script>
<script>
	$(document).ready(function(){
		window.AlgoliaPlaces = window.AlgoliaPlaces || {};

		$('[data-address]').each(function(){

			var $this      = $(this),
			$addressConfig = $this.data('address'),
			$field = $('[name="'+$addressConfig.field+'"]'),
			$place = places({
				//appId: '<YOUR_PLACES_APP_ID>',
    			//apiKey: '<YOUR_PLACES_API_KEY>',
				container: $this[0],
				style: true
			});
			function clearInput() {
				if( !$this.val().length ){
					$field.val('');
				}
			}



			$place.on('change', function(e){
				console.log(e.suggestion);
				var result = JSON.parse(JSON.stringify(e.suggestion));
				$('input[name=lat]').val(result.latlng.lat);
				$('input[name=lng]').val(result.latlng.lng);
				$('input[name=city]').val(result.city);

				delete(result.highlight); delete(result.hit); delete(result.hitIndex);
				delete(result.rawAnswer); delete(result.query);

				$field.val( JSON.stringify(result) );

			});

			$this.on('change blur', clearInput);
			$place.on('clear', clearInput);

			if( $field.val().length ){
				var existingData = JSON.parse($field.val());
				$this.val(existingData.value);
			}


			window.AlgoliaPlaces[ $addressConfig.field ] = $place;
		});
	});
</script>
@endpush
