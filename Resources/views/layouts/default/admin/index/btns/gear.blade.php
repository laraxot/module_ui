{{-- {{ dddx($second_last) }}
@if (isset($second_last))
nel caso di ristorante /cuisine
cuisine puo' essere vuoro percio' l'edit va sul padre ovvero sul penultimo oggetto
@can('edit', $second_last)
<div class="color-palate">
	<div class="color-trigger">
		<i class="fa fa-gear"></i>
	</div>
	<div class="color-palate-head">
		<h6>@lang($view_default.'.show.manage')</h6>
	</div>
	<br>
	<div class="palate-foo">
		<a href="{{ $row->index_edit_url }}" class="btn theme-btn" >
		@lang($view_default.'.show.edit_page') <i class="fa fa-edit"></i>
		</a>
		<span>@lang($view_default.'.show.more_opt')</span>
	</div>
</div>
{{ Theme::add('theme/pub/js/color-settings.js') }}
{{ Theme::add('theme/pub/css/color-switcher-design.css') }}
@endcan
@endif --}}
