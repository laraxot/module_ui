<div class="menu-rest">
    @php
        //$tabs=['restaurant','cuisineCat'];
        $current_tab = $row->post_type;
        //dddx($view);
        $trad = str_replace($row->post_type . '.edit', $row->post_type, $view);
    @endphp
    <ul class="nav nav-pills mb-3 nav-justified" id="pills-tab" role="tablist">
        {{-- <li class="nav-item">
			<a class="nav-link btn btn-secondary active">
				@lang($trad.'.tab.content')
				<span class="badge pull-right">
					<i class="fa fa-pencil"></i>
				</span>
			</a>
		</li> --}}
        @foreach ($tabs as $k => $tab)
            @php
                switch ($routename) {
                    case 'containers.edit':
                        $route = route('containers.index_edit', array_merge($params, ['container1' => $tab]));
                        break;
                    case 'containers.edit':
                        //$route=route('containers.index_edit',array_merge($params,['container2'=>$tab]));
                        $route = '#';
                        break;
                    case 'containers.index_edit':
                        //containers.container2.container3.index_edit] not defined
                        //dddx($row->post);
                        $route = route('containers.index_edit', array_merge($params, ['item2' => $row->post, 'container3' => $tab]));
                        break;
                    default:
                        $route = '#' . $routename; //containers.index_edit
                        //dddx($routename);
                        break;
                }
            @endphp
            <li class="nav-item">
                <a class="nav-link btn btn-secondary {{ $tab == $current_tab ? 'active' : '' }}" href="{{ $route }}"
                    role="tab" aria-controls="pills-menu" aria-selected="{{ $tab == $current_tab ? 'true' : 'false' }}">
                    @lang($trad.'.tab.'.$tab)
                    <span class="badge pull-right">
                        <i class="fa fa-pencil"></i>
                    </span>
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
