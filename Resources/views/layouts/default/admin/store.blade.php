@extends('adm_theme::layouts.app')
@section('content')
    @include('theme::includes.flash')
    <a class="btn btn-primary" href="{!! $_panel->url('create') !!}">
        <i class="fas fa-plus"></i> Crea Nuovo
    </a>
    <a class="btn btn-primary" href="{!! $_panel->url('edit') !!}">
        <i class="far fa-edit"></i> Continua a Modificare
    </a>
    <a class="btn btn-primary" href="{!! $_panel->url('index') !!}">
        <i class="fas fa-list"></i> Torna alla Lista
    </a>
    <div role="group" aria-label="Actions" class="btn-group btn-group-sm">
        @foreach ($_panel->getItemTabs() as $tab)
            <x-button :attrs="get_object_vars($tab)" class="btn"></x-button>
        @endforeach
    </div>


@endsection
