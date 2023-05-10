@extends('dashboard.layouts.main')

@section('container')
<div class="container-fluid mt-3 mb-3">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <div class="row">
                            <div class="col-lg-10">
                                <h4>Daftar Materi</h4>
                            </div>
                            <div class="col-lg-2">
                                <a href="/dashboard/materis/create" type="submit" class="btn mb-1 mr-5 btn-primary">Tambah Materi<span class="btn-icon-right"><i class="fa fa-plus-circle"></i></span>
                                </a>
                            </div>
                        </div>
                        @if(session()->has('success'))
                            <div class="alert alert-success alert-dismissible fade show">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
                                </button> {{ session('success') }}
                            </div>
                        @endif
                    </div>
                    <div class="table-responsive mt-4">
                        <table class="table table-striped table-bordered zero-configuration">
                            <thead>
                                <tr>
                                    <th class="col-md-1">#</th>
                                    <th class="col-md-1">Judul</th>
                                    <th class="col-md-2">Deskripsi</th>
                                    <th class="col-md-2">Kelas</th>
                                    <th class="col-md-4">Status</th>
                                    <th class="col-md-2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($materis as $materi)       
                                <tr>
                                    <th>{{ $loop->iteration }}</th>
                                    <td>{{ $materi->code }}</td>
                                    <td>{{ $materi->name }}</td>
                                    <td>{{ $materi->major }}</td>
                                    <td>{{ $materi->description }}</td>
                                    <td> 
                                        <div class="row">
                                            <a href="/dashboard/materis/{{ $materi->slug }}/edit" class="btn mb-1 btn-warning ml-2"><i class="fa fa-edit"></i>
                                            </a>
                                            
                                            <form action="/dashboard/materis/{{ $materi->slug }}" method="post" class="d-inline">
                                                @method('delete')
                                                @csrf
                                                <button onclick="return confirm('are you sure?')" class="btn mb-1 btn-danger ml-2"><i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                        </td>
                                </tr>
                                @endforeach
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /# card -->
        </div>
    </div>
</div>

@endsection