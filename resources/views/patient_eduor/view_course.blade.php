@extends('layouts_eduor.main')

@section('title', $c_menu->title)

@section('styles')
@endsection
    
@section('content')
    <!--=================================
        BREADCRUMB START
    ==================================-->
    <section class="tf__breadcrumb" style="background: url({{ asset('/assets/eduor/images/breadcrumb_bg_1.jpg') }});">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="tf__breadcrumb_text">
                        <h2>{{ $c_menu->title }}</h2>
                        <ul>
                            <li><a href="/">Home</a></li>
                            <li><a href="/list-courses">Daftar Materi</a></li>
                            <li><a href="#">{{ $detail->course_header->title }}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--=================================
        BREADCRUMB END
    ==================================-->

    <!--=================================
        COURSES DETAILS START
    ==================================-->
    <section class="tf__courses_details mt_195 xs_mt_100">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-8">
                    <div class="tf__courses_details_area">
                        <div class="tf__courses_details_img">
                            <iframe class="img-fluid w-100" style="height: 100%" src="{{ asset('/storage/'.$detail->video) }}" allowfullscreen=""></iframe>
                        </div>
                        <div class="tf__courses_details_header d-flex flex-wrap align-items-center">
                            <div class="img">
                                <img src="{{ asset('/storage/'.$data->teacher->picture) }}" alt="Pengajar" class="img-fluid w-100">
                            </div>
                            <ul class="text d-flex flex-wrap align-items-center">
                                <li>
                                    <h4>Pengajar</h4>
                                    <p>{{ $data->teacher->full_name }}</p>
                                </li>
                                <li>
                                    <h4>Kategori</h4>
                                    <p>{{ $data->category->name }}</p>
                                </li>
                                <li>
                                    <h4>Tingkatan</h4>
                                    <p>{{ $data->level->name }}</p>
                                </li>
                                <li>
                                    <h4>Penonton</h4>
                                    <p>
                                        @if ($review)
                                            {{ $review->count }} 
                                        @else
                                            0
                                        @endif
                                        Orang
                                    </p>
                                </li>
                                <li>
                                    <h4>Durasi</h4>
                                    <p>
                                        @if (gmdate('H', $data->duration) != '00')
                                            {{ gmdate('H', $data->duration) }} <small class="text-muted">jam</small> &nbsp; 
                                        @endif
                                        @if (gmdate('i', $data->duration) != '00')
                                            {{ gmdate('i', $data->duration) }} <small class="text-muted">menit</small> &nbsp; 
                                        @endif
                                        @if (gmdate('s', $data->duration) != '00')
                                            {{ gmdate('s', $data->duration) }} <small class="text-muted">detik</small> &nbsp; 
                                        @endif
                                    </p>
                                </li>
                            </ul>
                        </div>

                        <div class="tf__courses_det_text">
                            <h2>{{ $detail->title }}</h2>

                            <ul class="nav nav-pills" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                                        aria-selected="true">Deskripsi</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-profile" type="button" role="tab"
                                        aria-controls="pills-profile" aria-selected="false">Pengajar</button>
                                </li>
                                {{-- <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-contact" type="button" role="tab"
                                        aria-controls="pills-contact" aria-selected="false">Komentar</button>
                                </li> --}}
                            </ul>
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                    aria-labelledby="pills-home-tab" tabindex="0">
                                    <div class="tf__course_overview">
                                        <h3>Deskripsi</h3>
                                        {!! $detail->description !!}
                                        <hr>
                                        <h5 class="mb-2">Unduh Buku Saku</h5>
                                        @if ($detail->course_detail_document)
                                            @foreach ($detail->course_detail_document as $item)
                                                <a class="file_download" data-id="{{ $item->id }}" href="{{ asset('/storage/'.$item->file) }}">
                                                    <i class="fa fa-file"></i> {{ $item->title }}
                                                </a><br>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                                    aria-labelledby="pills-profile-tab" tabindex="0">
                                    <div class="tf__course_instructor">
                                        <div class="row">
                                            <div class="col-xl-5 col-md-6">
                                                <div class="tf__course_instructor_img">
                                                    <img src="{{ asset('/storage/'.$data->teacher->picture) }}" alt="Pengajar" class="img-fluid w-100">
                                                </div>
                                            </div>
                                            <div class="col-xl-7 col-md-6">
                                                <div class="tf__course_instructor_text">
                                                    <h4>{{ $data->teacher->full_name }}</h4>
                                                    <p>{{ $data->teacher->biography }}</p>
                                                    <p>{{ $data->teacher->phone_number }}</p>
                                                    <p>{{ $data->teacher->email }}</p>
                                                    <ul class="d-flex flex-wrap align-items-center">
                                                        <li><a href="{{ $data->teacher->facebook }}"><i class="fab fa-facebook-f"></i></a></li>
                                                        <li><a href="{{ $data->teacher->twitter }}"><i class="fab fa-twitter"></i></a></li>
                                                        <li><a href="{{ $data->teacher->instagram }}"><i class="fab fa-instagram"></i></a></li>
                                                        <li><a href="{{ $data->teacher->github }}"><i class="fab fa-github"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4">
                    <div class="tf__sidebar" id="sticky_sidebar">
                        <div class="tf__sidebar_search">
                            <form class="" action="/list-courses" method="GET">
                                @method('get')
                                <input type="text" placeholder="Search" name="search" value="{{ old('search', $search) }}">
                                <button type="submit"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                        <div class="tf__sidebar_blog sidebar_item">
                            <h3>Materi Paling Populer</h3>
                            <ul>
                                @if ($popular)
                                    @foreach ($popular as $item)
                                        <li>
                                            <div class="img">
                                                <img src="{{ asset('/storage/'.$item->course_detail->course_header->picture) }}" alt="Materi" class="img-fluid w-100">
                                            </div>
                                            <div class="text">
                                                <p><i class="far fa-calendar-alt"></i> {{ date('d-M-Y', strtotime($item->course_detail->course_header->created_at)) }}</p>
                                                <a href="/view-course/{{ $item->course_detail->course_header_id }}/{{ $item->course_detail->id }}">{{ $item->course_detail->course_header->title }}</a>
                                            </div>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--=================================
        COURSES DETAILS END
    ==================================-->
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