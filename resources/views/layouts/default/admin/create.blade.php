@extends('adm_theme::layouts.app')
@php
    if (!is_object($row)) {
        return '';
    }
    $fields = $_panel->getFields(['act' => 'edit']);
@endphp
@section('content')
    <x-section type="crud">
        <x-include-view view="topbar" />
        {!! Form::bsOpenPanel($_panel, 'store') !!}
        <div class="row">
            @foreach ($fields as $field)
                {!! Theme::inputHtml($field, $row) !!}
            @endforeach
        </div>
        {{ Form::bsSubmit('Salva') }}
        {!! Form::close() !!}
    </x-section>
@endsection
