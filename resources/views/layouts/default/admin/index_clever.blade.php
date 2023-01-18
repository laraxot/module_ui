@extends('adm_theme::layouts.app')
@section('content')
<x-topbar />
<!-- Table -->
<div class="card">
	<div class="card-header border-bottom d-flex align-items-center">
		<h5 class="me-auto">
			<span class="primary-color"><strong>{{ number_format($rows->total(), 0, ',', ' ') }}</strong></span>
			{{ Str::plural($row->post_type ?? class_basename($row), $rows->total()) }}
		</h5>
        {{--  
		<div class="dropdown">
			<a class="text-muted" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true"
				aria-expanded="false">
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
        --}}
	</div>
    {{--  
	<div class="px-4 py-4 border-top border-bottom d-flex flex-column flex-sm-row gap-3">
		<div class="btn-group">
			<a href="#" class="btn btn-sm btn-neutral text-primary" aria-current="page">View all</a>
			<a href="#" class="btn btn-sm btn-neutral">Private</a>
			<a href="#" class="btn btn-sm btn-neutral">Shared files</a>
		</div>
		<div class="ms-auto hstack gap-2">
			<!-- Search -->
			<div class="input-group input-group-sm input-group-inline">
				<span class="input-group-text pe-2">
				<i class="bi bi-search"></i>
				</span>
				<input type="email" class="form-control" placeholder="Search" aria-label="Search">
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
	</div>
    --}}
	<x-panel.crud :panel="$_panel" />
	{{--  
	<div class="card-footer border-0 py-5">
		<span class="text-muted text-sm">Showing 10 items out of 250 results found</span>
	</div>
	--}}
</div>
@endsection
