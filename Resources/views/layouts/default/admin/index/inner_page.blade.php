{{--
@if(\View::exists($view_default.'.inner_page.'.snake_case($row->post_type)) )
	@include($view_default.'.inner_page.'.snake_case($row->post_type))
@else
<div class="inner-page-hero bg-image" data-image-src="{{ Theme::asset('theme/pub/images/bg/'.$row->post_type.'.jpg') }}">
	<div class="container"> </div>
	<!-- end:Container -->
</div>
@endif
--}}
