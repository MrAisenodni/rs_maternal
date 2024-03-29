@extends('layouts.main')

@section('title', 'Detail Approval Materi')

@section('styles')
    {{-- Data Table --}}
    <link href="{{ asset('/assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
@endsection
    
@section('content')
    <div class="mdk-drawer-layout__content page ">

        <div class="container-fluid page__container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ $c_menu->url }}">{{ $c_menu->menu->title }}</a></li>
                <li class="breadcrumb-item active">Detail Approval Materi</li>
            </ol>
            <div class="media align-items-center mb-headings">
                <div class="media-body">
                    <h1 class="h2">Detail Approval Materi</h1>
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
                            @if ($detail->action == 'add')
                                <form class="g-3" action="{{ $c_menu->url }}/{{ $detail->id }}" method="POST" enctype="multipart/form-data">
                                    @method('put')
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $detail->id }}">
                                    <input type="hidden" name="course_header_id" value="{{ $detail->course_header_id }}">
                                    <input type="hidden" name="course_detail_approval_id" value="{{ $detail->course_detail_approval_id }}">
                                    <input type="hidden" name="course_detail_id" value="{{ $detail->course_detail_id }}">
                                    <input type="hidden" name="course_detail_document_approval_id" value="{{ $detail->course_detail_document_approval_id }}">
                                    <input type="hidden" name="course_detail_document_id" value="{{ $detail->course_detail_document_id }}">
                                    <input type="hidden" name="action" value="{{ $detail->action }}">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row mb-n3">
                                                <div class="col-4 h3">Tambah Data Materi</div>
                                                <div class="col-4 h3">Tambah Data Pembelajaran</div>
                                                <div class="col-4 h3">Tambah Data Dokumen</div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-4">
                                                    <label class="form-label" for="title">Judul Materi</label>
                                                    <div class="">{{ $detail->title }}</div>
                                                    <input type="hidden" name="title" value="{{ $detail->title }}">
                                                </div>
                                                <div class="col-4">
                                                    <label class="form-label" for="course_detail_title">Judul Pembelajaran</label>
                                                    <div class="">{{ $detail->course_detail_title }}</div>
                                                    <input type="hidden" name="course_detail_title" value="{{ $detail->course_detail_title }}">
                                                </div>
                                                <div class="col-4">
                                                    <label class="form-label" for="course_detail_document_title">Judul Dokumen</label>
                                                    <div class="">{{ $detail->course_detail_document_title }}</div>
                                                    <input type="hidden" name="course_detail_document_title" value="{{ $detail->course_detail_document_title }}">
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-4">
                                                    <label class="form-label" for="picture">Foto Materi</label>
                                                    <span class="desc"></span>
                                                    <img id="show_picture" class="img-fluid" src="{{ asset('/storage/'.$detail->picture) }}" alt="" style="max-width:100%; max-height: 250px">
                                                    <input type="hidden" name="picture" value="{{ $detail->picture }}">
                                                    <input type="hidden" name="picture_name" value="{{ $detail->picture_name }}">
                                                </div>
                                                <div class="col-4">
                                                    <label class="form-label" for="video">Upload Video</label>
                                                    <iframe id="show_video" class="embed-responsive-item" src="{{ asset('/storage/'.$detail->video) }}" allowfullscreen="" style="width: 100%; height: 250px"></iframe>
                                                    <input type="hidden" name="video" value="{{ $detail->video }}">
                                                    <input type="hidden" name="video_name" value="{{ $detail->video_name }}">
                                                    <input type="hidden" name="playtime" value="{{ $detail->playtime }}">
                                                    <input type="hidden" name="course_detail_duration" value="{{ $detail->course_detail_duration }}">
                                                </div>
                                                <div class="col-4">    
                                                    <label class="form-label" for="document">Dokumen </label>
                                                    <span class="desc"></span><br>
                                                    <a href="{{ asset('/storage/'.$detail->file) }}">{{ $detail->file_name }}</a>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-4">
                                                    <label class="form-label" for="description">Deskripsi Materi</label>
                                                    <div class="">{{ $detail->description }}</div>
                                                    <input type="hidden" name="description" value="{{ $detail->description }}">
                                                </div>
                                                <div class="col-4">
                                                    <label class="form-label" for="course_detail_description">Deskripsi Pembelajaran</label>
                                                    <div class="">{{ $detail->course_detail_description }}</div>
                                                    <input type="hidden" name="course_detail_description" value="{{ $detail->course_detail_description }}">
                                                </div>
                                                <div class="col-4">
                                                    <label class="form-label" for="course_detail_document_description">Deskripsi Dokumen</label>
                                                    <div class="">{{ $detail->course_detail_document_description }}</div>
                                                    <input type="hidden" name="course_detail_document_description" value="{{ $detail->course_detail_document_description }}">
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-4">
                                                    <label class="form-label" for="created_by">Dibuat Oleh</label>
                                                    <div class="">{{ $detail->created_by }}</div>
                                                    <input type="hidden" class="form-control" id="created_by" name="created_by" value="{{ $detail->created_by }}">
                                                </div>
                                                <div class="col-4">
                                                    <label class="form-label" for="created_by">Dibuat Oleh</label>
                                                    <div class="">{{ $detail->created_by }}</div>
                                                    <input type="hidden" class="form-control" id="created_by" name="created_by" value="{{ $detail->created_by }}">
                                                </div>
                                                <div class="col-4">
                                                    <label class="form-label" for="created_by">Dibuat Oleh</label>
                                                    <div class="">{{ $detail->created_by }}</div>
                                                    <input type="hidden" class="form-control" id="created_by" name="created_by" value="{{ $detail->created_by }}">
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-4">
                                                    <label class="form-label" for="created_at">Dibuat Dari</label>
                                                    <div class="">{{ date('d-M-Y', strtotime($detail->created_at)) }}</div>
                                                    <input type="hidden" class="form-control" id="created_at" name="created_at" value="{{ $detail->created_at }}">
                                                </div>
                                                <div class="col-4">
                                                    <label class="form-label" for="created_at">Dibuat Dari</label>
                                                    <div class="">{{ date('d-M-Y', strtotime($detail->created_at)) }}</div>
                                                    <input type="hidden" class="form-control" id="created_at" name="created_at" value="{{ $detail->created_at }}">
                                                </div>
                                                <div class="col-4">
                                                    <label class="form-label" for="created_at">Dibuat Dari</label>
                                                    <div class="">{{ date('d-M-Y', strtotime($detail->created_at)) }}</div>
                                                    <input type="hidden" class="form-control" id="created_at" name="created_at" value="{{ $detail->created_at }}">
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-4">
                                                    <label class="form-label" for="doctor">Dokter Pengajar</label>
                                                    <div class="">[{{ $detail->teacher->nik }}] {{ $detail->teacher->full_name }}</div>
                                                    <input type="hidden" name="doctor" value="{{ $detail->course_teacher_id }}">
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-4">
                                                    <label class="form-label" for="category">Kategori</label>
                                                    <div class="">{{ $detail->category->name }}</div>
                                                    <input type="hidden" name="category" value="{{ $detail->category_id }}">
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-4">
                                                    <label class="form-label" for="level">Tingkatan</label>
                                                    <div class="">{{ $detail->level->name }}</div>
                                                    <input type="hidden" name="level" value="{{ $detail->level_id }}">
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="d-grid">
                                                        <a href="{{ $c_menu->url }}" class="btn btn-warning">KEMBALI</a>
                                                        <a href="#" class="btn btn-danger">TOLAK</a>
                                                        <button type="submit" class="btn btn-success">SETUJU</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            @else
                                <form class="g-3" action="{{ $c_menu->url }}/{{ $detail->id }}" method="POST" enctype="multipart/form-data">
                                    @method('put')
                                    @csrf
                                    <input type="hidden" name="course_header_id" value="{{ $detail->course_header_id }}">
                                    <input type="hidden" name="action" value="{{ $detail->action }}">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row mb-n3">
                                                <div class="col-6 h3">Data Sebelum</div>
                                                <div class="col-6 h3">Data Sesudah</div>
                                            </div>
                                            <hr>
                                            <div class="row mb-2">
                                                <div class="col-6">
                                                    <label class="form-label" for="action">Aksi</label>
                                                    @if ($detail->action == 'edit')
                                                        <div class="text-success">
                                                            Ubah
                                                        </div>
                                                    @else
                                                        <div class="text-danger">
                                                            Hapus
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-6">
                                                    <label class="form-label" for="title">Judul Materi</label>
                                                    <div class="">{{ $detail->course_header->title }}</div>
                                                </div>
                                                <div class="col-6">
                                                    <label class="form-label" for="title">Judul Materi</label>
                                                    <div class="@if ($detail->title != $detail->course_header->title) text-danger @endif">{{ $detail->title }}</div>
                                                    <input type="hidden" class="form-control" id="title" name="title" value="{{ old('title', $detail->title) }}">
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-6">
                                                    <label class="form-label" for="doctor">Dokter</label>
                                                    <div class="">{{ '['.$detail->course_header->teacher->nik.'] '.$detail->course_header->teacher->full_name }}</div>
                                                </div>
                                                <div class="col-6">
                                                    <label class="form-label" for="doctor">Dokter</label>
                                                    <div class="@if ($detail->course_teacher_id != $detail->course_header->course_teacher_id) text-danger @endif">{{ '['.$detail->course_header->teacher->nik.'] '.$detail->course_header->teacher->full_name }}</div>
                                                    <input type="hidden" class="form-control" id="doctor" name="doctor" value="{{ old('doctor', $detail->course_teacher_id) }}">
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-6">
                                                    <label class="form-label" for="category">Kategori</label>
                                                    <div class="">{{ $detail->course_header->category->name }}</div>
                                                </div>
                                                <div class="col-6">
                                                    <label class="form-label" for="category">Kategori</label>
                                                    <div class="@if ($detail->category_id != $detail->course_header->category_id) text-danger @endif">{{ $detail->category->name }}</div>
                                                    <input type="hidden" class="form-control" id="category" name="category" value="{{ old('category', $detail->category_id) }}">
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-6">
                                                    <label class="form-label" for="level">Tingkatan</label>
                                                    <div class="">{{ $detail->course_header->level->name }}</div>
                                                </div>
                                                <div class="col-6">
                                                    <label class="form-label" for="level">Tingkatan</label>
                                                    <div class="@if ($detail->level_id != $detail->course_header->level_id) text-danger @endif">{{ $detail->level->name }}</div>
                                                    <input type="hidden" class="form-control" id="level" name="level" value="{{ old('level', $detail->level_id) }}">
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-6">
                                                    <label class="form-label" for="picture">Foto Materi</label>
                                                    <span class="desc"></span>
                                                    <img id="show_picture" class="img-fluid" src="{{ asset('/storage/'.$detail->course_header->picture) }}" alt="" style="max-width:100%;">
                                                    <input type="hidden" name="old_picture" value="{{ $detail->course_header->picture }}">
                                                </div>
                                                <div class="col-6">
                                                    <label class="form-label" for="picture">Foto Materi</label>
                                                    <span class="desc"></span>
                                                    <img id="show_picture" class="img-fluid" src="{{ asset('/storage/'.$detail->picture) }}" alt="" style="max-width:100%;">
                                                    <input type="hidden" name="picture" value="{{ $detail->picture }}">
                                                    <input type="hidden" name="picture_name" value="{{ $detail->picture_name }}">
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-6">
                                                    <label class="form-label" for="description">Deskripsi</label>
                                                    <div class="">{!! $detail->course_header->description !!}</div>
                                                </div>
                                                <div class="col-6">
                                                    <label class="form-label" for="description">Deskripsi</label>
                                                    <div class="@if ($detail->description != $detail->course_header->description) text-danger @endif">{!! $detail->description !!}</div>
                                                    <div class="">{!! $detail->course_header->description !!}</div>
                                                    <textarea name="description" id="description" class="form-control" cols="30" rows="10" disabled hidden>{!! old('description', $detail->description) !!}</textarea>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-6">
                                                    <label class="form-label" for="updated_by">Diubah Oleh</label>
                                                    <div class="">{{ $detail->course_header->updated_by }}</div>
                                                </div>
                                                <div class="col-6">
                                                    <label class="form-label" for="updated_by">Diubah Oleh</label>
                                                    <div class="@if ($detail->updated_by != $detail->course_header->updated_by) text-danger @endif">{{ $detail->updated_by }}</div>
                                                    <input type="hidden" class="form-control" id="updated_by" name="updated_by" value="{{ old('updated_by', $detail->updated_by) }}">
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-6">
                                                    <label class="form-label" for="updated_at">Diubah Dari</label>
                                                    <div class="">{{ $detail->course_header->updated_at }}</div>
                                                </div>
                                                <div class="col-6">
                                                    <label class="form-label" for="updated_at">Diubah Dari</label>
                                                    <div class="@if ($detail->updated_at != $detail->course_header->updated_at) text-danger @endif">{{ date('d-M-Y', strtotime($detail->updated_at)) }}</div>
                                                    <input type="hidden" class="form-control" id="updated_at" name="updated_at" value="{{ old('updated_at', $detail->updated_at) }}">
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-6">
                                                    <label class="form-label" for="disabled">Disabled</label>
                                                    <div class="">{{ $detail->course_header->disabled }}</div>
                                                </div>
                                                <div class="col-6">
                                                    <label class="form-label" for="disabled">Disabled</label>
                                                    <div class="@if ($detail->disabled != $detail->course_header->disabled) text-danger @endif">{{ $detail->disabled }}</div>
                                                    <input type="hidden" class="form-control" id="disabled" name="disabled" value="{{ old('disabled', $detail->disabled) }}">
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="d-grid">
                                                        <a href="{{ $c_menu->url }}" class="btn btn-warning">KEMBALI</a>
                                                        <a href="#" class="btn btn-danger">TOLAK</a>
                                                        <button type="submit" class="btn btn-success">SETUJU</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>                                
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {{-- Data Table --}}
    <script src="{{ asset('/assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('/assets/js/table-datatable.js') }}"></script>
@endsection