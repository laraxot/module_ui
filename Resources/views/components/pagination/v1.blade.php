{{--
@if (view()->exists('adm_theme::layouts.partials.pagination'))
{{ $rows->appends(request()->query())->links('adm_theme::layouts.partials.pagination') }}
@else
{{ $rows->appends(request()->query())->links() }}
@endif
--}}
{{ $rows->appends(request()->query())->links() }}
