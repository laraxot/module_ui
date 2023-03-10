@extends('adm_theme::layouts.app')
@php
    if (!is_object($row)) {
        return '';
    }
    
    $fields = $_panel->getFields('edit');
@endphp

@section('content')
    <x-section tpl="crud">
        <x-include-view view="topbar" />
        {!! Form::bsOpenPanel($_panel, 'update') !!}
        <div class="row">
            @foreach ($fields as $field)
                {!! Theme::inputHtml($field, $row) !!}

                {{-- WIP
                <x-input.field :field="$field" :row="$row" />
                --}}
            @endforeach
        </div>
        {{ Form::bsSubmit('Modifica') }}
        {!! Form::close() !!}
    </x-section>
@endsection
