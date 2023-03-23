@extends('layouts.main')

@section('title', 'Ubah Materi')

@section('styles')
    {{-- Select2 --}}
    <link href="{{ asset('/assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('/assets/plugins/select2/css/select2-bootstrap4.css') }}" rel="stylesheet" />

    {{-- Quill Theme --}}
    <!-- Quill Theme -->
    <link type="text/css" href="{{ asset('/assets/css/quill.css') }}" rel="stylesheet">
    
    {{-- Data Table --}}
    <link href="{{ asset('/assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />

    {{-- Sweet Alert --}}
    <link href="{{ asset('/assets/plugins/sweet-alert/sweetalert2.min.css') }}" rel="stylesheet" />
@endsection
    
@section('content')
    <div class="mdk-drawer-layout__content page ">

        <div class="container-fluid page__container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ $c_menu->url }}">{{ $c_menu->menu->title }}</a></li>
                <li class="breadcrumb-item active">Ubah Materi</li>
            </ol>
            <div class="media align-items-center mb-headings">
                <div class="media-body">
                    <h1 class="h2">Ubah Materi</h1>
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
                            <div class="card">
                                <div class="card-body">
                                    <form class="g-3" action="{{ $c_menu->url }}/{{ $detail->id }}" method="POST" enctype="multipart/form-data">
                                        @method('put')
                                        @csrf
                                        <div class="row mb-2">
                                            <div class="col-6">
                                                <label class="form-label" for="title">Judul Materi <small class="text-danger">*</small></label>
                                                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $detail->title) }}">
                                                @error('title')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label" for="doctor">Dokter <small class="text-danger">*</small></label>
                                                @if (session()->get('srole') == 'tec')
                                                    <input type="hidden" class="form-control" id="doctor" name="doctor" value="{{ $doctor->id }}">
                                                    <input type="text" class="form-control @error('doctor') is-invalid @enderror" id="doctor" value="[{{ $doctor->nik }}] {{ $doctor->full_name }}" disabled>
                                                @else
                                                    <select class="single-select form-control @error('doctor') is-invalid @enderror" id="doctor" name="doctor">
                                                        <option value="">=== SILAHKAN PILIH ===</option>
                                                        @if ($doctors)
                                                            @foreach ($doctors as $item)
                                                                <option value="{{ $item->id }}" @if ($item->id == old('doctor', $detail->course_teacher_id)) selected @endif>[{{ $item->nik }}] {{ $item->full_name }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                @endif
                                                @error('doctor')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-6">
                                                <label class="form-label" for="category">Kategori <small class="text-danger">*</small></label>
                                                <select class="single-select form-control @error('category') is-invalid @enderror" id="category" name="category">
                                                    <option value="">=== SILAHKAN PILIH ===</option>
                                                    @if ($categories)
                                                        @foreach ($categories as $item)
                                                            <option value="{{ $item->id }}" @if ($item->id == old('category', $detail->category_id)) selected @endif>{{ $item->name }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                @error('category')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label" for="level">Tingkatan <small class="text-danger">*</small></label>
                                                <select class="single-select form-control @error('level') is-invalid @enderror" id="level" name="level">
                                                    <option value="">=== SILAHKAN PILIH ===</option>
                                                    @if ($levels)
                                                        @foreach ($levels as $item)
                                                            <option value="{{ $item->id }}" @if ($item->id == old('level', $detail->level_id)) selected @endif>{{ $item->name }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                @error('level')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-3">
                                                <label class="form-label" for="picture">Foto Materi <small class="text-danger">*</small></label>
                                                <span class="desc"></span>
                                                {{-- <img class="" src="{{ asset($detail->picture) }}" alt="" style="max-width:100%;"> --}}
                                                <img id="show_picture" class="img-fluid" src="{{ asset('/storage/'.$detail->picture) }}" alt="" style="max-width:100%;">
                                                <input type="hidden" name="old_picture" value="{{ $detail->picture }}">
                                                <input type="file" class="form-control @error('picture') is-invalid @enderror" id="image" name="picture" value="{{ old('picture') }}" onchange="readURLPicture(this)">
                                                @error('picture')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-9">
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
                                                    <a href="{{ $c_menu->url }}" class="btn btn-warning">KEMBALI</a>
                                                    @if ($detail->id == $course_header_approval->course_header_id)
                                                        <button type="submit" class="btn btn-success" disabled>SIMPAN</button>
                                                    @else
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

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="media align-items-center mb-headings">
                                <div class="media-body">
                                    <h1 class="h2">Daftar Pembelajaran</h1>
                                </div>
                                <div class="media-right">
                                    @if ($access->add == 1)
                                        <div class="ms-auto">
                                            <div class="btn-group">
                                                <a href="/admin/course-detail/{{ $detail->id }}/create" class="btn btn-primary">Tambah</a>
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
                                                    <td class="text-center" style="width: 20mm">
                                                        @if ($access->edit == 1)
                                                            <a href="/admin/course-detail/{{ $item->id }}/edit"><i class="fa fa-edit"></i></a>
                                                        @endif
                                                        @if ($access->delete == 1)
                                                        <form action="/admin/course-detail/{{ $item->id }}" method="POST" class="d-inline">
                                                            @method('delete')
                                                            @csrf
                                                            <button id="delete" type="submit" class="fa fa-trash text-danger sa-warning" style="border: 0px; background: 0%"></button>
                                                        </form>
                                                        @endif
                                                        @if ($access->detail == 1)
                                                            <a href="/admin/course-detail/{{ $item->id }}"><i class="fa fa-eye"></i></a>
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
@endsection

@section('scripts')
    {{-- Select2 --}}
    <script src="{{ asset('/assets/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('/assets/js/form-select2.js') }}"></script>

    {{-- Quill Theme --}}
    <script src="{{ asset('/assets/vendor/quill.min.js') }}"></script>
    <script src="{{ asset('/assets/js/quill.js') }}"></script>

    {{-- Data Table --}}
    <script src="{{ asset('/assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('/assets/js/table-datatable.js') }}"></script>
    
    {{-- Sweet Alert --}}
    <script src="{{ asset('/assets/plugins/sweet-alert/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('/assets/js/sweet-alert.init.js') }}"></script>

    {{-- Auto Preview --}}
    <script type="text/javascript">
        function _(el)
        {
            return document.getElementById(el)
        }

        function uploadFile()
        {
            var file = _("file1").files[0]
            var formData = new FormData()

            formData.append("file1", file)

            var ajax = new XMLHttpRequest()
            ajax.upload.addEventListener("progress", progressHandler, false)
            ajax.addEventListener("load", completeHandler, false)
            ajax.addEventListener("error", abortHandler, false)
            // ajax.open("POST", "file_upload_parser.php")
            ajax.send(formData)
        }

        function progressHandler(event)
        {
            _("loaded_n_total").innerHTML = "Uploaded " + event.loaded + " bytes of " + event.total
            var percent = (event.loaded / event.total) * 100
            _("progressBar").value = Math.round(percent)
            _("status").innerHTML = Math.round(percent) + "% uploaded... please wait"            
        }

        function completeHandler(event)
        {
            _("status").innerHTML = event.target.responseText
            _("progressBar").value = 0
        }

        function errorHandler(event)
        {
            _("status").innerHTML = "Upload Failed"
        }

        function abortHandler(event)
        {
            _("status").innerHTML = "Upload Aborted"
        }

        function readURLPicture(input) 
        {
            if (input.files && input.files[0])
            {
                var reader = new FileReader()

                reader.onload = function (e) 
                {
                    $('#show_picture').attr('src', e.target.result)
                }

                reader.readAsDataURL(input.files[0])
            }
        }
    </script>
@endsection