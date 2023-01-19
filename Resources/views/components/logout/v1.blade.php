<a href="{{ route('logout') }}" class="dropdown-item"
    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
    <i class="fas fa-sign-out-alt mr-2 text-muted"></i>{{ $slot }}
</a>
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    {{ csrf_field() }}
</form>
