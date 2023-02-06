<header>
    <div class="container-fluid">
        <div class="border-bottom pt-6 pb-4 mb-4">
            <div class="row align-items-center">
                <div class="col-sm col-12">
                    <h1 class="h2 ls-tight">{{ Str::ucfirst($_panel->name) }}</h1>
                </div>
                <div class="col-sm-auto col-12 mt-4 mt-sm-0">
                    <div class="hstack gap-2 justify-content-sm-end">
                        {{-- <a href="#modalExport"
                            class="btn btn-sm btn-neutral border-base" data-bs-toggle="modal"><span class="pe-2"><i
                                    class="bi bi-people-fill"></i> </span><span>Share</span> </a> --}}
                        <x-panel.button.create :panel="$_panel" />
                        <x-panel.actions.buttons :acts="$_panel->containerActions()" />
                    </div>
                </div>
            </div>

            {{-- <ul class="nav nav-tabs overflow-x border-0">
                <li class="nav-item"><a href="#" class="nav-link active">View all</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Most recent</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Popular</a></li>
            </ul> --}}
        </div>
    </div>
</header>

{{-- <div class="d-flex justify-content-between flex-column flex-sm-row gap-3 mb-4">
    <div class="hstack gap-2">
        <div class="input-group input-group-sm input-group-inline"><span class="input-group-text pe-2"><i
                    class="bi bi-search"></i> </span><input type="email" class="form-control" placeholder="Search"
                aria-label="Search"></div>
        <div>
            <button type="button" class="btn btn-sm px-3 btn-neutral d-flex align-items-center"><i
                    class="bi bi-funnel me-2"></i> <span>Filters</span> <span class="vr opacity-20 mx-3"></span> <span
                    class="text-xs text-primary">2</span></button>
        </div>
    </div>
    <div class="btn-group"><a href="#" class="btn btn-sm btn-neutral"><i
                class="bi bi-cloud-download me-2"></i>Download all </a>
    </div>
    <a href="#" class="btn btn-sm btn-neutral"><i class="bi bi-gear-wide me-2"></i>Settings</a>
</div> --}}
