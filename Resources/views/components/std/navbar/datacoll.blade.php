@props(['datacoll', 'title'])
<ul class="navbar-nav">
    <li class="nav-item">
        <a class="nav-link" href="#sidebar-{{ $title }}" role="button" data-bs-toggle="collapse" aria-expanded="true"
            aria-controls="sidebar-{{ $title }}">
            {{-- <i class="bi bi-briefcase"></i> --}} {{ $title }}
        </a>
        <div class="collapse show" id="sidebar-{{ $title }}">
            <ul class="nav nav-sm flex-column">
                @foreach ($datacoll as $v)
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
