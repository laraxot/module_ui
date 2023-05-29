@php
    $val = Form::getValueAttribute($name) ?? [];
@endphp
<table class="table table-bordered">
    @foreach ($val as $k => $v)
        <tr>
            <td>{{ $k }}</td>
            <td>{{ is_string($v) ? $v : '--ARRAY--' }}</td>
        </tr>
    @endforeach
</table>
