@extends('adm_theme::layouts.app')
@php
//dddx(get_defined_vars());
$last_container = last($containers);
if (!is_object($row)) {
    return '';
}
$fields = $_panel->getFields(['act' => 'edit']);
@endphp
@section('content')
    @component('theme::components.crud', get_defined_vars())
        @slot('content')
            <x-include-view view="topbar" />
            {{-- prima di rimettere sto schifo spiegatemelo
            <h1>Crea {{ $_panel_name }}</h1> --}}
            <x-theme::alerts.error :errors="$errors" />
            {!! Form::bsOpenPanel($_panel, 'store') !!}
            <div class="row">
                @foreach ($fields as $field)
                    {!! Theme::inputHtml(['row' => $row, 'field' => $field]) !!}
                @endforeach
            </div>
            {{ Form::bsSubmit('Salva') }}
            {!! Form::close() !!}
        @endslot
    @endcomponent
@endsection
