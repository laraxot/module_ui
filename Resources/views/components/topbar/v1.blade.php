<header>
    <div class="container-fluid">
        <div class="border-bottom pt-6">
            <div class="row align-items-center">

                <div class="col-sm col-12">
                    <h1 class="h2 ls-tight">
                        {{--
                        <span class="d-inline-block me-3">👋</span>Hi, Tahlia!
                        --}}
                    </h1>
                    
                </div>

                <!-- Actions -->
                <div class="col-sm-auto col-12 mt-4 mt-sm-0">
                    <div class="hstack gap-2 justify-content-sm-end">
                        {{--
                        <a href="#modalExport" class="btn btn-sm btn-neutral border-base" data-bs-toggle="modal">
                            <span class="pe-2">
                                <i class="bi bi-people-fill"></i>
                            </span>
                            <span>Share</span>
                        </a>
                        <a href="#offcanvasCreate" class="btn btn-sm btn-primary" data-bs-toggle="offcanvas">
                            <span class="pe-2">
                                <i class="bi bi-plus-square-dotted"></i>
                            </span>
                            <span>Create</span>
                        </a>
                        --}}
                        {{--
                        @foreach ($_panel->containerActions() as $act)
                        
                        @php
                            try {
                                echo $act->btnHtml();
                            } catch (\Exception $e) {
                                //dddx(['act'=>$act,'e'=>$e]);
                            }
                        @endphp
                        @endforeach
                        --}}
                        <x-panel.actions.buttons :acts="$_panel->containerActions()" />
                        
                    </div>
                </div>
            </div>

            @foreach($_panel->getTabs() as $lvl)
            <!-- Nav -->
            <ul class="nav nav-tabs overflow-x border-0">
                @foreach($lvl as $v)
                
                <li class="nav-item">
                    <a href="{{ $v->url }}" class="nav-link {{$v->active?'active':'' }} ">{{ $v->title }}</a>
                </li>
                @endforeach
                {{--
                <li class="nav-item">
                    <a href="#" class="nav-link">Most recent</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">Popular</a>
                </li>
                --}}
            </ul>
            @endforeach 
        </div>
    </div>
</header>
