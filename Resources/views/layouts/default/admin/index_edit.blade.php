@extends('adm_theme::layouts.app')
@section('content')
    @php
    $last_item = last($items);
    $last_container = last($containers);
    $types = Str::camel(Str::plural($last_container));
    $field = (object) [
        'name' => 'areas',
        'type' => 'PivotFields',
    ];
    @endphp
    @component('theme::components.crud', get_defined_vars())
        @slot('content')
            {!! Theme::include('topbar', [], get_defined_vars()) !!}

            @foreach ($rows as $key => $row)
                @php
                    $fields = $_panel->getFields(['act' => 'index']);
                    //$row_panel=$_panel;
                    $row_panel = Panel::make()->get($row);
                    //dddx([$_panel->getName(),$_panel_name]);
                    $row_panel->setParent($_panel->getParent());
                    $row_panel->setName($_panel->getName());
                    //dddx([$_panel, $row_panel]);
                @endphp
                @if ($loop->first)
                    <table class="table table-striped table-hover table-sm">
                        <thead class="thead-light">
                            <tr>
                                @foreach ($fields as $field)
                                    <td>{{ str_replace('_', ' ', $field->name) }}</td>
                                @endforeach
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>
                @endif
                <tr>
                    @foreach ($fields as $field)
                        <td>
                            {!! Theme::inputFreeze(['row' => $row, 'field' => $field]) !!}

                            @if ($loop->first)
                                @foreach ($row_panel->itemActions() as $act)
                                    {!! $act->btnHtml() !!}
                                @endforeach
                            @endif
                        </td>
                    @endforeach
                    <td>
                        {!! $row_panel->btnCrud() !!}
                    </td>
                </tr>
                @if ($loop->last)
                    </tbody>
                    </table>
                @endif

            @endforeach
            {{ $rows->links() }}
        @endslot
    @endcomponent


@endsection
