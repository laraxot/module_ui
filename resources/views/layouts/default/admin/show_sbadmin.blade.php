@extends('adm_theme::layouts.app')
@section('content')
    @php
        $fields = $_panel->getFields('show');
    @endphp
    <table>
        @foreach ($fields as $k => $v)
            <tr>
                <td>{{ $v->name }}</td>

                <td>
                    {{-- {{ $row->{$v->name} }} --}}
                    {!! Theme::inputFreeze($v, $row) !!}
                </td>
            </tr>
        @endforeach
    </table>
    <a class="btn btn-primary" href="{!! $_panel->url('edit') !!}">
        <i class="far fa-edit"></i> Modifica
    </a>
@endsection
