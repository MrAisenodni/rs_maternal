@extends('layouts.main')

@section('title', $c_menu->title)

@section('styles')
    {{-- Select2 --}}
    <link href="{{ asset('/assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('/assets/plugins/select2/css/select2-bootstrap4.css') }}" rel="stylesheet" />

    {{-- Data Table --}}
    <link href="{{ asset('/assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
    
    {{-- ApexChart --}}
    <link href="{{ asset('/assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
@endsection
    
@section('content')
    <div class="mdk-drawer-layout__content page ">

        <div class="container-fluid page__container">
            <ol class="breadcrumb">
                {{-- <li class="breadcrumb-item"><a href="/">Home</a></li> --}}
                <li class="breadcrumb-item active">{{ $c_menu->title }}</li>
            </ol>
            <h1 class="h2">Dashboard</h1>

            {{-- Bar Chart Grafik Capaian Standar Proses --}}
            <div class="row">
                <!-- Search -->
                <div class="col-lg-12 mb-2">
                    <form class="g-3" action="{{ $c_menu->url }}" method="GET">
                        @method('get')
                        @csrf
                        <div class="row">
                            <div class="col-11">
                                <select class="single-select @error('search') is-invalid @enderror" id="search" name="search">
                                    @if ($hospitals)
                                        @foreach ($hospitals as $item)
                                            <option value="{{ $item->id }}" @if ($item->id == old('search', $search)) selected @endif>{{ $item->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-1">
                                <button class="btn form-control bg-success" type="submit"><i class="material-icons text-white font-size-24pt">search</i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- // END Search -->

                @if ($results)
                    @foreach ($results as $item)
                        <div class="@if ($item->detail_result->count() >= 10) col-lg-12 @else col-lg-6 @endif">
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
            <div class="row">
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header text-center">
                            <div class="btn btn-primary btn-circle text-center"><i class="fa fa-user-circle"></i></div>
                            <div class="h5 mb-n2">Member</div>
                        </div>
                        <div class="card-body text-center">
                            <div class="h2 mt-n1 mb-n1">@if ($count_user) {{ $count_user[0]->jumlah }} @endif</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header text-center">
                            <div class="btn btn-primary btn-circle text-center"><i class="fa fa-user-graduate"></i></div>
                            <div class="h5 mb-n2">Pengajar</div>
                        </div>
                        <div class="card-body text-center">
                            <div class="h2 mt-n1 mb-n1">@if ($count_user[1]) {{ $count_user[1]->jumlah }} @endif</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header text-center">
                            <div class="btn btn-primary btn-circle text-center"><i class="fa fa-book-reader"></i></div>
                            <div class="h5 mb-n2">Video Materi</div>
                        </div>
                        <div class="card-body text-center">
                            <div class="h2 mt-n1 mb-n1">{{ $count_video }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header text-center">
                            <div class="btn btn-primary btn-circle text-center"><i class="fa fa-file"></i></div>
                            <div class="h5 mb-n2">Dokumen Materi</div>
                        </div>
                        <div class="card-body text-center">
                            <div class="h2 mt-n1 mb-n1">{{ $count_document }}</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Pending Approval --}}
            @if (session()->get('sid'))
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header text-center">
                                <div class="h5 mb-n2">Tugas Approval</div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th style="width: 5%">No</th>
                                                <th>Informasi</th>
                                                <th>Jumlah</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($approvals)
                                                @foreach ($approvals as $item)
                                                    <tr data-id="{{ $item->id }}">
                                                        <td class="text-center">{{ $loop->iteration }}</td>
                                                        <td></td>
                                                        <td></td>
                                                        <td class="text-center" style="width: 20mm">
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
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header text-center">
                                <div class="h5 mb-n2">Menunggu Approval</div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th style="width: 5%">No</th>
                                                <th>Informasi</th>
                                                <th>Jumlah</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($approvals)
                                                @foreach ($approvals as $item)
                                                    <tr data-id="{{ $item->id }}">
                                                        <td class="text-center">{{ $loop->iteration }}</td>
                                                        <td></td>
                                                        <td></td>
                                                        <td class="text-center" style="width: 20mm">
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
            @endif
        </div>
    </div>
@endsection

@section('scripts')
    {{-- Select2 --}}
    <script src="{{ asset('/assets/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('/assets/js/form-select2.js') }}"></script>

    {{-- Data Table --}}
    <script src="{{ asset('/assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('/assets/js/table-datatable.js') }}"></script>

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