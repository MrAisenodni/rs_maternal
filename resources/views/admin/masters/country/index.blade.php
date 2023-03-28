@extends('layouts.main')

@section('title', $c_menu->title)

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
                <li class="breadcrumb-item active">{{ $c_menu->title }}</li>
            </ol>
            <h1 class="h2">{{ $c_menu->title }}</h1>

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
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="default" class="table table-striped table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th style="width: 5%">No</th>
                                                    <th>Kode</th>
                                                    <th>Nama</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($data)
                                                    @foreach ($data as $item)
                                                        <tr data-id="{{ $item->id }}">
                                                            <td class="text-center">{{ $loop->iteration }}</td>
                                                            <td>{{ $item->code }}</td>
                                                            <td>{{ $item->name }}</td>
                                                            <td class="text-center" style="width: 20%">
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
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    @if (request()->path() == substr($c_menu->url, 1))
                                        @include('admin.masters.country.create')
                                    @elseif (substr(request()->path(), -4) == 'edit')
                                        @include('admin.masters.country.edit')
                                    @else
                                        @include('admin.masters.country.show')
                                    @endif
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