@php
	$ingredientCat=$row;
@endphp
<div class="menu-widget m-b-30" id="{{ $ingredientCat->post_id }}">
	<div class="widget-heading">
		<h3 class="widget-title text-dark">
			{{ $ingredientCat->title }}
			<a class="btn btn-link pull-right" data-toggle="collapse" href="#m{{ $ingredientCat->post_id }}" aria-expanded="true">
			<p>{{ $ingredientCat->subtitle }}</p>
			<i class="fa fa-angle-right pull-right"></i>
			<i class="fa fa-angle-down pull-right"></i>
			</a>
		</h3>
		<div class="clearfix"></div>
	</div>
	<div class="collapse show" id="m{{ $ingredientCat->post_id }}">
		@foreach($ingredientCat->ingredients as $key=>$ingredient)
			@include($view_default.'.item.ingredient_cat_x_ingredient',['key'=>$key,'ingredient'=>$ingredient])
		@endforeach
	</div>
	<!-- end:Collapse -->
</div>