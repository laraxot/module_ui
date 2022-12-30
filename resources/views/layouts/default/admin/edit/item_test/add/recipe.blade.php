@php
	Theme::addSelect2();
	$action=route('containers.store',array_merge($params,['container1'=>'cuisine','item1'=>$cuisine->guid,'container2'=>'recipe']));
@endphp
<form method="POST" action="{{ $action }}" {{--  class="form-inline" --}} role="form">
	@csrf
	<input type="hidden" name="_action" value="come_back" />
	<div class="input-group">
		<select class="form-control select2ajax" name="title" data-tags="true"
		data-placeholder="Aggiungi Piatto"
		data-allow-clear="true" data-ajax--url="{{ url('/it/recipe')}}" data-ajax--cache="true" ></select>
		<input type="number" name="pivot[price]" placeholder="prezzo" step="0.01">
		<span class="input-group-btn">
			<button class="btn btn-primary btn-sm" type="submit">
				<i class="fa fa-plus"></i>
			</button>
		</span>
	</div>
</form>