@extends('layouts.main')

@section('title', 'Ubah Materi Pembelajaran')

@section('styles')
    {{-- Select2 --}}
    <link href="{{ asset('/assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('/assets/plugins/select2/css/select2-bootstrap4.css') }}" rel="stylesheet" />

    <!-- Quill Theme -->
    <link type="text/css" href="{{ asset('/assets/css/quill.css') }}" rel="stylesheet">
@endsection
    
@section('content')
    <div class="mdk-drawer-layout__content page ">

        <div class="container-fluid page__container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="/admin/course-header">{{ $c_menu->title }}</a></li>
                <li class="breadcrumb-item"><a href="/admin/course-header/{{ $detail->course_header_id }}/edit">Detail Materi</a></li>
                <li class="breadcrumb-item active">Ubah Materi Pembelajaran</li>
            </ol>
            <div class="media align-items-center mb-headings">
                <div class="media-body">
                    <h1 class="h2">Ubah Materi Pembelajaran</h1>
                </div>
                <div class="media-right">
                    @if ($access->add == 1)
                        <div class="ms-auto">
                            <div class="btn-group">
                                <a href="{{ $c_menu->url }}/{{ $detail->course_header_id }}/create" class="btn btn-primary">TAMBAH</a>
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
                                                <label class="form-label" for="title">Judul Materi Pembelajaran <small class="text-danger">*</small></label>
                                                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $detail->title) }}">
                                                @error('title')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-12">
                                                <iframe id="show_video" class="embed-responsive-item" src="{{ old('video', asset('/storage/'.$detail->video)) }}" allowfullscreen="" style="width: 100%; height: 300px"></iframe>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-12">
                                                <label class="form-label" for="video">Upload Video <small class="text-danger">*</small></label>
                                                <span class="desc"></span>
                                                <input type="hidden" name="old_video" value="{{ $detail->video }}">
                                                <input type="file" class="form-control @error('video') is-invalid @enderror" id="video" name="video" value="{{ old('video', $detail->video) }}" onchange="readURLVideo(this)">
                                                @error('video')
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
                                                {{-- @if ($access->add == 1) --}}
                                                    <div class="d-grid">
                                                        <a href="/admin/course-header/{{ $detail->course_header_id }}/edit" class="btn btn-warning">KEMBALI</a>
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

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="media align-items-center mb-headings">
                                        <div class="media-body">
                                            <h1 class="h2">Daftar Dokumen</h1>
                                        </div>
                                        <div class="media-right">
                                            @if ($access->add == 1)
                                                <div class="ms-auto">
                                                    <div class="btn-group">
                                                        <a href="/admin/course-detail_document/{{ $detail->id }}/create" class="btn btn-primary">Tambah</a>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div><hr>
                                    <div class="table-responsive">
                                        <table id="default" class="table table-striped table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th style="width: 5%">No</th>
                                                    <th>Judul</th>
                                                    <th>Deskripsi</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($data)
                                                    @foreach ($data as $item)
                                                        <tr data-id="{{ $item->id }}">
                                                            <td class="text-center">{{ $loop->iteration }}</td>
                                                            <td>{{ $item->title }}</td>
                                                            <td>{{ $item->description }}</td>
                                                            <td class="text-center" style="width: 30mm">
                                                                @if ($access->edit == 1)
                                                                    <a href="/admin/course-detail_document/{{ $item->id }}/edit"><i class="fa fa-edit"></i></a>
                                                                @endif
                                                                @if ($access->delete == 1)
                                                                <form action="/admin/course-detail_document/{{ $item->id }}" method="POST" class="d-inline">
                                                                    @method('delete')
                                                                    @csrf
                                                                    <button id="delete" type="submit" class="fa fa-trash text-danger sa-warning" style="border: 0px; background: 0%"></button>
                                                                </form>
                                                                @endif
                                                                @if ($access->detail == 1)
                                                                    <a href="/admin/course-detail_document/{{ $item->id }}"><i class="fa fa-eye"></i></a>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
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
        function readURLVideo(input) 
        {
            if (input.files && input.files[0])
            {
                var reader = new FileReader()

                reader.onload = function (e) 
                {
                    $('#show_video').attr('src', e.target.result)
                }

                reader.readAsDataURL(input.files[0])
            }
        }
    </script>
@endsection