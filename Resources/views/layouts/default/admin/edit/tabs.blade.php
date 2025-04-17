@php
	//dd(get_class(Panel::make()->get($row)));
	//dddx(get_defined_vars());
@endphp

<div class="menu-rest">
	@foreach($tabs as $tabs_level)
	<ul class="nav nav-pills mb-3 nav-justified" id="pills-tab" role="tablist">
		@foreach($tabs_level as $k=>$v)
		<li class="nav-item">
			<a class="nav-link {{ $v->active?'active':'' }}" href="{{ url($v->url) }}">
				{{ $v->title }}
			</a>
		</li>
		@endforeach
	</ul>
	@endforeach
</div>
