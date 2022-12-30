@php
$recipe_curr=collect($params)->where('type','recipe')->last();
@endphp
{!! Form::bsOpen($cart_item->getLinkedModel(),'store') !!}
<div class="row">
	<div class="col-xs-12 col-sm-6 col-lg-6">
		<b>{{$recipe_curr->title}}</b>
	</div>
	<div class="col-xs-6 col-sm-2 col-lg-2 text-xs-center">
		<span class="price pull-left">€ {{ number_format($recipe_curr->pivot->price,2) }}</span>
	</div>
	<div class="col-xs-6 col-sm-4 col-lg-4">
		<input type="hidden" name="pivot_id" value="{{ $recipe_curr->pivot->id }}">
		<input class="form-control" type="number" value="1" id="qty">
	</div>
	<div style="display:none">
		<span id="price">{{ $recipe_curr->pivot->price }}</span>
	</div>
</div>
{{--
<span id="price">
	{{ $recipe_curr->pivot->price }}
</span>
--}}