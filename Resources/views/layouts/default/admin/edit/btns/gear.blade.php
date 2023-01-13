@can('show', $row)
    <div class="color-palate">
        <div class="color-trigger">
            <i class="fa fa-gear"></i>
        </div>
        <div class="color-palate-head">
            <h6>@lang($view_default.'.manage')</h6>
        </div>
        <br>
        <div class="palate-foo">
            @if (!isset($params['container1']))
                <a href="{{ route('containers.show', $params) }}" class="btn theme-btn">
                    @lang($view_default.'.view_page')<i class="fa fa-show"></i>
                </a>
            @else
                <a href="{{ route('containers.show', $params) }}" class="btn theme-btn">
                    @lang($view_default.'.view_page')<i class="fa fa-show"></i>
                </a>
            @endif
            {{-- <span>You will find much more options</span> --}}
            @include('pub_theme::layouts.partials.btns.translate_manager')

        </div>
    </div>
    {{ Theme::add('theme/pub/js/color-settings.js') }}
    {{ Theme::add('theme/pub/css/color-switcher-design.css') }}
@else
    {{-- dddx('no diritto ??') --}}
@endcan
