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
                        <h2>Home</h2>
                        <ul>
                            <li><a href="#">Home</a></li>
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
        BLOG DETAILS PAGE START
    ==================================-->
    <section class="tf__blog_details_page mt_195 xs_mt_100">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-8">
                    <div class="tf__blog_details_area">
                        <div class="tf__blog_details_img wow fadeInUp" data-wow-duration="1.5s">
                            @if ($detail->picture)
                                <img src="{{ asset('/storage/'.$detail->picture) }}" alt="Foto" class="img-fluid w-100">
                            @endif
                        </div>
                        <div class="tf__blog_details_text wow fadeInUp" data-wow-duration="1.5s">
                            <ul class="date d-flex flex-wrap">
                                <li><i class="far fa-user-edit"></i> {{ $detail->created_by }}</li>
                                <li><i class="fal fa-calendar-alt"></i> {{ date('d M Y', strtotime($detail->created_at)) }}</li>
                                <li><i class="fal fa-eye"></i> 
                                    @if ($review)
                                        {{ $review->count }}
                                    @else
                                        0    
                                    @endif
                                </li>
                            </ul>
                            <h3>{{ $detail->title }}</h3>
                            {!! $detail->description !!}
                            <hr>
                            <h3>Dokumen Artikel</h3>
                            <ul>
                                @if ($detail->article_document)
                                    @foreach ($detail->article_document as $item)
                                        <li><a href="{{ asset('/storage/'.$item->file) }}" target="_blank">{{ $item->title }}</a></li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4">
                    <div class="tf__sidebar" id="sticky_sidebar">
                        <div class="tf__sidebar_search">
                            <form class="" action="/list-courses" method="GET">
                                @method('get')
                                <input type="text" placeholder="Cari Materi" name="search" value="{{ old('search', $search) }}">
                                <button type="submit"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                        <div class="tf__sidebar_category sidebar_item">
                            <ul>
                                @if ($reviews)
                                    @foreach ($reviews as $item)
                                        <li>
                                            <a href="#"> Total 
                                                @if ($item->type == 'video')
                                                    Penonton <span>({{ $item->count }})</span>
                                                @elseif ($item->type == 'document')
                                                    Unduhan <span>({{ $item->count }})</span>
                                                @elseif ($item->type == 'article')
                                                    Pembaca <span>({{ $item->count }})</span>
                                                @else
                                                    Pengunjung <span>({{ $item->count }})</span>
                                                @endif
                                            </a>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
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
        BLOG DETAILS PAGE END
    ==================================-->
@endsection

@section('scripts')
@endsection