@php
	Theme::add('theme/bc/jquery-ui/jquery-ui.min.js');
	Theme::add('theme/bc/jquery-ui/themes/base/jquery-ui.min.css');
	/*
	https://itsolutionstuff.com/post/jquery-draggable-sortable-table-rows-example-demo-with-bootstrapexample.html
	*/
@endphp
{!! Theme::showStyles(false) !!}
<style>
  	#sortable { list-style-type: none; margin: 0; padding: 0; width: 60%; }
  	#sortable li { margin: 0 5px 5px 5px; padding: 5px; font-size: 1.2em; height: 1.5em; }
  	html>body #sortable li { height: 1.5em; line-height: 1.2em; }
  	.ui-state-highlight { height: 1.5em; line-height: 1.2em; }
  	$('.ui-state-default').on('mousedown', function(){
		$(this).css( 'cursor', 'move' );
	}).on('mouseup', function(){
		$(this).css( 'cursor', 'auto' );
	});;

</style>
<ul id="sortable">
	@foreach($rows as $row)
		<li class="ui-state-default" id="{{ $row->post_id }}">
			<span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
			[{{ $row->post_id }}] {{ $row->title }}
		</li>
	@endforeach
</ul>

<form action="{{ Request::url() }}" method="POST">
	@csrf
	@method('POST')
	<input type="hidden" name="order_list" value="{{$order_list}}"/>
	<input type="submit" value="save" class="btn btn-primary"/>
</form>
<quote>Per vedere le modifiche poi devi ricaricare la pagina.</quote>


{!! Theme::showScripts(false) !!}
<script>
	$(function() {
		$( "#sortable" ).sortable({
			placeholder: "ui-state-highlight",
			update: function (event, ui) {
				var $list =  $(this).sortable("toArray").join("|");
				//var sortable_data = $(this).sortable('serialize');
				//alert(sortable_data);// non va
				//alert(list); //funziona
				$('input[name="order_list"]').val($list);
				/*
				 $.ajax({   url: "/persistListOrder.php",
                                      data: {
                                                  'section':this.id,
                                                  'components': list
                                            }
                                  });
                */
			}
		});
		$( "#sortable" ).disableSelection();
	});
</script>
