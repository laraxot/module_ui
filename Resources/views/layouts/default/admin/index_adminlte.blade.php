@extends('adm_theme::layouts.app')
@section('content')
    {!! $_panel->indexNav() !!}
    {!! Theme::include('inner_page', [], get_defined_vars()) !!}
    @component('ui::components.crud', get_defined_vars())
        @slot('content')
            {!! Theme::include('topbar', [], get_defined_vars()) !!}
            @php
                $fields = $_panel->getFields('index');
            @endphp
            <x-pagination :rows="$rows" />
            <x-std tpl="table">
                @foreach ($rows as $row)
                    @php
                        $row_panel = $_panel->newPanel($row);
                    @endphp
                    @if ($loop->first)
                        <x-slot name="thead">
                            <tr>
                                @if ($_panel->checkActions()->count() > 0)
                                    <td>select models</td>
                                @endif
                                @foreach ($fields as $field)
                                    <td>{{ str_replace('_', ' ', $field->name) }}</td>
                                @endforeach
                                <td></td>
                            </tr>
                        </x-slot>
                        <x-slot name="tbody">
                    @endif


                    <tr>
                        @if ($_panel->checkActions()->count() > 0)
                            <td>{{ Form::checkbox('checkbox_model_id[]', $row->id, false) }}</td>
                        @endif
                        @foreach ($row_panel->getFields('index') as $field)
                            <td>
                                {!! Theme::inputFreeze($field, $row) !!}
                                @if ($loop->first)
                                    @if ($row_panel->itemActions()->count() > 5)
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-tools"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                @foreach ($row_panel->itemActions() as $act)
                                                    {!! $act->btnHtml() !!}
                                                @endforeach
                                            </div>
                                        </div>
                                    @else
                                        @foreach ($row_panel->itemActions() as $act)
                                            {!! $act->btnHtml() !!}
                                        @endforeach
                                        {{--  
                                        @foreach ($row_panel->itemActionModals() as $act)
                                       
                                        @php
                                        $row_class=str_replace('\\','\\\\',$row_panel->row::class);
                                        @endphp
                                            <button
                                                onclick="Livewire.emit('modal.open', '{{ $act['class'] }}',{'model_type': '{{ $row_class }}','model_id':'{{ $row_panel->row->id }}'})"
                                                class="btn btn-secondary btn-success mb-2">{!! $act['icon'] !!}</button>
                                        @endforeach
                                        --}}
                                    @endif
                                @endif
                            </td>
                        @endforeach
                        <td>
                            <x-button.crud :panel="$row_panel" />
                        </td>
                    </tr>
                    @if ($loop->last)
                        </x-slot>
                    @endif
                @endforeach
            </x-std>
            <x-pagination :rows="$rows" />
        @endslot
    @endcomponent
@endsection
