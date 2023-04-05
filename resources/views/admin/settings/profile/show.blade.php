@extends('layouts.main')

@section('title', 'Ubah Profil')

@section('styles')
    {{-- Select2 --}}
    <link href="{{ asset('/assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('/assets/plugins/select2/css/select2-bootstrap4.css') }}" rel="stylesheet" />
@endsection
    
@section('content')
    <div class="mdk-drawer-layout__content page ">

        <div class="container-fluid page__container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Ubah Profil</li>
            </ol>
            <h1 class="h2">Ubah Profil</h1>

            <div class="row">
                @if (session('status'))
                    <div class="col-lg-12">
                        <div class="alert alert-dismissible bg-success text-white border-0 fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <strong>Sukses - </strong> {{ session('status') }}
                        </div>
                    </div>
                @endif 
                @if (session('error'))
                    <div class="col-lg-12">
                        <div class="alert alert-dismissible bg-danger text-white border-0 fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <strong>Gagal - </strong> {{ session('error') }}
                        </div>
                    </div>
                @endif 
            </div>

            <div class="card">
                <ul class="nav nav-tabs nav-tabs-card">
                    <li class="nav-item">
                        <a class="nav-link active" href="#first" data-toggle="tab">Data Pribadi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#second" data-toggle="tab">Kontak</a>
                    </li>
                </ul>
                <form action="{{ $c_menu->url }}/{{ session()->get('sid') }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
                    @method('put')
                    @csrf
                    <div class="tab-content card-body">
                        <div class="tab-pane active" id="first">
                            <div class="form-horizontal">
                                <div class="form-group row">
                                    <label for="picture" class="col-sm-3 col-form-label form-label">Foto Profil</label>
                                    <div class="col-sm-9">
                                        <div class="media align-items-center">
                                            <div class="media-left">
                                                <div class="icon-block rounded">
                                                    @if ($detail->picture)
                                                        <img id="show_picture" class="text-muted-light md-36" src="{{ asset('/storage/'.$detail->picture) }}" alt="" style="width: 80px; height: 80px">
                                                    @else
                                                        <i class="material-icons text-muted-light md-36">photo</i>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="media-body">
                                                <div class="custom-file" style="width: auto;">
                                                    <input type="hidden" name="old_picture" value="{{ $detail->picture }}">
                                                    <input type="file" class="custom-file-input @error('picture') is-invalid @enderror" id="image" name="picture" value="{{ old('picture') }}" onchange="readURLPicture(this)">
                                                    <label for="picture" class="custom-file-label">Pilih Foto Profil</label>
                                                    <small class="text-danger">* Maksimal ukuran foto 5 MB</small>
                                                    @error('picture')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="nik" class="col-sm-3 col-form-label form-label">Nomor Induk Kependudukan (NIK)</label>
                                    <div class="col-sm-8">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <input type="text" class="form-control @error('nik') is-invalid @enderror" id="nik" name="nik" value="{{ old('nik', $detail->nik) }}">
                                                @error('nik')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="full_name" class="col-sm-3 col-form-label form-label">Nama Lengkap</label>
                                    <div class="col-sm-8">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <input type="text" class="form-control @error('full_name') is-invalid @enderror" id="full_name" name="full_name" value="{{ old('full_name', $detail->full_name) }}">
                                                @error('full_name')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="birth_place" class="col-sm-3 col-form-label form-label">Tempat, Tanggal Lahir</label>
                                    <div class="col-sm-8">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <input type="text" class="form-control @error('birth_place') is-invalid @enderror" id="birth_place" name="birth_place" value="{{ old('birth_place', $detail->birth_place) }}" placeholder="Tempat Lahir">
                                                @error('birth_place')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <input type="date" class="form-control @error('birth_date') is-invalid @enderror" id="birth_date" name="birth_date" value="{{ old('birth_date', $detail->birth_date) }}">
                                                @error('birth_date')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="biography" class="col-sm-3 col-form-label form-label">Biografi</label>
                                    <div class="col-sm-8">
                                        <div class="row mb-2">
                                            <div class="col-md-12">
                                                <textarea name="biography" id="biography" class="form-control @error('biography') is-invalid @enderror" cols="15" rows="5" placeholder="Masukkan Biografi Anda">{!! old('biography', $detail->biography) !!}</textarea>
                                                @error('biography')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="gender" class="col-sm-3 col-form-label form-label">Jenis Kelamin</label>
                                    <div class="col-sm-8">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <select class="single-select form-control @error('gender') is-invalid @enderror" id="gender" name="gender">
                                                    <option value="l" @if (old('gender', $detail->gender) == 'l') selected @endif>Pria</option>
                                                    <option value="p" @if (old('gender', $detail->gender) == 'p') selected @endif>Wanita</option>
                                                </select>
                                                @error('gender')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="religion" class="col-sm-3 col-form-label form-label">Agama</label>
                                    <div class="col-sm-8">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <select class="single-select form-control @error('religion') is-invalid @enderror" id="religion" name="religion">
                                                    <option value="">=== SILAHKAN PILIH ===</option>
                                                    @if ($religions)
                                                        @foreach ($religions as $item)
                                                            <option value="{{ $item->id }}" @if ($item->id == old('religion', $detail->religion_id)) selected @endif>{{ $item->name }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                @error('religion')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="address_1" class="col-sm-3 col-form-label form-label">Alamat Lengkap</label>
                                    <div class="col-sm-8">
                                        <div class="row mb-2">
                                            <div class="col-md-12">
                                                <textarea name="address_1" id="address_1" class="form-control @error('address_1') is-invalid @enderror" cols="15" rows="5" placeholder="Masukkan Alamat Lengkap">{!! old('address_1', $detail->address_1) !!}</textarea>
                                                @error('address_1')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="form-label" for="address_2">RT</label>
                                                <input type="text" class="form-control @error('address_2') is-invalid @enderror" id="address_2" name="address_2" value="{{ old('address_2', $detail->address_2) }}" placeholder="RT: 002">
                                                @error('address_2')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label" for="address_3">RW</label>
                                                <input type="text" class="form-control @error('address_3') is-invalid @enderror" id="address_3" name="address_3" value="{{ old('address_3', $detail->address_3) }}" placeholder="RW: 003">
                                                @error('address_3')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="username" class="col-sm-3 col-form-label form-label">Nama Pengguna</label>
                                    <div class="col-sm-8">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username', $detail->login->username) }}" disabled>
                                                @error('username')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control @error('new_username') is-invalid @enderror" id="new_username" name="new_username" value="{{ old('new_username') }}" placeholder="Nama Pengguna Baru">
                                                @error('new_username')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="current_password" class="col-sm-3 col-form-label form-label">Kata Sandi</label>
                                    <div class="col-sm-8">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <input type="password" class="form-control @error('current_password') is-invalid @enderror @if (session('err_current_password')) is-invalid @endif" id="current_password" name="current_password" value="{{ old('current_password') }}" placeholder="Kata Sandi Lama">
                                                @error('current_password')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                @if (session('err_current_password'))
                                                    <div class="invalid-feedback">{{ session('err_current_password') }}</div>                                                    
                                                @endif
                                            </div>
                                            <div class="col-md-4">
                                                <input type="password" class="form-control @error('new_password') is-invalid @enderror @if (session('err_new_password')) is-invalid @endif" id="new_password" name="new_password" value="{{ old('new_password') }}" placeholder="Kata Sandi Baru">
                                                @error('new_password')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                @if (session('err_new_password'))
                                                    <div class="invalid-feedback">{{ session('err_new_password') }}</div>                                                    
                                                @endif
                                            </div>
                                            <div class="col-md-4">
                                                <input type="password" class="form-control @error('repassword') is-invalid @enderror" id="repassword" name="repassword" value="{{ old('repassword') }}" placeholder="Kata Sandi Baru">
                                                @error('repassword')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-8 offset-sm-3">
                                        <div class="media align-items-center">
                                            <div class="media-left">
                                                <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="second">
                            <div class="form-horizontal">
                                <div class="form-group row">
                                    <label for="email" class="col-sm-3 col-form-label form-label">Email</label>
                                    <div class="col-sm-8">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $detail->email) }}" placeholder="example@exp.com">
                                                @error('email')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="phone_number" class="col-sm-3 col-form-label form-label">Nomor HP</label>
                                    <div class="col-sm-8">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <input type="text" class="form-control @error('phone_number') is-invalid @enderror" id="phone_number" name="phone_number" value="{{ old('phone_number', $detail->phone_number) }}" placeholder="6285887789988">
                                                @error('phone_number')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="home_number" class="col-sm-3 col-form-label form-label">Nomor Telepon</label>
                                    <div class="col-sm-8">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <input type="text" class="form-control @error('home_number') is-invalid @enderror" id="home_number" name="home_number" value="{{ old('home_number', $detail->home_number) }}" placeholder="0218212482">
                                                @error('home_number')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="twitter" class="col-sm-3 col-form-label form-label">Twitter</label>
                                    <div class="col-sm-8">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <input type="text" class="form-control @error('twitter') is-invalid @enderror" id="twitter" name="twitter" value="{{ old('twitter', $detail->twitter) }}" placeholder="@twitter">
                                                @error('twitter')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="facebook" class="col-sm-3 col-form-label form-label">Facebook</label>
                                    <div class="col-sm-8">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <input type="text" class="form-control @error('facebook') is-invalid @enderror" id="facebook" name="facebook" value="{{ old('facebook', $detail->facebook) }}" placeholder="@facebook">
                                                @error('facebook')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="instagram" class="col-sm-3 col-form-label form-label">Instagram</label>
                                    <div class="col-sm-8">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <input type="text" class="form-control @error('instagram') is-invalid @enderror" id="instagram" name="instagram" value="{{ old('instagram', $detail->instagram) }}" placeholder="@instagram">
                                                @error('instagram')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="github" class="col-sm-3 col-form-label form-label">GitHub</label>
                                    <div class="col-sm-8">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <input type="text" class="form-control @error('github') is-invalid @enderror" id="github" name="github" value="{{ old('github', $detail->github) }}" placeholder="@github">
                                                @error('github')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-8 offset-sm-3">
                                        <div class="media align-items-center">
                                            <div class="media-left">
                                                <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection

@section('scripts')
    {{-- Select2 --}}
    <script src="{{ asset('/assets/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('/assets/js/form-select2.js') }}"></script>

    {{-- Auto Preview --}}
    <script type="text/javascript">
        // For Upload Picture
        function readURLPicture(input) 
        {
            if (input.files && input.files[0])
            {
                var reader = new FileReader()

                reader.onload = function (e) 
                {
                    $('#show_picture').attr('src', e.target.result)
                }

                reader.readAsDataURL(input.files[0])
            }
        }
    </script>
@endsection