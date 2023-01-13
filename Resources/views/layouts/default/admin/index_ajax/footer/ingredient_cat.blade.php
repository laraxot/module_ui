<div class="pull-right">
<h3>Totale :&euro; <span id="tot"></span></h3>
{{ Form::bsSubmit('salva') }}
</div>
{{ Form::close() }}
<script>
$(document).ready(function () {
	$('#qty').on("keyup", function(e) {
		updateTot();
	});
	$('.ingredient-qty').on("keyup", function(e) {
		updateTot();
	});
	//$('#tot').text(66);
});

function updateTot(){
	var $qty=$('#qty').val();
	var $price=$('#price').text();
	var $tot=$qty*$price;
	$('.ingredient-item').each(function( index ) {
		$tot+=$(this).find('.ingredient-qty').val() * $(this).find('.ingredient-price').val();
	});
	$('#tot').text($tot);
}

</script>