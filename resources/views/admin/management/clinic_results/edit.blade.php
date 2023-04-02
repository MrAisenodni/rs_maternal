@extends('layouts.main')

@section('title', $c_menu->title)

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
                <li class="breadcrumb-item"><a href="{{ $c_menu->url }}">{{ $c_menu->title }}</a></li>
                <li class="breadcrumb-item active">Ubah {{ $c_menu->title }}</li>
            </ol>
            <div class="media align-items-center mb-headings">
                <div class="media-body">
                    <h1 class="h2">Ubah {{ $c_menu->title }}</h1>
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
                            <form class="g-3" action="{{ $c_menu->url }}/{{ $detail->id }}" method="POST" enctype="multipart/form-data">
                                @method('put')
                                @csrf
                                @if ($companions)
                                    @foreach ($companions as $companion)
                                        @if ($results)
                                            @foreach ($results as $result)
                                                <div class="card">
                                                    <div class="card-body">
                                                        <h1 class="h4">{{ strtoupper($result->title) }} {{ strtoupper($result->subtitle) }} - {{ strtoupper($companion->title) }}</h1>
                                                        <hr>
                                                        <div class="row mb-2">
                                                            @if ($detail->clinic_results)
                                                                @foreach ($detail->clinic_results as $item)
                                                                    @if ($item->result_id == $result->id && $item->companion_id == $companion->id)
                                                                        <input type="hidden" name="id{{ $loop->iteration }}" value="{{ $item->id }}">
                                                                        <input type="hidden" name="count" value="{{ $detail->clinic_results->count() }}">
                                                                        <div class="col-lg-2">
                                                                            <label class="form-label" for="value{{ $loop->iteration }}">{{ $item->detail_result->title }}</label>
                                                                            <input type="text" class="form-control @error('value{{ $loop->iteration }}') is-invalid @enderror" id="value{{ $loop->iteration }}" name="value{{ $loop->iteration }}" value="{{ old('value'.$loop->iteration, $item->value) }}">
                                                                            @error('value{{ $loop->iteration }}')
                                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                                            @enderror
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    @endforeach
                                @endif
                                <div class="card">
                                    <div class="card-body">
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
        </div>
    </div>
@endsection

@section('scripts')
    {{-- Select2 --}}
    <script src="{{ asset('/assets/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('/assets/js/form-select2.js') }}"></script>
@endsection