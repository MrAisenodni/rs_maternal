@extends('layouts.main')

@section('title', $c_menu->title)

@section('styles')
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
                <div class="col-lg-7">

                    <div class="card">
                        <div class="card-header d-flex align-items-center">
                            <div class="h2 mb-0 mr-3 text-primary">116</div>
                            <div class="flex">
                                <h4 class="card-title">Angular</h4>
                                <p class="card-subtitle">Best score</p>
                            </div>
                            <div class="dropdown">
                                <a href="#" class="dropdown-toggle text-black-70" data-toggle="dropdown">Popular Topics</a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="" class="dropdown-item">Popular Topics</a>
                                    <a href="" class="dropdown-item">Web Design</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart" style="height: 319px;">
                                <canvas id="topicIqChart" 
                                    class="chart-canvas js-update-chart-line" 
                                    data-chart-hide-axes="false"
                                    data-chart-points="true"
                                    data-chart-suffix=" points"
                                    data-chart-line-border-color="primary">
                                </canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">

                    <div class="card">
                        <div class="card-header d-flex align-items-center">
                            <div class="h2 mb-0 mr-3 text-primary">432</div>
                            <div class="flex">
                                <h4 class="card-title">Experience IQ</h4>
                                <p class="card-subtitle">4 days streak this week</p>
                            </div>
                            <i class="material-icons text-muted ml-2">trending_up</i>
                        </div>
                        <div class="card-body">
                            <div class="chart"
                                style="height: 154px;">
                                <canvas id="iqChart"
                                        class="chart-canvas js-update-chart-line"
                                        data-chart-points="true"
                                        data-chart-suffix="pt"
                                        data-chart-line-border-color="primary"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="card card-2by1">
                        <div class="card-header">
                            <h4 class="card-title">Rewards</h4>
                            <p class="card-subtitle">Your latest achievements</p>
                        </div>
                        <div class="card-body text-center">
                            <div class="btn btn-primary btn-circle"><i class="material-icons">thumb_up</i></div>
                            <div class="btn btn-danger btn-circle"><i class="material-icons">grade</i></div>
                            <div class="btn btn-success btn-circle"><i class="material-icons">bubble_chart</i></div>
                            <div class="btn btn-warning btn-circle"><i class="material-icons">keyboard_voice</i></div>
                            <div class="btn btn-info btn-circle"><i class="material-icons">event_available</i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="media align-items-center">
                                <div class="media-body">
                                    <h4 class="card-title">Courses</h4>
                                    <p class="card-subtitle">Your recent courses</p>
                                </div>
                                <div class="media-right">
                                    <a class="btn btn-sm btn-primary"
                                    href="student-my-courses.html">My courses</a>
                                </div>
                            </div>
                        </div>

                        <ul class="list-group list-group-fit mb-0"
                            style="z-index: initial;">

                            <li class="list-group-item"
                                style="z-index: initial;">
                                <div class="d-flex align-items-center">
                                    <a href="student-take-course.html"
                                    class="avatar avatar-4by3 avatar-sm mr-3">
                                        <img src="{{ asset('/assets/images/gulp.png') }}" alt="course" class="avatar-img rounded">
                                    </a>
                                    <div class="flex">
                                        <a href="student-take-course.html"
                                        class="text-body"><strong>Learn Vue.js Fundamentals</strong></a>
                                        <div class="d-flex align-items-center">
                                            <div class="progress"
                                                style="width: 100px;">
                                                <div class="progress-bar bg-primary"
                                                    role="progressbar"
                                                    style="width: 25%"
                                                    aria-valuenow="25"
                                                    aria-valuemin="0"
                                                    aria-valuemax="100">
                                                </div>
                                            </div>
                                            <small class="text-muted ml-2">25%</small>
                                        </div>
                                    </div>
                                    <div class="dropdown ml-3">
                                        <a href="#"
                                        class="dropdown-toggle text-muted"
                                        data-caret="false"
                                        data-toggle="dropdown">
                                            <i class="material-icons">more_vert</i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item"
                                            href="student-take-course.html">Continue</a>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li class="list-group-item"
                                style="z-index: initial;">
                                <div class="d-flex align-items-center">
                                    <a href="student-take-course.html"
                                    class="avatar avatar-4by3 avatar-sm mr-3">
                                        <img src="{{ asset('/assets/images/vuejs.png') }}"
                                            alt="course"
                                            class="avatar-img rounded">
                                    </a>
                                    <div class="flex">
                                        <a href="student-take-course.html"
                                        class="text-body"><strong>Angular in Steps</strong></a>
                                        <div class="d-flex align-items-center">
                                            <div class="progress"
                                                style="width: 100px;">
                                                <div class="progress-bar bg-success"
                                                    role="progressbar"
                                                    style="width: 100%"
                                                    aria-valuenow="100"
                                                    aria-valuemin="0"
                                                    aria-valuemax="100"></div>
                                            </div>
                                            <small class="text-muted ml-2">100%</small>
                                        </div>
                                    </div>
                                    <div class="dropdown ml-3">
                                        <a href="#"
                                        class="dropdown-toggle text-muted"
                                        data-caret="false"
                                        data-toggle="dropdown">
                                            <i class="material-icons">more_vert</i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item"
                                            href="student-take-course.html">Continue</a>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li class="list-group-item"
                                style="z-index: initial;">
                                <div class="d-flex align-items-center">
                                    <a href="student-take-course.html"
                                    class="avatar avatar-4by3 avatar-sm mr-3">
                                        <img src="{{ asset('/assets/images/nodejs.png') }}"
                                            alt="course"
                                            class="avatar-img rounded">
                                    </a>
                                    <div class="flex">
                                        <a href="student-take-course.html"
                                        class="text-body"><strong>Bootstrap Foundations</strong></a>
                                        <div class="d-flex align-items-center">
                                            <div class="progress"
                                                style="width: 100px;">
                                                <div class="progress-bar bg-warning"
                                                    role="progressbar"
                                                    style="width: 80%"
                                                    aria-valuenow="80"
                                                    aria-valuemin="0"
                                                    aria-valuemax="100"></div>
                                            </div>
                                            <small class="text-muted ml-2">80%</small>
                                        </div>
                                    </div>
                                    <div class="dropdown ml-3">
                                        <a href="#"
                                        class="dropdown-toggle text-muted"
                                        data-caret="false"
                                        data-toggle="dropdown">
                                            <i class="material-icons">more_vert</i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item"
                                            href="student-take-course.html">Continue</a>
                                        </div>
                                    </div>
                                </div>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <!-- Chart.js -->
    <script src="{{ asset('/assets/vendor/Chart.min.js') }}"></script>
    <script src="{{ asset('/assets/js/chartjs.js') }}"></script>

    <!-- Student Dashboard Page JS -->
    <!-- <script src="assets/js/chartjs-rounded-bar.js"></script> -->
    <script src="{{ asset('/assets/js/page.student-dashboard.js') }}"></script>
@endsection