@php
	$field->title='ROOT';
	if($field->value!=0){
		$class=get_class($row);
		//$r=$class::where('id',$field->value)->first();
		$r=$class::find($field->value);
		$field->title='-- sconosciuto o cancellato --';
		if(is_object($r)){
			$field->title=$r->title;
		}
	}
@endphp
{{ $field->value }} {{ $field->title }}