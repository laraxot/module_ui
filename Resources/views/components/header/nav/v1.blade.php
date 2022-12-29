<header class="header">
    <!-- Navbar-->
    <nav class="navbar navbar-expand-lg fixed-top shadow navbar-light bg-white">
        <div class="container-fluid">
            <div class="d-flex align-items-center">
                <a class="navbar-brand py-1" href="{{ url('') }}">
                    <img src="{{ Theme::asset(Theme::metatag('logo_img')) }}" alt="" />
                </a>
                <form class="form-inline d-none d-sm-flex" action="{{ $search_action }}" id="search" method="GET">
                    <div class="input-label-absolute input-label-absolute-left input-expand ms-lg-2 ms-xl-3">
                        <label class="label-absolute" for="search_search"><i class="fa fa-search"></i><span
                                class="sr-only">What are you looking for?</span></label>
                        <input type="hidden" name="filter[0][criteria]" value="query_string_query">
                        @php
                            $max_search_days = $profile->getProfile()->max_search_days ?? 365;
                        @endphp
                        <input type="hidden" name="date_from" value="{{ date('Y-m-d', strtotime('-'.$max_search_days.' days')) }}">
                        <input type="hidden" name="date_to" value="{{ date('Y-m-d') }}">
                        <input type="hidden" name="order_by" value="desc">
                        <input class="form-control form-control-sm border-0 shadow-0 bg-gray-200" id="search_search"
                            placeholder="Search" aria-label="Search" type="search" name="filter[0][q]" />
                    </div>
                </form>

                @if ($adv === true)
                    {{--<button class="btn btn-info"
                        onclick="Livewire.emit('showModal','elastic_advanced_search',[])">{{ $text }}</button>--}}
                        <a href="/it/presses?filter[0][criteria]=query_string_query&date_from=&date_to=&order_by=desc&filter[0][q]=" class="btn btn-primary">{{ $text }}</a>
                @endif
            </div>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
                aria-label="Toggle navigation"><i class="fa fa-bars"></i></button>
            <x-navbar.collapse menuName="navbar"></x-navbar.collapse>
        </div>
    </nav>
    <!-- /Navbar -->
</header>
@push('modals')
    <livewire:modal.body-view show="false" id="elastic_advanced_search" title="Advanced Search" subtitle=""
        bodyView="theme::livewire.elastic.filter.v2">
    </livewire:modal.body-view>
@endpush
