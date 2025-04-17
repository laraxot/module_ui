@props([
    'href'=>'#',
])
<li class="nav-item">
    <a href="{{ $href }}" class="nav-link">
        {{ $slot }}
    </a>
</li>