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
                <a href="student-dashboard.html"
                   class="navbar-brand">
                    <img src="{{ asset('assets/images/logo/white.svg') }}" class="mr-2" alt="E-Learning Maternal" />
                    <span class="d-none d-xs-md-block">E-Learning Maternal</span>
                </a>

                <!-- Menu -->
                <ul class="nav navbar-nav flex-nowrap">
                    <!-- User dropdown -->
                    <li class="nav-item dropdown ml-1 ml-md-3">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button">
                            <img src="{{ asset('assets/images/people/50/guy-6.jpg') }}" alt="Avatar" class="rounded-circle" width="40">
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="student-profile.html">
                                <i class="material-icons">person</i> Profil
                            </a>
                            <a class="dropdown-item" href="guest-login.html">
                                <i class="material-icons">lock</i> Keluar
                            </a>
                        </div>
                    </li>
                    <!-- // END User dropdown -->
                </ul>
                <!-- // END Menu -->
            </div>
        </nav>
        <!-- // END Navbar -->
    </div>
</div>