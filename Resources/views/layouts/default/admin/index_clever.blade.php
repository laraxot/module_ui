@extends('adm_theme::layouts.app')
@section('content')
    {{-- <x-topbar /> --}}

    {!! $_panel->indexNav() !!}
    <x-include-view view="inner_page" :vars="get_defined_vars()" />

    @component('ui::components.crud', get_defined_vars())
        @slot('content')
            <x-include-view view="topbar" :vars="get_defined_vars()" />
            <!-- Table -->
            <div class="card">
                <div class="card-header border-bottom d-flex align-items-center">

                    <h5 class="me-auto">
                        <span class="primary-color"><strong>{{ number_format($rows->total(), 0, ',', ' ') }}</strong></span>
                        {{ Str::plural($row->post_type ?? class_basename($row), $rows->total()) }}
                    </h5>
                </div>
                <x-panel.crud :panel="$_panel" />
            </div>
        @endslot
    @endcomponent
@endsection
