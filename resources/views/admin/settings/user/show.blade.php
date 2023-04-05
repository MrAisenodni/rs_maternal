@extends('layouts.main')

@section('title', $c_menu->menu->title)

@section('styles')
@endsection
    
@section('content')
    <div class="mdk-drawer-layout__content page ">

        <div class="container-fluid page__container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ $c_menu->url }}">{{ $c_menu->menu->title }}</a></li>
                <li class="breadcrumb-item active">Detail Pengguna</li>
            </ol>
            <div class="media align-items-center mb-headings">
                <div class="media-body">
                    <h1 class="h2">Detail Pengguna</h1>
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
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <form class="g-3" action="#">
                                        @csrf
                                        <div class="row mb-2">
                                            <div class="col-3">
                                                <label class="form-label" for="nik">NIK</label>
                                                <input type="text" class="form-control @error('nik') is-invalid @enderror" id="nik" name="nik" value="{{ old('nik', $detail->nik) }}" disabled>
                                            </div>
                                            <div class="col-7">
                                                <label class="form-label" for="full_name">Nama Lengkap</label>
                                                <input type="text" class="form-control @error('full_name') is-invalid @enderror" id="full_name" name="full_name" value="{{ old('full_name', $detail->full_name) }}" disabled>
                                            </div>
                                            <div class="col-2">
                                                <label class="form-label" for="gender">Jenis Kelamin</label>
                                                <input type="text" class="form-control @error('gender') is-invalid @enderror" id="gender" name="gender" value="@if ($detail->gender == 'l') Pria @else Wanita @endif" disabled>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-3">
                                                <label class="form-label" for="birth_date">Tanggal Lahir</label>
                                                <input type="date" class="form-control @error('birth_date') is-invalid @enderror" id="birth_date" name="birth_date" value="{{ old('birth_date', date('Y-m-d', strtotime($detail->birth_date))) }}" disabled>
                                            </div>
                                            <div class="col-2">
                                                <label class="form-label" for="birth_place">Tempat Lahir</label>
                                                <input type="text" class="form-control @error('birth_place') is-invalid @enderror" id="birth_place" name="birth_place" value="{{ old('birth_place', $detail->birth_place) }}" disabled>
                                            </div>
                                            <div class="col-3">
                                                <label class="form-label" for="email">Email</label>
                                                <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $detail->email) }}" disabled>
                                            </div>
                                            <div class="col-2">
                                                <label class="form-label" for="phone_number">Nomor HP</label>
                                                <input type="text" class="form-control @error('phone_number') is-invalid @enderror" id="phone_number" name="phone_number" value="{{ old('phone_number', $detail->phone_number) }}" disabled>
                                            </div>
                                            <div class="col-2">
                                                <label class="form-label" for="home_number">Nomor Telepon</label>
                                                <input type="text" class="form-control @error('home_number') is-invalid @enderror" id="home_number" name="home_number" value="{{ old('home_number', $detail->home_number) }}" disabled>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-12">
                                                <label class="form-label" for="address_1">Alamat</label>
                                                <textarea name="address_1" id="address_1" class="form-control @error('address_1') is-invalid @enderror" cols="15" rows="5" disabled>{!! old('address_1', $detail->address_1) !!}</textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-2">
                                                <label class="form-label" for="address_2">RT</label>
                                                <input type="text" class="form-control @error('address_2') is-invalid @enderror" id="address_2" name="address_2" value="{{ old('address_2', $detail->address_2) }}" disabled>
                                            </div>
                                            <div class="col-2">
                                                <label class="form-label" for="address_3">RW</label>
                                                <input type="text" class="form-control @error('address_3') is-invalid @enderror" id="address_3" name="address_3" value="{{ old('address_3', $detail->address_3) }}" disabled>
                                            </div>
                                            <div class="col-4">
                                                <label class="form-label" for="religion">Agama</label>
                                                <input type="text" class="form-control @error('religion') is-invalid @enderror" id="religion" name="religion" value="{{ $detail->religion->name }}" disabled>
                                            </div>
                                            <div class="col-4">
                                                <label class="form-label" for="role">Peran</label>
                                                <input type="text" class="form-control @error('role') is-invalid @enderror" id="role" name="role" value="@if ($detail->role == 'tec') Pengajar @else Member @endif" disabled>
                                            </div>
                                        </div>
                                        <hr>
                                        <h1 class="h4">Akun Pengguna</h1>
                                        <div class="row mb-2">
                                            <div class="col-6">
                                                <label class="form-label" for="username">Nama Pengguna</label>
                                                <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username', $detail->login->username) }}" disabled>
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label" for="current_password">Kata Sandi Lama</label>
                                                <input type="password" class="form-control @error('current_password') is-invalid @enderror" id="current_password" name="current_password" value="{{ old('current_password') }}">
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
@endsection