@extends('adm_theme::layouts.app')
@section('content')
<x-topbar />

 <!-- Table -->
 <div class="card">
    <div class="card-header border-bottom d-flex align-items-center">
      <h5 class="me-auto">All projects</h5>
      <div class="dropdown">
        <a class="text-muted" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
    <x-panel.crud  :panel="$_panel" /> 
    
    <div class="card-footer border-0 py-5">
      <span class="text-muted text-sm">Showing 10 items out of 250 results found</span>
    </div>
  </div>

@endsection