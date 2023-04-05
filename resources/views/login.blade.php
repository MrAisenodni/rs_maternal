<!DOCTYPE html>
<html lang="en" dir="ltr">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Login | E-Learning Maternal Neonatal</title>

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

    </head>

    <body class="login">

        <div class="d-flex align-items-center" style="min-height: 100vh">
            <div class="col-sm-8 col-md-6 col-lg-4 mx-auto" style="min-width: 300px;">
                <div class="text-center mt-5 mb-1">
                    <div class="avatar avatar-lg">
                        <img src="{{ asset('/assets/images/logo/primary.svg') }}" class="avatar-img rounded-circle" alt="E-Learning Maternal Neonatal" />
                    </div>
                </div>
                <div class="d-flex justify-content-center mb-5 navbar-light">
                    <a href="/"
                       class="navbar-brand m-0">E-Learning Maternal Neonatal</a>
                </div>
                <div class="card navbar-shadow">
                    <div class="card-header text-center">
                        <h4 class="card-title">Masuk</h4>
                        <p class="card-subtitle">Silahkan masukkan Akun Anda</p>
                    </div>
                    @if (session('status'))
                        <div class="card-body mb-n5"> 
                            <div class="row">
                                <div class="col-12">
                                    <div class="alert alert-dismissible bg-success text-white border-0 fade show" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <strong>Sukses - </strong> {{ session('status') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif 
                    <div class="card-body">
                        <form action="/login" novalidate method="POST">
                            @csrf
                            <div class="form-group">
                                <label class="form-label" for="email">Masukkan Email Anda:</label>
                                <div class="input-group input-group-merge">
                                    <input id="email" type="email" required="" name="username" class="form-control form-control-prepended @error('username') is-invalid @enderror" placeholder="Masukkan Email Anda" value="{{ old('username') }}">
                                    @error('username')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <span class="fa fa-user"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label"
                                       for="password">Masukkan Kata Sandi Anda:</label>
                                <div class="input-group input-group-merge">
                                    <input id="password" type="password" required="" name="password" class="form-control form-control-prepended @error('password') is-invalid @enderror" placeholder="Masukkan Kata Sandi Anda" value="{{ old('password') }}">
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <span class="fa fa-key"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <button type="submit"class="btn btn-primary btn-block">Masuk</button>
                            </div>
                            {{-- <div class="text-center">
                                <a href="/forgot-password" class="text-black-70" style="text-decoration: underline;">Lupa Kata Sandi?</a>
                            </div> --}}
                        </form>
                    </div>
                    <div class="card-footer text-center text-black-50">
                        Belum punya akun? <a href="/registration">Daftar</a>
                    </div>
                </div>
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
    </body>
</html>