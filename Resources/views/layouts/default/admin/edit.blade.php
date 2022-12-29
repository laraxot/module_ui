@extends('adm_theme::layouts.app')
@php
$last_container = last($containers);
if (!is_object($row)) {
    return '';
}

$fields = $_panel->getFields(['act' => 'edit']);
/*
$breads=$_panel->getBreads();
$parz=[
    'module'=>$breads->first()->getModuleNameLow(),
];
foreach($breads as $i=>$bread){
    $parz['container'.$i]=$bread->postType();
    $parz['item'.$i]=$bread->guid();
}

$test=route('admin.item.update',$parz);
*/


@endphp

@section('content')
    @component('theme::components.crud', get_defined_vars())
        @slot('content')
            {{--!! Theme::include('topbar', [], get_defined_vars()) !!--}}
            <x-include-view view="topbar" />
            {{--
            <x-alerts.error :errors="$errors" />
            --}}
            {{-- <x-forms.panel :panel="$_panel" action="update"> --}}
            {!! Form::bsOpenPanel($_panel, 'update') !!}
            <div class="row">
                @foreach ($fields as $field)
                    {!! Theme::inputHtml($field,$row) !!}
                @endforeach
            </div>
            {{--
            <x-form.panel :panel="$_panel" type="edit" />
            --}}
            {{ Form::bsSubmit('Modifica') }}
            {!! Form::close() !!}
            {{-- </x-forms.panel> --}}
        @endslot
    @endcomponent
@endsection
