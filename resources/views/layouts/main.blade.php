<!DOCTYPE html>
<html lang="en" dir="ltr">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>@yield('title') | E-Learning Maternal Neonatal</title>

        <!-- Prevent the demo from appearing in search engines (REMOVE THIS) -->
        <meta name="robots" content="noindex">

        <!-- Custom Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Oswald:400,500,700%7CRoboto:400,500%7CRoboto:400,500&display=swap" rel="stylesheet">

        <!-- Perfect Scrollbar -->
        <link type="text/css" href="{{ asset('/assets/vendor/perfect-scrollbar.css') }}" rel="stylesheet">

        <!-- Material Design Icons -->
        <link type="text/css" href="{{ asset('/assets/css/material-icons.css') }}" rel="stylesheet">

        <!-- Font Awesome Icons -->
        <link type="text/css" href="{{ asset('/assets/css/fontawesome.css') }}" rel="stylesheet">

        <!-- Preloader -->
        <link type="text/css" href="{{ asset('/assets/vendor/spinkit.css') }}" rel="stylesheet">

        <!-- App CSS -->
        <link type="text/css" href="{{ asset('/assets/css/app.css') }}" rel="stylesheet">

        @yield('styles')
    </head>

    <body class="layout-fluid">

        <div class="preloader">
            <div class="sk-chase">
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
            </div>

            <!-- <div class="sk-bounce">
                <div class="sk-bounce-dot"></div>
                <div class="sk-bounce-dot"></div>
            </div> -->

            <!-- More spinner examples at https://github.com/tobiasahlin/SpinKit/blob/master/examples.html -->
        </div>

        <!-- Header Layout -->
        <div class="mdk-header-layout js-mdk-header-layout">

            <!-- Header -->
            @include('layouts.header')
            <!-- // END Header -->

            <!-- Header Layout Content -->
            <div class="mdk-header-layout__content">

                <div data-push data-responsive-width="992px" class="mdk-drawer-layout js-mdk-drawer-layout">
                    @yield('content')
                    
                    {{-- Navbar --}}
                    @include('layouts.navbar')

                </div>

                <!-- App Settings FAB -->
                {{-- <div id="app-settings">
                    <app-settings layout-active="default" :layout-location="{
                        'fixed': 'fixed-student-dashboard.html',
                        'default': 'student-dashboard.html'
                        }" sidebar-variant="bg-transparent border-0"></app-settings>
                </div> --}}
            </div>
        </div>

        <!-- jQuery -->
        <script src="{{ asset('/assets/vendor/jquery.min.js') }}"></script>

        <!-- Bootstrap -->
        <script src="{{ asset('/assets/vendor/popper.min.js') }}"></script>
        <script src="{{ asset('/assets/vendor/bootstrap.min.js') }}"></script>

        <!-- Perfect Scrollbar -->
        <script src="{{ asset('/assets/vendor/perfect-scrollbar.min.js') }}"></script>

        <!-- MDK -->
        <script src="{{ asset('/assets/vendor/dom-factory.js') }}"></script>
        <script src="{{ asset('/assets/vendor/material-design-kit.js') }}"></script>

        <!-- App JS -->
        <script src="{{ asset('/assets/js/app.js') }}"></script>

        <!-- Highlight.js -->
        <script src="{{ asset('/assets/js/hljs.js') }}"></script>

        <!-- App Settings (safe to remove) -->
        <script src="{{ asset('/assets/js/app-settings.js') }}"></script>

        <!-- Global Settings -->
        <script src="{{ asset('/assets/js/settings.js') }}"></script>

        <!-- Moment.js -->
        <script src="{{ asset('/assets/vendor/moment.min.js') }}"></script>
        <script src="{{ asset('/assets/vendor/moment-range.js') }}"></script>

        <!-- Chart.js -->
        <script src="{{ asset('/assets/vendor/Chart.min.js') }}"></script>
        <script src="{{ asset('/assets/js/chartjs.js') }}"></script>

        <!-- Student Dashboard Page JS -->
        <!-- <script src="assets/js/chartjs-rounded-bar.js"></script> -->
        <script src="{{ asset('/assets/js/page.student-dashboard.js') }}"></script>

        @yield('scripts')
    </body>
</html>