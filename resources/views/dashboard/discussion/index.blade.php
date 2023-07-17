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
                                <div class="card gradient-2">
                                    <div class="card-body">
                                        <h3 class="card-title text-white">Diskusi</h3>
                                        <div class="d-inline-block">
                                            <h2 class="text-white">{{ $count_discussions }}</h2>
                                        </div>
                                        <span class="float-right display-5 opacity-5"><i class="fa fa-file"></i></span>
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
                            <h4>Daftar Diskusi</h4>
                        </div>
                        <div class="col-lg-2">
                            <a href="/dashboard/discussions/create" type="submit" class="btn mb-1 mr-5 btn-primary">Tambah Diskusi<span class="btn-icon-right"><i class="fa fa-plus-circle"></i></span>
                            </a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered zero-configuration">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Judul</th>
                                    <th>Kelas</th>
                                    <th>Deskripsi</th>
                                    <th>Konten</th>
                                    <th>Jumlah Kelompok</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($discussions as $discussion)       
                                <tr>
                                    <th>{{ $loop->iteration }}</th>
                                    <td>{{ $discussion->title }}</td>
                                    <td>{{ $discussion->room->name }}</td>
                                    <td>{{ $discussion->description }}</td>
                                    <td>
                                        <form action="/dashboard/discussions/showContent" method="post">
                                            @csrf
                                                    <button type="submit" class="btn mb-1 btn-primary ml-2"><i class="fa fa-eye"></i></button>
                                                    <input type="hidden" id="content" name="content" value="{{ $discussion->content }}">
                                        </form>
                                    </td>
                                    <td>{{ $discussion->group->count() }}</td>
                                    <td>
                                        <form action="/dashboard/discussions/updateStatus" method="post">
                                            @csrf
                                                @if ( $discussion->status == 1)
                                                    <button type="submit" onclick="return confirm('Apakah anda ingin menonaktifkan diskusi : {{ $discussion->title }}?')" class="btn mb-1 btn-rounded btn-success">Aktif</button>
                                                @else
                                                    <button type="submit" onclick="return confirm('Apakah anda ingin mengaktifkan diskusi : {{ $discussion->title }}?')" class="btn mb-1 btn-rounded btn-danger">Nonaktif</button>
                                                @endif
                                                <input type="hidden" id="id" name="id" value="{{ $discussion->id }}">
                                        </form>
                                    </td>
                                    <td> 
                                        <div class="row">
                                            <a href="/dashboard/discussions/{{ $discussion->slug }}" class="btn mb-1 btn-primary ml-2"><i class="fa fa-eye"></i>
                                            </a>

                                            <a href="/dashboard/discussions/{{ $discussion->slug }}/edit" class="btn mb-1 btn-warning ml-2"><i class="fa fa-edit"></i>
                                            </a>
                                            
                                            <form action="/dashboard/discussions/{{ $discussion->slug }}" method="post" class="d-inline">
                                                @method('delete')
                                                @csrf
                                                <button onclick="return confirm('Apakah anda yakin ingin mengahapus diskusi: {{ $discussion->title }}?')" class="btn mb-1 btn-danger ml-2"><i class="fa fa-trash"></i>
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