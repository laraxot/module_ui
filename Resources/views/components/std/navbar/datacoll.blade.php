@props([
    'datacoll',
    'title',
])
<ul class="navbar-nav">
    <li class="nav-item">
        <a class="nav-link" href="#sidebar-{{ $title }}" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebar-{{ $title }}">
            {{-- <i class="bi bi-briefcase"></i> --}} {{ $title }}
        </a>
        <div class="collapse" id="sidebar-{{ $title }}">
            <ul class="nav nav-sm flex-column">
            @foreach($datacoll as $v)
                <li class="nav-item">
                    <a href="{{ $v->url }}" class="nav-link">
                        {{ $v->title }}
                    </a>
                </li>
            @endforeach
            </ul>
        </div>
    </li>
</ul>