@extends('dashboard.layouts.main')

@section('container')
<div class="container-fluid mt-3 mb-3">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <div class="row">
                            <div class="col-lg-12 col-sm-6">
                            </div>
                        </div>
                        @if(session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
                            </button> <b>{{ session('success') }}</b>
                        </div>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-lg-10">
                            <h4>Profile</h4>
                            <div class="row">
                                <div class="col-lg-2">
                                    <div class="card gradient-8">
                                        <div class="card-body">
                                            <div class="center">
                                                <span class="float-right display-5 opacity-5"><i class="fa fa-user"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                        <h5>Nama</h5>

                                        <h5>Username</h5>

                                        <h5>Emaill</h5>
                                </div>
                                <div class="col-lg-7">
                                    <h5>: {{ $user->name }}</h5>

                                    <h5>: {{ $user->username }}</h5>

                                    <h5>: {{ $user->email }}</h5>
                                </div>

                                <div class="col-lg-1">
                                    <a href="/dashboard/users/{{ $user->id }}/edit" type="submit" class="btn mb-1 mr-5 btn-warning">Edit Profile<span class="btn-icon-right"><i class="fa fa-edit"></i></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div>
                           
                            
                        </div>
                    </div>
                    <div class="table-responsive">
                        
                    </div>
                </div>
            </div>
            <!-- /# card -->
        </div>
    </div>
</div>

@endsection