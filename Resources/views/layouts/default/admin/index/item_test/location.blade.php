<div class="bg-gray restaurant-entry" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
	<meta itemprop="position" content="{{ $key+1 }}" />
	<div class="row" itemprop="item" itemscope itemtype="http://schema.org/City">
		<meta itemprop="url" content="{{ $row->url }}" />
		<div class="col-sm-12 col-md-12 col-lg-8 text-xs-center text-sm-left">
			<div class="entry-logo">
				<a class="img-fluid" href="#">
				{{--  <img src="http://placehold.it/110x110" alt="Food logo"> --}}
				{!! $row->image_html(['width'=>110,'height'=>110]) !!}
				{{--
				<img itemprop="image" src="{{ $row->image_src }}">
				--}}
				</a>
			</div>
			{{-- end:Logo --}}
			<div class="entry-dscr">
				<h5>
					<a href="{{ $row->url }}" title="{{ $row->title }}">
						<span itemprop="name">{{ $row->title }}</span>
					</a>
				</h5>
				<div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
					<i class="fa fa-map-marker" aria-hidden="true"></i>
      				<span itemprop="postalCode">{{ $row->postal_code }}</span>
      				<span itemprop="addressLocality">{{ $row->locality }}</span>,
      				(<span itemprop="addressRegion">{{ $row->administrative_area_level_2_short }}</span>)
      				<meta itemprop="addressCountry" content="{{ $row->country_short}}" />
    			</div>

				{{--
				<ul class="list-inline">
					<li class="list-inline-item"><i class="fa fa-check"></i> Min $ 10,00</li>
					<li class="list-inline-item"><i class="fa fa-motorcycle"></i> 30 min</li>
				</ul>
				--}}
			</div>
			{{-- end:Entry description --}}
		</div>
		<div class="col-sm-12 col-md-12 col-lg-4 text-xs-center">
			<div class="right-content bg-white">
				<div class="right-review">
					{{--
					<div class="rating-block">
						@for($i=0;$i<$row->rating_avg;$i++)
						<i class="fa fa-star"></i>
						@endfor
						@for($i=$row->rating_avg;$i<5;$i++)
						<i class="fa fa-star-o"></i>
						@endfor
					</div>
					<a href="{{ $row->url }}" class="btn theme-btn-dash">View Restaurants</a>
					--}}
					<p>{{-- non c'e' la relazione location_x_restaurant  $row->relatedCount('restaurant') --}}
						{{-- $row->restaurants_count --}}
					</p>
					@if(is_array($row->tabs))
						@foreach($row->tabs as $tab)
							<a href="{{ $row->url }}/{{ $tab }}" class="btn theme-btn-dash">@lang('pub_theme::location.show.tab.'.$tab)</a>
						@endforeach
					@endif
				</div>
			</div>
			{{-- end:right info --}}
		</div>
	</div>
	{{--end:row --}}
</div>
