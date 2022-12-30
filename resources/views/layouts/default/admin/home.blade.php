@extends('adm_theme::layouts.app')
@section('content')

@lang('Welcome')

@foreach($_panel->itemActions() as $act)
    {!! $act->btnHtml() !!}
@endforeach

{{-- sono le azioni di quel definito Modulo percio' item }
@foreach($_panel->containerActions() as $act)
    <li>{!! $act->url() !!}</li>
@endforeach
--}}


@endsection
