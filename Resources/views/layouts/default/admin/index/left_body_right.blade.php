<div class="col-xs-12 col-sm-4 col-md-4 col-lg-3">
	@includeFirst(
		[
			$view.'.left',
			$view_default.'.left.'.snake_case($row->post_type)
		]
	)
</div>
<div class="col-xs-12 col-sm-8 col-md-8 col-lg-6">
	@includeFirst(
		[
			$view.'.body1',
			$view_default.'.body_content',
			$view_extend.'.body_content'
		]
	)
</div>
<div class="col-xs-12 col-md-12 col-lg-3">
	@includeFirst(
		[
			$view.'.right',
			$view_default.'.right.'.snake_case($row->post_type)
		]
	)
</div>