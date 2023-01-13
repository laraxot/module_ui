@php
	$recipe_curr=collect($params)->where('type','recipe')->last();
@endphp
<div class="food-item {{$key%2?'white':''  }}">
	<div class="row">
		<div class="col-xs-12 col-sm-6 col-lg-6">
			{{--
			<div class="item-img pull-left">
				<a class="restaurant-logo pull-left" href="#">
					<img src="http://placehold.it/70x70" alt="Food logo">
				</a>
			</div>
			<!-- end:Logo -->
			<div class="rest-descr">
				<h6><a href="#">Sandwich de Alegranza Grande Menü (28 - 30 cm.)</a></h6>
			</div>
			<!-- end:Description -->
			--}}
			<b>{{ $ingredient->title }}</b>
				<p>{{ $ingredient->subtitle }}</p>
		</div>
		<!-- end:col -->
		<div class="col-xs-6 col-sm-2 col-lg-2 text-xs-center"> <span class="price pull-left">€ {{ number_format($ingredient->pivot->price,2) }}</span></div>
		<div class="col-xs-6 col-sm-4 col-lg-4">
			<div class="row no-gutter">
				{{--
				<div class="col-xs-7">
					<select class="form-control b-r-0" id="exampleSelect2">
						<option>Size SM</option>
						<option>Size LG</option>
						<option>Size XL</option>
					</select>
				</div>
				--}}
				<div class="col-xs-5 ingredient-item"> {{-- ingredient-item mi serve per jquery --}}
					<input class="form-control ingredient-qty" type="number" value="0" name="son[{{$ingredient->pivot->id}}][qty]">
					<input class="form-control ingredient-price" type="hidden" value="{{ $ingredient->pivot->price }}" name="son[{{$ingredient->pivot->id}}][price]">
				</div>
			</div>
		</div>
	</div>
	<!-- end:row -->
</div>