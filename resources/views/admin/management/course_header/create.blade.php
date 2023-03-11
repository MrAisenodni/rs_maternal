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
                <li class="breadcrumb-item active">Tambah Materi</li>
            </ol>
            <div class="media align-items-center mb-headings">
                <div class="media-body">
                    <h1 class="h2">Tambah Materi</h1>
                </div>
                <div class="media-right">
                    {{-- @if ($access->add == 1)
                        <div class="ms-auto">
                            <div class="btn-group">
                                <a href="{{ $c_menu->url }}/create" class="btn btn-primary">Tambah</a>
                            </div>
                        </div>
                    @endif --}}
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
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <form class="g-3" action="{{ $c_menu->url }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row mb-2">
                                            <div class="col-6">
                                                <label class="form-label" for="title">Judul Materi <small class="text-danger">*</small></label>
                                                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}">
                                                @error('title')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label" for="doctor">Dokter <small class="text-danger">*</small></label>
                                                @if (session()->get('srole') == 'tec')
                                                    <input type="hidden" class="form-control" id="doctor" name="doctor" value="{{ $doctor->id }}">
                                                    <input type="text" class="form-control @error('doctor') is-invalid @enderror" id="doctor" value="[{{ $doctor->nik }}] {{ $doctor->full_name }}" disabled>
                                                @else
                                                    <select class="select-wards form-control @error('doctor') is-invalid @enderror" id="doctor" name="doctor">
                                                        <option value="">=== SILAHKAN PILIH ===</option>
                                                        @if ($doctors)
                                                            @foreach ($doctors as $item)
                                                                <option value="{{ $item->id }}" @if ($item->id == old('doctor')) selected @endif>[{{ $item->nik }}] {{ $item->full_name }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                @endif
                                                @error('doctor')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-6">
                                                <label class="form-label" for="category">Kategori <small class="text-danger">*</small></label>
                                                <select class="select-wards form-control @error('category') is-invalid @enderror" id="category" name="category">
                                                    <option value="">=== SILAHKAN PILIH ===</option>
                                                    @if ($categories)
                                                        @foreach ($categories as $item)
                                                            <option value="{{ $item->id }}" @if ($item->id == old('category')) selected @endif>{{ $item->name }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                @error('category')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label" for="level">Tingkatan <small class="text-danger">*</small></label>
                                                <select class="select-wards form-control @error('level') is-invalid @enderror" id="level" name="level">
                                                    <option value="">=== SILAHKAN PILIH ===</option>
                                                    @if ($levels)
                                                        @foreach ($levels as $item)
                                                            <option value="{{ $item->id }}" @if ($item->id == old('level')) selected @endif>{{ $item->name }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                @error('level')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-3">
                                                <label class="form-label" for="picture">Foto Materi <small class="text-danger">*</small></label>
                                                <span class="desc"></span>
                                                <img class="img-fluid" src="" alt="" style="max-width:100%;">
                                                <input type="file" class="form-control @error('picture') is-invalid @enderror" id="image" name="picture" value="{{ old('picture') }}">
                                                @error('picture')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-9">
                                                <label class="form-label" for="description">Deskripsi</label>
                                                <textarea name="description" id="description" class="form-control" cols="30" rows="10">{!! old('description') !!}</textarea>
                                                @error('description')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-12">
                                                {{-- @if ($access->add == 1) --}}
                                                    <div class="d-grid">
                                                        <a href="{{ $c_menu->url }}" class="btn btn-warning">KEMBALI</a>
                                                        <button type="submit" class="btn btn-success">SIMPAN</button>
                                                    </div>
                                                {{-- @endif --}}
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