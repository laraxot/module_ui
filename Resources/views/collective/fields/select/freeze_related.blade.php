@php
	$class=$field->related_class;
	if(class_exists($class)){
		$obj=$class::find($field->value);
		if(!is_object($obj)){
			$obj=new \stdClass();
			$obj->nome='Not Exists ['.$class.']['.$field->value.']';
		}else{
			if($obj->nome==''){
				$obj_panel=Panel::make()->get($obj);
				$obj->nome=$obj_panel->optionLabel($obj);
			}
		}
	}else{
		$obj=new \stdClass();
		$obj->nome='Not Exists ['.$class.']';
	}


@endphp
{{ $field->value }}]{{ $obj->nome }}
