<div class="menu-widget m-b-30" id="{{ $row->post_id }}">
	<div class="widget-heading">
		<h3 class="widget-title text-dark">
			<b class="text-dark">{{ $row->title }}</b>
			<a class="btn btn-link pull-right" data-toggle="collapse" href="#m{{ $row->post_id }}" aria-expanded="true">
			<i class="fa fa-angle-right pull-right"></i>
			<i class="fa fa-angle-down pull-right"></i>
			</a>
			<p class="text-dark">{{ $row->subtitle }}</p>
		</h3>
		@includeFirst([$view.'.item.add.recipe',$view_default.'.item.add.recipe'],['cuisine'=>$row])
		<div class="clearfix"></div>
	</div>
	<div class="collapse show" id="m{{ $row->post_id }}">
		@foreach($row->recipes as $key=>$recipe)
			{{--
			@include($view.'.item.recipe')
			--}}
			@include($view_default.'.item.cuisine_x_recipe',['key'=>$key,'row'=>$recipe])
		@endforeach
	</div>
</div>
{{--
@include($view.'.order_modal')
--}}