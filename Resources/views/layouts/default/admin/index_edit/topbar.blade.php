@php
//dddx(get_defined_vars());
@endphp
<div class="row text-dark" style="background-color: #e9ecef; padding:5px; ">
    {{-- {!! Form::bsBtnCreateAttach(['row'=>$row]) !!} --}}
    {!! $_panel->btnHtml(['act' => 'create']) !!}
    {{-- @can('create', $row)
	<a data-href="{{ Panel::make()->get($row)->url('create') }}" class="btn btn-primary" data-toggle="modal" data-target="#myModalAjax" data-title="plus">
		<i class="fa fa-plus"></i>
	</a>
    @endcan --}}
    @foreach ($_panel->containerActions() as $act)
        {!! $act->btn() !!}
    @endforeach

    <div class="col">
        <p>
            <span class="primary-color"><strong>{{ number_format($rows->total(), 0, ',', ' ') }}</strong></span>
            {{ Str::plural($row->post_type ?? class_basename($row), $rows->total()) }}
        </p>
    </div>

    @include('theme::includes.components.form_complete.search')
    @include('theme::includes.components.form_complete.order_by')
</div>
