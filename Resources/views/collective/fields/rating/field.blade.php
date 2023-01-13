@php
	//--- molto simile al pivot fields --//
	$field=transFields(get_defined_vars());
	$model=Form::getModel();
	$rating_objectives=$model->ratingObjectives;
    $rows=$model->$name;
    $rows_arr=[];
    if(is_object($rows)){
        $rows_arr=$rows->keyBy('post_id')->toArray();
    }
	$user_id=Auth::id();
@endphp
@foreach($rating_objectives as $ro)
	@isset($ro->post)
		@php
			$input_type='text';
			$input_name=$name.'.'.$ro->post_id.'.pivot.'.'rating';
			$input_name=dottedToBrackets($input_name);
			$input_value=Arr::get($rows_arr,$ro->post_id.'.pivot.rating');
			$input_attrs=['label'=>$ro->title];
        @endphp
		{{ Form::bsDecimalJqStar($input_name,$input_value,$input_attrs) }}
		<input type="hidden" name="{{ $name }}[{{ $ro->post_id }}][pivot][user_id]" value="{{ $user_id }}" />
	@endisset
@endforeach
