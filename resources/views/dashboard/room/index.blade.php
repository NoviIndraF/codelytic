@extends('dashboard.layouts.main')

@section('container')
<div class="container-fluid mt-3 mb-3">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card gradient-4">
                                    <div class="card-body">
                                        <h3 class="card-title text-white">Kelas</h3>
                                        <div class="d-inline-block">
                                            <h2 class="text-white">{{ $count_room }}</h2>
                                        </div>
                                        <span class="float-right display-5 opacity-5"><i class="fa fa-users"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if(session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
                            </button>{{ session('success') }}
                        </div>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-lg-10">
                            <h4>Daftar Kelas</h4>
                        </div>
                        <div class="col-lg-2">
                            <a href="/dashboard/rooms/create" type="submit" class="btn mb-1 mr-5 btn-primary">Tambah Kelas<span class="btn-icon-right"><i class="fa fa-plus-circle"></i></span>
                            </a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered zero-configuration">
                            <thead>
                                <tr>
                                    <th class="col-md-1">#</th>
                                    <th class="col-md-1">Code</th>
                                    <th class="col-md-2">Name</th>
                                    <th class="col-md-2">Jurusan</th>
                                    <th class="col-md-4">Deskripsi</th>
                                    <th class="col-md-2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rooms as $room)       
                                <tr>
                                    <th>{{ $loop->iteration }}</th>
                                    <td>{{ $room->code }}</td>
                                    <td>{{ $room->name }}</td>
                                    <td>{{ $room->major }}</td>
                                    <td>{{ $room->description }}</td>
                                    <td> 
                                        <div class="row">
                                            <a href="/dashboard/rooms/{{ $room->slug }}/edit" class="btn mb-1 btn-warning ml-2"><i class="fa fa-edit"></i>
                                            </a>
                                            
                                            <form action="/dashboard/rooms/{{ $room->slug }}" method="post" class="d-inline">
                                                @method('delete')
                                                @csrf
                                                <button onclick="return confirm('Apakah anda ingin menghapus kelas: {{ $room->name }}?')" class="btn mb-1 btn-danger ml-2"><i class="fa fa-trash"></i>
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