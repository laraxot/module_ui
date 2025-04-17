@php
$item_view = $view . '.item.' . snake_case($row->post_type);
$item_view_default = $view_default . '.item.' . snake_case($row->post_type);
$item_view_extend = $view_extend . '.item.' . snake_case($row->post_type);
if (!\View::exists($item_view) && !\View::exists($item_view_default) /*&& !\View::exists($item_view_extend)*/) {
    dddx('not exist [' . $item_view . '] [' . $item_view_default . '] ');
}
/*
 $add_item_view=$view.'.item.add.'.snake_case($row->post_type);
 $add_item_view_default=$view_default.'.item.add.'.snake_case($row->post_type);
 if(!\View::exists($add_item_view) && !\View::exists($add_item_view_default)){
  dddx('not exist ['.$add_item_view.'] ['.$add_item_view_default.']');
 }
 */
@endphp
{!! Form::bsBtnCreate(['txt' => __($item_view . '.btn.new')]) !!}
@foreach ($rows as $key => $row)
    @includeFirst(
    [
    $item_view,
    $item_view_default,
    $item_view_extend,
    ],
    ['key'=>$key,'row'=>$row]
    )
@endforeach
{{ $rows->links('pub_theme::layouts.partials.pagination') }}

{{-- dddx($row->linkable) row->linkable solo perche' sono in index_edit --}}
{{-- messo in un modalajax
@can('update-translate', $item0)
<a class="btn btn-primary" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">Toggle Translations</a>
<div class="collapse multi-collapse" id="multiCollapseExample1">
<form action="{{ url('/it/home') }}" method="POST">
	@csrf
@foreach (Theme::__getStatic('langs') as $k => $v)
	<label>{{$k}}</label>
	<input type="text" name="trans[{{ $k }}]" value="{{ $v }}" class="form-control"><br/>
@endforeach
<input type="submit" value="aggiorna" >
</form>
</div>
@endcan --}}
