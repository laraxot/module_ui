@php
$item_view = $view . '.item.' . snake_case($row->post_type);
$item_view_default = $view_default . '.item.' . snake_case($row->post_type);
$item_view_morph = $view_default . '.mitem.' . snake_case($row->post_type);
if (!\View::exists($item_view) && !\View::exists($item_view_default)) {
    dddx('not exist [' . $item_view . '] [' . $item_view_default . ']');
}
//$rows->load('related');
@endphp

{{-- 111 query 11 sec --}}
{{--  --}}
@foreach ($rows as $key => $row)
    @includeFirst([$item_view,$item_view_default],['key'=>$key,'row'=>$row])
@endforeach
{{ $rows->links('pub_theme::layouts.partials.pagination') }}
{{--  --}}
{{-- 31 query --}}
{{-- @foreach ($mrows as $key => $row)
	@includeFirst([$item_view,$item_view_morph,$item_view_default],['key'=>$key,'row'=>$row])
@endforeach
{{ $mrows->links('pub_theme::layouts.partials.pagination') }} --}}
