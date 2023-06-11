@extends('layouts.main')

@section('title', 'Detail Best Practice')

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
                <li class="breadcrumb-item"><a href="{{ $c_menu->url }}">Daftar Best Practice</a></li>
                <li class="breadcrumb-item active">Detail Best Practice</li>
            </ol>
            <div class="media align-items-center mb-headings">
                <div class="media-body">
                    <h1 class="h2">Detail Best Practice</h1>
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
                        <div class="col-lg-12">
                            <form class="g-3" action="#" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row mb-2">
                                            <div class="col-12">
                                                <label class="form-label" for="title">Judul Materi</label>
                                                <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $detail->title) }}" disabled>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-12">
                                                <label class="form-label" for="subtitle">Sub Judul Materi</label>
                                                <input type="text" class="form-control" id="subtitle" name="subtitle" value="{{ old('subtitle', $detail->subtitle) }}" disabled>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-12">
                                                <label class="form-label" for="picture">Foto Materi</label>
                                                <span class="desc"></span>
                                                <img id="show_picture" class="img-fluid" src="{{ asset('/storage/'.$detail->picture) }}" alt="" style="max-width:100%;">
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-12">
                                                <label class="form-label" for="description">Deskripsi</label>
                                                {!! $detail->description !!}
                                            </div>
                                        </div>
                                        @if ($detail->type == 'home') 
                                            <div class="row mb-2">
                                                <div class="col-12">
                                                    <label class="form-label" for="side_description">Deskripsi Pendamping </label>
                                                    {!! $detail->side_description !!}
                                                </div>
                                            </div>
                                        @endif
                                        <hr>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <a href="{{ $c_menu->url }}" class="btn btn-warning">KEMBALI</a>
                                                    @if ($access->edit == 1)
                                                        <a href="{{ $c_menu->url }}/{{ $detail->id }}/edit" class="btn btn-primary">UBAH</a>
                                                    @endif
                                                </div>
                                            </div>
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
@endsection

@section('scripts')
    {{-- Select2 --}}
    <script src="{{ asset('/assets/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('/assets/js/form-select2.js') }}"></script>

    {{-- tinymce js --}}
    <script src="{{ asset('/assets/plugins/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('/assets/js/form-editor.init.js') }}"></script>
@endsection