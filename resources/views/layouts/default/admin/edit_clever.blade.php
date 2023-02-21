@extends('adm_theme::layouts.app')
@php
    if (!is_object($row)) {
        return '';
    }
    
    $fields = $_panel->getFields('edit');
    
@endphp

@section('content')
    <x-section type="crud">
        <x-include-view view="topbar" />
        {!! Form::bsOpenPanel($_panel, 'update') !!}
        <div class="row">
            @foreach ($fields as $field)
                
                {!! Theme::inputHtml($field, $row) !!}

                {{-- WIP
                <x-input.field :field="$field" :row="$row" /> --}}
            @endforeach
        </div>
        {{-- <button type="submit"
            class="btn btn-sm bg-soft-success bg-opacity-20 bg-opacity-100-hover text-primary text-white-hover">Modifica</button> --}}
        <x-button type="submit">Modifica</x-button>
        {!! Form::close() !!}
    </x-section>
@endsection
