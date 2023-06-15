@extends('layouts.main')

@section('title', 'Ubah '.$c_menu->title)

@section('styles')
    {{-- Select2 --}}
    <link href="{{ asset('/assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('/assets/plugins/select2/css/select2-bootstrap4.css') }}" rel="stylesheet" />

    {{-- Sweet Alert --}}
    <link href="{{ asset('/assets/plugins/sweet-alert/sweetalert2.min.css') }}" rel="stylesheet" />
@endsection
    
@section('content')
    <div class="mdk-drawer-layout__content page ">

        <div class="container-fluid page__container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ $c_menu->url }}">Daftar {{ $c_menu->title }}</a></li>
                <li class="breadcrumb-item active">Ubah {{ $c_menu->title }}</li>
            </ol>
            <div class="media align-items-center mb-headings">
                <div class="media-body">
                    <h1 class="h2">Ubah {{ $c_menu->title }}</h1>
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
                                    <form class="g-3" action="{{ $c_menu->url }}/{{ $detail->id }}" method="POST" enctype="multipart/form-data">
                                        @method('put')
                                        @csrf
                                        <div class="row mb-2">
                                            <div class="col-11">
                                                <label class="form-label" for="title">Judul <small class="text-danger">*</small></label>
                                                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $detail->title) }}">
                                                @error('title')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-1">
                                                <label class="form-label" for="title_color">&nbsp;</label>
                                                <input type="color" class="form-control @error('title_color') is-invalid @enderror" id="title_color" name="title_color" value="{{ old('title_color', $detail->title_color) }}">
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-12">
                                                <label class="form-label" for="menu">Menu </label>
                                                <input type="text" class="form-control @error('menu') is-invalid @enderror" id="menu" name="menu" value="{{ old('menu', $detail->menu->title) }}" disabled>
                                                @error('menu')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-6">
                                                <label class="form-label" for="picture_header">Foto Header</label>
                                                <span class="desc"></span>
                                                <img id="show_picture_header" class="img-fluid" src="{{ asset('/storage/'.$detail->picture_header) }}" alt="" style="max-width:100%;">
                                                <input type="hidden" name="old_picture" value="{{ $detail->picture_header }}">
                                                <input type="file" class="form-control @error('picture_header') is-invalid @enderror" id="image" name="picture_header" value="{{ old('picture_header') }}" onchange="readURLPicture(this)">
                                                <small class="text-danger">* Maksimal ukuran foto {{ round(substr($app_param[0]->value, 4) / 1048, 0) }} MB</small>
                                                @error('picture_header')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label" for="picture">Foto </label>
                                                <span class="desc"></span>
                                                <img id="show_picture" class="img-fluid" src="{{ old('picture', asset('/storage/'.$detail->picture)) }}" alt="" style="max-width:100%;">
                                                <input type="hidden" name="old_picture" value="{{ $detail->picture }}">
                                                <input type="file" class="form-control @error('picture') is-invalid @enderror" id="image" name="picture" value="{{ old('picture') }}" onchange="readURLPicture(this)">
                                                <small class="text-danger">* Maksimal ukuran foto {{ round(substr($app_param[0]->value, 4) / 1048, 0) }} MB</small>
                                                @error('picture')
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

    {{-- Sweet Alert --}}
    <script src="{{ asset('/assets/plugins/sweet-alert/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('/assets/js/sweet-alert.init.js') }}"></script>

    {{-- Auto Preview --}}
    <script type="text/javascript">
        // For Upload Picture
        function readURLPicture(input) 
        {
            if (input.files && input.files[0])
            {
                var reader = new FileReader()
                var name = input.name
                
                reader.onload = function (e) 
                {
                    $('#show_'+name).attr('src', e.target.result)
                }

                reader.readAsDataURL(input.files[0])
            }
        }
    </script>
@endsection