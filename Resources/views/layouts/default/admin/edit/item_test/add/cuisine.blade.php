@php
	Theme::addSelect2();
	$action=route('containers.store',array_merge($params,['container1'=>'cuisine']));
@endphp
<form method="POST" action="{{ $action }}" {{--  class="form-inline" --}} role="form">
	@csrf
	<input type="hidden" name="_action" value="come_back" />
	<div class="input-group">
		<select class="form-control select2ajax" name="title" data-tags="true"
		data-placeholder="Aggiungi Categoria Piatto" data-allow-clear="true"
		data-ajax--url="{{ url('/it/cuisine') }}" data-ajax--cache="true" >
		</select>
		@if ($errors->any())
			<div class="alert">
				@foreach ($errors->all() as $error)
					<strong>{{ $error }}</strong>
				@endforeach
			</div>
		@endif
		<span class="input-group-append">
			<button class="btn btn-primary btn-sm" type="submit">
				<i class="fa fa-plus"></i>
			</button>
		</span>
	</div>
</form>

