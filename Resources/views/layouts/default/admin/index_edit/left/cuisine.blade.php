@php
	$restaurant_curr=collect($params)->where('type','restaurant')->last();
	$cuisines=$restaurant_curr->cuisines;
@endphp
<div class="sidebar clearfix m-b-20">
	<div class="main-block">
		<div class="sidebar-title white-txt">
			<h6>@lang($view.'.choose_cuisine')</h6>
			<i class="fa fa-cutlery pull-right"></i>
		</div>
		@includeFirst([$view.'.item.add.cuisine',$view_default.'.item.add.cuisine'])
		<ul>
			@foreach($cuisines as $cuisine)
			<li><a href="#{{ $cuisine->post_id }}" class="scroll active">[{{ $cuisine->post_id }}]{{ $cuisine->title }}</a></li>
			@endforeach
		</ul>
		<div class="clearfix"></div>
	</div>
	{{--
	<!-- end:Sidebar nav -->
	<div class="widget-delivery">
		<form>
			<div class="col-xs-6 col-sm-12 col-md-6 col-lg-6">
				<label class="custom-control custom-radio">
					<input id="radio1" name="radio" type="radio" class="custom-control-input" checked=""> <span class="custom-control-indicator"></span> <span class="custom-control-description">Delivery</span> </label>
			</div>
			<div class="col-xs-6 col-sm-12 col-md-6 col-lg-6">
				<label class="custom-control custom-radio">
					<input id="radio2" name="radio" type="radio" class="custom-control-input"> <span class="custom-control-indicator"></span> <span class="custom-control-description">Takeout</span> </label>
			</div>
		</form>
	</div>
	--}}
</div>
