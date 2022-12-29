@php
	//$tabs=['recipe','ingredientCat'];
@endphp
<div class="bg-gray restaurant-entry">
	<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-8 text-xs-center text-sm-left">
			<div class="entry-logo">
				<a class="img-fluid" href="{{ $row->url }}">
					{!! $row->image_html(['width'=>100,'height'=>100]) !!}
				</a>
			</div>
			<!-- end:Logo -->
			<div class="entry-dscr">
				<h5><a href="{{ $row->url }}">{{ $row->title }}</a></h5>
				<span>{{ $row->subtitle }} </span>
				{{--
				<ul class="list-inline">
					<li class="list-inline-item"><i class="fa fa-check"></i> Min $ 10,00</li>
					<li class="list-inline-item"><i class="fa fa-motorcycle"></i> 30 min</li>
				</ul>
				--}}
			</div>
			<!-- end:Entry description -->
		</div>
		<div class="col-sm-12 col-md-12 col-lg-4 text-xs-center">
			<div class="right-content bg-white">
				<div class="right-review">
					{{--
					<div class="rating-block"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> </div>
					<p> 245 Reviews</p>

					@foreach($tabs as $tab)
					<a href="{{ $row->url }}/{{ $tab }}" class="btn theme-btn-dash">@lang('pub_theme::restaurant.show.'.$tab)</a>
					@endforeach
					--}}
					@if(is_array($row->tabs))
					@foreach($row->tabs as $tab)
					<a href="{{ $row->url }}/{{ $tab }}" class="btn theme-btn-dash">@lang($view.'.tab.'.$tab)</a>
					@endforeach
					@endif
				</div>
			</div>
			<!-- end:right info -->
		</div>
	</div>
</div>
