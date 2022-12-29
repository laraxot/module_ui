{{--
@if(\View::exists($view_default.'.inner_page.'.$edit_type) )
	@include($view_default.'.inner_page.'.$edit_type)
@else
<div class="inner-page-hero bg-image" data-image-src="{{ Theme::asset('theme/pub/images/bg/'.$edit_type.'.jpg') }}">
	<div class="container"> </div>
	<!-- end:Container -->
</div>
@endif
--}}