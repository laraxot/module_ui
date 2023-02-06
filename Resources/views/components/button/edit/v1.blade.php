{{-- @props([
    'url' => null,
])

@if ($url != null)
    <a href="{{ $url }}" {{ $attributes }}>{{ $slot }}</a>
@else
    <button {{ $attributes->merge($attrs) }}>{{ $slot }}</button>
@endif --}}
<a href="{{ $panel->url('edit') }}" title="edit" data-toggle="tooltip" {{ $attributes->merge($attrs['button']) }}>
    <i {{ $attributes->merge($attrs['icon']) }}></i>
</a>
