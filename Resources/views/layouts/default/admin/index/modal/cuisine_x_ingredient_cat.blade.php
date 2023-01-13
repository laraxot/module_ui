<!-- Modal -->
<div class="modal fade" id="order-modal{{ $cuisine->post_id }}" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			 <div class="modal-header">
        		<h5 class="modal-title">Modal title</h5>
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          			<span aria-hidden="true">&times;</span>
        		</button>
      		</div>
			<div class="modal-body cart-addon">
				@foreach($cuisine->ingredientCats as $ingredientCat)
					@include($view_default.'.item.cuisine_x_ingredient_cat',['key'=>$key,'ingredientCat'=>$ingredientCat,'cuisine'=>$cuisine])
				@endforeach
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn theme-btn">Add to cart</button>
			</div>
		</div>
	</div>
</div>
