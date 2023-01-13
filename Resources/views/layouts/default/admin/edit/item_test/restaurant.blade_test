@php
	$tabs=['menu','photo','article','contact','map'];
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
				<br/>
				<i class="fa fa-cutlery" aria-hidden="true"></i>
				@php
					$cuisineCats=$row->cuisineCats;
				@endphp
				@foreach($cuisineCats as $cuisineCat)
				<span itemprop="servesCuisine">{{ $cuisineCat->title }}</span>,
				@endforeach
				<br/>
				<div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
					<i class="fa fa-map-marker" aria-hidden="true"></i>
      				<span itemprop="postalCode">{{ $row->postal_code }}</span>
      				<span itemprop="addressLocality">{{ $row->locality }}</span>,
      				(<span itemprop="addressRegion">{{ $row->administrative_area_level_2_short }}</span>)
      				<meta itemprop="addressCountry" content="{{ $row->country_short}}" /> 
    			</div>
				
				{{--
				@include('pub_theme::layouts.partials.item.address',['linked'=>$row->linked])
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
					--}}

					@foreach($tabs as $tab)											
					<a href="{{ $row->url }}/{{ $tab }}/edit" class="btn theme-btn-dash">@lang('pub_theme::restaurant.show.'.$tab)</a>
					@endforeach 
				</div>
			</div>
			<!-- end:right info -->
		</div>
	</div>
</div>
