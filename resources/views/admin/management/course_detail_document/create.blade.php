@extends('layouts.main')

@section('title', 'Tambah Dokumen')

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
                <li class="breadcrumb-item"><a href="/admin/course-header">Daftar Materi</a></li>
                <li class="breadcrumb-item"><a href="/admin/course-header/{{ $course_detail->course_header_id }}/edit">Detail Materi</a></li>
                <li class="breadcrumb-item"><a href="/admin/course-detail/{{ $course_detail->id }}/edit">Detail Pembelajaran</a></li>
                <li class="breadcrumb-item active">Tambah Dokumen</li>
            </ol>
            <div class="media align-items-center mb-headings">
                <div class="media-body">
                    <h1 class="h2">Tambah Dokumen</h1>
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
                                        <input type="hidden" name="id" value="{{ $course_detail->id }}">
                                        <div class="row mb-2">
                                            <div class="col-12">
                                                <label class="form-label" for="title">Judul Dokumen <small class="text-danger">*</small></label>
                                                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}">
                                                @error('title')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-12">
                                                <label class="form-label" for="document">Upload Dokumen <small class="text-danger">*</small></label>
                                                <span class="desc"></span>
                                                <input type="file" class="form-control @error('document') is-invalid @enderror" id="image" name="document" value="{{ old('document') }}" onchange="readURL(this)">
                                                <small class="text-danger">* Maksimal ukuran dokumen 50 MB</small>
                                                @error('document')
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
                                                <div class="d-grid">
                                                    <a href="/admin/course-detail/{{ $course_detail->id }}/edit" class="btn btn-warning">KEMBALI</a>
                                                    @if ($access->add == 1)
                                                        <button type="submit" class="btn btn-success">SIMPAN</button>
                                                    @endif
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

    {{-- Auto Preview --}}
    <script type="text/javascript">
        function readURL(input) 
        {
            if (input.files && input.files[0])
            {
                var reader = new FileReader()

                reader.onload = function (e) 
                {
                    $('#auto_preview').attr('src', e.target.result)
                }

                reader.readAsDataURL(input.files[0])
            }
        }
    </script>
@endsection