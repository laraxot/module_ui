@php
    $fields = $_panel->fields();
@endphp
<table>
    @foreach ($fields as $k => $v)
        <tr>
            <td>{{ $v->name }}</td>

            <td>
                {{--
	  	{{ $row->{$v->name} }}
		--}}
                {!! Theme::inputFreeze($v, $row) !!}
            </td>
        </tr>
    @endforeach
</table>
