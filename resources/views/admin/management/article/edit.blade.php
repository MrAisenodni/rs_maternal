@extends('layouts.main')

@section('title', 'Ubah Best Practice')

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
                <li class="breadcrumb-item active">Ubah Best Practice</li>
            </ol>
            <div class="media align-items-center mb-headings">
                <div class="media-body">
                    <h1 class="h2">Ubah Best Practice</h1>
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

            {{-- Edit Article --}}
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
                            <form class="g-3" action="{{ $c_menu->url }}/{{ $detail->id }}" method="POST" enctype="multipart/form-data">
                                @method('put')
                                @csrf
                                <input type="hidden" name="type" value="{{ $detail->type }}">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row mb-2">
                                            <div class="col-12">
                                                <label class="form-label" for="title">Judul Materi <small class="text-danger">*</small></label>
                                                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $detail->title) }}">
                                                @error('title')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-12">
                                                <label class="form-label" for="subtitle">Sub Judul Materi</label>
                                                <input type="text" class="form-control @error('subtitle') is-invalid @enderror" id="subtitle" name="subtitle" value="{{ old('subtitle', $detail->subtitle) }}">
                                                @error('subtitle')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-12">
                                                <label class="form-label" for="picture">Foto Materi <small class="text-danger">*</small></label>
                                                <span class="desc"></span>
                                                <img id="show_picture" class="img-fluid" src="{{ old('picture', asset('/storage/'.$detail->picture)) }}" alt="" style="max-width:100%;">
                                                <input type="hidden" name="old_picture" value="{{ $detail->picture }}">
                                                <input type="file" class="form-control @error('picture') is-invalid @enderror" id="image" name="picture" value="{{ old('picture') }}" onchange="readURLPicture(this)">
                                                <small class="text-danger">* Maksimal ukuran foto {{ round(substr($app_param[0]->value, 4) / 1048, 0) }} MB</small>
                                                @error('picture')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-12">
                                                <label class="form-label" for="description">Deskripsi <small class="text-danger">*</small></label>
                                                <textarea id="description" class="elm1 form-control @error('description') is-invalid @enderror" id="description" name="description">{!! old('description', $detail->description) !!}</textarea>
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
                                                    <button type="submit" class="btn btn-success">SIMPAN</button>
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

            {{-- Data Document --}}
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
                                                <a href="/admin/best-practice-document/{{ $detail->id }}/create" class="btn btn-primary">Tambah</a>
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
                                            <th>Dokumen</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($data)
                                            @foreach ($data as $item)
                                                <tr data-id="{{ $item->id }}">
                                                    <td class="text-center">{{ $loop->iteration }}</td>
                                                    <td>{{ $item->title }} @if ($item->approval_id) <small class="text-danger">* Menunggu Approval</small> @endif</td>
                                                    <td><a href="{{ asset('/storage/'.$item->file) }}">{{ $item->file_name }}</a></td>
                                                    <td class="text-center" style="width: 30mm">
                                                        @if ($item->approval_id)
                                                            @if ($access->edit == 1)
                                                                <i class="fa fa-edit text-secondary"></i>
                                                            @endif
                                                        @else
                                                            @if ($access->edit == 1)
                                                                <a href="/admin/best-practice-document/{{ $item->id }}/edit"><i class="fa fa-edit"></i></a>
                                                            @endif
                                                        @endif
                                                        @if ($item->approval_id)
                                                            @if ($access->delete == 1)
                                                                <form action="#" method="POST" class="d-inline">
                                                                    <button type="button" class="fa fa-trash text-secondary sa-warning" style="border: 0px; background: 0%" disabled></button>
                                                                </form>
                                                            @endif
                                                        @else
                                                            @if ($access->delete == 1)
                                                                <form action="/admin/best-practice-document/{{ $item->id }}" method="POST" class="d-inline">
                                                                    @method('delete')
                                                                    @csrf
                                                                    <button id="delete" type="submit" class="fa fa-trash text-danger sa-warning" style="border: 0px; background: 0%"></button>
                                                                </form>
                                                            @endif
                                                        @endif
                                                        @if ($access->detail == 1)
                                                            <a href="/admin/best-practice-document/{{ $item->id }}"><i class="fa fa-eye"></i></a>
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

    {{-- tinymce js --}}
    <script src="{{ asset('/assets/plugins/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('/assets/js/form-editor.init.js') }}"></script>

    {{-- Auto Preview --}}
    <script type="text/javascript">
        // For Upload Picture
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