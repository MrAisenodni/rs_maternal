@extends('layouts.main')

@section('title', $c_menu->title)

@section('styles')
@endsection
    
@section('content')
    <div class="mdk-drawer-layout__content page ">

        <div class="container-fluid page__container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">{{ $c_menu->title }}</li>
            </ol>
            <div class="media align-items-center mb-headings">
                <div class="media-body">
                    <h1 class="h2">{{ $c_menu->title }}</h1>
                </div>
                <div class="media-right">
                    <!-- Search -->
                    <form class="search-form d-none d-md-flex" action="{{ $c_menu->url }}" method="GET">
                        @method('get')
                        @csrf
                        <input type="text" class="form-control" placeholder="Search" name="search" value="{{ old('search', $search) }}">
                        <button class="btn" type="button"><i class="material-icons font-size-24pt">search</i></button>
                    </form>
                    <!-- // END Search -->
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="card-columns">
                @if ($data)
                    @foreach ($data as $item)    
                        <div class="card">
                            <div class="card-header text-center">
                                <h4 class="card-title mb-0"><a href="/view-course/{{ $item->id }}/1"></a>{{ $item->title }}</h4>
                                <div class="rating">
                                    @php
                                        $sisa = $item->rating
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
                            </div>
                            <a href="/view-course/{{ $item->id }}/{{ $item->min_course_detail[0]->id }}">
                                <img src="{{ $item->picture }}" alt="{{ $item->title }}" style="width:100%;">
                            </a>
                            <div class="card-body">
                                <small class="text-muted">{{ $item->level->name }}</small><br>
                                    {!! $item->description !!}
                                <span class="badge badge-primary ">{{ $item->category->name }}</span>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

            <!-- Pagination -->
            <ul class="pagination justify-content-center pagination-sm">
                {{-- {{ $data->links() }} --}}
                <li class="page-item @if ($data->currentPage() == 1) disabled @endif">
                    <a class="page-link" href="@if ($search) {{ $data->previousPageUrl().'&search='.explode('search=', request()->fullUrl())[1] }} @else {{ $data->previousPageUrl() }} @endif" aria-label="Previous">
                        <span aria-hidden="true" class="material-icons">chevron_left</span>
                        <span>Prev</span>
                    </a>
                </li>
                @for ($i = 1; $i <= $data->lastPage(); $i++)
                    <li class="page-item @if ($data->currentPage() == $i) disabled @endif">
                        <a class="page-link" href="@if ($search) {{ request()->url() }}?page={{ $i }}&search={{ $search }} @else {{ request()->url() }}?page={{ $i }} @endif" aria-label="1">
                            <span>{{ $i }}</span>
                        </a>
                    </li>
                @endfor
                {{-- <li class="page-item @if (request()->url().'?'.explode('?', request()->fullUrl())[1] == $data->nextPageUrl()) disabled @endif"> --}}
                <li class="page-item @if ($data->currentPage() == $data->lastPage()) disabled @endif">
                    <a class="page-link" href="@if ($search) {{ $data->nextPageUrl().'&search='.explode('search=', request()->fullUrl())[1] }} @else {{ $data->nextPageUrl() }} @endif" aria-label="Next">
                        <span>Next</span>
                        <span aria-hidden="true" class="material-icons">chevron_right</span>
                    </a>
                </li>
            </ul>
        </div>

    </div>
@endsection

@section('script')
@endsection