<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, target-densityDpi=device-dpi" />

    <title>@yield('title') | {{ $provider->provider_name }}</title>

    <link rel="icon" type="image/png" href="{{ asset('/storage/'.$provider->provider_logo) }}">
    <link rel="stylesheet" href="{{ asset('/assets/eduor/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/eduor/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/eduor/css/venobox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/eduor/css/animated_barfiller.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/eduor/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/eduor/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/eduor/css/nice-select.css') }}">

    <link rel="stylesheet" href="{{ asset('/assets/eduor/css/spacing.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/eduor/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/eduor/css/responsive.css') }}">

    @yield('styles')
</head>

<body>

    <!--=================================
        MAIN MENU START
    ==================================-->
    @include('layouts_eduor.navbar')
    <!--=================================
        MAIN MENU END
    ==================================-->


    @yield('content')


    <!--=================================
        FOOTER START
    ==================================-->
    <footer class="tf__footer mt_100" style="background: url({{ asset('/assets/eduor/images/footer_bg.jpg') }});">
        <div class="tf__footer_overlay pt_75">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-xl-6 col-sm-12 col-md-6 col-lg-6">
                        <div class="tf__footer_logo_area">
                            <a class="footer_logo" href="index.html">
                                <img src="{{ asset('/storage/'.$provider->provider_picture) }}" alt="#" class="img-fluid w-100" style="background: white;">
                            </a>
                            <p>{{ $provider->provider_name }}</p>
                            <ul class="d-flex flex-wrap">
                                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fab fa-pinterest-p"></i></a></li>
                                <li><a href="#"><i class="fab fa-google-plus-g"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-6 col-sm-12 col-md-6 col-lg-col-lg-6">
                        <div class="tf__footer_content xs_mt_30">
                            <h3>Kontak Kami</h3>
                            <p>Alamat: {!! $provider->provider_address_1 !!}</p>
                            <p>
                                <span>Telepon: {{ $provider->provider_phone_number }}</span>
                                <span>Fax: {{ $provider->provider_home_number }}</span>
                            </p>
                            <p>
                                <span>Email:  {{ $provider->provider_email }} </span>
                                <span>Website: www.mpku.or.id</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="tf__copyright">
                            <p>Copyright ©{{ date('Y', strtotime(now())) }} {{ $provider->provider_name }}.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!--=================================
        FOOTER END
    ==================================-->


    <!--=============================
        SCROLL BUTTON START
    ==============================-->
    <div class="tf__scroll_btn"> go to top </div>
    <!--=============================
        SCROLL BUTTON END 
    ==============================-->


    <!--jquery library js-->
    <script src="{{ asset('/assets/eduor/js/jquery-3.6.3.min.js') }}"></script>
    <!--bootstrap js-->
    <script src="{{ asset('/assets/eduor/js/bootstrap.bundle.min.js') }}"></script>
    <!--font-awesome js-->
    <script src="{{ asset('/assets/eduor/js/Font-Awesome.js') }}"></script>
    <!--venobox js-->
    <script src="{{ asset('/assets/eduor/js/venobox.min.js') }}"></script>
    <!--slick slider js-->
    <script src="{{ asset('/assets/eduor/js/slick.min.js') }}"></script>
    <!--wow js-->
    <script src="{{ asset('/assets/eduor/js/wow.min.js') }}"></script>
    <!--counterup js-->
    <script src="{{ asset('/assets/eduor/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('/assets/eduor/js/jquery.countup.min.js') }}"></script>
    <!--animated barfiller js-->
    <script src="{{ asset('/assets/eduor/js/animated_barfiller.js') }}"></script>
    <!--sticky sidebar js-->
    <script src="{{ asset('/assets/eduor/js/sticky_sidebar.js') }}"></script>
    <!--nice select js-->
    <script src="{{ asset('/assets/eduor/js/jquery.nice-select.min.js') }}"></script>

    <!--main/custom js-->
    <script src="{{ asset('/assets/eduor/js/main.js') }}"></script>

    @yield('scripts')
</body>

</html>