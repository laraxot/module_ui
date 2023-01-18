<!-- Navbar Collapse -->
<div class="collapse navbar-collapse" id="navbarCollapse">
    <form class="form-inline mt-4 mb-2 d-sm-none" action="#" id="searchcollapsed">
        <div class="input-label-absolute input-label-absolute-left w-100">
            <label class="label-absolute" for="searchcollapsed_search"><i class="fa fa-search"></i><span
                    class="sr-only">What are you looking for?</span></label>
            <input class="form-control form-control-sm border-0 shadow-0 bg-gray-200" id="searchcollapsed_search"
                placeholder="Search" aria-label="Search" type="search" />
        </div>
    </form>
    <ul class="navbar-nav ms-auto">
        @php
            $menu_items = $_theme->getMenuItemsByName('navbar');

            //dddx($_theme->getMenuItemsByName('navbar'));

            //dddx(Menu::getByName('navbar'));
            //dddx(get_defined_vars());
            //l'array menus è ancora vuoto, giustamente...
//fin quando verrà modificato il salvataggio in array su file, utilizziamo Menu::getByName('navbar')???

        @endphp

        @foreach ($menu_items as $menu_item)
            @php
                //dddx([Auth::check(), $menu_item,(Auth::check() && $menu_item->logged_policy === '1') || $menu_item->logged_policy !== '1' ]);
            @endphp
            @if ((Auth::check() && $menu_item->logged_policy === '1') || $menu_item->logged_policy !== '1')
                <li class="nav-item">
                    <a class="nav-link" href="{{ $menu_item->link }}">{{ $menu_item->label }}</a>
                </li>
            @endif
        @endforeach
        {{-- <li class="nav-item dropdown"><a class="nav-link dropdown-toggle " id="homeDropdownMenuLink" href="index.html"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Home</a>
            <div class="dropdown-menu" aria-labelledby="homeDropdownMenuLink"><a class="dropdown-item"
                    href="undefinedindex.html">Rooms</a><a class="dropdown-item"
                    href="undefinedindex-2.html">Restaurants</a><a class="dropdown-item"
                    href="undefinedindex-3.html">Travel</a><a class="dropdown-item" href="undefinedindex-4.html">Real
                    Estate <span class="badge badge-info-light ms-1 mt-n1">New</span></a></div>
        </li>
        <!--include inc-megamenu.pug-->
        <li class="nav-item"><a class="nav-link" href="undefinedcontact.html">Contact</a>
        </li>
        <x-dropdown-list menuName="navbar" title="Dropdown" />

        <li class="nav-item dropdown"><a class="nav-link dropdown-toggle " id="docsDropdownMenuLink" href="index.html"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Docs</a>
            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="docsDropdownMenuLink">
                <!--+dropdownList('Documentation', docLinks)    -->
                <div class="dropdown-divider"></div>
                <!--+dropdownList('Components', componentLinks)-->
            </div>
        </li> --}}
        <x-header.nav.user />
        {{-- @if (Auth::guest())
            @include(
                'pub_theme::layouts.partials.headernav.user_guest'
            )
        @else
            @include(
                'pub_theme::layouts.partials.headernav.user_logged'
            )
        @endif --}}
    </ul>
</div>
