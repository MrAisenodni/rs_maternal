@extends('layouts_eduor.main')

@section('title', $c_menu->title)

@section('styles')
@endsection
    
@section('content')
    <!--=================================
        BREADCRUMB START
    ==================================-->
    <section class="tf__breadcrumb" style="background: url({{ asset('/storage/'.$c_menu->section_header->picture_header) }}); margin-top: 100px;">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="tf__breadcrumb_text">
                        <h2>{{ $c_menu->section_header->title }}</h2>
                        <ul>
                            <li><a href="/">Home</a></li>
                            <li><a href="#">{{ $c_menu->title }}</a></li>
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
        BLOG PAGE START
    ==================================-->
    <section class="tf__blog_page mt_115 xs_mt_115">
        <div class="container">
            <div class="row wow fadeInUp" data-wow-duration="1.5s">
                <div class="col-xl-6 col-md-8 col-lg-6 m-auto">
                    <div class="tf__heading_area mb_15">
                        <h2 class="mb-2 text-primary">{{ strtoupper($c_menu->title) }}</h2>
                    </div>
                    <div class="tf__sidebar_search">
                        <form class="" action="{{ $c_menu->url }}" method="GET">
                            @method('get')
                            <input type="text" placeholder="Cari Materi" name="search" value="{{ old('search', $search) }}">
                            <button type="submit"><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row">
                @if ($data)
                    @foreach ($data as $item)
                        @php $a = 3; $b = 2 @endphp
                        <div class="col-xl-4 col-md-6 wow fadeInUp" data-wow-duration="1.5s">
                            <div class="tf__single_courses">
                                <div class="tf__single_courses_img" style="height: 200px">
                                    <img src="{{ asset('/storage/'.$item->picture) }}" alt="{{ $item->title }}" class="img-fluid w-100" style="max-height: 250px; background: url({{ asset('/assets/eduor/images/breadcrumb_bg_1.jpg') }}); object-fit: scale-down !important;">
                                    <a class="categories 
                                        @if ($item->id % $a == 0)
                                            orange
                                        @elseif ($item->id % $b == 0)
                                            blue
                                        @else
                                            red
                                        @endif
                                    " href="#" style="text-align: left">{{ $item->category->name }}</a>
                                    {{-- <span>$50.00</span> --}}
                                </div>
                                <ul class="tf__single_course_header">
                                    <li><i class="fas fa-user"></i> {{ $item->teacher->full_name }}</li>
                                    <li><i class="fas fa-folder-open"></i> {{ $item->course_detail->count() }} Materi</li>
                                </ul>
                                <div class="tf__single_courses_text">
                                    <a class="title" href="/view-course/{{ $item->id }}/{{ $item->min_course_detail[0]->id }}">{{ $item->title }}</a>
                                    <p class="description">{{ $item->description }}</p>
                                    <ul>
                                        <li>
                                            @if ($item->course_detail[0]->count_viewers) 
                                                {{ $item->course_detail[0]->count_viewers->count }} 
                                            @else 
                                                0
                                            @endif
                                            Penonton
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="tf__pagination mt_50">
                <div class="row">
                    <div class="col-12">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <li class="page-item @if ($data->currentPage() == 1) disabled @endif">
                                    <a class="page-link" href="@if ($search) {{ $data->previousPageUrl().'&search='.explode('search=', request()->fullUrl())[1] }} @else {{ $data->previousPageUrl() }} @endif" aria-label="Previous">
                                        <i class="far fa-angle-left"></i>
                                    </a>
                                </li>
                                @for ($i = 1; $i <= $data->lastPage(); $i++)
                                    <li class="page-item @if ($data->currentPage() == $i) disabled @endif">
                                        <a class="page-link @if ($data->currentPage() == $i) active @endif" href="@if ($search) {{ request()->url() }}?page={{ $i }}&search={{ $search }} @else {{ request()->url() }}?page={{ $i }} @endif" aria-label="1">
                                            <span>{{ $i }}</span>
                                        </a>
                                    </li>
                                @endfor
                                <li class="page-item @if ($data->currentPage() == $data->lastPage()) disabled @endif">
                                    <a class="page-link" href="@if ($search) {{ $data->nextPageUrl().'&search='.explode('search=', request()->fullUrl())[1] }} @else {{ $data->nextPageUrl() }} @endif" aria-label="Next">
                                        <i class="far fa-angle-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--=================================
        BLOG PAGE END
    ==================================-->
@endsection

@section('script')
@endsection