@extends('adm_theme::layouts.app')
@section('content')
    @lang('Welcome')

    @foreach ($_panel->getActions('item') as $act)
        <x-button.action :action="$act" />
        {{-- {!! $act->btnHtml() !!} --}}
    @endforeach

    {{-- sono le azioni di quel definito Modulo percio' item }
@foreach ($_panel->getActions('container') as $act)
    <li>{!! $act->url() !!}</li>
@endforeach
--}}
@endsection
