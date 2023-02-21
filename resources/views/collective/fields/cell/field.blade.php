@php
	$fields=$attributes['fields'];
	$model=Form::getModel();
	$disabled=isset($attributes['disabled'])?'disabled':'';
	
	/*
	$fields=collect($fields)->filter(function($item) {
		dddx($item);
		if(!isset($item->except)) $item->except=[];
		return (
			//!in_array($item->type,['Password']) &&
			   !in_array('edit',$item->except)  //controllare azione route
			//&& !in_array($item->name,$excepts)
		);
	})->all();
	*/
	if($disabled){
		
		$fields=$fields->toCollection()->map(
			function($item){
				
				if(!isset($item->attributes)){
					$item->attributes=[];
				}
				$item->attributes=array_merge($item->attributes,['readonly'=>'readonly']);
				return $item;
			}
		);
		$fields=\Modules\UI\Datas\FieldData::collection($fields);
		
	}

@endphp

{{--  
<fieldset class="form-group container-fluid border p-2" >
    <legend class="col-form-label col-sm-2 pt-0 w-auto"><h4>{{ $name }}</h4></legend>
	<div class="row">
    @foreach($fields as $field)
    	{!! Theme::inputHtml($field,$model) !!}
    @endforeach
	</div>
</fieldset>
--}}
<x-std tpl="fieldset">
	<x-std tpl="legend">
		<h4>{{ $name }}</h4>
	</x-std>
	<div class="row">
    @foreach($fields as $field)
    	{!! Theme::inputHtml($field,$model) !!}
    @endforeach
	</div>
</x-std>
