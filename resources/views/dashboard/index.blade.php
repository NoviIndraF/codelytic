@extends('dashboard.layouts.main')

@section('container')
<div class="container-fluid mt-3 mb-3">
    <div class="row">
        <div class="col-lg-3 col-sm-6">
            <div class="card gradient-4">
                <div class="card-body">
                    <h3 class="card-title text-white">Kelas</h3>
                    <div class="d-inline-block">
                        <h2 class="text-white">{{ $count_room }}</h2>
                        <p class="text-white mb-0">Jan - March 2019</p>
                    </div>
                    <span class="float-right display-5 opacity-5"><i class="fa fa-users"></i></span>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card gradient-3">
                <div class="card-body">
                    <h3 class="card-title text-white">Materi</h3>
                    <div class="d-inline-block">
                        <h2 class="text-white">{{ $count_materi }}</h2>
                        <p class="text-white mb-0">Jan - March 2019</p>
                    </div>
                    <span class="float-right display-5 opacity-5"><i class="fa fa-book"></i></span>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card gradient-2">
                <div class="card-body">
                    <h3 class="card-title text-white">Tugas</h3>
                    <div class="d-inline-block">
                        <h2 class="text-white">{{ $count_tasks }}</h2>
                        <p class="text-white mb-0">Jan - March 2019</p>
                    </div>
                    <span class="float-right display-5 opacity-5"><i class="fa fa-file"></i></span>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card gradient-1">
                <div class="card-body">
                    <h3 class="card-title text-white">Kuis</h3>
                    <div class="d-inline-block">
                        <h2 class="text-white">{{ $count_quizzes }}</h2>
                        <p class="text-white mb-0">Jan - March 2019</p>
                    </div>
                    <span class="float-right display-5 opacity-5"><i class="fa fa-star"></i></span>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body pb-0 d-flex justify-content-between">
                            <div>
                                <h4 class="mb-1">Activitas</h4>
                                <p>29</p>
                                <h3 class="m-0">256</h3>
                            </div>
                            <div>
                                <ul>
                                    <li class="d-inline-block mr-3"><a class="text-dark" href="#">Day</a></li>
                                    <li class="d-inline-block mr-3"><a class="text-dark" href="#">Week</a></li>
                                    <li class="d-inline-block"><a class="text-dark" href="#">Month</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="chart-wrapper">
                            <canvas id="chart_widget_2"></canvas>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div class="w-100 mr-2">
                                    <h6>Android</h6>
                                    <div class="progress" style="height: 6px">
                                        <div class="progress-bar bg-danger" style="width: 40%"></div>
                                    </div>
                                </div>
                                <div class="ml-2 w-100">
                                    <h6>IOS</h6>
                                    <div class="progress" style="height: 6px">
                                        <div class="progress-bar bg-primary" style="width: 80%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- #/ container -->

@endsection