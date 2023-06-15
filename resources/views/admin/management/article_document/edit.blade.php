@extends('layouts.main')

@section('title', 'Ubah Dokumen')

@section('styles')
@endsection
    
@section('content')
    <div class="mdk-drawer-layout__content page ">

        <div class="container-fluid page__container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="/admin/best-practice">Daftar Best Practice</a></li>
                <li class="breadcrumb-item"><a href="/admin/best-practice/{{ $detail->article_id }}/edit">Detail Best Practice</a></li>
                <li class="breadcrumb-item active">Ubah Dokumen</li>
            </ol>
            <div class="media align-items-center mb-headings">
                <div class="media-body">
                    <h1 class="h2">Ubah Dokumen</h1>
                </div>
                <div class="media-right">
                    @if ($access->add == 1)
                        <div class="ms-auto">
                            <div class="btn-group">
                                <a href="{{ $c_menu->url }}/{{ $detail->article_id }}/create" class="btn btn-primary">TAMBAH</a>
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
                                        <input type="hidden" name="article_id" value="{{ $detail->article_id }}">
                                        <div class="row mb-2">
                                            <div class="col-12">
                                                <label class="form-label" for="title">Judul Dokumen <small class="text-danger">*</small></label>
                                                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $detail->title) }}">
                                                @error('title')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-12">
                                                <label class="form-label" for="document">Upload Dokumen <small class="text-danger">*</small></label>
                                                <span class="desc"></span>
                                                <input type="hidden" name="old_document" value="{{ $detail->file }}">
                                                <input type="file" class="form-control @error('document') is-invalid @enderror" id="document" name="document" value="{{ old('document', $detail->file) }}" onchange="readURL(this)">
                                                <a href="{{ asset('/storage/'.$detail->file) }}">{{ $detail->file_name }}</a>
                                                <small class="text-danger">* Maksimal ukuran dokumen {{ round(substr($app_param[0]->value, 4) / 1048, 0) }} MB</small>
                                                @error('document')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-12">
                                                <label class="form-label" for="description">Deskripsi</label>
                                                <textarea name="description" id="description" class="form-control" cols="30" rows="10">{!! old('description', $detail->description) !!}</textarea>
                                                @error('description')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <a href="/admin/best-practice/{{ $detail->article_id }}/edit" class="btn btn-warning">KEMBALI</a>
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