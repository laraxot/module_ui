@extends('adm_theme::layouts.app')
@section('content')
    <x-topbar />
    @component('ui::components.crud', get_defined_vars())
        @slot('content')
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
