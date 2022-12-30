<div class="menu-rest">
    @php
        if (!is_array($tabs)) {
            return;
        }
        //$tabs=['restaurant','cuisineCat'];
        $current_tab = $row->post_type;
        $trad = str_replace('' . $row->post_type . '.show', $row->post_type, $view);
        //dddx($trad);
    @endphp
    <ul itemprop="WebPageElement" itemscope itemtype="http://schema.org/SiteNavigationElement"
        class="nav nav-pills mb-3 nav-justified" id="pills-tab" role="tablist">
        <li class="nav-item">
            <meta itemprop="url" content="{{ $row->show }}" />
            <a class="nav-link active" href="{{ $row->show }}">
                <span itemprop="name">@lang($trad.'.tab.content')</span>
            </a>
        </li>
        @foreach ($tabs as $k => $tab)
            @php
                switch ($routename) {
                    case 'containers.show':
                        $route = route('containers.index', array_merge($params, ['container1' => $tab]));
                        break;
                    case 'containers.show':
                        $route = route('containers.index', array_merge($params, ['container2' => $tab]));
                        $route = str_replace('cuisinecat', 'cuisineCat', $route);
                        break;
                    case 'containers.show':
                        $route = route('containers.index', array_merge($params, ['container3' => $tab]));
                        $route = str_replace('cuisinecat', 'cuisineCat', $route);
                        break;

                    default:
                        $route = '#[' . __LINE__ . '][' . __FILE__ . ']';
                        break;
                }

            @endphp
            <li class="nav-item">
                <meta itemprop="url" content="{{ $route }}" />
                <a class="nav-link {{ $tab == $current_tab ? 'active' : '' }}" href="{{ $route }}" role="tab"
                    aria-controls="pills-menu" aria-selected="{{ $tab == $current_tab ? 'true' : 'false' }}"><span
                        itemprop="name">@lang($trad.'.tab.'.$tab)</span></a>
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
