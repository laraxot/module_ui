@php
	if(isset($attributes['label']))
		$label=$attributes['label'];
	else
		$label=trans($view.'.field.'.$name);
    /*Theme::add('theme/bc/dropzone/dist/min/dropzone.min.css');
	Theme::add('theme/bc/dropzone/dist/min/dropzone.js');
    /*Theme::add('pub_theme::includes/components/form/singleFileUpload/css/dropzone.css');
    Theme::add('pub_theme::includes/components/form/singleFileUpload/js/dropzone.js');*/
@endphp

{{--
	,'Fare click qui oppure trasportare l\'immagine su questo riquadro'
DUE TO DROPZONE BUG you MUST INSERT THE FOLLOWING INSIDE THE SECTION "SCRIPT" OF YOUR VIEW

    <script src="{{ url('/bc/dropzone/dist/dropzone.js') }}"></script>  .. si fa con la funzione theme::add
    <script type="text/javascript">// Immediately after the js include
        Dropzone.autoDiscover = false;
    </script>

OTHERWISE THE FORM AND DROPZONE WILL NOT WORK

--}}

<div id="dZUpload" class="dropzone">
	<div class="dz-default dz-message">
		<div class="col-xs-12">
			<div class="message">
				<p>{{ $label }}</p>
			</div>
		</div>
	</div>
	<input type="hidden" id="{{$name}}" name="filepath" value="">
	{{ Form::hidden($name, $value, array_merge(['class' => 'form-control'], $attributes)) }}
	@if ( $errors->has($name) )
		<span class="help-block">
			<strong>{{ $errors->first($name) }}</strong>
		</span>
	@endif
</div>



