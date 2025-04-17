<div class="col-md-12">
@includeFirst(
	[
		$view_default.'.body.'.$row_type,
		//$view_default.'.body_content',
		$view_extend.'.body.'.$row_type,
		$view_extend.'.body_content'
	]
)
</div>