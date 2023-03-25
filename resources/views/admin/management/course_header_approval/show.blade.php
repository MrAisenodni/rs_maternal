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
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row mb-2">
                                                <div class="col-6">
                                                    <label class="form-label" for="title">Judul Materi</label>
                                                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $detail->title) }}" disabled>
                                                </div>
                                                <div class="col-6">
                                                    <label class="form-label" for="doctor">Dokter</label>
                                                    <input type="text" class="form-control" id="doctor" name="doctor" value="{{ old('doctor', '['.$detail->teacher->nik.'] '.$detail->teacher->full_name) }}" disabled>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-6">
                                                    <label class="form-label" for="category">Kategori</label>
                                                    <input type="text" class="form-control" id="category" name="category" value="{{ old('category', $detail->category->name) }}" disabled>
                                                </div>
                                                <div class="col-6">
                                                    <label class="form-label" for="level">Tingkatan</label>
                                                    <input type="text" class="form-control" id="level" name="level" value="{{ old('level', $detail->level->name) }}" disabled>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-3">
                                                    <label class="form-label" for="picture">Foto Materi</label>
                                                    <span class="desc"></span>
                                                    <img id="show_picture" class="img-fluid" src="{{ asset('/storage/'.$detail->picture) }}" alt="" style="max-width:100%;">
                                                </div>
                                                <div class="col-9">
                                                    <label class="form-label" for="description">Deskripsi</label>
                                                    <textarea name="description" id="description" class="form-control" cols="30" rows="10" disabled>{!! old('description', $detail->description) !!}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            <h1 class="h4">Detail Materi Video</h1><hr>
                                            <div class="row mb-2">
                                                <div class="col-12">
                                                    <label class="form-label" for="title_detail">Judul Materi Pembelajaran</label>
                                                    <input type="text" class="form-control" id="title_detail" name="title_detail" value="{{ old('title_detail') }}">
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
                                                    <label class="form-label" for="video">Upload Video</label>
                                                    <span class="desc"></span>
                                                    <input type="file" class="form-control" id="video" name="video" value="{{ old('video') }}" onchange="readURLVideo(this)">
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-12">
                                                    <label class="form-label" for="description_detail">Deskripsi</label>
                                                    <textarea name="description_detail" id="description_detail" class="form-control" cols="30" rows="10">{!! old('description_detail') !!}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            <h1 class="h4">Detail Materi Dokumen</h1><hr>
                                            <div class="row mb-2">
                                                <div class="col-12">
                                                    <label class="form-label" for="title_document">Judul Dokumen</label>
                                                    <input type="text" class="form-control" id="title_document" name="title_document" value="{{ old('title_document') }}">
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-12">
                                                    <label class="form-label" for="document">Upload Dokumen</label>
                                                    <span class="desc"></span>
                                                    <input type="file" class="form-control" id="image" name="document" value="{{ old('document') }}">
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-12">
                                                    <label class="form-label" for="description_document">Deskripsi</label>
                                                    <textarea name="description_document" id="description_document" class="form-control" cols="30" rows="10">{!! old('description_document') !!}</textarea>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="d-grid">
                                                        <a href="{{ $c_menu->url }}" class="btn btn-warning">KEMBALI</a>
                                                        <button type="submit" class="btn btn-danger">TOLAK</button>
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
                                                </div>
                                                <div class="col-6">
                                                    <label class="form-label" for="picture">Foto Materi</label>
                                                    <span class="desc"></span>
                                                    <img id="show_picture" class="img-fluid" src="{{ asset('/storage/'.$detail->picture) }}" alt="" style="max-width:100%;">
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
                                                    <div class="@if ($detail->updated_at != $detail->course_header->updated_at) text-danger @endif">{{ $detail->updated_at }}</div>
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