@props([
    'url' => null,
])

@if ($url != null)
    {{-- <a href="{{ $url }}" {{ $attributes }}>{{ $slot }}</a> --}}
    <a href="{{ $url }}" {{ $attributes->merge($attrs) }}>
        @if (isset($attrs['icon']))
            <i class="{{ $attrs['icon'] }}"></i>
        @else
            {{ $slot }}
        @endif
    </a>
@else
    <button {{ $attributes->merge($attrs) }}>
        @if (isset($attrs['icon']))
            <i class="{{ $attrs['icon'] }}"></i>
        @else
            {{ $slot }}
        @endif
    </button>
    {{--
    @if($attributes->get('wire:click')!=null)
    <div wire:loading wire:target="{{ $attributes->get('wire:click') }}">
        <x-spinner />
    </div>
    @endif
    --}}
    <div wire:loading >
        <x-spinner />
    </div>
@endif

{{-- <a href="{{ $attrs['url'] }}" title="{{ $attrs['title'] }}" data-toggle="tooltip" class="{{ $attrs['class']['button'] }}">
    <i class="{{ $attrs['icon'] }}"></i>
</a> --}}
