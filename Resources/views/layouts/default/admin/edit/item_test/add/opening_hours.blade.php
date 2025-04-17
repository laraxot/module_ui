@php
	$action=route('containers.store',array_merge($params,['container1'=>'opening_hour']));
@endphp

<form method="POST" action="{{ $action }}" {{--  class="form-inline" --}} role="form">
	@csrf
	<input type="hidden" name="_action" value="come_back" />
	<div class="input-group">
		<select name='day_of_week'>
			<option value="">---</option>
			@for($i=0;$i<7;$i++)
			<option value="{{ $i }}">{{ $daynames[$i] }}</option>
			@endfor
		</select>
		{{ Form::time('open_at') }}
		{{ Form::time('close_at') }}

		<span class="input-group-btn">
			<button class="btn btn-default btn-sm" type="submit">
				<i class="fa fa-plus"></i>
			</button>
		</span>
	</div>
</form>