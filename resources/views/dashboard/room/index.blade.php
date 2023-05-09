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
                                <h4>Daftar Kelas</h4>
                            </div>
                            <div class="col-lg-2">
                                <a href="/dashboard/rooms/create" type="submit" class="btn mb-1 mr-5 btn-primary">Tambah Kelas<span class="btn-icon-right"><i class="fa fa-plus-circle"></i></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive mt-4">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Jurusan</th>
                                    <th>Deskripsi</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rooms as $room)       
                                <tr>
                                    <th>{{ $loop->iteration }}</th>
                                    <td>{{ $room->name }}</td>
                                    <td>{{ $room->major }}</td>
                                    <td>{{ $room->description }}</td>
                                    <td> 
                                        <div class="row">
                                                <button type="button" class="btn mb-1 btn-warning ml-2"><i class="fa fa-edit"></i>
                                                </button>
                                                <button type="button" class="btn mb-1 btn-danger ml-2"><i class="fa fa-trash"></i>
                                            </button>
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