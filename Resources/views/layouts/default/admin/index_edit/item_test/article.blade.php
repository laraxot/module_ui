<!-- Each popular food item starts -->
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 food-item">
	<div class="food-item-wrap">
		<div class="figure-wrap bg-image" data-image-src="{{ $row->imageResizeSrc(['width'=>380,'height'=>210]) }}">
			{{--
			<div class="distance">
				<i class="fa fa-pin"></i>1240m
			</div>
			--}}
			{{--
			<div class="rating pull-left">
				<i class="fa fa-star"></i>
				<i class="fa fa-star"></i>
				<i class="fa fa-star"></i>
				<i class="fa fa-star"></i>
				<i class="fa fa-star-o"></i>
			</div>
			<div class="review pull-right"><a href="#">198 reviews</a> </div>
			--}}
		</div>

		<div class="content">
			<h5><a href="{{ $row->url }}">{{ $row->title }}</a></h5>
			<div class="product-name">{{ $row->subtitle }}</div>
			<p>{{ $row->txt }}</p>

			<div class="price-btn-block">
				{{--  <span class="price">$ 15,99</span> --}}
				<a href="{{ $row->url }}" class="btn theme-btn-dash pull-right">Read</a>
				<div class="pull-right">
				{!! Form::bsBtnCrud(['row'=>$row]) !!}
				<div>
			</div>

		</div>
		{{--
		<div class="restaurant-block">
			<div class="left">
				<a class="pull-left" href="#"> <img src="http://placehold.it/50x46" alt="Restaurant logo"> </a>
				<div class="pull-left right-text"> <a href="#">Chicken Restaurant</a> <span>68 5th Avenue New York</span> </div>
			</div>
		</div>
		--}}
	</div>
</div>
