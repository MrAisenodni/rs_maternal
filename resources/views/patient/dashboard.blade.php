@extends('layouts.main')

@section('title', $c_menu->title)

@section('styles')
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

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex align-items-center">
                            <div class="flex">
                                <h4 class="card-title">Earnings</h4>
                                <p class="card-subtitle">Last 7 Days</p>
                            </div>
                            <a href="#" class="btn btn-sm btn-primary"><i class="material-icons">trending_up</i></a>
                        </div>
                        {{-- <div class="custom-control custom-checkbox-toggle">
                            <input 
                              id="chart-switch-toggle"
                              type="checkbox"
                              class="custom-control-input"
                              role="switch"
                              data-toggle="chart" 
                              data-target="#ordersChart" 
                              data-add='{
                                "data":{
                                  "datasets":[{
                                    "data":[15,10,20,12,7,0,8,16,18,16,10,22],
                                    "backgroundColor":"#b2e599",
                                    "label":"Affiliate",
                                    "barPercentage": 0.5,
                                    "barThickness": 20
                                  }]
                                }
                              }'
                              checked="">
                            <label 
                              class="custom-control-label" 
                              for="chart-switch-toggle">
                              <span class="sr-only">Show affiliate</span>
                            </label>
                        </div> --}}
                        <div class="card-body">
                            <div id="legend" class="chart-legend mt-0 mb-24pt justify-content-start"></div>
                            <div id="chart-group" style="height: 200px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('/assets/plugins/apexcharts-bundle/js/apexcharts.min.js') }}"></script>
    <script src="{{ asset('/assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
    <script>
        $(function() {
	    "use strict";
        var companion = {!! json_encode($companion->toArray()) !!}
            console.log(companion)
        // chart grouped
        var options = {
            series: [
                    {
                        name: 'p1',
                        data: [
                            {
                                x: 'MATERNAL STANDAR',
                                y: 86,
                            },
                            {
                                x: 'MATERNAL PROSES',
                                y: 88,
                            },
                            {
                                x: 'NEONATAL STANDAR',
                                y: 90,
                            },
                            {
                                x: 'NEONATAL PROSES',
                                y: 92,
                            },
                            {
                                x: 'TATAKELOLA KLINIS STANDAR',
                                y: 93,
                            },
                            {
                                x: 'TATAKELOLA KLINIS PROSES',
                                y: 92,
                            },
                            {
                                x: 'PENCEGAHAN KLINIS STANDAR',
                                y: 77,
                            },
                            {
                                x: 'PENCEGAHAN KLINIS PROSES',
                                y: 97,
                            },
                            {
                                x: 'TOTAL STANDAR',
                                y: 86,
                            },
                            {
                                x: 'TOTAL PROSES',
                                y: 92,
                            },
                        ]
                    },
                    {
                        name: 'p2',
                        data: [
                            {
                                x: 'MATERNAL STANDAR',
                                y: 87,
                            },
                            {
                                x: 'MATERNAL PROSES',
                                y: 89,
                            },
                            {
                                x: 'NEONATAL STANDAR',
                                y: 90,
                            },
                            {
                                x: 'NEONATAL PROSES',
                                y: 94,
                            },
                            {
                                x: 'TATAKELOLA KLINIS STANDAR',
                                y: 100,
                            },
                            {
                                x: 'TATAKELOLA KLINIS PROSES',
                                y: 93,
                            },
                            {
                                x: 'PENCEGAHAN KLINIS STANDAR',
                                y: 79,
                            },
                            {
                                x: 'PENCEGAHAN KLINIS PROSES',
                                y: 97,
                            },
                            {
                                x: 'TOTAL STANDAR',
                                y: 89,
                            },
                            {
                                x: 'TOTAL PROSES',
                                y: 93,
                            },
                        ]
                    },
                    {
                        name: 'p3',
                        data: [
                            {
                                x: 'MATERNAL STANDAR',
                                y: 94,
                            },
                            {
                                x: 'MATERNAL PROSES',
                                y: 96,
                            },
                            {
                                x: 'NEONATAL STANDAR',
                                y: 97,
                            },
                            {
                                x: 'NEONATAL PROSES',
                                y: 98,
                            },
                            {
                                x: 'TATAKELOLA KLINIS STANDAR',
                                y: 100,
                            },
                            {
                                x: 'TATAKELOLA KLINIS PROSES',
                                y: 93,
                            },
                            {
                                x: 'PENCEGAHAN KLINIS STANDAR',
                                y: 83,
                            },
                            {
                                x: 'PENCEGAHAN KLINIS PROSES',
                                y: 98,
                            },
                            {
                                x: 'TOTAL STANDAR',
                                y: 93,
                            },
                            {
                                x: 'TOTAL PROSES',
                                y: 96,
                            },
                        ]
                    }
                ],
                    // data: [44, 55, 41, 64, 22, 43, 21, 22, 43, 21]
                    //     }, {
                    //         data: [53, 32, 33, 52, 13, 44, 32, 22, 43, 21]
                    //     }, {
                    //         data: [53, 32, 33, 52, 13, 44, 32, 22, 43, 21]
                    //     }],
                chart: {
                type: 'bar',
                height: 430
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
            offsetX: -6,
            style: {
                fontSize: '12px',
                colors: ['#fff']
            }
            },
            stroke: {
            show: true,
            width: 1,
            colors: ['#fff']
            },
            tooltip: {
            shared: true,
            intersect: false
            },
            xaxis: {
                // categories: [
                //     "STANDAR", "PROSES", "STANDAR", "PROSES", "STANDAR", "PROSES", "STANDAR", "PROSES", "STANDAR", "PROSES",
                // ],
            },
            legend: {
                show: true,
                showForSingleSeries: true,
                customLegendItems: ['Actual', 'Expected'],
                markers: {
                    fillColors: ['#00E396', '#775DD0']
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#chart-group"), options);
        chart.render();
        
        // chart 2
        var options = {
            series: [{
                name: "Messages",
                data: [
                    {
                        data: [44, 55, 41, 64, 22, 43, 21]
                    }, {
                        data: [53, 32, 33, 52, 13, 44, 32]
                    }
                ]
            }],
            chart: {
                foreColor: '#9a9797',
                type: "bar",
                //width: 130,
                height: 320,
                toolbar: {
                    show: !1
                },
                zoom: {
                    enabled: !1
                },
                dropShadow: {
                    enabled: 0,
                    top: 3,
                    left: 14,
                    blur: 4,
                    opacity: .12,
                    color: "#3461ff"
                },
                sparkline: {
                    enabled: 0
                }
            },
            markers: {
                size: 0,
                colors: ["#3461ff"],
                strokeColors: "#fff",
                strokeWidth: 2,
                hover: {
                    size: 7
                }
            },
            plotOptions: {
                bar: {
                    horizontal: !1,
                    columnWidth: "45%",
                    // distributed: true,
                    //endingShape: "rounded"
                }
            },
            dataLabels: {
                enabled: true,
                offsetX: -6,
                style: {
                    fontSize: '12px',
                    colors: ['#fff']
                }
            },
            legend: {
                show: false
            },
            stroke: {
                show: !0,
                width: 1.5,
                curve: "smooth"
            },
            colors: ["#3461ff"],
            xaxis: {
                categories: [
                    "MATERNAL", "NEONATAL", "TATAKELOLA KLINIS", "PENCEGAHAN INFEKSI", "TOTAL", "STANDAR", "PROSES"
                ]
            },
            tooltip: {
                theme: "dark",
                fixed: {
                    enabled: !1
                },
                x: {
                    show: !1
                },
                y: {
                    title: {
                        formatter: function(e) {
                            return ""
                        }
                    }
                },
                marker: {
                    show: !1
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#chart2"), options);
        chart.render();

        new PerfectScrollbar(".client-message")

        });
    </script>
@endsection