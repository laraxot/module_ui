@extends('ui::errors.illustrated-layout')

@section('title', __('Not Found'))
@section('code', '404')
@section('message')
    {{ $message ?? __('Not Found') }}
    {{-- debug_print_backtrace() --}}
    {{-- dddx(debug_backtrace()) --}}
    <table class="table">
        @foreach (debug_backtrace() as $v)
            <tr>
                <td>{{ $v['file'] ?? '--' }}</td>
                <td>{{ $v['line'] ?? '--' }}</td>
            </tr>
        @endforeach
    </table>


@endsection
