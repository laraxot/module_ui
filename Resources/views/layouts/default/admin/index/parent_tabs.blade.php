<div class="menu-rest">
    @php
        //dddx($params);
        //$tabs=['restaurant','cuisineCat'];
        if (!is_array($tabs)) {
            return;
        }
        $current_tab = $row->post_type;
        $trad = str_replace('.' . $row->post_type . '.index', '', $view);
    @endphp
    <ul class="nav nav-pills mb-3 nav-justified" id="pills-tab" role="tablist">
        <li class="nav-item">
            {{-- dddx(get_class($second_last))
			[{{ get_class($second_last) }}][{{ $second_last->show_url }}] --}}
            <a class="nav-link btn btn-secondary" href="{{ $second_last->show_url }}">
                @lang($trad.'.tab.content')
            </a>
        </li>
        @foreach ($tabs as $k => $tab)
            @php
                switch ($routename) {
                    case 'containers.index':
                        $parz = $params;
                        $parz['container0'] = $tab;
                        $route = route('containers.index', $parz);
                        break;
                    case 'containers.index':
                        $parz = $params;
                        $parz['container1'] = $tab;
                        $route = route('containers.index', $parz);
                        break;
                    case 'containers.index':
                        $parz = $params;
                        $parz['container2'] = $tab;
                        $route = route('containers.index', $parz);
                        break;
                    case 'containers.index':
                        $parz = $params;
                        $parz['container3'] = $tab;
                        $route = route('containers.index', $parz);
                        break;
                    default:
                        dddx($routename);
                        break;
                }
            @endphp
            <li class="nav-item">
                <a class="btn btn-secondary nav-link {{ $tab == $current_tab ? 'active' : '' }}" href="{{ $route }}"
                    role="tab" aria-controls="pills-menu" aria-selected="{{ $tab == $current_tab ? 'true' : 'false' }}">
                    @lang('pub_theme::'.$second_last->post_type.'.tab.'.$tab)
                    {{-- @lang($trad.'.tab.'.$tab)
				@lang($view.'.tab.'.$tab)
				<span class="badge badge-primary pull-right">
					@php
						$plural=str_plural($tab);
						$q=$second_last->linked->$plural->count();
					@endphp
					{{ $q }}
				</span> --}}
                </a>
                {{-- [{{ $current_tab }}] --}}
            </li>
        @endforeach
    </ul>
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" role="tabpanel" aria-labelledby="pills-menu-tab">
            <div class="container m-t-30">
                <div class="row">
                    {{-- @include('pub_theme::restaurant.show.tabs.'.$current_tab)
					@include('pub_theme::restaurant.'.$current_tab.'.tabs.show') --}}
                </div>
            </div>
        </div>
    </div>
</div>
