<div class="row">
    <div class="col" style="overflow:auto">
        @foreach($rows as $k=>$v)
                @include($_layout->item_view,['key'=>$k,'row'=>$v])
		@endforeach
		{{ $rows->appends(request()->query())->links() }}
	</div>
</div>
