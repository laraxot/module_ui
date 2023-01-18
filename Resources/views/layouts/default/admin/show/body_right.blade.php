<div class="col-md-8">
	@includeFirst(
		[
			$view.'.body1',
			$view_default.'.body_content',
			$view_extend.'.body_content'
		]
	)
</div>
<div class="col-md-4">
	@includeFirst(
		[
			$view.'.right',
			$view_default.'.right.'.snake_case($row->post_type)
		]
	)
</div>