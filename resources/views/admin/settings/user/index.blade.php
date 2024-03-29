@extends('layouts.main')

@section('title', $c_menu->menu->title)

@section('styles')
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
                <li class="breadcrumb-item active">{{ $c_menu->menu->title }}</li>
            </ol>            
            <div class="media align-items-center mb-headings">
                <div class="media-body">
                    <h1 class="h2">{{ $c_menu->menu->title }}</h1>
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
                                    <div class="table-responsive">
                                        <table id="default" class="table table-striped table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th style="width: 5%">No</th>
                                                    <th>NIK</th>
                                                    <th>Nama Lengkap</th>
                                                    <th>Jenis Kelamin</th>
                                                    <th>Tempat, Tgl Lahir</th>
                                                    <th>Email</th>
                                                    <th>No HP/Telp</th>
                                                    <th>Agama</th>
                                                    <th>Posisi</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($data)
                                                    @foreach ($data as $item)
                                                        <tr data-id="{{ $item->id }}">
                                                            <td class="text-center">{{ $loop->iteration }}</td>
                                                            <td>{{ $item->nik }}</td>
                                                            <td>{{ $item->full_name }}</td>
                                                            <td>
                                                                @if ($item->gender == 'l')
                                                                    Laki-Laki
                                                                @else
                                                                    Perempuan
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if ($item->birth_place != null && $item->birth_date != null)
                                                                    {{ $item->birth_place }}, {{ date('d M Y', strtotime($item->birth_date)) }}
                                                                @else
                                                                    -
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if ($item->email != null)
                                                                    {{ $item->email != null }}
                                                                @else
                                                                    -
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if ($item->phone_number != null)
                                                                    {{ $item->phone_number != null }}
                                                                @else
                                                                    -
                                                                @endif /
                                                                @if ($item->home_number != null)
                                                                    {{ $item->home_number != null }}
                                                                @else
                                                                    -
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if ($item->religion != null)        
                                                                    {{ $item->religion->name }}
                                                                @else
                                                                    -
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if ($item->role == 'adm')     
                                                                    Administrator   
                                                                @elseif ($item->role == 'tec')
                                                                    Pengajar
                                                                @else
                                                                    Member
                                                                @endif
                                                            </td>
                                                            <td class="text-center" style="width: 20mm">
                                                                @if ($access->edit == 1)
                                                                    <a href="{{ $c_menu->url }}/{{ $item->id }}/edit"><i class="fa fa-edit"></i></a>
                                                                @endif
                                                                @if ($access->delete == 1)
                                                                    <form action="{{ $c_menu->url }}/{{ $item->id }}" method="POST" class="d-inline">
                                                                        @method('delete')
                                                                        @csrf
                                                                        <button id="delete" type="submit" class="fa fa-trash text-danger sa-warning" style="border: 0px; background: 0%"></button>
                                                                    </form>
                                                                @endif
                                                                @if ($access->detail == 1)
                                                                    <a href="{{ $c_menu->url }}/{{ $item->id }}"><i class="fa fa-eye"></i></a>
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
    {{-- Data Table --}}
    <script src="{{ asset('/assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('/assets/js/table-datatable.js') }}"></script>
    
    {{-- Sweet Alert --}}
    <script src="{{ asset('/assets/plugins/sweet-alert/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('/assets/js/sweet-alert.init.js') }}"></script>
@endsection