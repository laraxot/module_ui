@php
	Theme::addSelect2();
	$action=route('containers.store',array_merge($params,['container1'=>'cuisine','item1'=>$cuisine->guid,'container2'=>'recipe']));
@endphp
{{--
<p style="color:black">
<br/>store1:{{ $action }}
<br/>store2:{{ $cuisine->store_url }}
</p>
--}}
<form method="POST" action="{{ $action }}" {{--  class="form-inline" --}} role="form">
	@csrf
	<input type="hidden" name="_action" value="come_back" />
	{{--
	<div class="input-group">
	--}}
		<select class="form-control select2ajax" name="title" data-tags="true"
		data-placeholder="Aggiungi Piatto"
		data-allow-clear="true" data-ajax--url="{{ url('/it/recipe')}}" data-ajax--cache="true" ></select>
		<input type="text" name="subtitle" class="form-control" placeholder="descrizione corta" />
		<input type="number" name="pivot[price]" class="form-control" placeholder="prezzo" step="0.01" />
		<span class="input-group-btn">
			<button class="btn btn-primary btn-sm" type="submit">
				<i class="fa fa-plus"></i>
			</button>
			<button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModalAjax" data-title="ordinamento" data-href="{{ $action }}/order">
				<i class="fa fa-arrows-v" aria-hidden="true"></i>
			</button>
		</span>
	{{--
	</div>
	--}}
</form>