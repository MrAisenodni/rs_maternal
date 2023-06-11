<nav class="navbar navbar-expand-lg main_menu">
    <div class="container">
        <a class="navbar-brand" href="/">
            <img src="{{ asset('/storage/'.$provider->provider_picture) }}" alt="#" class="img-fluid w-100" style="max-height: 50px">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <i class="far fa-bars menu_icon"></i>
            <i class="far fa-times close_icon"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                @if ($main_menus[0]->menus)
                    @foreach ($main_menus[0]->menus as $menu)
                        @if (session()->get('suser_id'))
                            @if ($menu->parent == 1)
                                @if ($menu->menu_access->view == 1)
                                    <li class="nav-item">
                                        <a class="nav-link @if($menu->id == $c_menu->menu_access->menu_id) active @endif" href="#">{{ $menu->title }} <i class="far fa-angle-down"></i></a>
                                        <ul class="tf__droap_menu">
                                            @if ($menu->submenus)
                                                @foreach ($menu->submenus as $submenu)
                                                    <li><a class="@if($submenu->id == $c_menu->menu_access->submenu_id) active @endif" href="{{ $submenu->url }}">{{ $submenu->title }}</a></li>
                                                @endforeach
                                            @endif
                                        </ul>
                                    </li>
                                @endif
                            @else
                                @if ($menu->menu_access->view == 1)
                                    <li class="nav-item">
                                        <a class="nav-link @if($menu->id == $c_menu->menu_access->menu_id) active @endif" href="{{ $menu->url }}">{{ $menu->title }}</a>
                                    </li>
                                @endif
                            @endif 
                        @else
                            @if ($menu->parent == 1)
                                <li class="nav-item">
                                    <a class="nav-link @if($menu->id == $c_menu->id) active @endif" href="#">{{ $menu->title }} <i class="far fa-angle-down"></i></a>
                                    <ul class="tf__droap_menu">
                                        @if ($menu->submenus)
                                            @foreach ($menu->submenus as $submenu)
                                                <li><a class="@if($menu->id == $c_menu->id) active @endif" href="{{ $submenu->url }}">{{ $submenu->title }}</a></li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link @if($menu->id == $c_menu->id) active @endif" href="{{ $menu->url }}">{{ $menu->title }}</a>
                                </li>
                            @endif
                        @endif                    
                    @endforeach
                    @if (session()->get('suser_id'))
                        @if (session()->get('srole') != 'pat')
                            <li class="nav-item">
                                <a class="nav-link common_btn" href="/setting/provider">Go To Admin</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item">
                            <a class="nav-link common_btn" href="/login">Masuk / Daftar</a>
                        </li>
                    @endif
                @endif
            </ul>
        </div>
    </div>
</nav>