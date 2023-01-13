@php
$last_item=last($items);
$last_container=last($containers);
$types=Str::camel(Str::plural($last_container));

$field=(object)[
	'name'=>'areas',
	'type'=>'PivotFields',
];
@endphp

{!! Form::bsBtnCreate(['row'=>$row]) !!}
@foreach($rows as $key=>$row)
	@include($_layout->item_view,['key'=>$key,'row'=>$row])
@endforeach
{{ $rows->links() }}



