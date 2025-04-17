@props([
    'href' => null,
    //'title' => null,
])

@if ($href != null)
    <a href="{{ $href }}" {{ $attributes->merge($attrs) }}>
        @if (isset($attrs['icon']))
            <i class="{{ $attrs['icon'] }}"></i>
        @else
            @php
                $trans_key = $tradKey . '.' . $slot;
                $trans = trans($trans_key);
                $slot1 = $trans_key == $trans ? $slot : $trans;
            @endphp
            {!! $trans !!}
        @endif
    </a>
@else
    <button {{ $attributes->merge($attrs) }}>
        @if (isset($attrs['icon']))
            <i class="{{ $attrs['icon'] }}"></i>
        @else
            @php
                $trans_key = $tradKey . '.' . $slot;
                $trans = trans($trans_key);
                $slot1 = $trans_key == $trans ? $slot : $trans;
            @endphp
            {!! $trans !!}
        @endif
    </button>
    {{--
    @if ($attributes->get('wire:click') != null)
    <div wire:loading wire:target="{{ $attributes->get('wire:click') }}">
        <x-spinner />
    </div>
    @endif
    --}}
    <div wire:loading>
        <x-spinner />
    </div>
@endif

{{-- <a href="{{ $attrs['url'] }}" title="{{ $attrs['title'] }}" data-toggle="tooltip" class="{{ $attrs['class']['button'] }}">
    <i class="{{ $attrs['icon'] }}"></i>
</a> --}}
