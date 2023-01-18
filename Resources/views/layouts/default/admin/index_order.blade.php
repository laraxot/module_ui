@extends('adm_theme::layouts.app')
@section('content')



    @if (isset($params['module']))
        {{-- che tanto mi sa che si usa sempre IndexOrder di ewb a prescindere dal modulo --}}
        @livewire('crud.index_order', ['rows' => $rows])
    @else
        @livewire('crud.index_order', ['rows' => $rows])
    @endif

@endsection
