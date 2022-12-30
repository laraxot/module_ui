@extends('adm_theme::layouts.app')
@section('content')
    {!! $_panel->indexNav() !!}

    <x-include-view view="inner_page" />
    <x-section type="crud">
        {!! Theme::include('topbar', [], get_defined_vars()) !!}
        @php
            $fields = $_panel->getFields(['act' => 'index']);
        @endphp
        <x-pagination :rows="$rows" />
        <x-component type="table">
            @foreach ($rows as $row)
                @php
                    $row_panel = $_panel->newPanel($row);
                @endphp
                @if ($loop->first)
                    <x-slot name="thead">
                        <tr>
                            @foreach ($fields as $field)
                                <td>{{ str_replace('_', ' ', $field->name) }}</td>
                            @endforeach
                            <td></td>
                        </tr>
                    </x-slot>
                    <x-slot name="tbody">
                @endif
                <tr>
                    @foreach ($row_panel->getFields(['act' => 'index']) as $field)
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
        </x-component>

        <x-pagination :rows="$rows" />
    </x-section>
    {{-- <x-include-view view="topbar" /> --}}
    {{-- @if (view()->exists('adm_theme::layouts.partials.pagination'))
                {{ $rows->appends(request()->query())->links('adm_theme::layouts.partials.pagination') }}
            @else
                {{ $rows->appends(request()->query())->links() }}
            @endif --}}
@endsection
