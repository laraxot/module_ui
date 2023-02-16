{{-- @include($view_work . '_clever') --}}
{{-- @include($view_work . current_theme_name()) --}}
@extends('adm_theme::layouts.app')
@section('content')
    {!! $_panel->indexNav() !!}
    <x-include-view view="inner_page" :vars="get_defined_vars()" />
    <header>
        <div class="container-fluid">
            <div class="border-bottom pt-6">
                <div class="row align-items-center">
                    <div class="col-sm col-12">
                        <!-- Title -->
                        <h1 class="h2 ls-tight">
                            <span class="d-inline-block me-3">😎</span>My Cool Projects
                        </h1>
                    </div>
                    <!-- Actions -->
                    <div class="col-sm-auto col-12 mt-4 mt-sm-0">
                        <div class="hstack gap-2 justify-content-sm-end">
                            {{-- {{ dddx($_panel->containerActions()) }} --}}
                            @foreach ($_panel->containerActions() as $action)
                                {{-- <a href="#modalExport" class="btn btn-sm btn-neutral border-base" data-bs-toggle="modal">
                                    <span class="pe-2">
                                        <i class="bi bi-people-fill"></i>
                                    </span>
                                    <span>Share</span>
                                </a> --}}
                                <x-button.action :action="$action"></x-button.action>
                            @endforeach
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
                <ul class="nav nav-tabs overflow-x border-0">
                    @foreach ($_panel->getTabs() as $level)
                        @foreach ($level as $tab)
                            <x-button.link :link="$tab" />
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
                    @endforeach
                </ul>
            </div>
        </div>
    </header>
    <!-- Main -->
    <main class="py-6 bg-surface-secondary">
        <!-- Offcanvas -->
        <div class="offcanvas offcanvas-end w-full w-lg-1/3" data-bs-scroll="true" data-bs-backdrop="true" tabindex="-1"
            id="offcanvasCreate" aria-labelledby="offcanvasCreateLabel">
            <div class="offcanvas-header border-bottom py-5 bg-surface-secondary">
                <h5 class="offcanvas-title" id="offcanvasCreateLabel">Create a new project</h5>
                <button type="button" class="btn-close text-reset text-xs" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <div class="offcanvas-body vstack gap-5">
                <div>
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control" placeholder="Project name">
                    <span class="d-block mt-2 text-sm text-muted">Make it unique.</span>
                </div>
                <div>
                    <label class="form-label">Description</label>
                    <textarea class="form-control" placeholder="Project description ..." rows="2"></textarea>
                    <span class="d-block mt-2 text-sm text-muted">Make it unique.</span>
                </div>
                <hr class="my-0" />
                <div>
                    <label class="form-label">Select view</label>
                    <div class="hstack gap-3">
                        <div class="form-item-checkable">
                            <input class="form-item-check" type="radio" name="project-view" id="project-view-kanban"
                                checked>
                            <label class="form-item" for="project-view-kanban">
                                <span
                                    class="form-item-click d-inline-flex align-items-center justify-content-center form-control w-24 h-24 text-center text-muted">
                                    <i class="bi bi-kanban" style="font-size: 2rem;"></i>
                                </span>
                            </label>
                        </div>
                        <div class="form-item-checkable">
                            <input class="form-item-check" type="radio" name="project-view" id="project-view-list">
                            <label class="form-item" for="project-view-list">
                                <span
                                    class="form-item-click d-inline-flex align-items-center justify-content-center form-control w-24 h-24 text-center text-muted">
                                    <i class="bi bi-view-list" style="font-size: 2rem;"></i>
                                </span>
                            </label>
                        </div>
                        <div class="form-item-checkable">
                            <input class="form-item-check" type="radio" name="project-view" id="project-view-table">
                            <label class="form-item" for="project-view-table">
                                <span
                                    class="form-item-click d-inline-flex align-items-center justify-content-center form-control w-24 h-24 text-center text-muted">
                                    <i class="bi bi-table" style="font-size: 2rem;"></i>
                                </span>
                            </label>
                        </div>
                    </div>
                </div>
                <hr class="my-0" />
                <div class="vstack gap-4">
                    <div class="d-flex gap-3">
                        <input class="form-check-input flex-shrink-0 text-lg" type="radio" name="projecy-privacy" checked>
                        <div class="pt-1 form-checked-content">
                            <h6 class="mb-1 lh-relaxed">Private</h6>
                            <span class="d-block text-muted text-sm">
                                <i class="bi bi-lock-fill me-1"></i>
                                Only you will be able to see this project
                            </span>
                        </div>
                    </div>
                    <div class="d-flex gap-3">
                        <input class="form-check-input flex-shrink-0 text-lg" type="radio" name="projecy-privacy">
                        <div class="pt-1 form-checked-content">
                            <h6 class="mb-1 lh-relaxed">Make it public</h6>
                            <span class="d-block text-muted text-sm">
                                <i class="bi bi-people-fill me-1"></i>
                                Everyone in this workspace will be able to see this project
                            </span>
                        </div>
                    </div>
                </div>
                <hr class="my-0" />
                <div class="row gx-4">
                    <div class="col-md">
                        <div>
                            <label class="form-label">Client</label>
                            <select class="form-select">
                                <option>Webpixels</option>
                                <option>Apple</option>
                                <option>Elrond</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-auto align-self-end">
                        <span class="d-inline-block py-3 font-semibold text-muted">or</span>
                    </div>
                    <div class="col-md-auto align-self-end">
                        <button type="button" class="btn btn-neutral">
                            <i class="bi bi-plus-lg me-2"></i>New client
                        </button>
                    </div>
                </div>
                <div class="row gx-4">
                    <div class="col-md-6">
                        <div>
                            <label class="form-label">Start date</label>
                            <div class="input-group input-group-inline datepicker">
                                <span class="input-group-text pe-2">
                                    <i class="bi bi-calendar"></i>
                                </span>
                                <input type="text" class="form-control" placeholder="Select date" data-input>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div>
                            <label class="form-label">Due date</label>
                            <div class="input-group input-group-inline datepicker">
                                <span class="input-group-text pe-2">
                                    <i class="bi bi-calendar"></i>
                                </span>
                                <input type="text" class="form-control" placeholder="Select date" data-input>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer py-2 bg-surface-secondary">
                <button type="button" class="btn btn-sm btn-neutral" data-bs-dismiss="offcanvas">Close</button>
                <button type="button" class="btn btn-sm btn-primary">Save</button>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="modalExport" tabindex="-1" aria-labelledby="modalExport" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content shadow-3">
                    <div class="modal-header">
                        <div class="icon icon-shape rounded-3 bg-soft-primary text-primary text-lg me-4">
                            <i class="bi bi-globe"></i>
                        </div>
                        <div>
                            <h5 class="mb-1">Share to web</h5>
                            <small class="d-block text-xs text-muted">Publish and share link with anyone</small>
                        </div>
                        <div class="ms-auto">
                            <div class="form-check form-switch me-n2">
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
                                <label class="form-check-label" for="flexSwitchCheckChecked"></label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <!-- Text -->
                        <div class="d-flex align-items-center mb-5">
                            <div>
                                <p class="text-sm">
                                    Anyone with this link <span class="font-bold text-heading">can view</span>
                                </p>
                            </div>
                            <div class="ms-auto">
                                <a href="#" class="text-sm font-semibold">Settings</a>
                            </div>
                        </div>
                        <!-- Form group -->
                        <div>
                            <div class="input-group input-group-inline">
                                <input type="email" class="form-control" placeholder="username"
                                    value="https://webpixels.io/your-amazing-link">
                                <span class="input-group-text">
                                    <i class="bi bi-clipboard"></i>
                                </span>
                            </div>
                            <span class="mt-2 valid-feedback">Looks good!</span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="me-auto">
                            <a href="#" class="text-sm font-semibold"><i class="bi bi-clipboard me-2"></i>Copy
                                link</a>
                        </div>
                        <button type="button" class="btn btn-sm btn-neutral" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-sm btn-success">Share file</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container -->
        <div class="container-fluid">
            <div class="vstack gap-4">
                <!-- Filters -->
                <div class="d-flex flex-column flex-md-row gap-3 justify-content-between">
                    <div class="d-flex gap-3">
                        <!-- Search -->
                        <div class="input-group input-group-sm input-group-inline">
                            <span class="input-group-text pe-2">
                                <i class="bi bi-search"></i>
                            </span>
                            <input type="text" class="form-control" placeholder="Search" aria-label="Search">
                        </div>
                        <!-- Filters -->
                        <div>
                            <button type="button" class="btn btn-sm px-3 btn-neutral d-flex align-items-center">
                                <i class="bi bi-funnel me-2"></i>
                                <span>Filters</span>
                                <span class="vr opacity-20 mx-3"></span>
                                <span class="text-xs text-primary">2</span>
                            </button>
                        </div>
                    </div>
                    <div class="btn-group">
                        <a href="#" class="btn btn-sm btn-neutral text-primary" aria-current="page">View
                            all</a>
                        <a href="#" class="btn btn-sm btn-neutral">Private</a>
                        <a href="#" class="btn btn-sm btn-neutral">Shared files</a>
                    </div>
                </div>
                <!-- Table -->
                <div class="card">
                    <div class="card-header border-bottom d-flex align-items-center">
                        <h5 class="me-auto">All projects</h5>
                        <div class="dropdown">
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
                        </div>
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
