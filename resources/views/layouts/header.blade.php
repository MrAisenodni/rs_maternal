<div id="header" data-fixed class="mdk-header js-mdk-header mb-0">
    <div class="mdk-header__content">

        <!-- Navbar -->
        <nav id="default-navbar" class="navbar navbar-expand navbar-dark bg-primary m-0">
            <div class="container-fluid">
                <!-- Toggle sidebar -->
                <button class="navbar-toggler d-block" data-toggle="sidebar" type="button">
                    <span class="material-icons">menu</span>
                </button>

                <!-- Brand -->
                <a href="/" class="navbar-brand">
                    <img src="{{ asset('/storage/'.$provider->provider_logo) }}" class="mr-2" alt="#" style="max-height: 50px" />
                    <span class="d-none d-xs-md-block">{{ $provider->provider_name }}</span>
                </a>

                <!-- Menu -->
                <ul class="nav navbar-nav flex-nowrap">
                    <!-- User dropdown -->
                    <li class="nav-item dropdown ml-1 ml-md-3">
                        @if (!session()->get('suser_id'))
                            <a href="/login" class="text-white">Masuk</a><a href="#" class="text-white">&nbsp / &nbsp</a><a href="/registration" class="text-white">Daftar</a>
                        @else
                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button">
                                <img src="{{ asset('/storage/'.session()->get('spicture')) }}" alt="Avatar" class="rounded-circle" width="40">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="/profil/{{ session()->get('suser_id') }}">
                                    <i class="material-icons">person</i> Profil
                                </a>
                                <a class="dropdown-item" href="/logout">
                                    <i class="material-icons">lock</i> Keluar
                                </a>
                            </div>
                        @endif
                    </li>
                    <!-- // END User dropdown -->
                </ul>
                <!-- // END Menu -->
            </div>
        </nav>
        <!-- // END Navbar -->
    </div>
</div>