@php
	$field=transFields(get_defined_vars());
	$name_date=dottedToBrackets(bracketsToDotted($name).'_date');
	$name_time=dottedToBrackets(bracketsToDotted($name).'_time');
	$val=Form::getValueAttribute($name);
	if($val==null) $val=Carbon\Carbon::now();
	$val1=$val->format('d/m/Y H:i');
@endphp

<div style="display:none">
{{ Form::bsText($name,$val1) }}
</div>
<div class="row">
	<div class="col-sm-6">{{ Form::bsDate($name_date,$val) }}</div>
	<div class="col-sm-6">{{ Form::bsTime($name_time,$val) }}</div>
</div>

@push('scripts')
<script>
	$('#{{ $name_date }},#{{ $name_time }}').on( "change", function() {
		$date=$('#{{ $name_date }}').val();
		$time=$('#{{ $name_time }}').val();
		$('#{{ $name }}').val($date+' '+$time);
	});
</script>
@endpush

