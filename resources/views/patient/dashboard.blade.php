@extends('layouts.main')

@section('title', $c_menu->title)

@section('styles')
@section('styles')
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
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex align-items-center">
                            <div class="flex">
                                <h4 class="card-title">GRAFIK CAPAIAN STANDAR DAN PROSES</h4>
                                <p class="card-subtitle">KINERJA KLINIS</p>
                            </div>
                            {{-- <a href="#" class="btn btn-sm btn-primary"><i class="material-icons">trending_up</i></a> --}}
                        </div>
                        <div class="card-body">
                            <div id="legend" class="chart-legend mt-0 mb-24pt justify-content-start"></div>
                            <div id="chart-group" style="height: 200px;"></div>
                        </div>
                    </div>
                </div>
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
                            <div class="h2 mt-n1 mb-n1">{{ $count_user[0]->count }}</div>
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
                            <div class="h2 mt-n1 mb-n1">{{ $count_user[1]->count }}</div>
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
            var companion = {!! json_encode($companion->toArray()) !!}
            var index = 0
            console.log(companion, companion.length, companion[index+1].title)
            var options = {
                series: [
                        {
                            name: companion[index].title,
                            data: [
                                {
                                    x: companion[index].description + ' STANDAR',
                                    y: companion[index].standard,
                                    fillColor: '#e02712',
                                },
                                {
                                    x: companion[index].description + ' PROSES',
                                    y: companion[index].process,
                                    fillColor: '#e02712',
                                },
                                {
                                    x: companion[index+3].description + ' STANDAR',
                                    y: companion[index+3].standard,
                                    fillColor: '#e02712',
                                },
                                {
                                    x: companion[index+3].description + ' PROSES',
                                    y: companion[index+3].process,
                                    fillColor: '#e02712',
                                },
                                {
                                    x: companion[index+6].description + ' STANDAR',
                                    y: companion[index+6].standard,
                                    fillColor: '#e02712',
                                },
                                {
                                    x: companion[index+6].description + ' PROSES',
                                    y: companion[index+6].process,
                                    fillColor: '#e02712',
                                },
                                {
                                    x: companion[index+9].description + ' STANDAR',
                                    y: companion[index+9].standard,
                                    fillColor: '#e02712',
                                },
                                {
                                    x: companion[index+9].description + ' PROSES',
                                    y: companion[index+9].process,
                                    fillColor: '#e02712',
                                },
                                {
                                    x: companion[index+12].description + ' STANDAR',
                                    y: companion[index+12].standard,
                                    fillColor: '#e02712',
                                },
                                {
                                    x: companion[index+12].description + ' PROSES',
                                    y: companion[index+12].process,
                                    fillColor: '#e02712',
                                },
                            ],
                        },
                        {
                            name: companion[index+1].title,
                            data: [
                                {
                                    x: companion[index+1].description + ' STANDAR',
                                    y: companion[index+1].standard,
                                    fillColor: '#fffb26',
                                },
                                {
                                    x: companion[index+1].description + ' PROSES',
                                    y: companion[index+1].process,
                                    fillColor: '#fffb26',
                                },
                                {
                                    x: companion[index+4].description + ' STANDAR',
                                    y: companion[index+4].standard,
                                    fillColor: '#fffb26',
                                },
                                {
                                    x: companion[index+4].description + ' PROSES',
                                    y: companion[index+4].process,
                                    fillColor: '#fffb26',
                                },
                                {
                                    x: companion[index+7].description + ' STANDAR',
                                    y: companion[index+7].standard,
                                    fillColor: '#fffb26',
                                },
                                {
                                    x: companion[index+7].description + ' PROSES',
                                    y: companion[index+7].process,
                                    fillColor: '#fffb26',
                                },
                                {
                                    x: companion[index+10].description + ' STANDAR',
                                    y: companion[index+10].standard,
                                    fillColor: '#fffb26',
                                },
                                {
                                    x: companion[index+10].description + ' PROSES',
                                    y: companion[index+10].process,
                                    fillColor: '#fffb26',
                                },
                                {
                                    x: companion[index+13].description + ' STANDAR',
                                    y: companion[index+13].standard,
                                    fillColor: '#fffb26',
                                },
                                {
                                    x: companion[index+13].description + ' PROSES',
                                    y: companion[index+13].process,
                                    fillColor: '#fffb26',
                                },
                            ]
                        },
                        {
                            name: companion[index+2].title,
                            data: [
                                {
                                    x: companion[index+2].description + ' STANDAR',
                                    y: companion[index+2].standard,
                                    fillColor: '#12de2a',
                                },
                                {
                                    x: companion[index+2].description + ' PROSES',
                                    y: companion[index+2].process,
                                    fillColor: '#12de2a',
                                },
                                {
                                    x: companion[index+5].description + ' STANDAR',
                                    y: companion[index+5].standard,
                                    fillColor: '#12de2a',
                                },
                                {
                                    x: companion[index+5].description + ' PROSES',
                                    y: companion[index+5].process,
                                    fillColor: '#12de2a',
                                },
                                {
                                    x: companion[index+8].description + ' STANDAR',
                                    y: companion[index+8].standard,
                                    fillColor: '#12de2a',
                                },
                                {
                                    x: companion[index+8].description + ' PROSES',
                                    y: companion[index+8].process,
                                    fillColor: '#12de2a',
                                },
                                {
                                    x: companion[index+11].description + ' STANDAR',
                                    y: companion[index+11].standard,
                                    fillColor: '#12de2a',
                                },
                                {
                                    x: companion[index+11].description + ' PROSES',
                                    y: companion[index+11].process,
                                    fillColor: '#12de2a',
                                },
                                {
                                    x: companion[index+14].description + ' STANDAR',
                                    y: companion[index+14].standard,
                                    fillColor: '#12de2a',
                                },
                                {
                                    x: companion[index+14].description + ' PROSES',
                                    y: companion[index+14].process,
                                    fillColor: '#12de2a',
                                },
                            ]
                        }
                    ],
                    chart: {
                    type: 'bar',
                    height: 480,
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
                        fontSize: '12px',
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
                        fillColors: ['#e02712', '#fffb26', '#12de2a']
                    }
                }
            }

            var chart = new ApexCharts(document.querySelector("#chart-group"), options);
            chart.render();
        })
    </script>
@endsection