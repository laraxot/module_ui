{{--
<li>
    <a class="dropdown-item" href="#">{{ $slot }}</a>
</li>
--}}
<li {{ $attributes->merge($attrs) }}>
    {{ $slot }}
</li>