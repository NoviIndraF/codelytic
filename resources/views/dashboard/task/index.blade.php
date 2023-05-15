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
                                <h4>Daftar Tugas</h4>
                            </div>
                            <div class="col-lg-2">
                                <a href="/dashboard/tasks/create" type="submit" class="btn mb-1 mr-5 btn-primary">Tambah Tugas<span class="btn-icon-right"><i class="fa fa-plus-circle"></i></span>
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
                                    <th>#</th>
                                    <th>Judul</th>
                                    <th>Kelas</th>
                                    <th>Deskripsi</th>
                                    <th>Note</th>
                                    <th>Deadline</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tasks as $task)       
                                <tr>
                                    <th>{{ $loop->iteration }}</th>
                                    <td>{{ $task->title }}</td>
                                    <td>{{ $task->name }}</td>
                                    <td>{{ $task->description }}</td>
                                    <td>{{ $task->note }}</td>
                                    <td>{{ $task->deadline }}</td>
                                    <td>
                                        <form action="/dashboard/tasks/updateStatus" method="post">
                                            @csrf
                                                @if ( $task->status == 1)
                                                    <button type="submit" onclick="return confirm('Apakah anda ingin menonaktifkan tugash : {{ $task->title }}?')" class="btn mb-1 btn-rounded btn-success">Aktif</button>
                                                @else
                                                    <button type="submit" onclick="return confirm('Apakah anda ingin mengaktifkan tugash : {{ $task->title }}?')" class="btn mb-1 btn-rounded btn-danger">Nonaktif</button>
                                                @endif
                                                <input type="hidden" id="id" name="id" value="{{ $task->id }}">
                                        </form>
                                    </td>
                                    <td> 
                                        <div class="row">
                                            <a href="/dashboard/tasks/{{ $task->slug }}" class="btn mb-1 btn-primary ml-2"><i class="fa fa-eye"></i>
                                            </a>

                                            <a href="/dashboard/tasks/{{ $task->slug }}/edit" class="btn mb-1 btn-warning ml-2"><i class="fa fa-edit"></i>
                                            </a>
                                            
                                            <form action="/dashboard/tasks/{{ $task->slug }}" method="post" class="d-inline">
                                                @method('delete')
                                                @csrf
                                                <button onclick="return confirm('Apakah anda yakin ingin mengahapus tugas: {{ $task->title }}?')" class="btn mb-1 btn-danger ml-2"><i class="fa fa-trash"></i>
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