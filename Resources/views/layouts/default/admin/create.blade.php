@extends('adm_theme::layouts.app')
@php
    if (!is_object($row)) {
        return '';
    }
    $fields = $_panel->getFields('create');
@endphp
@section('content')
    <x-section tpl="crud">
        <x-include-view view="topbar" />
        {!! Form::bsOpenPanel($_panel, 'store') !!}
        <div class="row">
            @foreach ($fields as $field)
                {!! Theme::inputHtml($field, $row) !!}
            @endforeach
        </div>
        {{-- {{ Form::bsSubmit('Salva') }} --}}
        <x-button type="submit">Salva</x-button>
        {!! Form::close() !!}
    </x-section>
@endsection
