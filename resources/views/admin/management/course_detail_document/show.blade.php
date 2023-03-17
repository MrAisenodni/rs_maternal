@extends('layouts.main')

@section('title', $c_menu->title)

@section('styles')
@endsection
    
@section('content')
    <div class="mdk-drawer-layout__content page ">

        <div class="container-fluid page__container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="/admin/course_header">{{ $c_menu->title }}</a></li>
                <li class="breadcrumb-item"><a href="/admin/course_header">Detail Materi</a></li>
                <li class="breadcrumb-item"><a href="/admin/course_detail/{{ $detail->course_detail_id }}/edit">Detail Materi Pembelajaran</a></li>
                <li class="breadcrumb-item active">Ubah Dokumen</li>
            </ol>
            <div class="media align-items-center mb-headings">
                <div class="media-body">
                    <h1 class="h2">Detail Dokumen</h1>
                </div>
                <div class="media-right">
                    @if ($access->add == 1)
                        <div class="ms-auto">
                            <div class="btn-group">
                                <a href="{{ $c_menu->url }}/{{ $detail->course_detail_id }}/create" class="btn btn-primary">TAMBAH</a>
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
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <form class="g-3" action="{{ $c_menu->url }}/{{ $detail->id }}" method="POST" enctype="multipart/form-data">
                                        @method('put')
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $detail->course_header_id }}">
                                        <div class="row mb-2">
                                            <div class="col-12">
                                                <label class="form-label" for="title">Judul Dokumen <small class="text-danger">*</small></label>
                                                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $detail->title) }}" disabled>
                                                @error('title')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-12">
                                                <label class="form-label" for="document">Upload Dokumen <small class="text-danger">*</small></label>
                                                <span class="desc"></span>
                                                <input type="hidden" name="document" value="{{ $detail->document }}">
                                                <input type="file" class="form-control @error('document') is-invalid @enderror" id="document" name="document" value="{{ old('document', $detail->document) }}" onchange="readURL(this)" disabled>
                                                <a href="/download/?file={{ storage_path('public/', $detail->file) }}">{{ $detail->file_name }}</a>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-12">
                                                <label class="form-label" for="description">Deskripsi</label>
                                                <textarea name="description" id="description" class="form-control" cols="30" rows="10" disabled>{!! old('description', $detail->description) !!}</textarea>
                                                @error('description')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <a href="/admin/course_detail/{{ $detail->course_detail_id }}/edit" class="btn btn-warning">KEMBALI</a>
                                                    @if ($access->edit == 1)
                                                        <a href="{{ $c_menu->url }}/{{ $detail->id }}/edit" class="btn btn-primary">UBAH</a>
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
@endsection