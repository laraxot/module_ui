@extends('pub_theme::layouts.app')
@section('page_heading',trans($view.'.page_heading'))
@section('content')
@include('extend::includes.flash')
@include('extend::includes.components')
@php
	$edit_type=snake_case($row->post_type);
	if(!\View::exists($view.'.form') && !\View::exists($view_default.'.form.'.$edit_type)){
		ddd('not exist ['.$view.'.form'.'] ['.$view_default.'.form.'.$edit_type.']');
	}
@endphp
<div class="page-wrapper">
	@includeFirst(
		[
			$view.'.inner_page',
			$view_default.'.inner_page.'.$edit_type,
			$view_extend.'.inner_page.'.$edit_type,
			$view_default.'.inner_page',
			$view_extend.'.inner_page'
		]
	)
	@include('extend::layouts.partials.breadcrumb')
	<section class="create-page inner-page">
		<div class="container">
			<div class="row">
				<div class="col-md-8">
					<div class="widget">
						<div class="widget-body">
							@if (count($errors) > 0)
							<div class="alert alert-danger">
								<ul>
									@foreach ($errors->all() as $k=>$error)
									<li>{{ $error }}</li>
									@endforeach
								</ul>
							</div>
							@endif
							@includeFirst([$view.'.form',$view_default.'.form.'.$edit_type])
						</div>
					</div>
				</div>
				<div class="col-md-4">
					@includeFirst(
						[
							$view.'.right',
							$view_default.'.right',
							$view_extend.'.right'
						]
					)
				</div>
			</div>
		</div>
	</section>
</div>
@endsection