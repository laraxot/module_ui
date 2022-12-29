@php
	$restaurant_curr=collect($params)->where('type','restaurant')->last();
	//$cuisines=$restaurant_curr->cuisines;
@endphp
@if(isset($restaurant_curr))
	@include($_layout->view_default.'.left.restaurant_cuisine',['restaurant_curr'=>$restaurant_curr])
@endif
