<!DOCTYPE html>
<html lang="en" dir="ltr">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Registrasi | E-Learning Maternal Neonatal</title>

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
        
        {{-- Select2 --}}
        <link href="{{ asset('/assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('/assets/plugins/select2/css/select2-bootstrap4.css') }}" rel="stylesheet" />
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
                    <a href="/" class="navbar-brand m-0">E-Learning Maternal Neonatal</a>
                </div>
                <div class="card navbar-shadow">
                    <div class="card-header text-center">
                        <h4 class="card-title">Registrasi</h4>
                        <p class="card-subtitle">Silahkan daftarkan diri Anda</p>
                    </div>
                    <div class="card-body">
                        <form action="/registration" novalidate method="POST">
                            @csrf
                            <div class="form-group">
                                <label class="form-label" for="role">Pilih Peran Anda:</label>
                                <div class="input-group input-group-merge">
                                    <select class="single-select form-control @error('role') is-invalid @enderror" id="role" name="role">
                                        <option value="pat" @if (old('role') == 'pat') selected @endif>Member E-Learning</option>
                                        <option value="tec" @if (old('role') == 'tec') selected @endif>Dokter Pengajar</option>
                                    </select>
                                    @error('role')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <span class="fa fa-genderless"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="nik">Masukkan Nomor Induk Keluarga (NIK) Anda:</label>
                                <div class="input-group input-group-merge">
                                    <input id="nik" type="text" name="nik" class="form-control form-control-prepended @error('nik') is-invalid @enderror" placeholder="Masukkan Nomor Induk Keluarga (NIK) Anda" value="{{ old('nik') }}">
                                    @error('nik')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <span class="fa fa-id-card"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="full_name">Masukkan Nama Lengkap Anda:</label>
                                <div class="input-group input-group-merge">
                                    <input id="full_name" type="text" name="full_name" class="form-control form-control-prepended @error('full_name') is-invalid @enderror" placeholder="Masukkan Nama Lengkap Anda" value="{{ old('full_name') }}">
                                    @error('full_name')
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
                                <label class="form-label" for="gender">Pilih Jenis Kelamin Anda:</label>
                                <div class="input-group input-group-merge">
                                    <select class="single-select form-control @error('gender') is-invalid @enderror" id="gender" name="gender">
                                        <option value="l" @if (old('gender') == 'l') selected @endif>Pria</option>
                                        <option value="p" @if (old('gender') == 'p') selected @endif>Wanita</option>
                                    </select>
                                    @error('gender')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <span class="fa fa-genderless"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="birth_place">Masukkan Tempat Lahir Anda:</label>
                                <div class="input-group input-group-merge">
                                    <input id="birth_place" type="text" name="birth_place" class="form-control form-control-prepended @error('birth_place') is-invalid @enderror" placeholder="Masukkan Tempat Lahir Anda" value="{{ old('birth_place') }}">
                                    @error('birth_place')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <span class="fa fa-city"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="birth_date">Masukkan Tanggal Lahir Anda:</label>
                                <div class="input-group input-group-merge">
                                    <input id="birth_date" type="date" name="birth_date" class="form-control form-control-prepended @error('birth_date') is-invalid @enderror" placeholder="Masukkan Tanggal Lahir Anda" value="{{ old('birth_date') }}">
                                    @error('birth_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <span class="fa fa-calendar"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="phone_number">Masukkan Nomor HP Anda:</label>
                                <div class="input-group input-group-merge">
                                    <input id="phone_number" type="text" name="phone_number" class="form-control form-control-prepended @error('phone_number') is-invalid @enderror" placeholder="Masukkan Nomor HP Anda" value="{{ old('phone_number') }}">
                                    @error('phone_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <span class="fa fa-phone"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="home_number">Masukkan Nomor Telepon Anda:</label>
                                <div class="input-group input-group-merge">
                                    <input id="home_number" type="text" name="home_number" class="form-control form-control-prepended @error('home_number') is-invalid @enderror" placeholder="Masukkan Nomor Telepon Anda" value="{{ old('home_number') }}">
                                    @error('home_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <span class="fa fa-phone-alt"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="email">Masukkan Email Anda:</label>
                                <div class="input-group input-group-merge">
                                    <input id="email" type="email" name="username" class="form-control form-control-prepended @error('username') is-invalid @enderror" placeholder="Masukkan Email Anda" value="{{ old('username') }}">
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
                                <label class="form-label" for="password">Masukkan Kata Sandi Anda:</label>
                                <div class="input-group input-group-merge">
                                    <input id="password" type="password" name="password" class="form-control form-control-prepended @error('password') is-invalid @enderror" placeholder="Masukkan Kata Sandi Anda" value="{{ old('password') }}">
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
                            <div class="form-group">
                                <label class="form-label" for="repassword">Masukkan Ulang Kata Sandi Anda:</label>
                                <div class="input-group input-group-merge">
                                    <input id="repassword" type="password" name="repassword" class="form-control form-control-prepended @error('repassword') is-invalid @enderror" placeholder="Masukkan Ulang Kata Sandi Anda" value="{{ old('repassword') }}">
                                    @error('repassword')
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
                                <button type="submit"class="btn btn-primary btn-block">Daftar</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-center text-black-50">
                        Sudah punya akun? <a href="/login">Masuk</a>
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
        
        {{-- Select2 --}}
        <script src="{{ asset('/assets/plugins/select2/js/select2.min.js') }}"></script>
        <script src="{{ asset('/assets/js/form-select2.js') }}"></script>
    </body>
</html>