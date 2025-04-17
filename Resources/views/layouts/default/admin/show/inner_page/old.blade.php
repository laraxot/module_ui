<section class="inner-page-hero bg-image" data-image-src="{{ Theme::img_src($bg) }}" >
	<div class="profile">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12  col-md-4 col-lg-4 profile-img">
					<div class="image-wrap">
						<figure>
							{!! $row->image_html(['width'=>240,'height'=>140]) !!}
						</figure>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 profile-desc" style="background-color: black;opacity: 0.6;filter: alpha(opacity=50);">
					<div class="pull-left right-text white-txt">
						<h6><a href="{{ $row->url }}">{{ $row->title }}</a></h6> {{--  <a class="btn btn-small btn-green">Open</a> --}}
						<h2>{{ $row->subtitle }}</h2>
						<p style="">{!! ($row->txt) !!}</p>
						@if(isset($row->latitude)){
							<a href="{{ asset(App::getLocale().'/restaurant_map?lat='.$row->latitude.'&lng='.$row->longitude)}}">Show on Map</a>
						}
						@endif
						{{--
						<ul class="nav nav-inline">
							<li class="nav-item"> <a class="nav-link active" href="#"><i class="fa fa-check"></i> Min $ 10,00</a> </li>
							<li class="nav-item"> <a class="nav-link" href="#"><i class="fa fa-motorcycle"></i> 30 min</a> </li>
							<li class="nav-item ratings">
								<a class="nav-link" href="#"> <span>
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star-o"></i>
						</span> </a>
							</li>
						</ul>
						--}}
					</div>
				</div>
			</div>
		</div>
	</div>
</section>