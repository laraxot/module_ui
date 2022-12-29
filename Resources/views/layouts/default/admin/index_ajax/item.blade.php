@php
// nella lista la password e conferma password posso ometterle
/*
 $fields=collect($_panel->fields())->filter(function($item){
  return !in_array($item->type,['Password']);
 })->all();
 */
$fields = $_panel->getFields(['act' => 'index']);
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
            {!! Theme::inputFreeze(['row' => $row, 'field' => $field]) !!}
            @if ($loop->first)
                @foreach ($_panel->itemActions() as $act)
                    {!! $act->btn(['row' => $row]) !!}
                @endforeach
            @endif
            {{-- @php
					$field_name=str_replace(['[',']'],['.',''],$field->name);
				@endphp
				{{ \Arr::get($row,$field_name) }} --}}
            {{-- $field->type --}}
        </td>
    @endforeach
    <td>
        {!! Form::bsBtnCrud(['row' => $row]) !!}
    </td>
</tr>
@if ($loop->last)
    </tbody>
    </table>
@endif
