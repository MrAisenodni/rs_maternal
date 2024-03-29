@extends('layouts.main')

@section('title', $c_menu->title)

@section('styles')
@endsection
    
@section('content')
    <div class="mdk-drawer-layout__content page ">

        <div class="container-fluid page__container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="/list-courses">Daftar Materi</a></li>
                <li class="breadcrumb-item active">{{ $detail->course_header->title }}</li>
            </ol>
            <h1 class="h2">{{ $detail->course_header->title }}</h1>
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" src="{{ asset('/storage/'.$detail->video) }}" allowfullscreen=""></iframe>
                        </div>
                        <div class="card-body">
                            {!! $detail->description !!}
                        </div>
                    </div>

                    <!-- Lessons -->
                    <ul class="card list-group list-group-fit">
                        @if ($data->course_detail)
                            @foreach ($data->course_detail as $item)
                                <li class="list-group-item @if ($item->id == $detail->id) active @endif">
                                    <div class="media">
                                        <div class="media-left">
                                            <div class="text-muted">{{ $loop->iteration }}.</div>
                                        </div>
                                        <div class="media-body">
                                            <a @if ($item->id == $detail->id) class="text-white" @endif href="{{ $c_menu->url }}/{{ $item->course_header_id }}/{{ $item->id }}">{{ $item->title }}</a>
                                        </div>
                                        <div class="media-right">
                                            <small class="text-muted-light">{{ $item->playtime }}</small>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h1 class="h5">Unduh Buku Saku</h1><hr>
                            @if ($detail->course_detail_document)
                                @foreach ($detail->course_detail_document as $item)
                                    <a class="file_download" data-id="{{ $item->id }}" href="{{ asset('/storage/'.$item->file) }}">
                                        <i class="fa fa-file"></i> {{ $item->title }}
                                    </a><br>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <div class="media align-items-center">
                                <div class="media-left">
                                    <img src="{{ asset('/storage/'.$data->teacher->picture) }}" alt="#" width="50" class="rounded-circle">
                                </div>
                                <div class="media-body">
                                    <h4 class="card-title"><a href="#">{{ $data->teacher->full_name }}</a></h4>
                                    <p class="card-subtitle">Pengajar (Dokter)</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            {!! $data->teacher->biography !!}
                        </div>
                        <div class="card-footer text-center">
                            <a target="_blank" href="{{ url('https://id-id.facebook.com/'.$data->teacher->facebook) }}" class="btn btn-light"><i class="fab fa-facebook"></i></a>
                            <a target="_blank" href="{{ url('https://twitter.com/'.$data->teacher->twitter) }}" class="btn btn-light"><i class="fab fa-twitter"></i></a>
                            <a target="_blank" href="{{ url('https://www.instagram.com/'.$data->teacher->instagram) }}" class="btn btn-light"><i class="fab fa-instagram"></i></a>
                            <a target="_blank" href="{{ url('https://github.com/'.$data->teacher->github) }}" class="btn btn-light"><i class="fab fa-github"></i></a>
                        </div>
                    </div>

                    <div class="card">
                        <ul class="list-group list-group-fit">
                            <li class="list-group-item">
                                <div class="media align-items-center">
                                    <div class="media-left">
                                        <i class="fa fa-clock text-muted-light"></i>
                                    </div>
                                    <div class="media-body">
                                        @if (gmdate('H', $data->duration) != '00')
                                            {{ gmdate('H', $data->duration) }} <small class="text-muted">jam</small> &nbsp; 
                                        @endif
                                        @if (gmdate('i', $data->duration) != '00')
                                            {{ gmdate('i', $data->duration) }} <small class="text-muted">menit</small> &nbsp; 
                                        @endif
                                        @if (gmdate('s', $data->duration) != '00')
                                            {{ gmdate('s', $data->duration) }} <small class="text-muted">detik</small> &nbsp; 
                                        @endif
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="media align-items-center">
                                    <div class="media-left">
                                        <i class="fa fa-th-large text-muted-light"></i>
                                    </div>
                                    <div class="media-body">{{ $data->category->name }}</div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="media align-items-center">
                                    <div class="media-left">
                                        <i class="fa fa-chart-line text-muted-light"></i>
                                    </div>
                                    <div class="media-body">{{ $data->level->name }}</div>
                                </div>
                            </li>
                        </ul>
                    </div>

                    {{-- <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Peringkat</h4>
                        </div>
                        <div class="card-body">
                            <div class="rating">
                                @php
                                    $sisa = $data->rating
                                @endphp
                                @for ($i = 1; $i <= 5; $i++) 
                                    @if ($sisa >= 1)
                                        <i class="material-icons">star</i>
                                    @elseif ($sisa >= 0.5 && $sisa < 1)
                                        <i class="material-icons">star_half</i>
                                    @else
                                        <i class="material-icons">star_border</i>
                                    @endif 
                                    @php
                                        $sisa = $sisa - 1
                                    @endphp
                                @endfor
                            </div>
                            <small class="text-muted">20 ratings</small>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(function() {
            "use strict"

            $(document).ready(function() {
                $('.file_download').click(function() {
                    var data_id = $(this).attr('data-id')
                    var url = '/download/'+data_id

                    $.ajax({
                        url: url,
                        dataType: 'json',
                    })
                })
            })
        })
    </script>
@endsection