@can('edit',$row)
<div class="color-palate">
	<div class="color-trigger">
		<i class="fa fa-gear"></i>
	</div>
	<div class="color-palate-head">
		<h6>Gestisci</h6>
	</div>
	<br>
	<div class="palate-foo">
		@if(!isset($params['container1']))
		<a href="{{ route('containers.edit',$params) }}" class="btn theme-btn" >
		vai alla pagina di modifica <i class="fa fa-edit"></i>
		</a>
		@else
		<a href="{{ route('containers.index_edit',$params) }}" class="btn theme-btn" >
		vai alla pagina di modifica.<i class="fa fa-edit"></i>
		</a>
		@endif
		<span>You will find much more options</span>
	</div>
</div>
{{ Theme::add('theme/pub/js/color-settings.js') }}
{{ Theme::add('theme/pub/css/color-switcher-design.css') }}
@endcan

