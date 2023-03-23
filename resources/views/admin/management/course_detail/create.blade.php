@extends('layouts.main')

@section('title', 'Tambah Materi Pembelajaran')

@section('styles')
    {{-- Quill Theme --}}
    <link type="text/css" href="{{ asset('/assets/css/quill.css') }}" rel="stylesheet">
@endsection
    
@section('content')
    <div class="mdk-drawer-layout__content page ">

        <div class="container-fluid page__container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="/admin/course-header">Daftar Materi</a></li>
                <li class="breadcrumb-item"><a href="/admin/course-header/{{ $id }}/edit">Detail Materi</a></li>
                <li class="breadcrumb-item active">Tambah Materi Pembelajaran</li>
            </ol>
            <div class="media align-items-center mb-headings">
                <div class="media-body">
                    <h1 class="h2">Tambah Materi Pembelajaran</h1>
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
                                    <form id="fileUploadForm" class="g-3" action="{{ $c_menu->url }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $id }}">
                                        <div class="row mb-2">
                                            <div class="col-12">
                                                <label class="form-label" for="title">Judul Materi Pembelajaran <small class="text-danger">*</small></label>
                                                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}">
                                                @error('title')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-12">
                                                <iframe id="show_video" class="embed-responsive-item" src="{{ old('video') }}" allowfullscreen="" style="width: 100%; height: 300px"></iframe>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-12">
                                                <div class="progress" style="height: 20px;">
                                                    <div id="video-progress" class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                                                </div>
                                                <label class="form-label" for="video">Upload Video <small class="text-danger">*</small></label>
                                                <span class="desc"></span>
                                                <input type="file" class="form-control @error('video') is-invalid @enderror" id="image" name="video" value="{{ old('video') }}" onchange="readURLVideo(this)">
                                                @error('video')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-12">
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
                                                        <a href="/admin/course-header/{{ $id }}/edit" class="btn btn-warning">KEMBALI</a>
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
    {{-- Quill Theme --}}
    <script src="{{ asset('/assets/vendor/quill.min.js') }}"></script>
    <script src="{{ asset('/assets/js/quill.js') }}"></script>

    {{-- Auto Preview --}}
    <script type="text/javascript">
        function readURLVideo(input) 
        {
            if (input.files && input.files[0])
            {
                var reader = new FileReader()

                reader.onprogress = function (e)
                {
                    var percent = (event.loaded / event.total) * 100
                    $("#video-progress").attr('aria-valuenow', Math.round(percent))
                    $("#video-progress").attr('style', "width: " + Math.round(percent) + "%")
                    $("#video-progress").text(Math.round(percent) + "%")
                }

                reader.onload = function (e) 
                {
                    $('#show_video').attr('src', e.target.result)
                }

                reader.readAsDataURL(input.files[0])
            }
        }
    </script>
@endsection