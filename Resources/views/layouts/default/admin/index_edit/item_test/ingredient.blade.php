<div class="food-item {{ $key%2?'white':'' }}">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-lg-8">
			@if($row->image_src!="")
			<div class="rest-logo pull-left">
				<a class="restaurant-logo pull-left" href="{{ $row->url }}">
					{!! $row->image_html(['width'=>100,'height'=>80]) !!}
				</a>
			</div>
			<div class="rest-descr">
				<b>{{ $row->title }}</b>
				<p>{{ $row->subtitle }}</p>
			</div>
			@else
			<b>{{ $row->title }}</b>
			<p>{{ $row->subtitle }}</p>
			@endif
		</div>
		<div class="col-xs-12 col-sm-12 col-lg-4 pull-right item-cart-info">
			<span class="price pull-left">€ {{ number_format($row->pivot->price,2) }}</span>
			{{--
			<a href="#" class="btn btn-small btn btn-secondary pull-right" data-toggle="modal" data-target="#order-modal{{ $cuisine->post_id }}">&#43;</a>
			--}}
		</div>
	</div>
</div>