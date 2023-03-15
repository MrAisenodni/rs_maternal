@extends('layouts.main')

@section('title', $c_menu->title)

@section('styles')
    {{-- Select2 --}}
    <link href="{{ asset('/assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('/assets/plugins/select2/css/select2-bootstrap4.css') }}" rel="stylesheet" />

    {{-- Quill Theme --}}
    <!-- Quill Theme -->
    <link type="text/css" href="{{ asset('/assets/css/quill.css') }}" rel="stylesheet">
@endsection
    
@section('content')
    <div class="mdk-drawer-layout__content page ">

        <div class="container-fluid page__container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ $c_menu->url }}">{{ $c_menu->title }}</a></li>
                <li class="breadcrumb-item active">Tambah Pengguna</li>
            </ol>
            <div class="media align-items-center mb-headings">
                <div class="media-body">
                    <h1 class="h2">Tambah Pengguna</h1>
                </div>
                <div class="media-right">
                    @if ($access->add == 1)
                        <div class="ms-auto">
                            <div class="btn-group">
                                <a href="{{ $c_menu->url }}/create" class="btn btn-primary">Tambah</a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        @if (session('status'))
                            <div class="col-12">
                                <div class="alert alert-dismissible bg-success text-white border-0 fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <strong>Sukses - </strong> {{ session('status') }}
                                </div>
                            </div>
                        @endif 
                        @if (session('error'))
                            <div class="col-12">
                                <div class="alert alert-dismissible bg-danger text-white border-0 fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <strong>Gagal - </strong> {{ session('error') }}
                                </div>
                            </div>
                        @endif 
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <form class="g-3" action="{{ $c_menu->url }}/{{ $detail->id }}" method="POST" enctype="multipart/form-data">
                                        @method('put')
                                        @csrf
                                        <div class="row mb-2">
                                            <div class="col-3">
                                                <label class="form-label" for="nik">NIK <small class="text-danger">*</small></label>
                                                <input type="text" class="form-control @error('nik') is-invalid @enderror" id="nik" name="nik" value="{{ old('nik', $detail->nik) }}">
                                                @error('nik')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-7">
                                                <label class="form-label" for="full_name">Nama Lengkap <small class="text-danger">*</small></label>
                                                <input type="text" class="form-control @error('full_name') is-invalid @enderror" id="full_name" name="full_name" value="{{ old('full_name', $detail->full_name) }}">
                                                @error('full_name')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-2">
                                                <label class="form-label" for="gender">Jenis Kelamin <small class="text-danger">*</small></label>
                                                <select class="select-wards form-control @error('gender') is-invalid @enderror" id="gender" name="gender">
                                                    <option value="l" @if (old('gender', $detail->gender) == 'l') selected @endif>Pria</option>
                                                    <option value="p" @if (old('gender', $detail->gender) == 'p') selected @endif>Wanita</option>
                                                </select>
                                                @error('gender')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-3">
                                                <label class="form-label" for="birth_date">Tanggal Lahir</label>
                                                <input type="date" class="form-control @error('birth_date') is-invalid @enderror" id="birth_date" name="birth_date" value="{{ old('birth_date', date('Y-m-d', strtotime($detail->birth_date))) }}">
                                                @error('birth_date')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-2">
                                                <label class="form-label" for="birth_place">Tempat Lahir</label>
                                                <input type="text" class="form-control @error('birth_place') is-invalid @enderror" id="birth_place" name="birth_place" value="{{ old('birth_place', $detail->birth_place) }}">
                                                @error('birth_place')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-3">
                                                <label class="form-label" for="email">Email</label>
                                                <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $detail->email) }}">
                                                @error('email')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-2">
                                                <label class="form-label" for="phone_number">Nomor HP</label>
                                                <input type="text" class="form-control @error('phone_number') is-invalid @enderror" id="phone_number" name="phone_number" value="{{ old('phone_number', $detail->phone_number) }}">
                                                @error('phone_number')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-2">
                                                <label class="form-label" for="home_number">Nomor Telepon</label>
                                                <input type="text" class="form-control @error('home_number') is-invalid @enderror" id="home_number" name="home_number" value="{{ old('home_number', $detail->home_number) }}">
                                                @error('home_number')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-12">
                                                <label class="form-label" for="address_1">Alamat</label>
                                                <textarea name="address_1" id="address_1" class="form-control @error('address_1') is-invalid @enderror" cols="15" rows="5">{!! old('address_1', $detail->address_1) !!}</textarea>
                                                @error('address_1')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-2">
                                                <label class="form-label" for="address_2">RT</label>
                                                <input type="text" class="form-control @error('address_2') is-invalid @enderror" id="address_2" name="address_2" value="{{ old('address_2', $detail->address_2) }}">
                                                @error('address_2')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-2">
                                                <label class="form-label" for="address_3">RW</label>
                                                <input type="text" class="form-control @error('address_3') is-invalid @enderror" id="address_3" name="address_3" value="{{ old('address_3', $detail->address_2) }}">
                                                @error('address_3')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-4">
                                                <label class="form-label" for="religion">Agama <small class="text-danger">*</small></label>
                                                <select class="select-wards form-control @error('religion') is-invalid @enderror" id="religion" name="religion">
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
                                            <div class="col-4">
                                                <label class="form-label" for="role">Peran <small class="text-danger">*</small></label>
                                                <select class="select-wards form-control @error('role') is-invalid @enderror" id="role" name="role">
                                                    <option value="tec" @if (old('role', $detail->role) == 'tec') selected @endif>Dokter</option>
                                                    <option value="pat" @if (old('role', $detail->role) == 'pat') selected @endif>Pasien</option>
                                                </select>
                                                @error('role')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <hr>
                                        <h1 class="h4">Akun Pengguna</h1>
                                        <div class="row mb-2">
                                            <div class="col-4">
                                                <label class="form-label" for="username">Nama Pengguna <small class="text-danger">*</small></label>
                                                <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username', $detail->login->username) }}" disabled>
                                                @error('username')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-4">
                                                <label class="form-label" for="current_password">Kata Sandi Lama</label>
                                                <input type="password" class="form-control @error('current_password') is-invalid @enderror" id="current_password" name="current_password" value="{{ old('current_password') }}">
                                                @error('current_password')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-4">
                                                <label class="form-label" for="new_password">Kata Sandi Baru</label>
                                                <input type="password" class="form-control @error('new_password') is-invalid @enderror" id="new_password" name="new_password" value="{{ old('new_password') }}">
                                                @error('new_password')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <a href="{{ $c_menu->url }}" class="btn btn-warning">KEMBALI</a>
                                                    <button type="submit" class="btn btn-success">SIMPAN</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {{-- Select2 --}}
    <script src="{{ asset('/assets/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('/assets/js/form-select2.js') }}"></script>

    {{-- Quill Theme --}}
    <script src="{{ asset('/assets/vendor/quill.min.js') }}"></script>
    <script src="{{ asset('/assets/js/quill.js') }}"></script>
@endsection