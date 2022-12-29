@extends('theme::layouts.app_ajax')
@section('content')
{{--

@include('theme::includes.flash')
@include('theme::modal_ajax')
{!! Theme::include('header',['edit_type'=>$row_type],get_defined_vars() ) !!}
--}}
<section class="restaurants-page">
	<div class="container">
		<div class="row">
			{{--
			{!! Theme::include($view_body,[],get_defined_vars() ) !!}
			--}}
			@include('theme::layouts.default.common.'.$_layout->view_body)
		</div>
	</div>
</section>
{{--
{!! Theme::include('footer',['edit_type'=>$row_type],get_defined_vars() ) !!}
{{ Theme::showScripts(false) }}
{!! Theme::showScripts(false) !!}
--}}
@endsection
