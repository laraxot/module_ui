@php
    // nella lista la password e conferma password posso ometterle
    /*
$fields=collect($_panel->fields())->filter(function($item){
return !in_array($item->type,['Password']);
})->all();
*/
    
    $fields = $_panel->getFields('index');
    //$row_panel=$_panel;
    $row_panel = Panel::make()->get($row);
    $row_panel->setParent($_panel->getParent());
    //dddx([$_panel,$row_panel]);
@endphp
@if ($loop->first)
    <table>
        <thead>
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
            {!! Theme::inputFreeze($field, $row) !!}

            @if ($loop->first)
                @foreach ($row_panel->getActions('item') as $act)
                    <x-button.action :action="$act" />
                @endforeach
            @endif
        </td>
    @endforeach
    <td>
        {{-- {!! Form::bsBtnCrud(['row' => $row]) !!}
        {!! $row_panel->btnCrud() !!} --}}
    </td>
</tr>
@if ($loop->last)
    </tbody>
    </table>
@endif
