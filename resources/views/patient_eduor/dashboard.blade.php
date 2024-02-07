@extends('layouts_eduor.main')

@section('title', $c_menu->title)

@section('styles')
    {{-- Custom Section --}}
    <style>
        .tf__breadcrumb .container::after {
            position: absolute;
            content: "";
            background: url('{{ asset('/storage/'.$provider->provider_logo) }}');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            width: 500px;
            height: 500px;
            top: -125px;
            right: 0;
            z-index: 1;
        }
        @media (min-width: 1200px) and (max-width: 1399.99px) {
            .tf__breadcrumb .container::after {
                width: 250px;
                height: 320px;
                top: 20px;
            }
        }
    </style>

    {{-- Select2 --}}
    <link href="{{ asset('/assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('/assets/plugins/select2/css/select2-bootstrap4.css') }}" rel="stylesheet" />
    
    {{-- ApexChart --}}
    <link href="{{ asset('/assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
@endsection
    
@section('content')
    <!--=================================
        BREADCRUMB START
    ==================================-->
    <section class="tf__breadcrumb" style="background: #2377a8 url('{{ asset('/storage/'.$c_menu->section_header->picture_header) }}'); margin-top: 80px;">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="tf__breadcrumb_text">
                        <h2 style="color: {{ $c_menu->section_header->title_color }}">{{ $c_menu->section_header->title }}</h2>
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
                    <form class="g-3" action="{{ $c_menu->url }}" method="GET">
                        @method('get')
                        @csrf
                        <div class="row mb-4">
                            <div class="col-10">
                                <select class="single-select @error('search') is-invalid @enderror" id="search" name="search">
                                    @if ($hospitals)
                                        @foreach ($hospitals as $item)
                                            <option value="{{ $item->id }}" @if ($item->id == old('search', $search)) selected @endif>{{ $item->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-2">
                                <button class="form-control btn btn-success" type="submit"><i class="fa fa-search text-white"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                @if ($results)
                    @foreach ($results as $item)
                        <div class="@if ($item->detail_result->count() >= 10) col-lg-12 @else col-lg-6 @endif mb-4">
                            <div class="card">
                                <div class="card-header d-flex align-items-center">
                                    <div class="flex">
                                        <h4 class="card-title">{{ $item->title }}</h4>
                                        <p class="card-subtitle">{{ $item->subtitle }}</p>
                                    </div>
                                    {{-- <a href="#" class="btn btn-sm btn-primary"><i class="material-icons">trending_up</i></a> --}}
                                </div>
                                <div class="card-body">
                                    <div id="legend" class="chart-legend mt-0 mb-24pt justify-content-start"></div>
                                    <div id="chart-group{{ $loop->iteration }}" style="height: @if ($item->detail_result->count() >= 10) 350px @else 200px @endif;"></div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

            {{-- Count --}}
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header text-center">
                            <div class="btn btn-primary btn-circle text-center mt-2"><i class="fa fa-user-circle"></i></div>
                            <div class="h5 mt-2">Member</div>
                        </div>
                        <div class="card-body text-center">
                            <div class="h2 mt-n1 mb-n1">@if ($count_user) {{ $count_user[0]->jumlah }} @endif</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header text-center">
                            <div class="btn btn-secondary btn-circle text-center mt-2"><i class="fa fa-user-graduate"></i></div>
                            <div class="h5 mt-2">Pengajar</div>
                        </div>
                        <div class="card-body text-center">
                            <div class="h2 mt-n1 mb-n1">@if ($count_user[1]) {{ $count_user[1]->jumlah }} @endif</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header text-center">
                            <div class="btn btn-danger btn-circle text-center mt-2"><i class="fa fa-book-reader"></i></div>
                            <div class="h5 mt-2">Video Materi</div>
                        </div>
                        <div class="card-body text-center">
                            <div class="h2 mt-n1 mb-n1">{{ $count_video }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header text-center">
                            <div class="btn btn-warning btn-circle text-center mt-2"><i class="fa fa-file"></i></div>
                            <div class="h5 mt-2">Dokumen Materi</div>
                        </div>
                        <div class="card-body text-center">
                            <div class="h2 mt-n1 mb-n1">{{ $count_document }}</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Summary --}}
            <div class="row">
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header text-center">
                            <div class="btn btn-primary btn-circle text-center mt-2"><i class="fa fa-user"></i></div>
                            <div class="h5 mt-2">Pengunjung</div>
                        </div>
                        <div class="card-body text-center">
                            <div class="h2 mt-n1 mb-n1">@if ($history) {{ $history[0]->count }} @endif</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header text-center">
                            <div class="btn btn-secondary btn-circle text-center mt-2"><i class="fa fa-eye"></i></div>
                            <div class="h5 mt-2">Penonton</div>
                        </div>
                        <div class="card-body text-center">
                            <div class="h2 mt-n1 mb-n1">@if ($history) {{ $history[1]->count }} @endif</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header text-center">
                            <div class="btn btn-danger btn-circle text-center mt-2"><i class="fa fa-book"></i></div>
                            <div class="h5 mt-2">Unduhan</div>
                        </div>
                        <div class="card-body text-center">
                            <div class="h2 mt-n1 mb-n1">@if ($history) {{ $history[2]->count }} @endif</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header text-center">
                            <div class="btn btn-warning btn-circle text-center mt-2"><i class="fa fa-download"></i></div>
                            <div class="h5 mt-2">Pembaca</div>
                        </div>
                        <div class="card-body text-center">
                            <div class="h2 mt-n1 mb-n1">@if ($history) {{ $history[3]->count }} @endif</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--=================================
        BLOG PAGE END
    ==================================-->
@endsection

@section('scripts')
    {{-- Select2 --}}
    <script src="{{ asset('/assets/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('/assets/js/form-select2.js') }}"></script>

    {{-- ApexChart --}}
    <script src="{{ asset('/assets/plugins/apexcharts-bundle/js/apexcharts.min.js') }}"></script>
    <script src="{{ asset('/assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
    <script>
        $(function() {
            "use strict";
            var companion = {!! json_encode($companions->toArray()) !!}
            var result = {!! json_encode($results->toArray()) !!}
            var clinic = {!! json_encode($clinic_results->toArray()) !!}
            
            var index = 0
            let data_index = 0
            let color_index = 0

            for (let i = 0; i < result.length; i++) {
                const color = [
                    '#e02712', '#fffb26', '#12de2a', '#d0eff9', '#9cdcf2', '#169acc', '#d0eff9', '#9cdcf2', '#169acc', 
                    '#fdd8f0', '#f81fe5', '#9b1587', '#fdd8f0', '#f81fe5', '#9b1587', '#e6e6e6', '#c6cdd1', '#333a3e',
                    '#e6e6e6', '#c6cdd1', '#333a3e', '#d0ede4', '#8cd5c1', '#225f4d', '#d0ede4', '#8cd5c1', '#225f4d',
                    '#e8bf17', '#cc7a12', '#3b3618', '#e8bf17', '#cc7a12', '#3b3618'
                ]
                const element = []
                const element1 = []
                const element2 = []
                var legend_color = []

                for (let a = 0; a < result[i].detail_result.length; a++) {
                    element.push({
                        x: result[i].detail_result[a].title,
                        y: clinic[data_index].value,
                        fillColor: color[color_index],
                    });

                    data_index = data_index + 1
                }
                legend_color.push(color[color_index])
                color_index = color_index + 1

                for (let a = 0; a < result[i].detail_result.length; a++) {
                    element1.push({
                        x: result[i].detail_result[a].title,
                        y: clinic[data_index].value,
                        fillColor: color[color_index],
                    });

                    data_index = data_index + 1
                }
                legend_color.push(color[color_index])
                color_index = color_index + 1

                for (let a = 0; a < result[i].detail_result.length; a++) {
                    element2.push({
                        x: result[i].detail_result[a].title,
                        y: clinic[data_index].value,
                        fillColor: color[color_index],
                    });

                    data_index = data_index + 1
                }
                legend_color.push(color[color_index])
                color_index = color_index + 1

                var options = {
                    series: [
                            {
                                name: companion[index].title,
                                data: element,
                            },
                            {
                                name: companion[index+1].title,
                                data: element1,
                            },
                            {
                                name: companion[index+2].title,
                                data: element2,
                            }
                        ],
                        chart: {
                        type: 'bar',
                        height: 300,
                    },
                    xaxis: {
                        labels: {
                            show: true,
                            style: {
                                colors: ['#000'],
                                fontSize: '9px',
                            }
                        }
                    },
                    plotOptions: {
                        bar: {
                            dataLabels: {
                                position: 'top',
                            },
                        }
                    },
                    dataLabels: {
                        enabled: true,
                        offsetY: -20,
                        offsetX: 0,
                        style: {
                            fontSize: '9px',
                            colors: ['#000'],
                        }
                    },
                    stroke: {
                        show: true,
                        width: 1,
                        colors: ['#000']
                    },
                    tooltip: {
                        shared: true,
                        intersect: false
                    },
                    legend: {
                        position: 'top',
                        show: true,
                        showForSingleSeries: true,
                        customLegendItems: ['p1', 'p2', 'p3'],
                        markers: {
                            fillColors: legend_color
                        }
                    }
                }
                legend_color = []
                
                var chart = new ApexCharts(document.querySelector("#chart-group"+(i+1)), options);
                chart.render();
            }
        })
    </script>
@endsection