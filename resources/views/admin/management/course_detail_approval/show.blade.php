@extends('layouts.main')

@section('title', 'Detail Approval Pembelajaran')

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
                <li class="breadcrumb-item active">Detail Approval Pembelajaran</li>
            </ol>
            <div class="media align-items-center mb-headings">
                <div class="media-body">
                    <h1 class="h2">Detail Approval Pembelajaran</h1>
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
                                    <input type="hidden" name="course_detail_id" value="{{ $detail->course_detail_id }}">
                                    <input type="hidden" name="duration" value="{{ $detail->duration }}">
                                    <input type="hidden" name="playtime" value="{{ $detail->playtime }}">
                                    <input type="hidden" name="action" value="{{ $detail->action }}">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row mb-n3">
                                                <div class="col-4 h3">Tambah Data Pembelajaran</div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-4">
                                                    <label class="form-label" for="title">Judul Pembelajaran</label>
                                                    <div class="">{{ $detail->title }}</div>
                                                    <input type="hidden" name="title" value="{{ $detail->title }}">
                                                </div>
                                                <div class="col-4">
                                                    <label class="form-label" for="created_by">Dibuat Oleh</label>
                                                    <div class="">{{ $detail->created_by }}</div>
                                                    <input type="hidden" class="form-control" id="created_by" name="created_by" value="{{ $detail->created_by }}">
                                                </div>
                                                <div class="col-4">
                                                    <label class="form-label" for="created_at">Dibuat Dari</label>
                                                    <div class="">{{ date('d-M-Y', strtotime($detail->created_at)) }}</div>
                                                    <input type="hidden" class="form-control" id="created_at" name="created_at" value="{{ $detail->created_at }}">
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-6">
                                                    <label class="form-label" for="video">Upload Video</label>
                                                    <iframe id="show_video" class="embed-responsive-item" src="{{ asset('/storage/'.$detail->video) }}" allowfullscreen="" style="width: 100%; height: 350px"></iframe>
                                                    <input type="hidden" name="video" value="{{ $detail->video }}">
                                                    <input type="hidden" name="video_name" value="{{ $detail->video_name }}">
                                                    <input type="hidden" name="playtime" value="{{ $detail->playtime }}">
                                                    <input type="hidden" name="duration" value="{{ $detail->duration }}">
                                                </div>
                                                <div class="col-6">
                                                    <label class="form-label" for="description">Deskripsi Materi</label>
                                                    <div class="">{{ $detail->description }}</div>
                                                    <input type="hidden" name="description" value="{{ $detail->description }}">
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
                                    <input type="hidden" name="course_detail_id" value="{{ $detail->course_detail_id }}">
                                    <input type="hidden" name="duration" value="{{ $detail->duration }}">
                                    <input type="hidden" name="playtime" value="{{ $detail->playtime }}">
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
                                                    <div class="">{{ $detail->course_detail->title }}</div>
                                                </div>
                                                <div class="col-6">
                                                    <label class="form-label" for="title">Judul Materi</label>
                                                    <div class="@if ($detail->title != $detail->course_detail->title) text-danger @endif">{{ $detail->title }}</div>
                                                    <input type="hidden" class="form-control" id="title" name="title" value="{{ old('title', $detail->title) }}">
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-6">
                                                    <label class="form-label" for="video">Video Pembelajaran</label>
                                                    <span class="desc"></span>
                                                    <iframe id="show_video" class="embed-responsive-item" src="{{ old('video', asset('/storage/'.$detail->course_detail->video)) }}" allowfullscreen="" style="width: 100%; height: 300px"></iframe>
                                                    <input type="hidden" name="old_video" value="{{ $detail->course_detail->video }}">
                                                </div>
                                                <div class="col-6">
                                                    <label class="form-label" for="video">Video Pembelajaran</label>
                                                    <span class="desc"></span>
                                                    <iframe id="show_video" class="embed-responsive-item" src="{{ old('video', asset('/storage/'.$detail->video)) }}" allowfullscreen="" style="width: 100%; height: 300px"></iframe>
                                                    <input type="hidden" name="video" value="{{ $detail->video }}">
                                                    <input type="hidden" name="video_name" value="{{ $detail->video_name }}">
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-6">
                                                    <label class="form-label" for="description">Deskripsi</label>
                                                    <div class="">{!! $detail->course_detail->description !!}</div>
                                                </div>
                                                <div class="col-6">
                                                    <label class="form-label" for="description">Deskripsi</label>
                                                    <div class="@if ($detail->description != $detail->course_detail->description) text-danger @endif">{!! $detail->description !!}</div>
                                                    <div class="">{!! $detail->course_detail->description !!}</div>
                                                    <textarea name="description" id="description" class="form-control" cols="30" rows="10" disabled hidden>{!! old('description', $detail->description) !!}</textarea>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-6">
                                                    <label class="form-label" for="updated_by">Diubah Oleh</label>
                                                    <div class="">{{ $detail->course_detail->updated_by }}</div>
                                                </div>
                                                <div class="col-6">
                                                    <label class="form-label" for="updated_by">Diubah Oleh</label>
                                                    <div class="@if ($detail->updated_by != $detail->course_detail->updated_by) text-danger @endif">{{ $detail->updated_by }}</div>
                                                    <input type="hidden" class="form-control" id="updated_by" name="updated_by" value="{{ old('updated_by', $detail->updated_by) }}">
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-6">
                                                    <label class="form-label" for="updated_at">Diubah Dari</label>
                                                    <div class="">{{ $detail->course_detail->updated_at }}</div>
                                                </div>
                                                <div class="col-6">
                                                    <label class="form-label" for="updated_at">Diubah Dari</label>
                                                    <div class="@if ($detail->updated_at != $detail->course_detail->updated_at) text-danger @endif">{{ date('d-M-Y', strtotime($detail->updated_at)) }}</div>
                                                    <input type="hidden" class="form-control" id="updated_at" name="updated_at" value="{{ old('updated_at', $detail->updated_at) }}">
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-6">
                                                    <label class="form-label" for="disabled">Disabled</label>
                                                    <div class="">{{ $detail->course_detail->disabled }}</div>
                                                </div>
                                                <div class="col-6">
                                                    <label class="form-label" for="disabled">Disabled</label>
                                                    <div class="@if ($detail->disabled != $detail->course_detail->disabled) text-danger @endif">{{ $detail->disabled }}</div>
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