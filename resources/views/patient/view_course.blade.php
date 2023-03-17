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
                            {{-- <video class="embed-responsive-item" allow="fullscreen" frameBorder="0" width="100%" height="700" controls controlsList="nodownload">
                                <source :src="{{ $detail->video }}" />
                            </video> --}}
                            <iframe class="embed-responsive-item" src="{{ $detail->video }}" allowfullscreen=""></iframe>
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
                                            <small class="text-muted-light">{{ $getID3->analyze(substr($item->video, 1))['playtime_string'] }}</small>
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
                                    <a href="{{ storage_path('public/'.$item->file) }}"><i class="fa fa-file"></i> {{ $item->title }}</a><br>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <div class="media align-items-center">
                                <div class="media-left">
                                    <img src="assets/images/people/110/guy-6.jpg"
                                         alt="About Adrian"
                                         width="50"
                                         class="rounded-circle">
                                </div>
                                <div class="media-body">
                                    <h4 class="card-title"><a href="instructor-profile.html">Adrian Demian</a></h4>
                                    <p class="card-subtitle">Instructor</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <p>Having over 12 years exp. Adrian is one of the lead UI designers in the industry Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facere, aut.</p>
                            <a href=""
                               class="btn btn-light"><i class="fab fa-facebook"></i></a>
                            <a href=""
                               class="btn btn-light"><i class="fab fa-twitter"></i></a>
                            <a href=""
                               class="btn btn-light"><i class="fab fa-github"></i></a>
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

                    <div class="card">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection