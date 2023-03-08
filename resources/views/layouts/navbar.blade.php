<div class="mdk-drawer js-mdk-drawer" id="default-drawer">
    <div class="mdk-drawer__content ">
        <div class="sidebar sidebar-left sidebar-dark bg-dark o-hidden" data-perfect-scrollbar>
            <div class="sidebar-p-y">
                @if ($main_menus)
                    @foreach ($main_menus as $main_menu)
                        @if (session()->get('suser_id'))
                            @if ($main_menu->menu_access->view == 1)
                                <div class="sidebar-heading">{{ $main_menu->title }}</div>
                                @if ($main_menu->parent == 1)
                                    @if ($main_menu->menus)
                                        <ul class="sidebar-menu sm-active-button-bg">
                                            @foreach ($main_menu->menus as $menu)
                                                @if ($menu->menu_access->view == 1)
                                                    <li class="sidebar-menu-item @if($menu->id == $c_menu->id) active @endif">
                                                        <a class="sidebar-menu-button" href="{{ $menu->url }}">
                                                            <i class="sidebar-menu-icon sidebar-menu-icon--left {{ $menu->icon }}" style="font-size: 18px"></i>{{ $menu->title }} 
                                                        </a>
                                                    </li> 
                                                @endif
                                            @endforeach
                                        </ul>
                                    @endif
                                @endif
                            @endif
                        @else
                            <div class="sidebar-heading">{{ $main_menu->title }}</div>
                            @if ($main_menu->parent == 1)
                                @if ($main_menu->menus)
                                    <ul class="sidebar-menu sm-active-button-bg">
                                        @foreach ($main_menu->menus as $menu)
                                            <li class="sidebar-menu-item @if($menu->id == $c_menu->id) active @endif">
                                                <a class="sidebar-menu-button" href="{{ $menu->url }}">
                                                    <i class="sidebar-menu-icon sidebar-menu-icon--left {{ $menu->icon }}" style="font-size: 18px"></i>{{ $menu->title }} 
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            @endif
                        @endif
                    @endforeach
                @endif
                
                <!-- Cadangan Template -->
                {{-- <div class="sidebar-heading">Account</div>
                <ul class="sidebar-menu">
                    <li class="sidebar-menu-item">
                        <a class="sidebar-menu-button sidebar-js-collapse"
                            data-toggle="collapse"
                            href="#account_menu">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left fa fa-school" style="font-size: 18px"></i>
                            Account
                            <span class="ml-auto sidebar-menu-toggle-icon"></span>
                        </a>
                        <ul class="sidebar-submenu sm-indent collapse"
                            id="account_menu">
                            <li class="sidebar-menu-item">
                                <a class="sidebar-menu-button"
                                    href="guest-login.html">
                                    <span class="sidebar-menu-text">Login</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item">
                                <a class="sidebar-menu-button"
                                    href="guest-signup.html">
                                    <span class="sidebar-menu-text">Sign Up</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <div class="sidebar-heading">Student</div>
                <ul class="sidebar-menu sm-active-button-bg">
                    <li class="sidebar-menu-item">
                        <a class="sidebar-menu-button"
                            href="student-browse-courses.html">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">search</i> Browse Courses
                        </a>
                    </li>
                </ul> --}}
            </div>
        </div>
    </div>
</div>