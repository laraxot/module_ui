{{-- @include($view_work . '_clever') --}}
{{-- @include($view_work . current_theme_name()) --}}
@extends('adm_theme::layouts.app')
@section('content')
    {!! $_panel->indexNav() !!}
    <x-include-view view="inner_page" :vars="get_defined_vars()" />
    <header>
        <div class="container-fluid">
            {{-- <div class="border-bottom pt-6"> --}}
            <div class="row align-items-center">
                <div class="col-sm col-12">
                    <!-- Title -->
                    {{-- <h1 class="h2 ls-tight">
                            <span class="d-inline-block me-3">😎</span>My Cool Projects
                        </h1> --}}
                </div>
                <!-- Actions -->
                <div class="col-sm-auto col-12 mt-4 mt-sm-0">
                    <div class="hstack gap-2 justify-content-sm-end">
                        {{-- @foreach ($_panel->getActions('container') as $action)
                                <a href="#modalExport" class="btn btn-sm btn-neutral border-base" data-bs-toggle="modal">
                                    <span class="pe-2">
                                        <i class="bi bi-people-fill"></i>
                                    </span>
                                    <span>Share</span>
                                </a>
                                <x-button.action :action="$action"></x-button.action>
                            @endforeach --}}
                        <x-button.panel :panel="$_panel" type="create" />
                        {{-- <a href="#offcanvasCreate" class="btn btn-sm btn-primary" data-bs-toggle="offcanvas">
                                <span class="pe-2">
                                    <i class="bi bi-plus-square-dotted"></i>
                                </span>
                                <span>Create</span>
                            </a> --}}
                    </div>
                </div>
            </div>
            <!-- Nav -->
            {{-- <ul class="nav nav-tabs overflow-x border-0"> --}}
            {{-- <ul class="nav nav-tabs align-items-end card-header-tabs w-100">
                @foreach ($_panel->getTabs() as $level)
                    @foreach ($level as $tab)
                        <x-button.link :link="$tab" tpl="tab" />
                        <li class="nav-item">
                                <a href="#" class="nav-link active">View all</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">Most recent</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">Popular</a>
                            </li>
                    @endforeach

                    &nbsp;
                @endforeach
            </ul> --}}
            <x-navbar.container tpl="horizontal">
                @foreach ($_panel->getTabs() as $level)
                    @foreach ($level as $tab)
                        <x-button.link :link="$tab" tpl="tab" />
                        {{-- <li class="nav-item">
                                <a href="#" class="nav-link active">View all</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">Most recent</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">Popular</a>
                            </li> --}}
                    @endforeach

                    &nbsp;
                @endforeach
            </x-navbar.container>
        </div>
    </header>
    <!-- Main -->
    <main class="py-6 bg-surface-secondary">
        <!-- Container -->
        <div class="container-fluid">
            <div class="vstack gap-4">
                <!-- Filters -->
                <div class="d-flex flex-column flex-md-row gap-3 justify-content-between">
                    <div class="d-flex gap-3">
                        <!-- Search -->
                        {{-- <div class="input-group input-group-sm input-group-inline">
                            <span class="input-group-text pe-2">
                                <i class="bi bi-search"></i>
                            </span>

                            <input type="text" class="form-control" placeholder="Search" aria-label="Search"
                                name="q">
                        </div> --}}
                        <x-form.search />
                        <!-- Filters -->
                        {{-- <div>
                            <button type="button" class="btn btn-sm px-3 btn-neutral d-flex align-items-center">
                                <i class="bi bi-funnel me-2"></i>
                                <span>Filters</span>
                                <span class="vr opacity-20 mx-3"></span>
                                <span class="text-xs text-primary">2</span>
                            </button>
                        </div> --}}
                    </div>
                    <div class="btn-group">
                        @foreach ($_panel->getActions('container') as $action)
                            <x-button.action :action="$action"></x-button.action>
                            {{-- <x-button.link :link="$action->getLinkData()" /> --}}
                        @endforeach
                        {{-- <a href="#" class="btn btn-sm btn-neutral text-primary" aria-current="page">View
                            all</a>
                        <a href="#" class="btn btn-sm btn-neutral">Private</a>
                        <a href="#" class="btn btn-sm btn-neutral">Shared files</a> --}}
                    </div>
                </div>
                <!-- Table -->
                <div class="card">
                    <div class="card-header border-bottom d-flex align-items-center">
                        <h5 class="me-auto">{{ $_panel_name }}</h5>
                        {{-- <div class="dropdown">
                            <a class="text-muted" href="#" role="button" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="bi bi-three-dots-vertical"></i>
                            </a>
                            <div class="dropdown-menu">
                                <a href="#!" class="dropdown-item">
                                    Action
                                </a>
                                <a href="#!" class="dropdown-item">
                                    Another action
                                </a>
                                <a href="#!" class="dropdown-item">
                                    Something else here
                                </a>
                            </div>
                        </div> --}}
                    </div>

                    <x-panel.crud :panel="$_panel" :rows="$rows" />

                    {{-- @php
                        $fields = $_panel->getFields('index');
                    @endphp
                    <div class="table-responsive">
                        <table class="table table-hover table-nowrap">
                            @foreach ($rows as $row)
                                @php
                                    $row_panel = $_panel->newPanel($row);
                                @endphp
                                @if ($loop->first)
                                    <thead class="table-light">
                                        <tr>
                                            @foreach ($fields as $field)
                                                <th scope="col">{{ $field->name }}</th>
                                            @endforeach
                                            <th></th>
                                        </tr>
                                    </thead>
                                @endif
                                <tbody>

                                    <tr>
                                        @foreach ($fields as $field)
                                            <td>
                                                <x-input.freeze :field="$field" :row="$row" />
                                            </td>
                                        @endforeach

                                        <td class="text-end">
                                            <x-panel.buttons.crud :panel="$row_panel" />
                                        </td>
                                    </tr>

                                </tbody>
                            @endforeach
                        </table>
                    </div>
                    <div class="card-footer border-0 py-5">
                        <span class="text-muted text-sm">Showing 10 items out of 250 results found</span>
                    </div> --}}
                </div>
            </div>
        </div>
    </main>
@endsection
