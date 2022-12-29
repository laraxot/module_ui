<li class="nav-item dropdown ms-lg-3">
    <a id="userDropdownMenuLink" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <img
            class="avatar avatar-sm avatar-border-white me-2" src="{{ $profile->avatar() }}" alt="Me"></a>
    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdownMenuLink">
        {{-- <a class="dropdown-item" href="user-booking-1.html">Booking process - 4 pages </a><a class="dropdown-item"
            href="user-grid.html">Bookings &mdash; grid view </a><a class="dropdown-item"
            href="user-booking-detail.html">Booking detail </a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="login.html"><i class="fas fa-sign-out-alt me-2 text-muted"></i> Sign out</a> --}}

        <a class="dropdown-item" href="{{ $profile->url('show') }}">Profile </a>
        <div class="dropdown-divider"></div>

        <a class="dropdown-item" href="{{ route('logout') }}" title="logout"
            onclick="event.preventDefault();document.getElementById('logout-form').submit();">
            <i class=" fas fa-sign-out-alt me-2 text-muted"></i>
            @lang('lu::auth.sign_out')
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
    </div>
    {{-- qui volevo usare il componente, o meglio ancora il componente livewire --}}
    {{-- <x-theme::lis.logoutclass="dropdown-item">Logout</x-theme::lis.logout> --}}
</li>
