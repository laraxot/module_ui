@php
	$action=route('containers.store',array_merge($params,['container1'=>'opening_hour']));
@endphp

<form method="POST" action="{{ $action }}" {{--  class="form-inline" --}} role="form">
	@csrf
	<input type="hidden" name="_action" value="come_back" />
		{{--
	<div class="input-group">
		<select name='day_of_week' class="form-control">
			<option value="">---</option>
			@for($i=0;$i<7;$i++)
			<option value="{{ $i }}">{{ $daynames[$i] }}</option>
			@endfor
		</select>
		--}}
		{{ Form::bsSelectDay('day_of_week') }}
		{{ Form::bsWeareoutmanClock('open_at') }}
		{{ Form::bsWeareoutmanClock('close_at') }}
		{{--
		<span class="input-group-btn">
		--}}
            <button class="btn btn-primary btn-sm" type="submit">
                <i class="fa fa-plus"></i>
            </button>
     {{--
        </span>
	</div>
	--}}

</form>